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
        $groupedPermintaan = $permintaan->flatMap(function ($item) {
            return $item->detailPermintaan->map(function ($detail) use ($item) {
                return [
                    'bulan' => \Carbon\Carbon::parse($item->tanggal_permintaan)->translatedFormat('F Y'),
                    'unit_kerja' => $item->unitKerja->nama_unit_kerja,
                    'kode_barang' => $detail->barang->kategori->kode_barang,
                    'nama_barang' => $detail->barang->nama_barang,
                    'spesifikasi_nama_barang' => $detail->barang->spesifikasi_nama_barang,
                    'total_permintaan' => (int) $detail->jumlah_permintaan,
                    'jumlah' => $detail->barang->jumlah,
                    'satuan' => $detail->barang->satuan,
                    'keperluan' => $item->keperluan,
                ];
            });
        })->groupBy(function ($item) {
            return $item['unit_kerja'] . '-' . $item['bulan'] . '-' . $item['nama_barang'] . '-' . $item['spesifikasi_nama_barang'];
        })->map(function ($group) {
            $first = $group->first();
            $first['total_permintaan'] = $group->sum(function ($item) {
                return (int) $item['total_permintaan'];
            });
            return $first;
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

        // Group and aggregate data
        $details = $permintaan->flatMap->detailPermintaan;
        $groupedDetails = $details->groupBy(function ($detail) {
            return $detail->permintaan->unitKerja->nama_unit_kerja . '-' . \Carbon\Carbon::parse($detail->permintaan->tanggal_permintaan)->format('F Y') . '-' . $detail->barang->nama_barang . '-' . $detail->barang->spesifikasi_nama_barang;
        })->map(function ($group) {
            $first = $group->first();
            $first->jumlah_permintaan = $group->sum(function ($detail) {
                return (int) $detail->jumlah_permintaan;
            });
            return $first;
        });

        // mengisi placeholder dengan data yang sudah difilter
        $templateProcessor->setValue('unit_kerja', $permintaan->first()->unitKerja->nama_unit_kerja ?? 'Semua Unit Kerja');
        $templateProcessor->setValue('bulan', $bulan);
        $templateProcessor->setValue('tahun', $tahun);

        // menambahkan tanggal cetak
        $tanggalCetak = Carbon::now()->format('d-m-Y');
        $templateProcessor->setValue('tanggal_cetak', $tanggalCetak);

        // loop through grouped details and fill in the table
        $templateProcessor->cloneRow('kode_barang', $groupedDetails->count());
        foreach ($groupedDetails->values() as $index => $detail) {
            $index = $index + 1; // Adjusting index to start from 1

            $stok_awal = $detail->barang->jumlah + $detail->jumlah_permintaan;
            $sisa_persediaan = $stok_awal - $detail->jumlah_permintaan;
            $usulan_pengajuan_persetujuan = $detail->jumlah_permintaan;

            $templateProcessor->setValue("no#{$index}", $index);
            $templateProcessor->setValue("unit_kerja#{$index}", $detail->permintaan->unitKerja->nama_unit_kerja);
            $templateProcessor->setValue("kode_barang#{$index}", $detail->barang->kategori->kode_barang);
            $templateProcessor->setValue("nama_barang#{$index}", $detail->barang->nama_barang);
            $templateProcessor->setValue("spesifikasi_nama_barang#{$index}", $detail->barang->spesifikasi_nama_barang);
            $templateProcessor->setValue("total_permintaan#{$index}", $detail->jumlah_permintaan);
            $templateProcessor->setValue("stok_awal#{$index}", $stok_awal);
            // $templateProcessor->setValue("jumlah#{$index}", $detail->barang->jumlah);
            $templateProcessor->setValue("jumlah#{$index}", $sisa_persediaan);
            $templateProcessor->setValue("usulan_pengajuan_persetujuan#{$index}", $usulan_pengajuan_persetujuan);
            $templateProcessor->setValue("satuan#{$index}", $detail->barang->satuan);
            $templateProcessor->setValue("keperluan#{$index}", $detail->permintaan->keperluan);
        }

        // save file baru
        $fileName = 'SPB_' . $tanggalCetak . '.docx';
        $tempFilePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempFilePath);
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }
}
