@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl font-bold dark:text-white mb-4 sm:mb-0">Daftar Properti Anda</h1>
        <a href="{{ route('property.create') }}" 
           class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Properti
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($properties as $property)
            <div class="bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 transition-all duration-300 hover:shadow-xl hover:transform hover:scale-[1.02]">
                <div class="relative">
                    @if ($property->fotos->isNotEmpty())
                        <img src="{{ asset('storage/' . $property->fotos->first()->file_path) }}" 
                             alt="Foto Properti" 
                             class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent"></div>
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                        </div>
                    @endif
                </div>

                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold dark:text-white truncate">{{ $property->nama_properti }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ ucfirst($property->tipe) }} • {{ $property->jumlah_kamar }} Kamar
                        </p>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                                Rp{{ number_format($property->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                /{{ $property->sewa_jenis }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('pemilik.property.edit', $property->id) }}" 
                           class="flex-1 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center justify-center gap-2 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </a>
                        
                        <form action="{{ route('pemilik.property.destroy', $property->id) }}" method="POST" 
                              class="flex-1"
                              onsubmit="return confirm('Yakin ingin menghapus properti ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 text-white px-4 py-2 rounded-lg inline-flex items-center justify-center gap-2 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <div class="mb-6 text-gray-500 dark:text-gray-400">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-4">Anda belum memiliki properti</p>
                <a href="{{ route('property.create') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Properti Pertama
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection