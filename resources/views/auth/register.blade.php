<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- No WhatsApp -->
        <div class="mt-4">
            <x-input-label for="no_wa" :value="__('No WhatsApp')" />
            <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa" :value="old('no_wa')" required />
            <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
        </div>

        <!-- Kelurahan -->
        <div class="mt-4">
            <x-input-label for="kelurahan" :value="__('Kelurahan')" />
            <x-text-input id="kelurahan" class="block mt-1 w-full" type="text" name="kelurahan" :value="old('kelurahan')" required />
            <x-input-error :messages="$errors->get('kelurahan')" class="mt-2" />
        </div>

        <!-- Jalan -->
        <div class="mt-4">
            <x-input-label for="jalan" :value="__('Jalan')" />
            <x-text-input id="jalan" class="block mt-1 w-full" type="text" name="jalan" :value="old('jalan')" required />
            <x-input-error :messages="$errors->get('jalan')" class="mt-2" />
        </div>

        <!-- RT -->
        <div class="mt-4">
            <x-input-label for="rt" :value="__('RT')" />
            <x-text-input id="rt" class="block mt-1 w-full" type="text" name="rt" :value="old('rt')" required />
            <x-input-error :messages="$errors->get('rt')" class="mt-2" />
        </div>

        <!-- RW -->
        <div class="mt-4">
            <x-input-label for="rw" :value="__('RW')" />
            <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw')" required />
            <x-input-error :messages="$errors->get('rw')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Daftar Sebagai')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">-- Pilih Role --</option>
               <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik Kost</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
