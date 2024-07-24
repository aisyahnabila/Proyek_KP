@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Laporan Bulanan</div>

        <div
            class="p-5 border border-black overflow-x-auto flex justify-between items-center pb-4 bg-white dark:bg-gray-900 space-x-4">
            <form action="{{ route('laporan.bulan') }}" method="GET" class="flex space-x-4">
                <div class="flex-1">
                    <select id="unit-kerja" name="unit_kerja"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Semua Unit Kerja</option>
                        @foreach ($unitKerjaOptions as $unit)
                            <option value="{{ $unit->id_unitkerja }}"
                                {{ request('unit_kerja') == $unit->id_unitkerja ? 'selected' : '' }}>
                                {{ $unit->nama_unit_kerja }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="bulan" name="bulan"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Bulan</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="tahun" name="tahun"
                        class="text-sm block w-full md:w-72 p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Tahun</option>
                        @foreach (range(date('Y'), date('Y') - 5) as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit"
                        class="flex items-center justify-center font-semibold focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-5 py-3">Bulan Pengajuan</th>
                        <th scope="col" class="px-5 py-3">Unit Kerja</th>
                        <th scope="col" class="px-5 py-3">Kode Barang</th>
                        <th scope="col" class="px-5 py-3">Nama Barang</th>
                        <th scope="col" class="px-5 py-3">Spesifikasi Nama Barang</th>
                        <th scope="col" class="px-5 py-3">Jumlah Pengajuan Permintaan</th>
                        <th scope="col" class="px-5 py-3">Informasi Sisa Persediaan</th>
                        <th scope="col" class="px-5 py-3">Satuan</th>
                        <th scope="col" class="px-5 py-3">Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td class="px-5 py-3">{{ $p['bulan'] }}</td>
                            <td class="px-5 py-3">{{ $p['unit_kerja'] }}</td>
                            <td class="px-5 py-3">{{ $p['kode_barang'] }}</td>
                            <td class="px-5 py-3">{{ $p['nama_barang'] }}</td>
                            <td class="px-5 py-3">{{ $p['spesifikasi_nama_barang'] }}</td>
                            <td class="px-5 py-3">{{ $p['total_permintaan'] }}</td>
                            <td class="px-5 py-3">{{ $p['jumlah'] }}</td>
                            <td class="px-5 py-3">{{ $p['satuan'] }}</td>
                            <td class="px-5 py-3">{{ $p['keperluan'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
