<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryPermintaanController extends Controller
{
    public function index(){
        return view('laporan.permintaan');
    }
}
