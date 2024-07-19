<!DOCTYPE html>
<html>

<head>
    <title>Nota Permintaan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body class="bg-white text-black">

    <div class="container mx-auto p-4">
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold">DINAS SOSIAL PROVINSI JAWA TIMUR</h1>
            <h2 class="text-lg">SEKRETARIAT</h2>
            <h3 class="text-lg font-bold mt-4">NOTA PERMINTAAN BARANG</h3>
            <p>Nomor : {{ $permintaan->kode_permintaan }}</p>
        </div>

        <div class="mb-6">
            <p>Yang meminta : <strong>{{ $permintaan->unitKerja->nama_unit_kerja }}</strong></p>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-800">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-800 px-4 py-2">No</th>
                    <th class="border border-gray-800 px-4 py-2">Spesifikasi Nama Barang</th>
                    <th class="border border-gray-800 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-800 px-4 py-2">Satuan Barang</th>
                    <th class="border border-gray-800 px-4 py-2">Keperluan</th>
                    <th class="border border-gray-800 px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permintaan->detailPermintaan as $key => $detail)
                    <tr>
                        <td class="border border-gray-800 px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border border-gray-800 px-4 py-2">{{ $detail->barang->nama_barang }}</td>
                        <td class="border border-gray-800 px-4 py-2">{{ $detail->jumlah_permintaan }}</td>
                        <td class="border border-gray-800 px-4 py-2">{{ $detail->barang->satuan }}</td>
                        <td class="border border-gray-800 px-4 py-2">{{ $permintaan->keperluan }}</td>
                        <td class="border border-gray-800 px-4 py-2">{{ $detail->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-between">
            <div></div>
            <div class="text-right">
                <p>Surabaya, {{ \Carbon\Carbon::parse($permintaan->tanggal_permintaan)->format('d F Y') }}</p>
                <p>Sub Bagian dan Kepegawaian</p>
                <p class="mt-12">{{ $permintaan->nama_pemohon }}</p>
            </div>
        </div>
    </div>

</body>

</html>
