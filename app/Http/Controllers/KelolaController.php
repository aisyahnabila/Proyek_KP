<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

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


    public function search(Request $request)
    {
        $search = $request->input('search');

        $barangs = Barang::where('nama_barang', 'like', "%{$search}%")
            ->orWhere('kode_barang', 'like', "%{$search}%")
            ->orWhere('spesifikasi_nama_barang', 'like', "%{$search}%")
            ->get();

        return view('kelola.partials.barang_table', compact('barangs'));
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
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_barang' => 'required',
            'spesifikasi_nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
        ]);

        Barang::create($request->all());

        // Set flash message
        return redirect()->route('barang.index')->with('Berhasil', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // manampilkan detail barang
    public function show($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        return view('barang.show', compact('barang'));
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
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    public function showForm()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

}
