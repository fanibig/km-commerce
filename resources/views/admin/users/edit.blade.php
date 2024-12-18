<x-admin-layout :title="$pageTitle">
    @include('admin.users.styles')
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.users.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $user->exists ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="post" class="users-form mt-4" enctype="multipart/form-data">
        @include('admin.users.form')
    </form>

    @include('admin.users.script')
</x-admin-layout>
