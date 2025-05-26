@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Properties Card -->
            <a href="{{ route('properties.show') }}" class="group">
                <div class="bg-indigo-100 dark:bg-indigo-900 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-indigo-600 dark:text-indigo-300 font-medium">Total Properti</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $propertiesCount }}
                            </p>
                        </div>
                        <div class="bg-indigo-600 dark:bg-indigo-700 p-4 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Owners Card -->
            <a href="{{ route('owner.show') }}" class="group">
                <div class="bg-green-100 dark:bg-green-900 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-600 dark:text-green-300 font-medium">Total Pemilik</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $ownersCount }}
                            </p>
                        </div>
                        <div class="bg-green-600 dark:bg-green-700 p-4 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Administrators Card -->
            <a href="{{ route('admin.show') }}" class="group">
                <div class="bg-purple-100 dark:bg-purple-900 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-purple-600 dark:text-purple-300 font-medium">Total Admin</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $adminsCount }}
                            </p>
                        </div>
                        <div class="bg-purple-600 dark:bg-purple-700 p-4 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Contacts Card -->
            <a href="{{ route('contacts.index') }}" class="group">
                <div class="bg-blue-100 dark:bg-blue-900 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-600 dark:text-blue-300 font-medium">Contact Us</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $contactsCount }}
                            </p>
                        </div>
                        <div class="bg-blue-600 dark:bg-blue-700 p-4 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        
            <!-- Fasilitas Card -->
            <a href="{{ route('fasilitas.show') }}" class="group">
                <div class="bg-green-100 dark:bg-green-900 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-600 dark:text-green-300 font-medium">Daftar Fasilitas</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $fasilitasCount }}
                            </p>
                        </div>
                        <div class="bg-green-600 dark:bg-green-700 p-4 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Aktivitas Terbaru
            </h2>
            <!-- Tambahkan konten aktivitas di sini -->
            <div class="space-y-4">
                @forelse($recentProperties as $property)
                <div class="flex items-start p-4 rounded-lg bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <span class="w-8 h-8 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            <a href="{{ route('pemilik.show', $property->pemilik) }}">
                                <span class="font-medium text-blue-600 dark:text-blue-400 hover:underline">{{ $property->pemilik->name }}</span> 
                            </a>
                            menambahkan properti 
                            <a href="{{ route('detail.show', $property) }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $property->nama_properti }}
                            </a>
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ $property->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                    Tidak ada aktivitas terbaru
                </div>
                @endforelse
            </div>
        </div>
        </div>
    </div>
</div>
@endsection