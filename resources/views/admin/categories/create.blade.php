<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.categories.list')">{{ __('Back') }}</x-admin.back-button>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="post" class="categorie-form mt-4" enctype="multipart/form-data">
        @include('admin.categories.form')
    </form>

    @include('admin.categories.script')
</x-admin-layout>
