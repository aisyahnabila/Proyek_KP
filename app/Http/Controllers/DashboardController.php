<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Permintaan;
use App\Models\UnitKerja;
use App\Models\DetailPermintaan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Get the top requested items by category
        $topItems = DetailPermintaan::select('barang.id_kategori', 'kategori.nama_kode_barang', DB::raw('SUM(jumlah_permintaan) as total_requests'))
            ->join('barang', 'detail_permintaan.id_barang', '=', 'barang.id_barang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->groupBy('barang.id_kategori', 'kategori.nama_kode_barang')
            ->orderBy('total_requests', 'desc')
            ->limit(9) // Limit to top 9 categories
            ->get();

        // Prepare data for the chart
        $categories = $topItems->pluck('nama_kode_barang');
        $requestCounts = $topItems->pluck('total_requests');

        // Prepare data for the top requested items chart
        $topCategories = $topItems->pluck('nama_kode_barang');
        $topRequestCounts = $topItems->pluck('total_requests');

        // Get the number of requests by work unit
        $requestsByUnit = Permintaan::select('id_unitkerja', DB::raw('count(*) as requests_unit'))
            ->groupBy('id_unitkerja')
            ->get();

        // Prepare data for the work unit chart
        $unitLabels = $requestsByUnit->map(function ($item) {
            return $item->unitKerja->nama_unit_kerja;
        })->toArray();

        $unitSeries = $requestsByUnit->map(function ($item) {
            return $item->requests_unit;
        })->toArray();

        // Get the total count of items
        $totalItems = Barang::count();
        $totalRequest = Permintaan::count();

        // Return the data to the view
        return view('dashboard', compact(
            'totalItems',
            'totalRequest',
            'topCategories',
            'topRequestCounts',
            'unitLabels',
            'unitSeries'
        ));
    }
}
