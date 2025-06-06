@extends('layouts.app',['title' => 'Dashboard'])

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 h-full">
            <!-- Card Jumlah Properti -->
            <a href="{{ route('property.show') }}" class="group h-full">
                <div class="h-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:transform hover:scale-[1.02] hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="flex items-center justify-between h-full">
                        <div class="flex-1">
                            <div class="text-gray-500 dark:text-gray-400 text-sm mb-1">Total Properti</div>
                            <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $properties->count() }}</div>
                            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-3">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Properti aktif</span>
                            </div>
                        </div>
                        <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-full group-hover:bg-blue-200 dark:group-hover:bg-blue-800 ml-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card Tambah Properti -->
            <a href="{{ route('property.create') }}" class="group h-full">
                <div class="h-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:transform hover:scale-[1.02] hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="h-full flex flex-col items-center justify-center">
                        <div class="mx-auto mb-4 bg-green-100 dark:bg-green-900 rounded-full p-4 w-max group-hover:bg-green-200 dark:group-hover:bg-green-800 transition-colors">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-green-600 dark:group-hover:text-green-400">
                            Tambah Properti Baru
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mulai daftarkan properti Anda</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- History Penambahan Properti -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                History Penambahan Properti
            </h2>
            
            <div class="space-y-4">
                @forelse($properties as $property)
                <div class="flex items-start p-4 rounded-lg bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <span class="w-8 h-8 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            Anda telah menambahkan properti 
                            <a href="{{ route('pemilik.property.edit', $property) }}" class="font-medium text-green-600 dark:text-green-400 hover:underline">
                                {{ $property->nama_properti }}
                            </a>
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            pada {{ $property->created_at->translatedFormat('l, d F Y H:i') }}
                            ({{ $property->created_at->diffForHumans() }})
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                    Belum ada history penambahan properti
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection