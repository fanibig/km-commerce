<?php

namespace App\Contracts;

interface BaseRepositoryInterface
{
    public function all(array $params = []);
    public function create(array $attributes);
    public function update(array $attributes, int $id);
    public function find(int $id);
    public function findOneOrFail(int $id);
    public function findBy(array $data);
    public function findOneBy(array $data);
    public function delete(int $id);
}