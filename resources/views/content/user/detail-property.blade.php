@extends('layouts.guest')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4" x-data="{ showRatingModal: false, rating: 0, hoverRating: 0 }">

    <!-- Floating WhatsApp Button -->
    @if($property->pemilik->no_wa)
        @php
            $waNumber = str_starts_with($property->pemilik->no_wa, '0') 
                        ? '62'.substr($property->pemilik->no_wa, 1) 
                        : $property->pemilik->no_wa;
        @endphp
        <div class="fixed bottom-4 right-4 z-50">
            <a href="https://wa.me/{{ $waNumber }}" target="_blank" 
               class="bg-green-600 text-white p-4 rounded-full shadow-lg hover:bg-green-700 transition-all flex items-center">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm.01 1.67c2.33 0 4.52.91 6.17 2.56a8.677 8.677 0 012.55 6.17c0 4.75-3.88 8.63-8.63 8.63-1.53 0-3-.4-4.28-1.11l-.3-.18-3.12.82.83-3.04-.2-.31a8.6 8.6 0 01-1.32-4.61c0-4.75 3.88-8.63 8.64-8.63zM8.54 7.7c-.2 0-.43.06-.66.31-.22.25-.87.86-.87 2.07 0 1.22.89 2.39 1 2.56.14.17 1.76 2.67 4.25 3.73.59.27 1.05.42 1.41.53.59.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.16-.48-.27-.25-.14-1.47-.74-1.69-.82-.23-.08-.37-.12-.56.12-.18.25-.7.81-.86.98-.15.17-.31.19-.58.07-.28-.12-1.17-.43-2.24-1.37-.83-.75-1.38-1.66-1.55-1.94-.16-.28-.01-.43.12-.56.13-.13.28-.33.42-.5.15-.18.19-.3.25-.5.06-.2.03-.37-.02-.52-.06-.15-.56-1.34-.77-1.84-.2-.48-.4-.42-.56-.43-.14 0-.3-.01-.47-.01z"/>
                </svg>
            </a>
        </div>
    @endif

        <!-- Rating Popup -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" 
         x-show="showRatingModal" 
         x-cloak>
       <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md">
           <form method="POST" action="{{ route('ulasan.store', $property) }}">
               @csrf

               <div class="mb-4">
                <!-- Input untuk user non-login -->
                @guest
                <div class="space-y-4">
                    <div>
                        <x-input-label for="username" value="Nama" />
                        <x-text-input id="username" name="username" class="w-full mt-1" required />
                    </div>
                </div>
                @endguest
        
                <!-- Input rating dan komentar -->
                <div class="mt-4">
                    <label class="block text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">
                        Beri Rating
                    </label>

                    <div class="flex justify-center space-x-2 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" 
                                    @click="rating = {{ $i }}"
                                    @mouseover="hoverRating = {{ $i }}" 
                                    @mouseleave="hoverRating = 0"
                                    class="w-10 h-10">
                                <svg class="w-8 h-8 transition-colors duration-200" 
                                     :class="{
                                         'text-yellow-400 fill-current': {{ $i }} <= (hoverRating || rating),
                                         'text-gray-300 dark:text-gray-600': {{ $i }} > (hoverRating || rating)
                                     }" 
                                     stroke="currentColor" 
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" x-model="rating">
                </div>
                
                <textarea name="komentar" 
                          class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 mt-4" 
                          rows="4" 
                          placeholder="Tulis ulasan Anda..."
                          required></textarea>
            </div>
               <div class="flex justify-end space-x-4">
                   <button type="button" 
                           @click="showRatingModal = false" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                       Batal
                   </button>
                   <button type="submit" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                       Kirim
                   </button>
               </div>
           </form>
       </div>
   </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md relative" x-data="{ show: true }" 
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-1/2 right-4 -translate-y-1/2">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @endif

        <!-- Header dengan Rating -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $property->nama_properti }}
                </h1>
                <div class="text-right">
                    <div class="flex items-center text-yellow-400 mb-2">
                        @php
                            $averageRating = $property->ulasans->avg('rating') ?? 0;
                            $totalReviews = $property->ulasans->count();
                        @endphp
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-6 h-6 {{ $i < $averageRating ? 'fill-current' : 'fill-none' }}" 
                                 stroke="currentColor" 
                                 viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ number_format($averageRating, 1) }} dari {{ $totalReviews }} ulasan
                    </p>
                </div>
            </div>
        </div>

        <!-- Galeri Foto -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-6">
            @if($property->fotos->isNotEmpty())
                <div class="col-span-1">
                    <img src="{{ asset('storage/'.$property->fotos[0]->file_path) }}" 
                         alt="Foto utama" 
                         class="w-full h-96 object-cover rounded-lg">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($property->fotos->slice(1) as $foto)
                    <div class="relative">
                        <img src="{{ asset('storage/'.$foto->file_path) }}" 
                             alt="Foto properti" 
                             class="w-full h-48 object-cover rounded-lg">
                        @if($foto->link_VT)
                        <div class="absolute bottom-2 right-2">
                            <a href="{{ $foto->link_VT }}" target="_blank" 
                               class="px-3 py-1 bg-blue-600 text-white rounded-full text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Virtual Tour
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Informasi Utama -->
        <div class="p-6 space-y-6">
            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    {{ $property->nama_properti }}
                </h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                                Rp{{ number_format($property->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ ucfirst($property->sewa_jenis) }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <div>
                            <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ ucfirst($property->tipe) }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Tipe Properti
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div>
                            <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ $property->jumlah_kamar }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Kamar Tersedia
                            </p>
                        </div>
                    </div>

                    @if($property->fotos[0]->link_VT)
                        <div class="mt-4">
                            <a href="{{ $property->fotos[0]->link_VT }}" target="_blank"
                               class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-full text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                Virtual Tour
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Alamat Lengkap</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $property->alamatProperty->jalan }}, 
                                RT {{ $property->alamatProperty->rt }}/RW {{ $property->alamatProperty->rw }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">
                                Kelurahan {{ $property->alamatProperty->kelurahan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fasilitas -->
            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($property->fasilitas as $fasilitas)
                    <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">{{ $fasilitas->nama_fasilitas }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Detail Pemilik -->
            <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Detail Pemilik</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <p class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ $property->pemilik->name }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ $property->pemilik->email }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">{{ $property->pemilik->no_wa }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nomor WhatsApp</p>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-gray-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ $property->pemilik->alamat->jalan }}, 
                                    RT {{ $property->pemilik->alamat->rt }}/RW {{ $property->pemilik->alamat->rw }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Kelurahan {{ $property->pemilik->alamat->kelurahan }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ulasan -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Ulasan Penyewa</h2>
                <div class="space-y-6">
                    @forelse($property->ulasans as $ulasan)
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $ulasan->username }}</span>
                            <div class="flex items-center text-yellow-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 {{ $i < $ulasan->rating ? 'fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">{{ $ulasan->komentar }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            {{ $ulasan->created_at->format('d M Y') }}
                        </p>
                    </div>
                    @empty
                    <div class="text-center py-6">
                        <p class="text-gray-500 dark:text-gray-400">Belum ada ulasan untuk properti ini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Tombol Beri Rating -->
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <button @click="showRatingModal = true" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Beri Rating & Ulasan
            </button>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection