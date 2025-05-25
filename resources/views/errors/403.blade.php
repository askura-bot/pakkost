@extends('layouts.errors')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 transition-colors duration-300 p-4">
    <div class="w-full max-w-md md:max-w-xl bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 md:p-8 transition-all duration-300">
        <div class="flex flex-col items-center space-y-6">
            <!-- Icon -->
            <div class="w-20 h-20 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                <span class="text-4xl text-red-600 dark:text-red-400">⚠️</span>
            </div>

            <!-- Content -->
            <div class="text-center space-y-4">
                <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100">403</h1>
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">
                    Akses Ditolak
                </h2>
                <p class="text-gray-600 dark:text-gray-400 md:text-lg">
                    {{ $exception->getMessage() ?? 'Anda tidak memiliki izin untuk mengakses halaman ini' }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard.admin') }}" class="w-full sm:w-auto px-6 py-3 bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 text-white rounded-full font-medium transition-colors duration-200 text-center">
                            Dashboard Admin
                        </a>
                    @elseif(auth()->user()->role === 'pemilik')
                        <a href="{{ route('dashboard.pemilik') }}" class="w-full sm:w-auto px-6 py-3 bg-amber-600 hover:bg-amber-700 dark:bg-amber-700 dark:hover:bg-amber-800 text-white rounded-full font-medium transition-colors duration-200 text-center">
                            Dashboard Pemilik
                        </a>
                    @endif
                @else
                    <a href="{{ url('/') }}" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-full font-medium transition-colors duration-200 text-center">
                        Kembali ke Beranda
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection