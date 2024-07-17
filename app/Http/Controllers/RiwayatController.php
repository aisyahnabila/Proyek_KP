<?php

namespace App\Http\Controllers;

use App\Models\LogUser;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $logUsers = LogUser::with('user')->get();

        return view('riwayat', compact('logUsers'));
    }
}
