<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class HistoryPermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with('detailPermintaan', 'unitKerja')->orderBy('created_at', 'desc')->get();
        return view('laporan.permintaan', compact('permintaans'));
    }

<<<<<<< HEAD
    public function exportWord($id)
    {
        // Path ke template Word
        $templatePath = public_path('templates/templete_nota_permintaan_barang.docx');

        // Verifikasi apakah file template ada
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template file not found'], 404);
=======
    public function exportWord($id, $type)
    {
        // Path ke template berdasarkan tipe dokumen
        $templatePath = '';
        switch ($type) {
            case 'nota_permintaan':
                $templatePath = base_path('public/templates/templete_nota_permintaan_barang.docx');
                break;
            case 'penyaluran':
                $templatePath = base_path('public/templates/template_penyaluran.docx');
                break;
            case 'spb':
                $templatePath = base_path('public/templates/template_spb2.docx');
                break;
            default:
                return response()->json(['error' => 'Invalid document type'], 400);
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
        }

        // Buat instance TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Ambil data permintaan berdasarkan ID
        $permintaan = Permintaan::with('detailPermintaan.barang', 'unitKerja')->findOrFail($id);

<<<<<<< HEAD

        // Konversi tanggal_permintaan menjadi objek Carbon
        $tanggalPermintaan = Carbon::parse($permintaan->tanggal_permintaan);
=======
        // Konversi tanggal_permintaan menjadi objek Carbon
        $tanggalPermintaan = \Carbon\Carbon::parse($permintaan->tanggal_permintaan);
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
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
<<<<<<< HEAD
            $templateProcessor->setValue("barang_nama#{$rowIndex}", $detail->barang->nama_barang);
            $templateProcessor->setValue("jumlah#{$rowIndex}", $detail->jumlah_permintaan);
=======
            $templateProcessor->setValue("kode_barang#{$rowIndex}", $detail->barang->kategori->kode_barang);
            $templateProcessor->setValue("barang_nama#{$rowIndex}", $detail->barang->nama_barang);
            $templateProcessor->setValue("spesifikasi_nama_barang#{$rowIndex}", $detail->barang->spesifikasi_nama_barang);
            $templateProcessor->setValue("stok_awal#{$rowIndex}", $detail->stok_awal);//saldo awal sebelum barang dikurang dengan jumlah permintaan
            $templateProcessor->setValue("jumlah#{$rowIndex}", $detail->jumlah_permintaan); //jumlah permintaan yang diinputkan oleh user
            $templateProcessor->setValue("usulan_pengajuan_persetujuan#{$rowIndex}", $detail->jumlah_permintaan); //disamakan dengan jumlah permintaan yang diinputkan oleh user
            $templateProcessor->setValue("sisa_persediaan#{$rowIndex}", $detail->saldo_akhir);
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
            $templateProcessor->setValue("satuan#{$rowIndex}", $detail->barang->satuan);
            $templateProcessor->setValue("keperluan#{$rowIndex}", $permintaan->keperluan);
            $templateProcessor->setValue("keterangan#{$rowIndex}", $detail->keterangan);
        }

        // Save file baru
<<<<<<< HEAD
        $fileName = 'Nota_Permintaan_Barang_' . $permintaan->kode_permintaan . '.docx';
=======
        $fileName = ucfirst($type) . '_Permintaan_Barang_' . $permintaan->kode_permintaan . '.docx';
>>>>>>> 94c9f7ef75db53ef6dff63cf4b8e6bdf805dbcd0
        $tempFilePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempFilePath);
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}
