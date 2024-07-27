<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

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

    public function exportToWord(Request $request)
    {
        // path ke template
        $templatePath = public_path('templates/template_surat_permintaan_barang.docx');

        // buat instance TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // mengambil data dari filter
        $unit_kerja = $request->input('unit_kerja');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // simpan data yang sudah difilter dari database
        $permintaan = Permintaan::when($unit_kerja, function ($query, $unit_kerja) {
            return $query->where('id_unitkerja', $unit_kerja);
        })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('tanggal_permintaan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tanggal_permintaan', $tahun);
            })
            ->with('detailPermintaan.barang.kategori', 'unitKerja')
            ->get();

        // mengisi placeholder dengan data yang sudah difilter
        $templateProcessor->setValue('unit_kerja', $permintaan->first()->unitKerja->nama_unit_kerja ?? 'Semua Unit Kerja');
        $templateProcessor->setValue('bulan', $bulan);
        $templateProcessor->setValue('tahun', $tahun);

        // menambahkan tanggal cetak
        $tanggalCetak = Carbon::now()->format('d-m-Y');
        $templateProcessor->setValue('tanggal_cetak', $tanggalCetak);

        // loop through permintaan and fill in the table
        $templateProcessor->cloneRow('kode_barang', $permintaan->count());
        foreach ($permintaan as $index => $item) {
            $index += 1;
            $templateProcessor->setValue("no#{$index}", $index);
            $templateProcessor->setValue("unit_kerja#{$index}", $item->unitKerja->nama_unit_kerja);
            $templateProcessor->setValue("kode_barang#{$index}", $item->detailPermintaan->first()->barang->kategori->kode_barang);
            $templateProcessor->setValue("nama_barang#{$index}", $item->detailPermintaan->first()->barang->nama_barang);
            $templateProcessor->setValue("spesifikasi_nama_barang#{$index}", $item->detailPermintaan->first()->barang->spesifikasi_nama_barang);
            $templateProcessor->setValue("total_permintaan#{$index}", $item->detailPermintaan->sum('jumlah_permintaan'));
            $templateProcessor->setValue("jumlah#{$index}", $item->detailPermintaan->first()->barang->jumlah);
            $templateProcessor->setValue("satuan#{$index}", $item->detailPermintaan->first()->barang->satuan);
            $templateProcessor->setValue("keperluan#{$index}", $item->keperluan);
        }

        // save file baru
        $fileName = 'SPB_' . $tanggalCetak . '.docx';
        $tempFilePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempFilePath);
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}
