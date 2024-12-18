
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
                    {{ __('Roles') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-72 text-left">
                    {{ __('Email') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-28">
                    {{ __('Count') }}
                </x-admin.tables.th-row>
                <x-admin.tables.th-row class="w-32">
                    {{ __('Dates') }}
                </x-admin.tables.th-row>
                @can('user-destroy')
                    <x-admin.tables.th-row class="w-24">
                        {{ __('Actions') }}
                    </x-admin.tables.th-row>
                @endcan
            </x-admin.tables.tr-row>
        </x-admin.tables.table-head>
    </x-slot>

    <x-slot name="tbody">
        <x-admin.tables.table-body>
            @if($userCount > 0)
                @foreach ($users as $user)
                    @php
                        $role = config('common.default_role');
                        foreach ($user->roles as $r) {
                            $role = $r->id;
                        }
                    @endphp
                    <x-admin.tables.tr-row class="text-black hover:bg-gray-300 even:bg-gray-50 odd:bg-white group align-top dark:bg-gray-800 dark:text-white dark:even:bg-gray-800 dark:odd:bg-gray-700">
                        <x-admin.tables.td-row>
                            <div class="text-sm"> {{ $user->id }} </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row>
                            @if(auth()->user()->can('user-edit'))
                                <x-admin.tables.table-link route="{{ route('admin.users.edit', $user->id) }}">
                                    {{ $user->full_name }}
                                </x-admin.tables.table-link>
                            @else
                                {{ $user->full_name }}
                            @endif
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $user->roles->implode('name', ', ') }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-left">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $user->email }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $user->products->count() }}
                            </div>
                        </x-admin.tables.td-row>
                        <x-admin.tables.td-row class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-300">
                                {{ $user->created_at->format($webConfig['dateFormat']) }}
                            </div>
                        </x-admin.tables.td-row>
                        @can('user-destroy')
                            <x-admin.tables.td-row class="text-center">
                                <x-admin.delete-form-button route="{{ route('admin.users.destroy', $user->id) }}" />
                            </x-admin.tables.td-row>
                        @endcan
                    </x-admin.tables.tr-row>
                @endforeach
            @else
                <x-admin.tables.tr-row>
                    <x-admin.tables.td-row colspan="7">
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

