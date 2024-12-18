<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.users.permissions.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $permission->exists ? route('admin.users.permissions.update', $permission->id) : route('admin.users.permissions.store') }}" method="post" class="permissions-form mt-4" enctype="multipart/form-data">
        @include('admin.permissions.form')
    </form>
</x-admin-layout>
