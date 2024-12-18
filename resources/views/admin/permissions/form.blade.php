
@csrf
@if ($permission->exists)
    @method('PUT')
@endif
<div class="grid grid-cols-1 lg:grid-cols-12 xl:grid-cols-12 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-8 xl:col-span-8">
        <div class="py-6 px-4">

            <div class="form-group mb-6">
                <x-admin.text-input label="Enter name" name="name" id="name" value="{{ $permission->name ?? old('name') }}" class="rounded-md py-3 border-gray-200" placeholder="{{ __('Enter name') }}" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="form-group mb-6 text-right">
                <x-admin.submit-button>
                    {{ $permission->exists ? __('Update permission') : __('Add new permission') }}
                </x-admin.submit-button>
            </div>
        </div>
    </div>
</div>

