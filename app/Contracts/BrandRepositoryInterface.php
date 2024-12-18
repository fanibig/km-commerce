<?php

namespace App\Contracts;

use App\Models\Brand;

interface BrandRepositoryInterface
{
    public function filterFor(array $params);

    public function listBrands(array $params = []);

    public function findById(int $id);

    public function createBrand(array $params);

    public function updateBrand(int $id, array $params);

    public function deleteBrand($id);
}