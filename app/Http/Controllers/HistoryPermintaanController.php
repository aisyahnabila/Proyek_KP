<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class HistoryPermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with('detailPermintaan', 'unitKerja')->get();
        return view('laporan.permintaan', compact('permintaans'));
    }

    public function exportWord($id)
    {
        // Path ke template Word
        $templatePath = resource_path('views/templete_nota_permintaan_barang.docx');

        // Verifikasi apakah file template ada
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template file not found'], 404);
        }

        // Buat instance TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Ambil data permintaan berdasarkan ID
        $permintaan = Permintaan::with('detailPermintaan.barang', 'unitKerja')->findOrFail($id);


        // Konversi tanggal_permintaan menjadi objek Carbon
        Carbon::setLocale('id');
        $tanggalPermintaan = Carbon::parse($permintaan->tanggal_permintaan);
        // Format tanggal dalam bahasa Indonesia
        $formattedDate = $tanggalPermintaan->translatedFormat('d F Y');

        // Set value dari placeholder di template
        $templateProcessor->setValue('tanggal_permintaan', $formattedDate);
        $templateProcessor->setValue('unit_kerja', $permintaan->unitKerja->nama_unit_kerja);
        $templateProcessor->setValue('nama_pemohon', $permintaan->nama_pemohon);

        // Set value untuk detail permintaan (tabel)
        $templateProcessor->cloneRow('no', $permintaan->detailPermintaan->count());

        foreach ($permintaan->detailPermintaan as $index => $detail) {
            $rowIndex = $index + 1;
            $templateProcessor->setValue("no#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("barang_nama#{$rowIndex}", $detail->barang->spesifikasi_nama_barang);
            $templateProcessor->setValue("jumlah#{$rowIndex}", $detail->jumlah_permintaan);
            $templateProcessor->setValue("satuan#{$rowIndex}", $detail->barang->satuan);
            $templateProcessor->setValue("keperluan#{$rowIndex}", $permintaan->keperluan);
            $templateProcessor->setValue("keterangan#{$rowIndex}", $detail->keterangan);
        }

        // Save file baru
        $fileName = 'Nota_Permintaan_Barang_' . $permintaan->kode_permintaan . '.docx';
        $tempFilePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempFilePath);
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}

