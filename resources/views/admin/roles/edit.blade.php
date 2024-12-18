<x-admin-layout :title="$pageTitle">
    <x-slot name="header">
        {{ __($pageTitle) }}
    </x-slot>

    <div class="flex items-center justify-end mt-4 px-2 py-2">
        <x-admin.back-button :href="route('admin.users.roles.list')">
            {{ __('Back') }}
        </x-admin.back-button>
    </div>
    <form action="{{ $role->exists ? route('admin.users.roles.update', $role->id) : route('admin.users.roles.store') }}" method="post" class="roles-form mt-4" enctype="multipart/form-data">
        @include('admin.roles.form')
    </form>
    @include('admin.roles.script')
</x-admin-layout>
