<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Contracts\UserRepositoryInterface;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class UserController extends Controller
{
    protected $userRepository;
    protected $limit;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->limit = config('common.default_per_page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'User List';

        $params = [
            'search' => $request->search,
            'sort' => $request->sort,
            'order' => $request->order,
            'roles' => $request->roles,
            'permissions' => $request->permissions,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $usersData = $this->userRepository->getList($params);

        return view('admin.users.index', [
            'pageTitle' => $pageTitle,
            'users' => $usersData['users'],
            'userCount' => $usersData['usersCount'],
            'usersPlural' => Str::plural('Item', $usersData['usersCount']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $pageTitle = 'Create User';

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.create', [
            'pageTitle' => $pageTitle,
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            $filename     = $request->file('image');
            $originalName = pathinfo($filename->getClientOriginalName() . '.' . $filename->getClientOriginalExtension(), PATHINFO_FILENAME);
            $path         = 'users';

            // Store the image in the 'public/category' directory
            $storedPath = $filename->storeAs($path, $originalName, 'public');

            // Optimize the stored image
            $fullPath = Storage::disk('public')->path($storedPath);
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);

            // Save the optimized image path in the database
            $userData['image'] = $storedPath;
        }

        $user = $this->userRepository->createUser($userData);

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        Alert::toast('User created successfully.', 'success')->autoClose(2000);
        return redirect()->route('admin.users.list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit User';

        $user = $this->userRepository->getById($id);

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.edit', [
            'pageTitle' => $pageTitle,
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userRepository->getById($id);
        // dd($request->all());
        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ];

        $this->userRepository->updateUser($user->id, $userData);

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        Alert::toast('User updated successfully.', 'success')->autoClose(2000);
        return redirect()->route('admin.users.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->getById($id);
        $getRole = $user->getRoleNames();
        $user->removeRole($getRole[0]);
        $this->userRepository->deleteUser($user->id);

        Alert::toast('User deleted successfully.', 'error')->autoClose(2000);
        return redirect()->route('admin.users.list');
    }
}