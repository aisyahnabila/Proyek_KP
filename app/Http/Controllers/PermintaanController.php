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
        return redirect()->route('historypermintaan.index')->with('success', 'Permintaan barang berhasil disimpan.');
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
}
