{{-- custom bg color: bg-base --}}

{{-- side bar --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-10 transition-transform -translate-x-full bg-base border-r border-gray-300 sm:translate-x-0 shadow-xl flex flex-col"
    aria-label="Sidebar">
    <a href="/dashboard" class="flex ms-8 mb-4">
        <img src="{{ asset('img/logo-provinsi.png') }}" class="h-14 me-3" alt="Logo Provinsi" />
        <img src="{{ asset('img/logo-dinsos.png') }}" class="h-14 me-3" alt="Logo Dinsos" />
    </a>
    <div class="flex-grow h-full px-3 pb-4 overflow-y-auto bg-base">
        <span class="flex-1 text-white text-sm">Menu</span>
        <ul class="space-y-2 font-medium">
            {{-- dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="text-sm flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-yellow-500 dark:hover:bg-yellow-400 group">
                    <i class="fa-solid fa-square-poll-vertical text-xl"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>

            {{-- kelola barang --}}
            <li>
                <a href="{{ route('kelola.index') }}"
                    class="text-sm flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-yellow-500 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-box text-xl"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Kelola Barang</span>
                </a>
            </li>

            {{-- permintaan barang --}}
            <li>
                <a href="{{ route('permintaan.index') }}"
                    class="mb-3 text-sm flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-yellow-500 dark:hover:bg-gray-700 group">

                    <i class="fa-solid fa-arrow-right-to-bracket text-xl"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Permintaan Barang</span>
                </a>
            </li>

            <span class="flex-1 text-white text-sm">Laporan</span>
            {{-- laporan per permintaan --}}
            <li>
                <a href="{{ route('historypermintaan') }}"
                    class="text-sm flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-yellow-500 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Per Permintaan</span>
                </a>
            </li>

            {{-- laporan bulanan --}}
            <li>
                <a href="{{ route('historybulan') }}"
                    class="text-sm flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-yellow-500 dark:hover:bg-gray-700 group">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Bulanan</span>
                </a>
            </li>
        </ul>
    </div>

    {{-- footer --}}
    <div class="mt-auto mb-4 text-sm text-white text-center">
        <a href="{{ route('about') }}">&copy; 2024 Tim Tel-U. About Us</a>
    </div>
</aside>
