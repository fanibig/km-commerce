<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    protected $limit;

    public function __construct(Admin $user)
    {
        $this->model = $user;
        $this->limit = config('common.default_per_page');
    }

    public function getList(array $params = [])
    {
        $query = $this->model->query()->with(['roles', 'permissions', 'products']);

        // Search by title or description
        $query->when(!empty($params['search']), function ($q) use ($params) {
            $q->where(function ($query) use ($params) {
                $query->where('first_name', 'like', '%' . $params['search'] . '%')
                    ->orWhere('last_name', 'like', '%' . $params['search'] . '%')
                    ->orWhere('email', 'like', '%' . $params['search'] . '%')
                    ->orWhereHas('roles', function ($q) use ($params) {
                        $q->where('name', 'like', '%' . $params['search'] . '%');
                    })->orWhereHas('permissions', function ($q) use ($params) {
                        $q->where('name', 'like', '%' . $params['search'] . '%');
                    });
            });
        });

        $query->when(!empty($params['sort']) && !empty($params['order']), function ($q) use ($params) {
            $q->orderBy($params['sort'], $params['order']);
        });

        // Fetch paginated results and total count
        $users = $query->paginate($this->limit);

        return [
            'users' => $users,
            'usersCount' => $users->total(),
        ];
    }

    public function getById($id)
    {
        return $this->model->with(['roles', 'permissions'])->find($id);
    }

    public function createUser(array $data): string|object
    {
        return $this->model->create($data);
    }

    public function updateUser($id, array $data): string|object
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}