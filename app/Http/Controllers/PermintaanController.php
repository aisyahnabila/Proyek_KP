<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\LogActivity;
use App\Models\UnitKerja;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Models\DetailPermintaan;
use RealRashid\SweetAlert\Facades\Alert;

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
            'evidence' => 'nullable|file|mimes:jpeg,png,pdf|max:5240', // 5MB = 5240KB
        ], [
            'evidence.max' => 'File evidence tidak boleh lebih dari 5MB.',
            'required' => 'Masukkan data :attribute',
        ]);

        // Cek duplikasi berdasarkan unit_kerja, nama_pemohon, dan tanggal_permintaan
        $duplicate = Permintaan::where('id_unitkerja', $validatedData['unit_kerja'])
            ->where('nama_pemohon', $validatedData['nama_pemohon'])
            ->whereDate('tanggal_permintaan', now()->subSeconds(20))
            ->first();

        if ($duplicate) {
            // Hapus permintaan duplikat dan rollback stok
            $this->rollbackStock($duplicate->id_permintaan);
            $duplicate->delete();
        }

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

        // Simpan file evidence jika ada
        $filename = null;
        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/evidence', $filename);
        }

        // Simpan data permintaan barang ke dalam database
        $permintaan = Permintaan::create([
            'kode_permintaan' => $nextCode,
            'tanggal_permintaan' => now(),
            'id_unitkerja' => $validatedData['unit_kerja'],
            'nama_pemohon' => $validatedData['nama_pemohon'],
            'keperluan' => $validatedData['keperluan'],
            'evidence' => $filename, // Bisa bernilai null jika evidence tidak diunggah
        ]);

        // Pastikan bahwa penyimpanan berhasil
        if (!$permintaan->save()) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan permintaan barang.']);
        }

        // Ambil ID permintaan setelah disimpan
        $permintaanID = $permintaan->id_permintaan;
        \Log::info('Permintaan ID:', ['id' => $permintaanID]);

        // Simpan detail barang ke dalam database
        if ($request->has('cartItems')) {
            $cartItems = json_decode($request->cartItems, true); // Decode JSON ke array asosiatif

            foreach ($cartItems as $item) {
                if (isset($item['id']) && isset($item['jumlahDiKeranjang'])) {
                    $detailBarang = new DetailPermintaan();
                    $detailBarang->id_permintaan = $permintaanID; // Gunakan id yang baru disimpan
                    $detailBarang->id_barang = $item['id']; // Ambil id barang dari setiap item
                    $detailBarang->jumlah_permintaan = $item['jumlahDiKeranjang']; // Sesuaikan dengan struktur data Anda
                    $detailBarang->save();

                    // Catat log aktivitas jumlah keluar
                    $barang = Barang::find($item['id']);
                    if ($barang) {
                        $currentStock = $barang->jumlah - $item['jumlahDiKeranjang']; // Kurangi stok dengan jumlahDiKeranjang

                        LogActivity::create([
                            'id_barang' => $item['id'],
                            'timestamp' => now(),
                            'jumlah_masuk' => 0,
                            'jumlah_keluar' => $item['jumlahDiKeranjang'], // Ambil jumlah dari jumlahDiKeranjang
                            'sisa' => $currentStock,
                        ]);

                        // Update jumlah barang di tabel Barang
                        $barang->jumlah = $currentStock;
                        $barang->save();
                    }
                }
            }
        }

        // Show a success alert
        Alert::success('Berhasil', 'Permintaan barang berhasil dibuat.');

        // Redirect atau kembalikan response sesuai kebutuhan
        return redirect()->route('historypermintaan.index');
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

    // fungsi ini hanya akan digunakan ada data permintaan barang yang diinputkan oleh user duplikat karena kesalahan klik.
    private function rollbackStock($permintaanId)
    {
        $permintaan = Permintaan::with('detailPermintaan')->find($permintaanId);
        if ($permintaan) {
            foreach ($permintaan->detailPermintaan as $detail) {
                $barang = Barang::find($detail->id_barang);
                if ($barang) {
                    $barang->jumlah += $detail->jumlah_permintaan;
                    $barang->save();

                    // Catat log aktivitas jumlah masuk
                    LogActivity::create([
                        'id_barang' => $detail->id_barang,
                        'timestamp' => now(),
                        'jumlah_masuk' => $detail->jumlah_permintaan,
                        'jumlah_keluar' => 0,
                        'sisa' => $barang->jumlah,
                    ]);
                }
            }
        }
    }
}
