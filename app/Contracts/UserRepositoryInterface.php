<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getList(array $params = []);
    public function getById($id);
    public function createUser(array $data): string|object;
    public function updateUser($id, array $data): string|object;
    public function deleteUser($id);
}