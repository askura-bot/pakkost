<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4">
            <x-input-label for="no_wa" :value="__('No WhatsApp')" />
            <x-text-input id="no_wa" name="no_wa" type="text" class="mt-1 block w-full" :value="old('no_wa', $user->no_wa)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('no_wa')" />
        </div>

        <div class="mt-4">
            <x-input-label for="kelurahan" :value="__('Kelurahan')" />
            <x-text-input id="kelurahan" name="kelurahan" type="text" class="mt-1 block w-full"
                :value="old('kelurahan', $user->alamat->kelurahan ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('kelurahan')" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="jalan" :value="__('Jalan')" />
            <x-text-input id="jalan" name="jalan" type="text" class="mt-1 block w-full"
                :value="old('jalan', $user->alamat->jalan ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('jalan')" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="rt" :value="__('RT')" />
            <x-text-input id="rt" name="rt" type="text" class="mt-1 block w-full"
                :value="old('rt', $user->alamat->rt ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('rt')" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="rw" :value="__('RW')" />
            <x-text-input id="rw" name="rw" type="text" class="mt-1 block w-full"
                :value="old('rw', $user->alamat->rw ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('rw')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
