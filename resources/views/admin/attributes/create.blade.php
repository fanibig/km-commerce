<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.attributes.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $attribute->exists ? route('admin.attributes.update', $attribute->id) : route('admin.attributes.store') }}" method="post" class="attributes-form mt-4" enctype="multipart/form-data">
        @include('admin.attributes.form')
    </form>
    @include('admin.attributes.script')
</x-admin-layout>
