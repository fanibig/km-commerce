<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;
    protected $limit;
    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->limit = config('common.default_per_page');
    }

    public function getList(array $params = [])
    {
        $query = $this->model->query()->with(['admin', 'products'])->withDepth();

        // Search by title or description
        $query->when(!empty($params['search']), function ($q) use ($params) {
            $q->where(function ($query) use ($params) {
                $query->where('title', 'like', '%' . $params['search'] . '%')
                    ->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        });

        // Filter by status
        $query->when(!empty($params['status']), function ($q) use ($params) {
            $q->where('status', $params['status']);
        });

        // Sorting
        $query->when(!empty($params['sort']) && !empty($params['order']), function ($q) use ($params) {
            $q->orderBy($params['sort'], $params['order']);
        });

        // Fetch paginated results and total count
        $categories = $query->defaultOrder()->paginate($this->limit);

        return [
            'categories' => $categories,
            'categoriesCount' => $categories->total(),
        ];
    }

    public function getCategoryById($id)
    {
        return $this->model->with(['admin', 'products'])->withDepth()->find($id);
    }

    public function createCategory(array $data): string|object
    {
        return $this->model->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteCategory($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getCategoryBySlug($slug)
    {
        return $this->model->with(['admin', 'products'])->withDepth()->where('slug', $slug)->first();
    }

    public function changeStatusById($id, $status)
    {
        return $this->model->where('id', $id)->update(['status' => $status]);
    }
}