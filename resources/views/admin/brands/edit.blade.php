<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.brands.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $brand->exists ? route('admin.brands.update', $brand->id) : route('admin.brands.store') }}" method="post" class="brands-form mt-4" enctype="multipart/form-data">
        @include('admin.brands.form')
    </form>
    @include('admin.brands.script')
</x-admin-layout>
