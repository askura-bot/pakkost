@extends('layouts.guest')

@section('content')

<div class="px-4 py-8" x-data="{ showFilters: false }" id="filter-section"> 
    <!-- Search Bar + Filter Button Container -->
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <!-- Search Form - Lebih panjang -->
        <form method="GET" action="{{ route('home') }}#filter-section" class="flex-grow">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari nama properti..." 
                    value="{{ request('search') }}"
                    class="w-full pl-4 pr-10 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                    type="submit"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-300 hover:text-blue-500"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Tombol Filter - Lebih kompak -->
        <div class="flex-shrink-0">
            <button 
                @click="showFilters = !showFilters"
                class="h-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg transition-colors whitespace-nowrap"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
            </button>
        </div>
    </div>

    <div x-cloak>
        <div 
            x-show="showFilters"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-8"
        >
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Filter Harga -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Range Harga</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_harga" placeholder="Min" 
                            value="{{ request('min_harga') }}"
                            class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <input type="number" name="max_harga" placeholder="Max" 
                            value="{{ request('max_harga') }}"
                            class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>

                <!-- Filter Alamat -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi</label>
                    <input type="text" name="kelurahan" placeholder="Kelurahan" 
                        value="{{ request('kelurahan') }}"
                        class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    <input type="text" name="jalan" placeholder="Jalan" 
                        value="{{ request('jalan') }}"
                        class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                </div>

                <!-- Filter RT/RW -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">RT/RW</label>
                    <div class="flex gap-2">
                        <input type="number" name="rt" placeholder="RT" 
                            value="{{ request('rt') }}"
                            class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <input type="number" name="rw" placeholder="RW" 
                            value="{{ request('rw') }}"
                            class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>

                <!-- Filter Fasilitas -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fasilitas</label>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto">
                        @foreach($fasilitasOptions as $fasilitas)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas->id }}" 
                                {{ in_array($fasilitas->id, (array)request('fasilitas')) ? 'checked' : '' }}
                                class="rounded border-gray-300 dark:bg-gray-700">
                            <span class="text-sm dark:text-gray-300">{{ $fasilitas->nama_fasilitas }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol Filter -->
                <div class="flex items-end gap-2">
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('home') }}" 
                    class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 px-4 py-2 rounded-lg transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>


    <div id="daftar-properti" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4 py-8">
        @foreach($properties as $property)
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

                <!-- Info Pemilik + Tombol WhatsApp -->
                <div class="space-y-4">
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

                    <!-- Tombol WhatsApp -->
                    @if($property->pemilik->no_wa)
                        @php
                            // Konversi nomor WhatsApp
                            $whatsappNumber = str_starts_with($property->pemilik->no_wa, '0') 
                                ? '62' . substr($property->pemilik->no_wa, 1) 
                                : $property->pemilik->no_wa;
                        @endphp
                        <a href="https://wa.me/{{ $whatsappNumber }}" 
                        target="_blank"
                        class="w-full flex items-center justify-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    @endif
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
                        <a href="{{ route('detail', $property) }}" 
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
        @endforeach
    </div>

</div>

<!-- Script untuk scroll otomatis -->
@if(request()->hasAny(['min_harga', 'max_harga', 'kelurahan', 'jalan', 'rt', 'rw', 'fasilitas']))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterSection = document.getElementById('filter-section');
        if (filterSection) {
            filterSection.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
@endif

@endsection