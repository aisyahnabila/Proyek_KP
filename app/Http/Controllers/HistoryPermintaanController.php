<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

class HistoryPermintaanController extends Controller
{
    public function index(){
        $permintaans = Permintaan::with('detailPermintaan', 'unitKerja')->get();
        return view('laporan.permintaan', compact('permintaans'));
    }
}

