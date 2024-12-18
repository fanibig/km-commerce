<?php

namespace App\Contracts;

interface ProductRepositoryInterface
{
    public function getList(array $params = []);
    public function findOneOrFail(int $id);
    public function createProduct(array $data);
    public function updateProduct(int $id, array $data);
    public function deleteProduct($id);
}