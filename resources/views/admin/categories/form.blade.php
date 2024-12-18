
@csrf
<div class="grid grid-cols-1 lg:grid-cols-8 xl:grid-cols-10 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-4 xl:col-span-4">
        <div class="py-6 px-4">
            <div class="form-group mb-6">
                <label class="inline-flex items-center cursor-pointer">
                    <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Active') }}
                    </span>
                    <input type="checkbox" name="status" value="{{ $category->status == true ? true : false }}" id="status" class="sr-only peer" {{ $category->status == 1 ? 'checked' : '' }} />
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="form-group mb-6">
                <input placeholder="Enter title" name="title" id="title" value="{{ $category->title ?? old('title') }}" class="px-4 py-3 w-full rounded-md border focus:outline-none focus:ring-0" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div class="form-group mb-6">
                <input name="slug" id="slug" placeholder="auto generated url key" value="{{ $category->slug ?? old('slug') }}" class="px-4 py-3 w-full rounded-md border focus:outline-none focus:ring-0" />
                <x-input-error :messages="$errors->get('slug')" />
            </div>

            <div class="form-group mb-6">
                <select
                    name="parent_id"
                    placeholder="Select parent category"
                    class="px-4 py-3 w-full rounded-md border focus:outline-none focus:ring-0">
                    <option value="">{{ __('Select parent category') }}</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                            @if($cat->depth > 0)
                                {!! str_repeat('&mdash; ', $cat->depth) !!}
                            @endif {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-6">
                <textarea placeholder="Meta Keywords" name="meta_keywords" id="meta_keywords" class="px-4 py-3 max-h-14 w-full rounded-md border focus:outline-none focus:ring-0 resize-none">{{ $category->meta_keywords ?? old('meta_keywords') }}</textarea>
                <small class="text-gray-400">{{ __('Add key words with comma separator like: title, category and lowercase.') }}</small>
            </div>

            <div class="form-group mb-6">
                <textarea name="description" id="description" class="px-4 py-3 min-h-72 w-full rounded-md border focus:outline-none focus:ring-0 resize-none" placeholder="{{ __('Description') }}">{{ $category->description ?? old('description') }}</textarea>
            </div>
        </div>

        <div class="form-group mb-6 px-4">
            <x-admin.image-input name="image" id="image" :image="$category->image" :value="$category->image !== null ? $category->image_url : null" />
            <x-input-error :messages="$errors->get('image')" />
        </div>

        <div class="py-2 px-4 text-right">
            <x-admin.submit-button>
                {{ $category->exists ? __('Update') : __('Save') }}
            </x-admin.submit-button>
        </div>
    </div>

</div>

