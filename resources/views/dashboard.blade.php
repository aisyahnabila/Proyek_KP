@extends('layouts.app')

@section('content')
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Dashboard</div>
        {{-- first row --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-black font-medium my-2 dark:text-gray-500">Total Barang</p>
                <p class="text-black font-medium my-3 text-5xl dark:text-gray-500">{{ $totalItems }}</p>
            </div>

            <div class="flex flex-col items-center justify-center h-36 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-black font-medium my-2 dark:text-gray-500">Total Permintaan</p>
                <p class="text-black font-medium my-3 text-5xl dark:text-gray-500">{{ $totalRequest }}</p>
            </div>
        </div>

        {{-- second rows --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div class="flex flex-col p-4 h-108 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-base text-black dark:text-gray-500">Top Barang Diminta</p>
                <div id="barchart"></div>
            </div>
            <div class="flex flex-col p-4 h-108 rounded bg-white shadow-xl dark:bg-gray-800">
                <p class="text-base text-black dark:text-gray-500">Jumlah Permintaan Berdasarkan Unit Kerja</p>
                <div id="piechart"></div>
            </div>
        </div>
    </div>

    <script>
        // Define the chart options and data
        var options = {
            series: [{
                data: @json($topRequestCounts)
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 1,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: @json($topCategories),
            }
        };

        var chart = new ApexCharts(document.querySelector("#barchart"), options);
        chart.render();
    </script>

    <script>
        // Log the data to the console for debugging
        console.log(@json($unitSeries));
        console.log(@json($unitLabels));

        var options = {
            series: @json($unitSeries),
            chart: {
                width: 450,
                type: 'pie',
            },
            labels: @json($unitLabels),
            legend: {
                position: 'bottom', // Menempatkan legenda di bawah chart
                horizontalAlign: 'center', // Menyelaraskan legenda di tengah secara horizontal
                // offsetY: 10 // Menambahkan jarak vertikal ke bawah jika diperlukan
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 340
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        // offsetY: 10
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#piechart"), options);
        chart.render();
    </script>
@endsection
