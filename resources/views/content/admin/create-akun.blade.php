@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-200 border border-green-400 text-green-800 rounded-md relative" x-data="{ show: true }" 
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

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                Tambah Akun Baru
            </h2>

            <form action="{{ route('store.user') }}" method="POST">
                @csrf

                <!-- Section Data User -->
                <div class="space-y-6 mb-8">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Identitas User
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email
                            </label>
                            <input type="email" name="email" id="email" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required
                                   value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password
                            </label>
                            <input type="password" name="password" id="password" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required>
                        </div>

                        <!-- Nomor WhatsApp -->
                        <div>
                            <label for="no_wa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nomor WhatsApp
                            </label>
                            <input type="tel" name="no_wa" id="no_wa" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   pattern="08[0-9]{9,12}"
                                   placeholder="081234567890"
                                   required
                                   value="{{ old('no_wa') }}">
                            @error('no_wa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Role
                            </label>
                            <select name="role" id="role" 
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                           focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                    required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section Alamat -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Alamat
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jalan -->
                        <div>
                            <label for="jalan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jalan
                            </label>
                            <input type="text" name="alamat[jalan]" id="jalan" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required
                                   value="{{ old('alamat.jalan') }}">
                            @error('alamat.jalan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelurahan -->
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kelurahan
                            </label>
                            <input type="text" name="alamat[kelurahan]" id="kelurahan" 
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                          focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                   required
                                   value="{{ old('alamat.kelurahan') }}">
                            @error('alamat.kelurahan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RT/RW -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="rt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    RT
                                </label>
                                <input type="number" name="alamat[rt]" id="rt" 
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                              focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                       min="1"
                                       required
                                       value="{{ old('alamat.rt') }}">
                                @error('alamat.rt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rw" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    RW
                                </label>
                                <input type="number" name="alamat[rw]" id="rw" 
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                              focus:border-blue-500 focus:ring-blue-500 dark:text-gray-200"
                                       min="1"
                                       required
                                       value="{{ old('alamat.rw') }}">
                                @error('alamat.rw')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" 
                            class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 
                                   dark:hover:bg-blue-600 text-white rounded-md font-medium transition-colors 
                                   duration-200">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection