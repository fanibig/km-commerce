<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="grid grid-cols-1">
        <div size="small" class="mt-4 py-3 px-3">
            <div class="grid grid-cols-2 gap-4 items-center">
                <div class="left-side">
                    <x-admin.search-input :value="request()->input('search')" name="search" :route="route('admin.tags.list')" />
                </div>
                <div class="right-side text-right">
                    <x-admin.add-new-button :href="route('admin.tags.create')">
                        {{ __('Add New') }}
                    </x-admin.add-new-button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-4">
        @include('admin.tags.table')

        {{ $tags->links() }}
    </div>
</x-admin-layout>