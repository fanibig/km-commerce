
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
                <x-admin.tables.th-row class="w-28 text-center">
                    {{ __('sku') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-32 text-center">
                    {{ __('quantity') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-28 text-center">
                    {{ __('prices') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-20">
                    {{ __('features') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-56">
                    {{ __('categories') }}
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
            @if($products->count() > 0)
                @foreach ($products as $product)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $product->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                <span class="rounded-md mr-4 inline-block overflow-hidden">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-10 h-10 inline-block" />
                                </span>
                                <span class="title inline-block align-top">
                                    {{ $product->title }}
                                </span>
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $product->sku }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $product->quantity }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                @if ($product->sale_price > 0)
                                    <span class="text-red-500 dark:text-red-400 line-through block">
                                        {{ currencyFormatted($product->price) }}
                                    </span>
                                    <span class="text-green-500 dark:text-green-400 block">
                                        {{ currencyFormatted($product->sale_price) }}
                                    </span>
                                @else
                                    {{ currencyFormatted($product->price) }}
                                @endif
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $product->is_featured }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                @foreach ($product->categories as $category)
                                    @unless ($loop->first), @endunless
                                    <a href="?category={{ $category->id }}">{{ $category->title }}</a>
                                @endforeach
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center text-nowrap">
                             <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ formatDate($product->created_at) }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-right">
                            <x-admin.delete-form-button route="{{ route('admin.products.destroy', $product->id) }}" />
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

