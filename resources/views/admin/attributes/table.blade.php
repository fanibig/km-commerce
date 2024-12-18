
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
                <x-admin.tables.th-row class="text-center">
                    {{ __('Code') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Type') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Validated') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Required') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Unique') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Filterable') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Configurable') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="text-center">
                    {{ __('Position') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-24">
                    {{ __('Actions') }}
                </x-admin.tables.th-row>
            </x-admin.tables.tr-row>
        </x-admin.tables.table-head>
    </x-slot>

    <x-slot name="tbody">
        <x-admin.tables.table-body>
            @if($attributes->count() > 0)
                @foreach ($attributes as $attribute)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $attribute->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <x-admin.tables.table-link route="{{ route('admin.attributes.edit', $attribute->id) }}">
                                {{ $attribute->admin_name }}
                            </x-admin.tables.table-link>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->code }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->type }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->validation }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->is_required }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->is_unique }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->is_filterable }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->is_configurable }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $attribute->position }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <x-admin.delete-form-button route="{{ route('admin.attributes.destroy', $attribute->id) }}" />
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
