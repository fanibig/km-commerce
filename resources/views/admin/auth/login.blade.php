<x-auth-layout :title="$pageTitle">
    <div class="
        grid grid-cols-1 w-full mx-auto items-start justify-start bg-gray-50 rounded-lg shadow-2xl border border-gray-300 overflow-hidden p-6
        dark:bg-gray-900 dark:border-gray-500 dark:text-gray-200 dark:shadow-none">
        <form method="POST" action="{{ route('admin.login-post') }}" name="admin-login-form" id="admin_login_form">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full focus-visible:ring-0 focus:ring-0 focus-within:ring-0 focus-visible:ring-transparent focus:ring-none" type="email" name="login_or_email" :value="old('login_or_email')" />
                <x-input-error :messages="$errors->get('login_or_email')" class="mt-2" />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('admin.password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-auth-layout>
