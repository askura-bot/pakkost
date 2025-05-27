@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-8">
    @forelse($properties as $property)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <!-- Foto Utama -->
        <div class="relative">
            @if($property->fotos->isNotEmpty())
                <img src="{{ asset('storage/'.$property->fotos[0]->file_path) }}" 
                     alt="{{ $property->nama_properti }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
            <div class="absolute top-2 right-2 bg-white dark:bg-gray-700 px-3 py-1 rounded-full text-sm shadow-sm">
                <span class="text-blue-600 dark:text-blue-400">{{ ucfirst($property->tipe) }}</span>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <!-- Header -->
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 truncate">{{ $property->nama_properti }}</h2>
                <div class="flex items-center justify-between mt-2">
                    <div>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            Rp{{ number_format($property->harga, 0, ',', '.') }}
                        </p>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $property->sewa_jenis === 'bulanan' ? 'Bulanan' : 'Tahunan' }}
                        </span>
                    </div>
                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm">
                        {{ $property->jumlah_kamar }} Kamar
                    </span>
                </div>
            </div>

            <!-- Info Pemilik -->
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $property->pemilik->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                        {{ $property->pemilik->alamat->jalan ?? 'Alamat tidak tersedia' }}
                    </p>
                </div>
            </div>

            <!-- Alamat Properti -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $property->alamatProperty->kelurahan }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">RT {{ $property->alamatProperty->rt }}/RW {{ $property->alamatProperty->rw }}</p>
                </div>
            </div>

            <!-- Fasilitas -->
            <div class="space-y-2">
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Fasilitas Utama:</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($property->fasilitas->take(3) as $fasilitas)
                    <span class="px-2.5 py-1 bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-300 rounded-full text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $fasilitas->nama_fasilitas }}
                    </span>
                    @endforeach
                </div>
            </div>

            <!-- Rating & Ulasan -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center text-yellow-400">
                            @php
                                $ulasans = $property->ulasans ?? collect();
                                $rating = $ulasans->isNotEmpty() ? $ulasans->avg('rating') : 0;
                                $totalUlasan = $ulasans->count();
                            @endphp
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 {{ $i < $rating ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            {{ number_format($rating, 1) }} ({{ $totalUlasan }})
                        </span>
                    </div>
                    <a href="{{ route('detail.show', $property) }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition-colors duration-200 flex items-center">
                        <span>Detail</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="col-span-full text-center py-20 text-gray-600 dark:text-gray-300">
            <svg class="mx-auto mb-4 w-16 h-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
              </svg>              
            <p class="text-xl font-semibold">Property masih kosong</p>
        </div>
    @endforelse
</div>
@endsection