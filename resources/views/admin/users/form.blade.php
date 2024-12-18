
@csrf
@if ($user->exists)
    @method('PUT')
@endif
<div class="grid grid-cols-1 lg:grid-cols-12 xl:grid-cols-12 gap-4 items-start justify-start">
    <div class="col-span-1 lg:col-span-8 xl:col-span-8">
        <div class="py-6 px-4">

            <div class="form-group mb-6">
                <x-admin.text-input placeholder="Enter first name" name="first_name" id="first_name" value="{{ $user->first_name ?? old('first_name') }}" class="rounded-md py-3 border-gray-200" />
                <x-input-error :messages="$errors->get('first_name')" />
            </div>

            <div class="form-group mb-6">
                <x-admin.text-input name="last_name" id="last_name" placeholder="Enter last name" value="{{ $user->last_name ?? old('last_name') }}" class="rounded-md py-3 border-gray-200" />
                <x-input-error :messages="$errors->get('last_name')" />
            </div>
            <div class="form-group mb-6">
                <x-admin.text-input name="email" id="email" placeholder="Enter email" value="{{ $user->email ?? old('email') }}" class="rounded-md py-3 border-gray-200" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div x-data="passwordToggle()">
                <div class="form-group mb-6 relative flex">
                    <x-admin.text-input type="password" name="password" id="password" placeholder="Enter password" value="{{ $user->password ?? old('password') }}" class="rounded-md py-3 border-gray-200" x-bind:type="showPassword ? 'text' : 'password'"
                    x-model="password"  />
                    <button
                        type="button"
                        x-on:click="togglePassword()"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-gray-200 w-24 h-full flex items-center justify-center text-white rounded-r-md dark:bg-gray-700"
                    >
                        <i x-bind:class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-xl cursor-pointer"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password')" />
                </div>
                <div class="form-group mb-6">
                    <x-admin.text-input type="password" id="password_confirmation"
                        name="password_confirmation"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        x-model="passwordConfirmation"
                        placeholder="Re-enter password"
                        value="{{ $user->confirm_password ?? old('confirm_password') }}"
                        class="rounded-md py-3 border-gray-200" />

                    <x-input-error :messages="$errors->get('password_confirmation')" />
                </div>
            </div>
            @php
                $roleName = '';
                if ($user->exists){
                    $role = $user->getRoleNames();
                    $roleName = $role[0];
                }
            @endphp
            <div class="form-group mb-6">
                <select name="role[]" id="role" class="px-4 py-3 w-full rounded-md border focus:outline-none focus:ring-0">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if($role->name == $roleName) selected @endif>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-6">
                <div class="flex items-center justify-between gap-4">
                    <x-admin.image-input id="image" name="image" value="{{ $user->image_url }}" btnName="Avatar User" />

                    <div class="logo-thumbnail rounded overflow-hidden" id="logo_thumbnail"></div>
                </div>
            </div>

            <div class="form-group mb-6">
                <label class="inline-flex items-center cursor-pointer">
                    <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Active') }}
                    </span>
                    <input type="checkbox" name="status" value="{{ $user->status == true ? true : false }}" id="status" class="sr-only peer" {{ $user->status == 1 ? 'checked' : '' }} />
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div class="form-group mb-6 text-right">
                <x-admin.submit-button>
                    {{ $user->exists ? __('Update') : __('Add new') }}
                </x-admin.submit-button>
            </div>
        </>
    </div>
</div>
