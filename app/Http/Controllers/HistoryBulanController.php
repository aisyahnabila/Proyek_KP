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

        // Get all permintaan with related models
        $permintaan = $query->with('detailPermintaan.barang.kategori', 'unitKerja')->get();

        // Group and transform data
        $groupedPermintaan = $permintaan->map(function ($item) {
            $totalPermintaan = $item->detailPermintaan->sum('jumlah_permintaan');
            Carbon::setLocale('id');

            return [
                'bulan' => \Carbon\Carbon::parse($item->tanggal_permintaan)->translatedFormat('F Y'),
                'unit_kerja' => $item->unitKerja->nama_unit_kerja,
                'kode_barang' => $item->detailPermintaan->first()->barang->kategori->kode_barang,
                'nama_barang' => $item->detailPermintaan->first()->barang->nama_barang,
                'spesifikasi_nama_barang' => $item->detailPermintaan->first()->barang->spesifikasi_nama_barang,
                'total_permintaan' => $totalPermintaan,
                'jumlah' => $item->detailPermintaan->first()->barang->jumlah,
                'satuan' => $item->detailPermintaan->first()->barang->satuan,
                'keperluan' => $item->keperluan,
            ];
        });

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

        $query = DB::table('permintaan')
            ->join('detail_permintaan', 'permintaan.id', '=', 'detail_permintaan.permintaan_id')
            ->join('barang', 'detail_permintaan.barang_id', '=', 'barang.id')
            ->join('unit_kerja', 'permintaan.unit_kerja_id', '=', 'unit_kerja.id')
            ->select(
                DB::raw('DATE_FORMAT(permintaan.tanggal_permintaan, "%M") as bulan'),
                // DB::raw('YEAR(permintaan.tanggal_permintaan) as tahun'),
                'unit_kerja.nama_unit_kerja',
                'barang.kategori.kode_barang',
                'barang.nama_barang',
                'barang.spesifikasi_nama_barang',
                'barang.satuan',
                'permintaan.keperluan',
                DB::raw('SUM(detail_permintaan.jumlah_permintaan) as total_permintaan'),
                'barang.jumlah as sisa_persediaan'
            );

        if ($unit_kerja_id) {
            $query->where('permintaan.unit_kerja_id', $unit_kerja_id);
        }

        if ($bulan) {
            $query->whereMonth('permintaan.tanggal_permintaan', $bulan);
        }

        if ($tahun) {
            $query->whereYear('permintaan.tanggal_permintaan', $tahun);
        }

        $permintaan = $query
            ->groupBy('bulan', 'unit_kerja.nama_unit_kerja', 'barang.kategori.kode_barang', 'barang.nama_barang', 'barang.spesifikasi_nama_barang', 'barang.satuan')
            ->orderBy('tahun')
            ->orderBy('bulan')
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
