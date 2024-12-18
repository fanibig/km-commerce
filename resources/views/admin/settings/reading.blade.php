<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <section class="mt-10 general-setting">
        <form action="{{ route('admin.settings.writing.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-4 items-start justify-start max-w-4xl">
                <div class="col-span-1">
                    <label for="site_name" class="block font-medium text-md text-gray-700 dark:text-gray-200">{{ __('Your homepage displays') }}</label>
                </div>
                <div class="col-span-3">
                    <div class="post-on-front">
                        <label for="front_page_posts" class="text-black dark:text-gray-200">
                            <input type="radio" name="show_on_front" value="posts" @if($webConfig['pageOnFront'] == 'posts') checked @endif class="form-radio" id="front_page_posts">
                            {{ __('Your latest posts') }}
                        </label>
                    </div>
                    <div class="page-on-front mt-4">
                        <label for="front_page_posts" class="text-black dark:text-gray-200">
                            <input type="radio" name="show_on_front" value="posts" @if($webConfig['pageOnFront'] == 'page') checked @endif class="form-radio" id="front_page_posts">
                            {!! __('A <a href="#" class="text-blue-700 dark:text-amber-600 dark:hover:text-white">static page</a> (select below)') !!}
                        </label>
                    </div>
                    <div class="list-of-pages grid grid-cols-5 items-center justify-start gap-4 mt-4">
                        <div class="col-span-1">
                            <label for="page_on_front" class="block font-medium text-md text-gray-700 dark:text-gray-200">
                                {{ __('Home page:') }}
                            </label>
                        </div>
                        <div class="col-span-4">
                            <select name="page_on_front" id="page_on_front" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}" @if($webConfig['pageOnFront'] == $page->id) selected @endif>
                                        {{ $page->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="list-of-pages grid grid-cols-5 items-center justify-start gap-4 mt-4">
                        <div class="col-span-1">
                            <label for="page_on_front" class="block font-medium text-md text-gray-700 dark:text-gray-200">
                                {{ __('Post page:') }}
                            </label>
                        </div>
                        <div class="col-span-4">
                            <select name="page_on_front" id="page_on_front" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}" @if($webConfig['pageOnFront'] == $page->id) selected @endif>
                                        {{ $page->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
