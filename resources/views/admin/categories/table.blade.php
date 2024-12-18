

<x-admin.tables.table-view>
    <x-slot name="thead">
        <x-admin.tables.table-head>
            <x-admin.tables.tr-row>
                <x-admin.tables.th-row class="w-12">
                    <span class="flex items-center justify-between w-full cursor-pointer">
                        {{ __('ID') }}
                    </span>
                </x-admin.tables.th-row>
                <x-admin.tables.th-row>
                    <span class="flex items-center justify-between w-full cursor-pointer">
                        {{ __('Name') }}
                    </span>
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-96 text-left">
                    {{ __('Description') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-32 text-center">
                    {{ __('Status') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-28 text-center">
                    {{ __('Count') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-36">
                    {{ __('Dates') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-28">
                    {{ __('Actions') }}
                </x-admin.tables.th-row>
            </x-admin.tables.tr-row>
        </x-admin.tables.table-head>
    </x-slot>

    <x-slot name="tbody">
        <x-admin.tables.table-body>
            @if($categories->count() > 0)
                @foreach ($categories as $category)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $category->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300 flex items-center justify-start">
                                <x-admin.tables.table-link route="{{ route('admin.categories.edit', $category->id) }}">
                                    @if($category->depth > 0)
                                        <span class="align-middle mr-1">
                                            {!! str_repeat($childSeparator, $category->depth) !!}
                                        </span>
                                    @endif
                                    <span class="rounded-md mr-4 inline-block overflow-hidden">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->title }}" class="w-10 h-10 inline-block" />
                                    </span>
                                    <span class="title inline-block align-top">{{ $category->title }}</span>
                                </x-admin.tables.table-link>
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $category->description }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" data-id="{{ $category->id }}" name="is_active" value="{{ $category->status == 1 ? 1 : 0 }}" id="status_{{ $category->id }}" class="sr-only peer" {{ $category->status == 1 ? 'checked' : '' }}>
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                <x-admin.tables.table-link :route="route('admin.products.list', ['category='. $category->id])">
                                {{ $category->products->count() }}
                                </x-admin.tables.table-link>
                            </div>
                        </x-admin.tables.td-row>

                        <x-admin.tables.td-row class="text-center text-nowrap">
                             <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ formatDate($category->created_at) }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-right">
                            <x-admin.delete-form-button route="{{ route('admin.categories.destroy', $category->id) }}" />
                        </x-admin.tables.td-row>
                    </x-admin.tables.tr-row>
                @endforeach
            @else
                <x-admin.tables.tr-row>
                    <x-admin.tables.td-row colspan="3">
                        <div class="flex items-center justify-center">
                            <div class="text-lg text-gray-500">
                                {{ __('No users found') }}
                            </div>
                        </div>
                    </x-admin.tables.td-row>
                </x-admin.tables.tr-row>
            @endif
        </x-admin.tables.table-body>
    </x-slot>
</x-admin.tables.table-view>
