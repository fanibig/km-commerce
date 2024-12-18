
@csrf
@if ($role->exists)
    @method('PUT')
@endif
<div class="grid grid-cols-1 lg:grid-cols-12 xl:grid-cols-12 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-8 xl:col-span-8">
        <div class="py-6 px-4">
            <div class="form-group mb-6">
                <x-admin.text-input label="Enter name" name="name" id="name" value="{{ $role->name ?? old('name') }}" class="rounded-md py-3 border-gray-200" placeholder="{{ __('Enter name') }}" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="form-group mb-6">
                <div class="grid grid-cols-4 gap-4">
                    @foreach($permissions as $permission)
                        <x-admin.checkbox-input :label="$permission->name" :name="'permissions[]'" :id="'permissions_' . $permission->id" :value="$permission->name" :checked="$role->hasPermissionTo($permission->name) ? true : false" :inputClass="'select-item'" />
                    @endforeach
                </div>
            </div>

            <div class="form-group mb-6 text-right">
                <x-admin.submit-button>
                    {{ $role->exists ? __('Update role') : __('Add new role') }}
                </x-admin.submit-button>
            </div>
        </div>

    </div>
    <div class="col-span-4">
        <div class="py-6 px-4">
            <label for="select_all" class="flex items-center w-full bg-white py-2 px-2 shadow-sm border rounded-md border-gray-300 cursor-pointer dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-200 dark:hover:text-gray-800 dark:text-white">
                <input type="checkbox" id="select_all" class="bg-white border-gray-300 text-gray-800 focus:ring-gray-800 mr-2 rounded-full dark:text-black dark:focus:ring-white ">
                    All Select Permissions
            </label>
        </div>
    </div>
</div>

