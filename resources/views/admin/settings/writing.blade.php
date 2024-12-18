<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <section class="mt-10 general-setting">
        <form action="{{ route('admin.settings.writing.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-4 items-center justify-start max-w-4xl">
                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Default Post Category') }}</label>
                </div>
                <div class="col-span-3">
                    <select id="default_category" name="default_category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($webConfig['defaultCategory'] == $category->id) selected @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Mail Server') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="text" id="mailserver_url" name="mailserver_url" value="{{ old('mailserver_url') ?? $webConfig['mailserverUrl'] }}" placeholder="{{ __('mail.example.net') }}" required />
                </div>

                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Login Name') }}</label>
                </div>
                <div class="col-span-3">
                    <div class="flex items-center justify-start">
                        <x-admin.text-input type="email" id="mailserver_login" name="mailserver_login" value="{{ old('mailserver_login') ?? $webConfig['mailserverLogin'] }}" placeholder="{{ __('Login: example@app.net') }}" class="max-w-lg" required />
                        <div class="inline-flex items-center justify-start gap-2 ml-3">
                            <label for="mailserver_port" class="block font-medium text-md text-gray-700 dark:text-gray-200">Port</label>
                            <x-admin.text-input type="number" id="mailserver_port" name="mailserver_port" value="{{ old('mailserver_port') ?? $webConfig['mailserverPort'] }}" placeholder="{{ __('Enter Port: 110') }}" class="max-w-16" min="0" required />
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Password') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="password" id="mailserver_pass" name="mailserver_pass" value="{{ old('mailserver_pass') ?? $webConfig['mailserverPass'] }}" placeholder="{{ __('Enter Password') }}" required />
                </div>

                <div class="col-span-1">
                    <x-admin.submit-button>
                        {{ __('Save change') }}
                    </x-admin.submit-button>
                </div>
                <div class="col-span-3"></div>
            </div>
        </form>
    </section>
</x-admin-layout>
