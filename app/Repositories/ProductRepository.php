<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    protected $limit;

    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->limit = config('common.default_per_page');
    }

    public function getList(array $params = [])
    {
        // basic query ...........
        $query = $this->model->query()->with(['categories', 'tags', 'brand', 'variants', 'downloadable']);
        // search input...........
        if (!empty($params['search'])) {
            $query->where(function ($q) use ($params) {
                $q->where('title', 'like', '%' . $params['search'] . '%')
                    ->orWhere('description', 'like', '%' . $params['search'] . '%')
                    ->orWhere('sku', 'like', '%' . $params['search'] . '%')
                    ->orWhere('upc', 'like', '%' . $params['search'] . '%')
                    ->orWhere('brand_id', function ($query) use ($params) {
                        $query->where('title', 'like', '%' . $params['search'] . '%');
                    });
            });
        }

        if (!empty($params['category'])) {
            $query->whereHas('categories', function ($q) use ($params) {
                $q->where('categories.id', $params['category']);
            });
        }

        if (!empty($params['brand'])) {
            $query->where('brand_id', $params['brand']);
        }

        if (!empty($params['min_price']) && !empty($params['max_price'])) {
            $query->whereBetween('price', [$params['min_price'], $params['max_price']]);
        }

        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        if (!empty($params['sort']) && !empty($params['order'])) {
            $sort = $params['sort'];
            $order = $params['order'];
            $this->model = $query->orderBy($sort, $order);
        }

        return $this->model->paginate($this->limit)->appends($params);
    }

    public function findOneOrFail(int $id)
    {
        // TODO: Implement findOneOrFail() method.
    }

    public function createProduct(array $data)
    {
        // TODO: Implement createProduct() method.
    }

    public function updateProduct(int $id, array $data)
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct($id)
    {
        // TODO: Implement deleteProduct() method.
    }
}