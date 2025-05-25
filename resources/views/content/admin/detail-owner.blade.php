@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- User Info Section -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Profil Pemilik: {{ $user->name }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nama Lengkap</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100 text-lg">{{ $user->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Email</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100 text-lg">{{ $user->email }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">No WhatsApp</label>
                    <div class="mt-1 flex items-center space-x-2">
                        <p class="text-gray-900 dark:text-gray-100 text-lg">{{ $user->no_wa }}</p>
                        @php
                            // Konversi nomor WhatsApp
                            $whatsapp_number = $user->no_wa;
                            if (str_starts_with($whatsapp_number, '0')) {
                                $whatsapp_number = '62' . substr($whatsapp_number, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $whatsapp_number }}" 
                        target="_blank"
                        class="inline-flex items-center px-2 py-1 bg-green-600 hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 text-white rounded-md text-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Chat
                        </a>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Daftar</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100 text-lg">
                        {{ $user->created_at->translatedFormat('l, d F Y H:i') }}
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Total Properti</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-100 text-lg">
                        {{ $user->properties->count() }} Properti
                    </p>
                </div>
            </div>
        </div>

        <!-- Properties Section -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Daftar Properti
            </h3>

            @if($user->properties->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500 dark:text-gray-400">Belum ada properti</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($user->properties as $property)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-4">
                            <div class="flex flex-col h-full">
                                <div class="flex-1">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                        {{ $property->nama_properti }}
                                    </h4>
                                    <div class="space-y-1 text-sm">
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Tipe:</span> 
                                            {{ $property->tipe }}
                                        </p>
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Harga Sewa:</span> 
                                            Rp {{ number_format($property->harga, 0, ',', '.') }}/{{ $property->sewa_jenis }}
                                        </p>
                                        <!-- Rating & Ulasan -->
                                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-2">
                                                        @php
                                                            // Perhitungan yang lebih akurat
                                                            $rating = $property->ulasans->avg('rating') ?? 0;
                                                            $totalUlasan = $property->ulasans->count();
                                                            $fullStars = floor($rating);
                                                            $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                                        @endphp
                                                        
                                                        <div class="flex items-center">
                                                            @for($i = 0; $i < 5; $i++)
                                                                @if($i < $fullStars)
                                                                    <!-- Bintang penuh -->
                                                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                    </svg>
                                                                @elseif($i == $fullStars && $hasHalfStar)
                                                                    <!-- Bintang setengah -->
                                                                    <div class="relative">
                                                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                        </svg>
                                                                        <div class="absolute top-0 left-0 w-1/2 overflow-hidden">
                                                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <!-- Bintang kosong -->
                                                                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                                    </svg>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ number_format($rating, 1) }} 
                                                            <span class="text-xs">({{ $totalUlasan }} ulasan)</span>
                                                        </span>
                                                    </div>  
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-2 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Ditambahkan: {{ $property->created_at->diffForHumans() }}
                                    </p>
                                    <a href="{{ route('detail.show', $property) }}" 
                                       class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white rounded-md text-sm transition-colors duration-200">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="text-right">
            <a href="{{ route('owner.show') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 text-white rounded-md text-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection