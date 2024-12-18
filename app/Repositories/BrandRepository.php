<?php

namespace App\Repositories;

use App\Models\Brand;
use InvalidArgumentException;
use App\Traits\UploadableFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Contracts\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class BrandRepository implements BrandRepositoryInterface
{
    use UploadableFile;
    protected $model;
    protected $limit;

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
        $this->limit = config('common.default_per_page');
    }

    public function filterFor(array $params)
    {
        // TODO: implement filterFor() method..
    }

    public function listBrands(array $params = [])
    {
        if (!empty($params['search'])) {
            $search = $params['search'];
            $this->model = $this->model->where('title', 'like', '%' . $search . '%');
        }

        if (!empty($params['status'])) {
            $this->model = $this->model->where('status', $params['status']);
        }

        if (!empty($params['sort']) && !empty($params['order'])) {
            $this->model = $this->model->orderBy($params['sort'], $params['order']);
        }

        return $this->model->paginate($this->limit)->withQueryString()->appends($params);
    }

    public function findById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createBrand(array $params)
    {
        try {
            if (!empty($params['brand_logo']) instanceof UploadedFile) {
                $directory = 'brand';
                $params['brand_logo'] = $this->uploadImage($params['brand_logo'], $directory);
            }
            return $this->model->create($params);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function updateBrand(int $id, array $params)
    {
        try {
            $brand = $this->model->findOrFail($id);
            if (!empty($params['brand_logo']) instanceof UploadedFile) {
                $directory = 'brand';
                $existingImagePath = $brand->brand_logo;
                $params['brand_logo'] = $this->updateUploadImage($params['brand_logo'], $existingImagePath, $directory);
            }
            return $brand->update($params);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function deleteBrand($id)
    {
        try {
            return $this->model->where('id', $id)->delete();
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}