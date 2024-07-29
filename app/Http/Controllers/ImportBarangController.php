<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportBarangRequest;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportBarangController extends Controller
{
    public function import(ImportBarangRequest $request)
    {

        // Debugging: log file details
        \Log::info('File details: ', [
            'file' => $request->file('file')->getClientOriginalName(),
            'mime' => $request->file('file')->getClientMimeType(),
            'size' => $request->file('file')->getSize(),
        ]);

        Excel::import(new BarangImport, $request->file('file'));

        return redirect()->route('kelola.index')->with('success', 'Data barang berhasil diimpor.');
    }
}
