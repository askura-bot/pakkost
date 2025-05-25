@extends('layouts.guest')

@section('content')
<div class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Hubungi Kami
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Kami siap membantu Anda 24/7 melalui berbagai saluran komunikasi
            </p>
        </div>

        @php
            $contact = App\Models\Contact::first();
        @endphp

        @if($contact)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- WhatsApp Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="p-4 bg-green-100 dark:bg-green-900 rounded-full">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">WhatsApp</h3>
                        <a href="https://wa.me/{{ $contact->no_wa }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $contact->no_wa }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Email Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Email</h3>
                        <a href="mailto:{{ $contact->email }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $contact->email }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Instagram Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="p-4 bg-pink-100 dark:bg-pink-900 rounded-full">
                        <svg class="w-8 h-8 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 2H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2zm-5 15a5 5 0 110-10 5 5 0 010 10zm0-12a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Instagram</h3>
                        <a href="https://instagram.com/{{ $contact->instagram }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $contact->instagram }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Facebook Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-transform hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Facebook</h3>
                        <a href="https://facebook.com/{{ $contact->facebook }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $contact->facebook }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg">
            <p class="text-red-500 dark:text-red-400">Data kontak belum tersedia</p>
        </div>
        @endif

        <!-- CTA Section -->
        <div class="mt-16 text-center bg-indigo-600 dark:bg-indigo-900 rounded-lg p-8">
            <h2 class="text-2xl font-bold text-white mb-4">Butuh Bantuan Lainnya?</h2>
            <p class="text-indigo-100 mb-6">Jangan ragu untuk menghubungi kami kapan saja</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('home') }}" class="px-6 py-2 bg-white text-indigo-600 rounded-full hover:bg-indigo-50 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection