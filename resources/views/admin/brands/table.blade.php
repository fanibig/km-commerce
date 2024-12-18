
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
                <x-admin.tables.th-row class="w-72 text-left">
                    {{ __('Description') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-72 text-left">
                    {{ __('keywords') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-32">
                    {{ __('Dates') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-24">
                    {{ __('Actions') }}
                </x-admin.tables.th-row>
            </x-admin.tables.tr-row>
        </x-admin.tables.table-head>
    </x-slot>

    <x-slot name="tbody">
        <x-admin.tables.table-body>
            @if($brands->count() > 0)
                @foreach ($brands as $brand)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $brand->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <x-admin.tables.table-link route="{{ route('admin.brands.edit', $brand->id) }}">
                                <span class="rounded-md mr-4 inline-block overflow-hidden">
                                    <img src="{{ $brand->brand_logo_url }}" alt="{{ $brand->title }}" class="w-10 h-10 inline-block" />
                                </span>
                                {{ $brand->title }}
                            </x-admin.tables.table-link>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $brand->description }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $brand->meta_keywords }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $brand->created_at->format($webConfig['dateFormat']) }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <x-admin.delete-form-button route="{{ route('admin.brands.destroy', $brand->id) }}" />
                        </x-admin.tables.td-row>
                    </x-admin.tables.tr-row>
                @endforeach
            @else
                <x-admin.tables.tr-row>
                    <x-admin.tables.td-row colspan="7">
                        <div class="flex items-center justify-center py-12">
                            <div class="text-lg text-gray-500 dark:text-gray-400">
                                {{ __('No users found') }}
                            </div>
                        </div>
                    </x-admin.tables.td-row>
                </x-admin.tables.tr-row>
            @endif
        </x-admin.tables.table-body>
    </x-slot>
</x-admin.tables.table-view>
