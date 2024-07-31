<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportBarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BarangImport;

class KelolaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // tampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // tampilkan form untuk menambah barang
    public function create()
    {

        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // simpan barang baru
    public function store(Request $request, )
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required',
            'spesifikasi_nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
        ], [
            'required' => 'Masukkan data :attribute',
            'id_kategori.required' => 'Masukkan kode barang',
        ]);

        $barang = Barang::create($request->all());

        // Log activity
        LogActivity::create([
            'id_barang' => $barang->id_barang,
            'timestamp' => now(),
            'jumlah_masuk' => $barang->jumlah,
            'jumlah_keluar' => 0,
            'sisa' => $barang->jumlah,
        ]);

        // Set flash message
        return redirect()->route('barang.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // manampilkan detail barang
    public function show($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $log_activities = LogActivity::where('id_barang', $id_barang)->get();

        return view('barang.history', compact('barang', 'log_activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // menampilkan form untuk mengedit barang
    public function edit(Barang $barang)
    {
        if ($barang->jumlah != 0) {
            return redirect()->route('barang.index')->with('error', 'Stok barang belum habis.');
        }
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    // update hanya untuk jumlah ketika nilai barang adalah 0
    public function update(Request $request, Barang $barang)
    {
        // Pastikan hanya update ketika jumlah barang adalah 0
        if ($barang->jumlah != 0) {
            return redirect()->route('barang.index')->with('error', 'Stok barang belum habis.');
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang->update(['jumlah' => $request->jumlah]);
        return redirect()->route('barang.index')->with('success', 'Jumlah barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        // $barang->delete();
        // return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus']);
    }

    public function showForm()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    public function showTambahJumlahForm($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function tambahJumlah(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->jumlah += $request->jumlah;
        $barang->save();

        LogActivity::create([
            'id_barang' => $barang->id_barang,
            'timestamp' => now(),
            'jumlah_masuk' => $request->jumlah,
            'jumlah_keluar' => 0, // Jumlah keluar tetap 0 karena ini adalah penambahan stok
            'sisa' => $barang->jumlah,
        ]);

        return redirect()->route('kelola.index')->with('success', 'Jumlah barang berhasil ditambahkan');
    }

    public function import(ImportBarangRequest $request)
    {
        // Import the file
        Excel::import(new BarangImport, $request->file('file'));

        return redirect()->back()->with('success', 'Goods imported successfully.');
    }
}
