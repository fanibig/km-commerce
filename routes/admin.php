<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Auth\AuthenticatedController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Login route without the 'admin:admin' middleware
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [AuthenticatedController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthenticatedController::class, 'loginPost'])->name('login-post');
    });

    // Protected admin routes with 'admin:admin' middleware
    Route::middleware(['admin:admin', 'check_permission'])->group(function () {
        Route::post('/logout', [AuthenticatedController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('role_or_permission:admin|dashboard');

        Route::prefix('settings')->name('settings.')->controller(SettingController::class)->group(function () {
            Route::get('/general', 'general_setting')->name('general')
                ->middleware('permission:setting-general-setting');

            Route::post('/general-update', 'general_setting_update')->name('general.update')
                ->middleware('permission:setting-general-setting-update');

            Route::get('/writing', 'getWriting')->name('writing')
                ->middleware('permission:setting-getwriting');

            Route::post('/writing-update', 'updateWriting')->name('writing.update')
                ->middleware('permission:setting-updatewriting');

            Route::get('/reading', 'getReading')->name('reading')
                ->middleware('permission:setting-getreading');

            Route::post('/reading-update', 'updateReading')->name('reading.update')
                ->middleware('permission:setting-updatereading');
        });

        Route::prefix('users')->name('users')->as('users.')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/', 'index')->name('list')
                    ->middleware('role_or_permission:admin|user-index');
                Route::get('/create', 'create')->name('create')
                    ->middleware('role_or_permission:admin|user-create');
                Route::get('/edit/{id}', 'edit')->name('edit')
                    ->middleware('role_or_permission:admin|user-edit');
                Route::post('/store', 'store')->name('store')
                    ->middleware('role_or_permission:admin|user-store');
                Route::put('/update/{id}', 'update')->name('update')
                    ->middleware('role_or_permission:admin|user-update');
                Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                    ->middleware('role_or_permission:admin|user-destroy');
            });

            Route::prefix('roles')->name('roles')->as('roles.')->controller(RoleController::class)->group(function () {
                Route::get('/', 'index')->name('list')
                    ->middleware('role_or_permission:admin|role-index');
                Route::get('/create', 'create')->name('create')
                    ->middleware('role_or_permission:admin|role-create');
                Route::get('/edit/{id}', 'edit')->name('edit')
                    ->middleware('role_or_permission:admin|role-edit');
                Route::post('/store', 'store')->name('store')
                    ->middleware('role_or_permission:admin|role-store');
                Route::put('/update/{id}', 'update')->name('update')
                    ->middleware('role_or_permission:admin|role-update');
                Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                    ->middleware('role_or_permission:admin|role-destroy');
            });

            Route::prefix('permissions')->name('permissions')->as('permissions.')->controller(PermissionController::class)->group(function () {
                Route::get('/', 'index')->name('list')
                    ->middleware('role_or_permission:admin|permission-index');
                Route::get('/create', 'create')->name('create')
                    ->middleware('role_or_permission:admin|permission-create');
                Route::get('/edit/{id}', 'edit')->name('edit')
                    ->middleware('role_or_permission:admin|permission-edit');
                Route::post('/store', 'store')->name('store')
                    ->middleware('role_or_permission:admin|permission-store');
                Route::put('/update/{id}', 'update')->name('update')
                    ->middleware('role_or_permission:admin|permission-update');
                Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                    ->middleware('role_or_permission:admin|permission-destroy');
            });
        });

        Route::prefix('categories')->name('categories')->as('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|category-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|category-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|category-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|category-store');
            Route::post('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|category-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|category-destroy');
            Route::post('/status-change/{id}', 'statusChange')->name('status-change')
                ->middleware('role_or_permission:admin|category-statuschange');
        });

        Route::prefix('posts')->name('posts')->as('posts.')->controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|post-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|post-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|post-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|post-store');
            Route::put('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|post-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|post-destroy');
        });

        Route::prefix('tags')->name('tags')->as('tags.')->controller(TagController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|tag-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|tag-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|tag-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|tag-store');
            Route::put('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|tag-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|tag-destroy');
        });

        Route::prefix('products')->name('products')->as('products.')->controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|product-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|product-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|product-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|product-store');
            Route::put('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|product-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|product-destroy');
        });

        Route::prefix('brands')->name('brands')->as('brands.')->controller(BrandController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|brand-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|brand-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|brand-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|brand-store');
            Route::put('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|brand-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|brand-destroy');
        });

        Route::prefix('attributes')->name('attributes')->as('attributes.')->controller(AttributeController::class)->group(function () {
            Route::get('/', 'index')->name('list')
                ->middleware('role_or_permission:admin|attribute-index');
            Route::get('/create', 'create')->name('create')
                ->middleware('role_or_permission:admin|attribute-create');
            Route::get('/edit/{id}', 'edit')->name('edit')
                ->middleware('role_or_permission:admin|attribute-edit');
            Route::post('/store', 'store')->name('store')
                ->middleware('role_or_permission:admin|attribute-store');
            Route::put('/update/{id}', 'update')->name('update')
                ->middleware('role_or_permission:admin|attribute-update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy')
                ->middleware('role_or_permission:admin|attribute-destroy');
        });
    });
    // Admin routes with middleware...................
});