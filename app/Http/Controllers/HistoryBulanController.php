<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryBulanController extends Controller
{
    public function index(){
        return view('laporan.bulan');
    }
}
