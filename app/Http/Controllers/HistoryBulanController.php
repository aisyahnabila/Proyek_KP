<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\UnitKerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HistoryBulanController extends Controller
{
    public function index(Request $request)
    {
        $unit_kerja = $request->input('unit_kerja');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Permintaan::query();

        if ($unit_kerja) {
            $query->where('id_unitkerja', $unit_kerja);
        }

        if ($bulan) {
            $query->whereMonth('tanggal_permintaan', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_permintaan', $tahun);
        }

        //
        $permintaan = $query->with('detailPermintaan.barang.kategori', 'unitKerja')
            ->get()
            ->groupBy(function ($item) {
                // Mengelompokkan berdasarkan id_unitkerja,barang_id, dan spesifikasi_nama_barang
                return $item->id_unitkerja . '-' . $item->detailPermintaan->first()->barang_id . '-' . $item->detailPermintaan->first()->barang->spesifikasi_nama_barang;
            });

        // Mengelompokkan data dan menjumlahkan permintaan berdasarkan divisi dan barang
        $groupedPermintaan = [];
        foreach ($permintaan as $group => $items) {
            $totalPermintaan = 0;
            foreach ($items as $item) {
                foreach ($item->detailPermintaan as $detail) {
                    $totalPermintaan += $detail->jumlah_permintaan;
                }
            }
            // Konversi tanggal_permintaan menjadi objek Carbon
            $firstItem = $items->first();
            Carbon::setLocale('id');
            $groupedPermintaan[] = [
                'bulan' => \Carbon\Carbon::parse($firstItem->tanggal_permintaan)->translatedFormat('F'),
                'unit_kerja' => $firstItem->unitKerja->nama_unit_kerja,
                'kode_barang' => $firstItem->detailPermintaan->first()->barang->kategori->kode_barang,
                'nama_barang' => $firstItem->detailPermintaan->first()->barang->nama_barang,
                'spesifikasi_nama_barang' => $firstItem->detailPermintaan->first()->barang->spesifikasi_nama_barang,
                'total_permintaan' => $totalPermintaan,
                'jumlah' => $firstItem->detailPermintaan->first()->barang->jumlah,
                'satuan' => $firstItem->detailPermintaan->first()->barang->satuan,
                'keperluan' => $firstItem->keperluan,
            ];
        }

        return view('laporan.bulan', [
            'permintaan' => $groupedPermintaan,
            'unitKerjaOptions' => UnitKerja::all(),
        ]);
    }

    public function laporanBulanan(Request $request)
    {
        $unit_kerja_id = $request->input('unit_kerja_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $permintaan = DB::table('permintaan')
            ->join('detail_permintaan', 'permintaan.id', '=', 'detail_permintaan.permintaan_id')
            ->join('barang', 'detail_permintaan.barang_id', '=', 'barang.id')
            ->join('unit_kerja', 'permintaan.unit_kerja_id', '=', 'unit_kerja.id')
            ->select(
                'unit_kerja.nama_unit_kerja',
                'barang.kategori.kode_barang',
                'barang.nama_barang',
                'barang.spesifikasi_nama_barang',
                'barang.satuan',
                'permintaan.keperluan',
                DB::raw('SUM(detail_permintaan.jumlah_permintaan) as total_permintaan'),
                'barang.jumlah as sisa_persediaan' //jumlah barang yang tersisa

            )
            ->where('permintaan.unit_kerja_id', $unit_kerja_id)
            ->whereMonth('permintaan.tanggal_permintaan', $bulan)
            ->whereYear('permintaan.tanggal_permintaan', $tahun)
            ->groupBy('unit_kerja.nama_unit_kerja', 'barang.kategori.kode_barang', 'barang.nama_barang', 'barang.spesifikasi_nama_barang', 'barang.satuan')
            ->orderBy('unit_kerja.nama_unit_kerja')
            ->get();

        return view('laporan.bulanan', compact('permintaan'));
    }

    public function exportPdf(Request $request)
    {
        $unitKerja = $request->input('unit_kerja');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Permintaan::with(['detailPermintaan.barang', 'unitKerja'])
            ->when($unitKerja, function ($query, $unitKerja) {
                return $query->where('id_unitkerja', $unitKerja);
            })
            ->whereMonth('tanggal_permintaan', $bulan)
            ->whereYear('tanggal_permintaan', $tahun)
            ->get();

        $permintaan = $query->groupBy('id_unitkerja');

        $pdf = Pdf::loadView('exports.permintaan_pdf', compact('permintaan'));
        return $pdf->download('Laporan_Bulanan.pdf');
    }
}
