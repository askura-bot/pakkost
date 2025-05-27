@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Side - Login Form -->
        <div class="w-full md:w-1/2 bg-white dark:bg-gray-900 p-8 md:p-20 lg:p-24 flex items-center justify-center">
            <div class="w-full max-w-md">
                <div class="mb-10">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                        PakKost
                    </a>
                    <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">Selamat Datang</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Silakan masuk ke akun Anda</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            class="w-full mt-1"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            class="w-full mt-1"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember" 
                                class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-900"
                            >
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <x-primary-button class="w-full justify-center py-3">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </form>
            </div>
        </div>

        <!-- Right Side - Contact Info -->
        <div class="w-full md:w-1/2 bg-indigo-600 dark:bg-indigo-900 p-8 md:p-20 lg:p-24 text-white flex items-center justify-center">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold mb-6">Belum Punya Akun?</h2>
                <p class="text-lg mb-8">
                    Mau daftar akun? Hubungi kami melalui:
                </p>

                <div class="space-y-6">
                    @php
                        $contact = App\Models\Contact::first();
                    @endphp

                    <!-- WhatsApp -->
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-indigo-700 dark:bg-indigo-800 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">WhatsApp</p>
                            @if($contact)
                                @php
                                    $waNumber = str_starts_with($contact->no_wa, '0') 
                                        ? '62' . substr($contact->no_wa, 1) 
                                        : $contact->no_wa;
                                @endphp
                                <a 
                                    href="https://wa.me/{{ $waNumber }}" 
                                    target="_blank"
                                    class="hover:underline"
                                >
                                    {{ $contact->no_wa }}
                                </a>
                            @else
                                <span class="text-gray-200">-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-indigo-700 dark:bg-indigo-800 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Email</p>
                            @if($contact)
                                <a 
                                    href="mailto:{{ $contact->email }}" 
                                    class="hover:underline"
                                >
                                    {{ $contact->email }}
                                </a>
                            @else
                                <span class="text-gray-200">-</span>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Page -->
                    <div class="mt-12">
                        <p class="flex items-center space-x-2">
                            <span>Atau kunjungi</span>
                            <a 
                                href="{{ route('contact') }}" 
                                class="flex items-center hover:underline"
                            >
                                halaman kontak kami
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection