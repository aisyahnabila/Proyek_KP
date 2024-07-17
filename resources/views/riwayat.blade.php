@extends('layouts.app')

@section('content')
    {{-- content --}}
    <div class="p-6 mt-2 sm:ml-64">
        <div class="text-2xl my-4">Riwayat Login</div>

        {{-- Content --}}
        <div class="border relative overflow-x-auto shadow-xl sm:rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Login
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logUsers as $logUser)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $logUser->created_at->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $logUser->user->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $logUser->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
