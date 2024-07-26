@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">About Sistem</div>

        {{-- Kotak Atas --}}
        <div class="flex flex-col items-center justify-center h-auto p-6 rounded bg-white shadow-xl dark:bg-gray-800 mb-6 w-full max-w-2xl mx-auto">
            <img src='../img/logo-care.png' alt="Logo Careventory">
            <p class="text-black font-regular my-3 text-center text-base dark:text-gray-500">
                Careventory: Sistem Informasi Manajemen Aset, Dinas Sosial Provinsi Jawa Timur. Aplikasi ini, memudahkan dalam mengakses data inventori kapan saja dan di mana saja, serta mendapatkan informasi yang akurat dan terkini untuk mendukung operasional harian.
            </p>
        </div>

        {{-- Kotak Profil 1 --}}
        <div class="flex flex-col items-center justify-center p-6 rounded bg-white shadow-xl dark:bg-gray-800 w-full max-w-2xl mx-auto mb-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-blue-800">OUR TEAM CAREVENTORY</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                {{-- Profil 1 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Rizqy Athiyya</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Telkom University Surabaya</p>
                </div>

                {{-- Profil 2 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Aisyah Nabila</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Telkom University Surabaya</p>
                </div>

                {{-- Profil 3 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Aida Rifdatul</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Telkom University Surabaya</p>
                </div>
            </div>
        </div>

        {{-- Kotak Team Asset --}}
        <div class="flex flex-col items-center justify-center p-6 rounded bg-white shadow-xl dark:bg-gray-800 w-full max-w-2xl mx-auto mb-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-blue-800">OUR TEAM ASSET DINSOS</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                {{-- Profil 1 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Galuh Permana Putra A. S.Sos.</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Pejabat Penatausaha Pengguna Barang</p>
                </div>

                {{-- Profil 2 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Aries Hartoyo, S.Sos</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Pengurus Barang Persediaan</p>
                </div>

                {{-- Profil 3 --}}
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="text-lg font-bold text-black mt-3 dark:text-gray-400">Budi Haryanto</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-500">Penanggung Jawab Pergudangan</p>
                </div>
            </div>
        </div>
    </div>
@endsection
