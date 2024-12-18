<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <section class="mt-10 general-setting">
        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-4 items-center justify-start max-w-4xl">
                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Site Name') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="text" id="site_name" name="site_name" value="{{ $general['site_name'] ?? old('site_name') }}" required />
                </div>

                <div class="col-span-1">
                    <label for="site_favicon" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Site Icon') }}</label>
                </div>
                <div class="col-span-3">
                    <div id="file_preview" class="file-preview">
                        <div class="file-preview-item flex items-center gap-2 flex-wrap">
                            <div id="favicon_preview" class="favicon-preview flex items-center justify-start gap-4"></div>
                            <div class="file-preview-buttons w-full max-w-full z-10 relative">
                                <span id="choose_file" class="bg-white text-gray-700 py-4 px-6 w-full h-full max-w-64 text-center block active:ring-1 active:ring-blue-500 capitalize cursor-pointer">
                                    {{ __('Choose a Site Icon') }}
                                </span>
                                <input id="file_input" type="file" class="opacity-0 w-full h-full absolute top-0 left-0 z-0 max-w-40 cursor-pointer" name="site_favicon" value="{{ $webConfig['siteFavicon'] !== '' ? $webConfig['siteFavicon'] : '' }}" />
                                <span id="change_icon" class="change-btn bg-white hover:bg-gray-200 text-black font-medium py-2 px-4 rounded mr-1 cursor-pointer capitalize dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                                    {{ __('Change site icon') }}
                                </span>

                                <button type="button" id="remove_icon" class="remove-btn text-red-400 hover:bg-red-500 hover:text-white font-medium py-2 px-4 rounded relative z-10 dark:bg-red-600 dark:hover:bg-gray-700 dark:hover:text-white dark:text-white">
                                    {{ __('Remove site icon') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <small class="text-gray-400">{{ __('The Site Icon is what you see in browser tabs, bookmark bars, and within the '.$webConfig["siteName"]. ' mobile apps. It should be square and at least 512 × 512 pixels.') }}</small>
                </div>

                <div class="col-span-1 dark:text-gray-200">
                    {{ __('Site Logo') }}
                </div>
                <div class="col-span-3">
                    <div class="flex items-center justify-between gap-4">
                        <x-admin.image-input id="site_logo" name="site_logo" value="{{ $general['site_logo'] ?? $webConfig['siteLogo'] }}" btnName="Upload Logo" />

                        <div class="logo-thumbnail rounded overflow-hidden" id="logo_thumbnail"></div>
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="site_tagline" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Tagline') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="text" id="site_tagline" name="site_tagline" value="{{ $general['site_tagline'] ?? old('site_tagline') }}" />
                    <small class="text-gray-400">{{ __('In a few words, explain what this site is about. Example: “Just another '. $webConfig["siteName"] .' site."') }}</small>
                </div>

                <div class="col-span-1">
                    <label for="site_description" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Description') }}</label>
                </div>
                <div class="col-span-3">
                    <textarea id="site_description" name="site_description" placeholder="{{ __('Description') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="5" cols="20">{{ $general['site_description'] ?? old('site_description') }}</textarea>
                </div>

                <div class="col-span-1">
                    <label for="home_url" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Home Url') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="url" id="home_url" name="home_url" value="{{ $general['home_url'] ?? old('home_url') }}" required />
                </div>

                <div class="col-span-1">
                    <label for="site_url" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Site Url') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="url" id="site_url" name="site_url" value="{{ $general['site_url'] ?? old('site_url') }}" required />
                </div>

                <div class="col-span-1">
                    <label for="admin_email" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Administrator Email') }}</label>
                </div>
                <div class="col-span-3">
                    <x-admin.text-input type="email" id="admin_email" name="admin_email" value="{{ $general['admin_email'] ?? old('admin_email') }}" required />
                </div>
                <div class="col-span-1">
                    <label for="default_role" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('New User Default Role') }}</label>
                </div>
                <div class="col-span-3">
                    <select name="default_role" id="default_role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select" placeholder="Select Role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @if($general['default_role'] == $role->name) selected @endif>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="grid grid-cols-4 gap-4 items-start justify-start max-w-4xl mt-5">
                <div class="col-span-1">
                    <label for="date_format" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Date Format') }}</label>
                </div>
                <div class="col-span-3">
                    <div class="block w-full">
                        <label for="date_format1" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="date_format1" name="date_format" value="{{ $general['date_format'] == 'F j, Y' ? $general['date_format'] : 'F j, Y' }}" @if($general['date_format'] == 'F j, Y') checked @endif class="form-radio" /> {{ date('F j, Y') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm text-center block">
                                    {{ __('F j, Y') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="date_format2" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="date_format2" name="date_format" value="{{ $general['date_format'] == 'Y-m-d' ? $general['date_format'] : 'Y-m-d' }}" @if($general['date_format'] == 'Y-m-d') checked @endif class="form-radio" /> {{ date('Y-m-d') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm block text-center">
                                    {{ __('Y-m-d') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="date_format3" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="date_format3" name="date_format" value="{{ $general['date_format'] == 'm/d/Y' ? $general['date_format'] : 'm/d/Y' }}" @if($general['date_format'] == 'm/d/Y') checked @endif class="form-radio" /> {{ date('m/d/Y') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm block text-center">
                                    {{ __('m/d/Y') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="date_format4" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="date_format4" name="date_format" value="{{ $general['date_format'] == 'd/m/Y' ? $general['date_format'] : 'd/m/Y' }}" @if($general['date_format'] == 'd/m/Y') checked @endif class="form-radio" /> {{ date('d/m/Y') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm w-full block text-center">
                                    {{ __('d/m/Y') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="date_format5" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="date_format5" name="date_format" value="{{ $general['date_format'] ?? old('date_format') }}" @if($general['date_format'] == 'c/u/s/t/o/m') checked @endif class="form-radio" /> {{ __('Custom:') }}
                            </div>
                            <div class="col-span-1">
                                <x-admin.text-input type="text" id="date_format6" name="date_format" value="{{ $general['date_format'] ?? old('date_format') }}" />
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 items-start justify-start max-w-4xl mt-5">
                <div class="col-span-1">
                    <label for="time_format" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Time Format') }}</label>
                </div>
                <div class="col-span-3">
                    <div class="block w-full">
                        <label for="time_format1" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="time_format1" name="time_format" value="{{ $general['time_format'] == 'g:i a' ? $general['time_format'] : 'g:i a' }}" @if($general['time_format'] == 'g:i a') checked @endif class="form-radio" /> {{ date('g:i a') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm text-center block">
                                    {{ __('g:i a') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="time_format2" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="time_format2" name="time_format" value="{{ $general['time_format'] == 'g:i A' ? $general['time_format'] : 'g:i A' }}" @if($general['time_format'] == 'g:i A') checked @endif class="form-radio" /> {{ date('g:i A') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm block text-center">
                                    {{ __('g:i A') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="time_format3" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="time_format3" name="time_format" value="{{ $general['time_format'] == 'H:i' ? $general['time_format'] : 'H:i' }}" @if($general['time_format'] == 'H:i') checked @endif class="form-radio" /> {{ date('H:i') }}
                            </div>
                            <div class="col-span-1">
                                <span class="text-box px-4 py-0.5 bg-gray-300 rounded-sm block text-center">
                                    {{ __('H:i') }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="block w-full">
                        <label for="time_format4" class="grid grid-cols-5 gap-8 mb-2 items-center justify-between">
                            <div class="col-span-4 dark:text-gray-200">
                                <input type="radio" id="time_format4" name="time_format" value="{{ $general['time_format'] ?? old('time_format') }}" @if($general['time_format'] == 'c/u/s/t/o/m') checked @endif class="form-radio" /> {{ __('Custom:') }}
                            </div>
                            <div class="col-span-1">
                                <x-admin.text-input type="text" id="time_format5" name="time_format" value="{{ $general['time_format'] ?? old('time_format') }}" />
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 items-start justify-start max-w-4xl mt-5 pb-16">
                <div class="col-span-1">
                    <label for="start_of_week" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Week start on') }}</label>
                </div>
                <div class="col-span-3">
                    @php
                        $start_of_weeks = config('common.start_of_week', []);
                    @endphp
                    @if (!empty($general['start_of_week']))
                        <select name="start_of_week" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select" id="week_start">
                            @foreach ($start_of_weeks as $key => $weekday)
                                <option value="{{ $key }}" @if($general['start_of_week'] == $key) selected @endif>{{ $weekday }}</option>
                            @endforeach
                        </select>
                    @else
                        <p>No week start options available.</p>
                    @endif
                </div>
                <div class="col-span-1">
                    <x-admin.submit-button>
                        {{ __('Save Change') }}
                    </x-admin.submit-button>
                </div>
                <div class="col-span-3"></div>
            </div>
        </form>
    </section>

    @push('custom_scripts')
        <script>
            $('input[name="date_format"]').on('change', function() {
                $('#date_format6').val($(this).val());
            });
            $('input[name="time_format"]').on('change', function() {
                $('#time_format5').val($(this).val());
            });

            /* Image uploading */
            $(document).ready(function() {
                const $removeIcon = $('#remove_icon').hide();
                const $changeIcon = $('#change_icon').hide();
                const $faviconPreview = $('#favicon_preview').hide();
                const $chooseFile = $('#choose_file').show();
                const $fileInput = $('#file_input');

                const faviconImage = '{{ $webConfig["siteFavicon"] }}';
                const existingFaviconUrl = '{{ asset("storage/" . $webConfig["siteFavicon"]) }}';
                const siteName = '{{ $webConfig["siteName"] }}';
                const $bg = '{{ asset("assets/images/browser.png") }}';

                if (faviconImage !== '') {
                    displayFaviconPreview(existingFaviconUrl, siteName);
                    $faviconPreview.show();
                        $removeIcon.show();
                        $changeIcon.show();
                        $chooseFile.hide();

                }

                $fileInput.on('change', function() {
                    const files = $fileInput[0].files;
                    handleFiles(files);
                });

                $removeIcon.on('click', function() {
                    removeFaviconPreview();
                });

                function handleFiles(files) {
                    $faviconPreview.empty();
                    if (files.length > 0) {
                        $faviconPreview.show();
                        $removeIcon.show();
                        $changeIcon.show();
                        $chooseFile.hide();

                        $.each(files, function(index, file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                displayFaviconPreview(e.target.result, siteName);
                            }
                            reader.readAsDataURL(file);
                        });
                    }
                }

                function displayFaviconPreview(faviconUrl, siteName) {
                    const site_name = $('<span class="absolute top-[12px] left-[146px] text-black font-medium ml-2">'+ siteName +'</span>');
                    const smallIcon = $('<div class="bg-img w-64 h-20 relative" style="background-image: url('+ $bg +')">').append(site_name)
                        .append($('<img class="favicon w-[16px] h-[16px] absolute top-[16px] left-[127px]">').attr('id', 'favicon').attr('src', faviconUrl));
                    const bigImg = $('<img class="w-20 big-favicon rounded-lg">').attr('id', 'big_favicon').attr('src', faviconUrl);
                    if(existingFaviconUrl !== '') {
                        $faviconPreview.append(smallIcon).append(bigImg).show();
                    } else {
                        $faviconPreview.append(smallIcon).append(bigImg).hide();
                    }
                }

                function removeFaviconPreview() {
                    $faviconPreview.empty().hide();
                    $fileInput.val('');
                    $removeIcon.hide();
                    $changeIcon.hide();
                    $chooseFile.show();
                }

                /*** Site Logo ***/
                $(document).ready(function() {
                    const $siteLogoInput = $('#site_logo');
                    const $logoThumbnail = $('#logo_thumbnail');
                    const $logo = '{{ $webConfig["siteLogo"] }}';
                    const siteLogo = $logo !== '' ? '{{ asset("storage/" . $webConfig["siteLogo"]) }}' : 'https://placehold.co/150x150?text=Logo';

                    if (siteLogo) {
                        displaySiteLogoPreview(siteLogo);
                    }

                    $siteLogoInput.on('change', function() {
                        const files = $siteLogoInput[0].files;
                        sitLogoHandleFile(files);
                    });

                    function sitLogoHandleFile(files) {
                        if (files.length > 0) {
                            $.each(files, function(index, file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    console.log(e.target.result);
                                    displaySiteLogoPreview(e.target.result);
                                };
                                reader.onerror = function(e) {
                                    console.error("Error reading file: ", e.target.error);
                                };
                                reader.readAsDataURL(file);
                            });
                        }
                    }

                    function displaySiteLogoPreview(siteLogo) {
                        $logoThumbnail.empty(); // Clear previous thumbnail
                        const logo = $('<img class="w-40 rounded-lg">').attr('id', 'site_logo_img').attr('src', siteLogo);
                        $logoThumbnail.append(logo);
                    }
                });

            });
        </script>
    @endpush
</x-admin-layout>
