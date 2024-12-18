<?php

namespace App\Contracts;

interface CategoryRepositoryInterface
{
    public function getList(array $params = []);
    public function getCategoryById($id);
    public function createCategory(array $data): string|object;
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
    public function getCategoryBySlug($slug);
    public function changeStatusById($id, $status);
}