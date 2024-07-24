<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

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


    public function exportToWord(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $divisi = $request->input('divisi');

        $permintaan = Permintaan::when($bulan, function ($query, $bulan) {
            return $query->whereMonth('tanggal_permintaan', $bulan);
        })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tanggal_permintaan', $tahun);
            })
            ->when($divisi, function ($query, $divisi) {
                return $query->where('unit_kerja_id', $divisi);
            })
            ->with('detailPermintaan.barang.kategori', 'unitKerja')
            ->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Laporan Bulanan Permintaan Barang");
        $section->addText("Divisi: " . ($permintaan->first()->unitKerja->nama_unit_kerja ?? 'Semua Divisi'));
        $section->addText("Bulan: " . \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y'));

        $table = $section->addTable();

        $table->addRow();
        $table->addCell()->addText('Bulan');
        $table->addCell()->addText('Unit Kerja');
        $table->addCell()->addText('Kode Barang');
        $table->addCell()->addText('Nama Barang');
        $table->addCell()->addText('Spesifikasi Nama Barang');
        $table->addCell()->addText('Jumlah Pengajuan Permintaan');
        $table->addCell()->addText('Informasi Sisa Persediaan');
        $table->addCell()->addText('Satuan');
        $table->addCell()->addText('Keperluan');

        foreach ($permintaan as $item) {
            $table->addRow();
            $table->addCell()->addText(\Carbon\Carbon::parse($item->tanggal_permintaan)->translatedFormat('F Y'));
            $table->addCell()->addText($item->unitKerja->nama_unit_kerja);
            $table->addCell()->addText($item->detailPermintaan->first()->barang->kategori->kode_barang);
            $table->addCell()->addText($item->detailPermintaan->first()->barang->nama_barang);
            $table->addCell()->addText($item->detailPermintaan->first()->barang->spesifikasi_nama_barang);
            $table->addCell()->addText($item->detailPermintaan->sum('jumlah_permintaan'));
            $table->addCell()->addText($item->detailPermintaan->first()->barang->jumlah);
            $table->addCell()->addText($item->detailPermintaan->first()->barang->satuan);
            $table->addCell()->addText($item->keperluan);
        }

        $fileName = 'template_surat_permintaan_barang.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

}
