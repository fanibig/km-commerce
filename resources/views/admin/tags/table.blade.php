

<x-admin.tables.table-view>
    <x-slot name="thead">
        <x-admin.tables.table-head>
            <x-admin.tables.tr-row>
                <x-admin.tables.th-row class="w-12">
                    <span class="flex items-center justify-between w-full cursor-pointer">
                        {{ __('ID') }}
                    </span>
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="min-w-44">
                    <span class="flex items-center justify-between w-full cursor-pointer">
                        {{ __('Name') }}
                    </span>
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-72 text-left">
                    {{ __('Slug') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-96 text-left">
                    {{ __('Description') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-24">
                    {{ __('Count') }}
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
            @if($tags->isNotEmpty())
                @foreach ($tags as $tag)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $tag->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <x-admin.tables.table-link route="{{ route('admin.tags.edit', $tag->id) }}">
                                {{ $tag->title }}
                            </x-admin.tables.table-link>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            {{ $tag->slug }}
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            {{ $tag->description }}
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            {{ $tag->products->count() }}
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $tag->created_at->format($webConfig['dateFormat']) }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <x-admin.delete-form-button route="{{ route('admin.users.destroy', $tag->id) }}" />
                        </x-admin.tables.td-row>
                    </x-admin.tables.tr-row>
                @endforeach
            @else
                <x-admin.tables.tr-row>
                    <x-admin.tables.td-row colspan="6">
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
