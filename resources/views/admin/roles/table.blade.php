

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
                @can('role-edit')
                    <x-admin.tables.th-row class="w-72 text-left">
                        {{ __('Assigned') }}
                    </x-admin.tables.th-row>
                @endcan
                <x-admin.tables.th-row class="w-32">
                    {{ __('Dates') }}
                </x-admin.tables.th-row>
                @can('role-destroy')
                    <x-admin.tables.th-row class="w-24">
                        {{ __('Actions') }}
                    </x-admin.tables.th-row>
                @endcan
            </x-admin.tables.tr-row>
        </x-admin.tables.table-head>
    </x-slot>

    <x-slot name="tbody">
        <x-admin.tables.table-body>
            @if($roles->count() > 0)
                @foreach ($roles as $role)
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $role->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $role->role_name }}
                            </div>
                        </x-admin.tables.td-row>
                        @can('role-edit')
                            <x-admin.tables.td-row class="text-center">
                                <div class="text-sm text-gray-900 dark:text-gray-300 pl-4">
                                    <x-admin.tables.table-link route="{{ route('admin.users.roles.edit', $role->id) }}">
                                        <i class="fa-solid fa-link text-xl"></i>
                                    </x-admin.tables.table-link>
                                </div>
                            </x-admin.tables.td-row>
                        @endcan
                        <x-admin.tables.td-row class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $role->created_at->format($webConfig['dateFormat']) }}
                            </div>
                        </x-admin.tables.td-row>
                        @can('role-destroy')
                            <x-admin.tables.td-row class="text-center">
                                <x-admin.delete-form-button route="{{ route('admin.users.destroy', $role->id) }}" />
                            </x-admin.tables.td-row>
                        @endcan
                    </x-admin.tables.tr-row>
                @endforeach
            @else
                <x-admin.tables.tr-row>
                    <x-admin.tables.td-row colspan="5">
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
