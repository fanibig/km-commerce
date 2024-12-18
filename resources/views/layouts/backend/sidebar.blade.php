<aside class="sidebar bg-white dark:bg-gray-800 fixed inset-0">
    <ul class="sidebar-menu m-0 p-0">
        <a href="{{ route('admin.dashboard') }}" class="py-1 flex items-center justify-center">
            <div class="logo-box max-w-[80px] mx-auto">
                <img src="{{ asset('storage/' . $webConfig['siteLogo']) }}" alt="{{ $webConfig['siteName'] }}" class="w-full">
            </div>
        </a>
        @can('dashboard')
             <x-admin.sidebar-link :active="request()->routeIs('admin.dashboard')" :href="route('admin.dashboard')">
                <x-slot name="icon">
                    <i class="fa-solid fa-gauge text-2xl"></i>
                </x-slot>
                {{ __('Dashboard') }}
            </x-admin.sidebar-link>
        @endcan

        {{--  Catalog  --}}
        @haspermission('catalog-access')
            <x-admin.sidebar-dropdown align="right">
                <x-slot name="trigger">
                    <x-admin.sidebar-link class="cursor-pointer" :active="request()->routeIs('admin.catalog.*')">
                        <x-slot name="icon">
                            <i class="fa-solid fa-boxes-stacked text-2xl"></i>
                        </x-slot>
                        {{ __('Catalog') }}
                    </x-admin.sidebar-link>
                </x-slot>

                <x-slot name="content">
                    @can('category-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.categories.*')" href="{{ route('admin.categories.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Categories') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('product-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.products.*')" href="{{ route('admin.products.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Products') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('tag-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.tags.*')" href="{{ route('admin.tags.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('tags') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('brand-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.brands.*')" href="{{ route('admin.brands.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('brands') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                </x-slot>
            </x-admin.sidebar-dropdown>
        @endhaspermission

        {{--  Users, Roles and Permissions  --}}
        @haspermission('users-access')
            <x-admin.sidebar-dropdown align="right">
                <x-slot name="trigger">
                    <x-admin.sidebar-link class="cursor-pointer" :active="request()->routeIs('admin.users.*')">
                        <x-slot name="icon">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </x-slot>
                        {{ __('Users') }}
                    </x-admin.sidebar-link>
                </x-slot>

                <x-slot name="content">
                    @can('user-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.users.list')" href="{{ route('admin.users.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('All Users') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('role-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.users.roles.*')" href="{{ route('admin.users.roles.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('All Roles') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('permission-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.users.permissions.*')" href="{{ route('admin.users.permissions.list') }}">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('All Permissions') }}</span>
                        </x-admin.dropdown-link>
                    @endcan
                </x-slot>
            </x-admin.sidebar-dropdown>
        @endhaspermission

        {{--  Attributes  --}}
        @haspermission('attributes-access')
            <x-admin.sidebar-dropdown align="right">
                <x-slot name="trigger">
                    <x-admin.sidebar-link class="cursor-pointer" :active="request()->routeIs('admin.attributes.*')">
                        <x-slot name="icon">
                            <i class="fa-solid fa-feather text-2xl"></i>
                        </x-slot>
                        {{ __('Attributes') }}
                    </x-admin.sidebar-link>
                </x-slot>

                <x-slot name="content">
                    @can('attribute-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.attributes.list')" :href="route('admin.attributes.list')">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Attributes') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('attribute-family-index')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.settings.writing')" :href="route('admin.settings.writing')">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Attribute Families') }}</span>
                        </x-admin.dropdown-link>
                    @endcan
                </x-slot>
            </x-admin.sidebar-dropdown>
        @endhaspermission

        {{-- Settings --}}
        @haspermission('settings-access')
            <x-admin.sidebar-dropdown align="right">
                <x-slot name="trigger">
                    <x-admin.sidebar-link class="cursor-pointer" :active="request()->routeIs('admin.settings.*')">
                        <x-slot name="icon">
                            <i class="fa-solid fa-gear text-2xl"></i>
                        </x-slot>
                        {{ __('Settings') }}
                    </x-admin.sidebar-link>
                </x-slot>

                <x-slot name="content">
                    @can('setting-general-setting')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.settings.general')" :href="route('admin.settings.general')">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('General') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('setting-getwriting')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.settings.writing')" :href="route('admin.settings.writing')">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Writing') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    @can('setting-getreading')
                        <x-admin.dropdown-link :active="request()->routeIs('admin.settings.reading')" :href="route('admin.settings.reading')">
                            <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                            <span class="text-block capitalize">{{ __('Reading') }}</span>
                        </x-admin.dropdown-link>
                    @endcan

                    <x-admin.dropdown-link :active="false" href="#">
                        <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                        <span class="text-block capitalize">{{ __('Discussion') }}</span>
                    </x-admin.dropdown-link>

                    <x-admin.dropdown-link :active="false" href="#">
                        <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                        <span class="text-block capitalize">{{ __('Media') }}</span>
                    </x-admin.dropdown-link>

                    <x-admin.dropdown-link :active="false" href="#">
                        <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                        <span class="text-block capitalize">{{ __('Permalinks') }}</span>
                    </x-admin.dropdown-link>

                    <x-admin.dropdown-link :active="false" href="#">
                        <span class="icon-block mr-2"><i class="fa-regular fa-circle"></i></span>
                        <span class="text-block capitalize">{{ __('Privacy') }}</span>
                    </x-admin.dropdown-link>
                </x-slot>
            </x-admin.sidebar-dropdown>
        @endhaspermission
    </ul>
</aside>
