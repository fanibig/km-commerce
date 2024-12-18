<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="grid grid-cols-1">
        <div class="mt-4 py-3">
            <div class="grid grid-cols-2 gap-4 items-center">
                <div class="left-side">
                    <div class="flex items-center justify-start">
                        <x-admin.search-input name="search" value="{{ request()->input('search') }}" :route="route('admin.categories.list')" />
                    </div>
                </div>
                <div class="right-side text-right">
                    <x-admin.add-new-button :href="route('admin.categories.create')">
                        {{ __('Add New') }}
                    </x-admin.add-new-button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-4">
        @include('admin.categories.table')

        {{ $categories->links() }}
    </div>

    @include('admin.categories.script')
</x-admin-layout>
