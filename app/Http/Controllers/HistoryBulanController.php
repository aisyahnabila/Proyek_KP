<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\UnitKerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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

        $permintaan = $query->with('detailPermintaan.barang.kategori', 'unitKerja')->get();

        // Mengelompokkan data berdasarkan barang
        $groupedPermintaan = $permintaan->groupBy('detailPermintaan.barang_id');

        return view('laporan.bulan', [
            'permintaan' => $groupedPermintaan,
            'unitKerjaOptions' => UnitKerja::all(),
        ]);
    }

    public function historyBulan(Request $request)
    {
        $unitKerja = $request->input('unit_kerja');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $results = DB::table('permintaan')
            ->join('detail_permintaan', 'permintaan.id', '=', 'detail_permintaan.permintaan_id')
            ->join('barang', 'detail_permintaan.barang_id', '=', 'barang.id')
            ->join('unit_kerja', 'permintaan.id_unitkerja', '=', 'unit_kerja.id') // Perbaiki disini
            ->select('unit_kerja.nama_unit_kerja', 'barang.kode_barang', 'barang.nama_barang', DB::raw('SUM(detail_permintaan.jumlah_permintaan) as total_jumlah'))
            ->when($unitKerja, function ($query, $unitKerja) {
                return $query->where('permintaan.id_unitkerja', $unitKerja); // Sesuaikan disini juga
            })
            ->whereMonth('permintaan.tanggal_permintaan', $bulan)
            ->whereYear('permintaan.tanggal_permintaan', $tahun)
            ->groupBy('unit_kerja.nama_unit_kerja', 'barang.kode_barang', 'barang.nama_barang')
            ->get();

        return view('bulan', compact('results')); // Pastikan view ini benar
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
