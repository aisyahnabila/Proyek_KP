<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\LogActivity;
use App\Models\UnitKerja;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Models\DetailPermintaan;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permintaans = Permintaan::with('detailPermintaan')->get();
        $items = Barang::all();
        return view('permintaan.index', compact('permintaans', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit_kerja = UnitKerja::all();
        return view('permintaan.create', compact('unit_kerja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'unit_kerja' => 'required|exists:unit_kerja,id_unitkerja',
            'nama_pemohon' => 'required|string|max:255',
            'keperluan' => 'required|string',
            'evidence' => 'required|file|mimes:jpeg,png,pdf|max:5240', // 5MB = 5240KB
        ], [
            'evidence.max' => 'File evidence tidak boleh lebih dari 5MB.'
        ]);

        // Generate kode permintaan
        $latestPermintaan = Permintaan::latest()->first();
        if ($latestPermintaan) {
            $lastCode = $latestPermintaan->kode_permintaan;
            $lastNumber = (int) substr($lastCode, strpos($lastCode, '-') + 1);
            $nextNumber = $lastNumber + 1;
            $nextCode = substr($lastCode, 0, strpos($lastCode, '-') + 1) . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $nextCode = 'A-001'; // Jika belum ada data, mulai dari A-001
        }

        // Simpan file evidence
        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/evidence', $filename);
        } else {
            return redirect()->back()->withInput()->withErrors(['evidence' => 'File evidence harus diunggah.']);
        }

        // Simpan data permintaan barang ke dalam database
        $permintaan = Permintaan::create([
            'kode_permintaan' => $nextCode,
            'tanggal_permintaan' => now(),
            'id_unitkerja' => $validatedData['unit_kerja'],
            'nama_pemohon' => $validatedData['nama_pemohon'],
            'keperluan' => $validatedData['keperluan'],
            'evidence' => $filename,
        ]);

        // Pastikan bahwa penyimpanan berhasil
        if (!$permintaan->save()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan permintaan barang.']);
        }

        // Ambil ID permintaan setelah disimpan
        $permintaanID = $permintaan->id_permintaan;

        // Simpan detail barang ke dalam database
        if ($request->has('cartItems')) {
            $cartItems = json_decode($request->cartItems, true); // Decode JSON ke array asosiatif
            foreach ($cartItems as $item) {
                $detailBarang = new DetailPermintaan();
                $detailBarang->id_permintaan = $permintaanID; // Gunakan id yang baru disimpan
                $detailBarang->id_barang = $item['id']; // Ambil id barang dari setiap item
                $detailBarang->jumlah_permintaan = $item['jumlah']; // Sesuaikan dengan struktur data Anda
                // Anda bisa tambahkan logika validasi jumlah permintaan atau lainnya di sini
                $detailBarang->save();

                // Catat log aktivitas jumlah keluar
                $barang = Barang::find($item['id']);
                $currentStock = $barang->jumlah - $item['jumlah'];

                LogActivity::create([
                    'id_barang' => $item['id'],
                    'timestamp' => now(),
                    'jumlah_masuk' => 0,
                    'jumlah_keluar' => $item['jumlah'],
                    'sisa' => $currentStock,
                ]);

                // Update jumlah barang di tabel Barang
                $barang->jumlah = $currentStock;
                $barang->save();
            }
        }

        // Redirect atau kembalikan response sesuai kebutuhan
        return redirect()->route('permintaan.index')->with('success', 'Permintaan barang berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
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

        // Mengatur locale ke bahasa Indonesia
        Carbon::setLocale('id');
        // Konversi tanggal_permintaan menjadi objek Carbon
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
            $templateProcessor->setValue("barang_nama#{$rowIndex}", $detail->barang->nama_barang);
            $templateProcessor->setValue("jumlah#{$rowIndex}", $detail->jumlah_permintaan);
            $templateProcessor->setValue("satuan#{$rowIndex}", $detail->barang->satuan);
            $templateProcessor->setValue("keperluan#{$rowIndex}", $permintaan->keperluan);
            $templateProcessor->setValue("keterangan#{$rowIndex}", $detail->keterangan);
        }

        // Save file baru
        $fileName = 'Nota_Permintaan_Barang_' . $permintaan->kode_permintaan . '.docx';
        $tempFilePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($tempFilePath);

        // Return file sebagai download response
        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }

}
