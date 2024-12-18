
@csrf
@if ($attribute->exists)
    @method('PUT')
@endif
<div class="grid grid-cols-1 lg:grid-cols-12 xl:grid-cols-12 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-8 xl:col-span-8">
        <div class="py-6 px-4">
            <div class="form-group mb-6">
                <label class="inline-flex items-center cursor-pointer">
                    <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Active') }}
                    </span>
                    <input type="checkbox" name="status" value="{{ $attribute->status == true ? true : false }}" id="status" class="sr-only peer" {{ $attribute->status == 1 ? 'checked' : '' }} />
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="form-group mb-6">
                <x-admin.text-input label="Enter title" name="title" id="title" value="{{ $attribute->title ?? old('title') }}" class="rounded-md py-3 border-gray-200" placeholder="{{ __('Enter title') }}" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div class="form-group mb-6">
                <x-admin.text-input label="Enter slug" name="slug" id="slug" value="{{ $attribute->slug ?? old('slug') }}" class="rounded-md py-3 border-gray-200" placeholder="{{ __('Enter slug') }}" />
                <x-input-error :messages="$errors->get('slug')" />
            </div>

            <div class="form-group mb-6">
                <x-admin.text-input label="Enter meta keywords" name="meta_keywords" id="meta_keywords" value="{{ $attribute->meta_keywords ?? old('meta_keywords') }}" class="rounded-md py-3 border-gray-200" placeholder="{{ __('Enter meta keywords') }}" />
                <x-input-error :messages="$errors->get('meta_keywords')" />
            </div>

            <div class="form-group mb-6">
                <textarea name="description" id="description" cols="30" rows="10" class="px-4 py-3 w-full rounded-md border focus:outline-none focus:ring-0" placeholder="{{ __('Description') }}">{{ $attribute->description ?? old('description') }}</textarea>
            </div>

            <div class="form-group mb-6">
                <x-admin.image-input name="attribute_logo" id="attribute_logo" :image="$attribute->attribute_logo_url" :value="$attribute->attribute_logo_url ?? old('attribute_logo')" />
                <x-input-error :messages="$errors->get('attribute_logo')" />
            </div>

            <div class="form-group mb-6 text-right">
                <x-admin.submit-button>
                    {{ $attribute->exists ? __('Update attribute') : __('Add new attribute') }}
                </x-admin.submit-button>
            </div>
        </div>
    </div>
</div>

