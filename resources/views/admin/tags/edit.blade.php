<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.tags.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $tag->exists ? route('admin.tags.update', $tag->id) : route('admin.tags.store') }}" method="post" class="tags-form mt-4" enctype="multipart/form-data">
        @include('admin.tags.form')
    </form>
</x-admin-layout>
