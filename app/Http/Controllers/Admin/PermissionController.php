<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = config('common.default_per_page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'Permission List';

        $search = $request->input('search');

        $query = Permission::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $permissions = $query->orderBy('id', 'asc')->paginate(100)->withQueryString();

        return view('admin.permissions.index', compact('pageTitle', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Permission $permission)
    {
        $pageTitle = 'Create Permission';

        return view('admin.permissions.create', compact('pageTitle', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        Alert::toast('Permission created successfully', 'success')->autoClose(2000);
        return redirect()->route('admin.permissions.list');
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
        $pageTitle = 'Edit Permission';
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->name = $request->name;
        $permission->save();
        Alert::toast('Permission updated successfully', 'success')->autoClose(2000);
        return redirect()->route('admin.permissions.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->roles()->detach();
        $permission->delete();
        Alert::toast('Successfully deleted permission', 'error')->autoClose(2000);
        return redirect()->route('admin.permissions.list');
    }
}