
@csrf
@if ($tag->exists)
    @method('PUT')
@endif
<div class="grid grid-cols-1 lg:grid-cols-12 xl:grid-cols-12 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-8 xl:col-span-8">
        <div class="py-6 px-4">
            <div class="form-group mb-6">
                <x-admin.text-input name="title" id="title" value="{{ $tag->title ?? old('title') }}" placeholder="{{ __('Enter title') }}" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div class="form-group mb-6">
                <x-admin.text-input name="slug" id="slug" label="auto generated url key" value="{{ $tag->slug ?? old('slug') }}" placeholder="{{ __('auto generated url key') }}" />
                <x-input-error :messages="$errors->get('slug')" />
            </div>

            <div class="form-group mb-6">
                <textarea placeholder="{{ __('Meta Keywords') }}" name="meta_keywords" id="meta_keywords" class="w-full resize-none rounded-md border-gray-300 shadow-sm">{{ $tag->keywords ?? old('keywords') }}</textarea>
                <small class="text-gray-400 -mt-6">{{ __('Add key words with comma separator like: title, tag and lowercase.') }}</small>
            </div>

            <div class="form-group mb-6">
                <textarea name="description" id="description" class="w-full min-h-96 resize-none rounded-md border-gray-300 shadow-sm" placeholder="{{ __('Description') }}">{{ $tag->description ?? old('description') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <x-admin.submit-button class="ml-auto">
                    {{ $tag->exists ? __('Update tag') : __('Add new tag') }}
                </x-admin.submit-button>
            </div>
        </div>
    </div>
</div>

