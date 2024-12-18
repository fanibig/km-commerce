<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = config('common.default_per_page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Role List';
        $roles = Role::with('permissions')->paginate($this->limit);

        return view('admin.roles.index', compact('pageTitle', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Role $role)
    {
        $pageTitle = 'Create Role';
        $permissions = Permission::orderBy('name')->get();

        return view('admin.roles.create', compact('pageTitle', 'role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $role = new Role();

        $role->name = $request->name;

        $role->save();

        $role->syncPermissions($request->permissions);
        Alert::toast('Role created successfully', 'success')->autoClose(2000);

        return redirect()->route('admin.users.roles.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Role';
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.edit', compact('pageTitle', 'role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;

        $role->save();
        $role->syncPermissions($request->permissions);
        Alert::toast('Role updated successfully', 'success')->autoClose(2000);

        return redirect()->route('admin.users.roles.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();

        $role->delete();
        Alert::toast('Role deleted successfully', 'error')->autoClose(2000);

        return redirect()->route('admin.roles.list');
    }
}