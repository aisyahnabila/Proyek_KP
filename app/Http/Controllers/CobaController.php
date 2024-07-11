<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index(){
        return view('barang.edit');
    }

    public function detail(){
        return view('barang.history');
    }
}
