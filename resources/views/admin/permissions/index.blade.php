<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="grid grid-cols-1">
        <div class="mt-4 py-3 px-3">
            <div class="grid grid-cols-2 gap-4 items-center">
                <div class="left-side">
                    <x-admin.search-input :value="request()->input('search')" name="search" :route="route('admin.users.permissions.list')" />
                </div>
                <div class="right-side text-right"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-4">
         @include('admin.permissions.table')

        {{ $permissions->links() }}
    </div>

    @include('admin.permissions.script')
</x-admin-layout>
