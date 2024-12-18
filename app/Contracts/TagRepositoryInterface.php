<?php

namespace App\Contracts;

interface TagRepositoryInterface
{
    public function getList(array $params = []);

    public function getTagById($id);

    public function createTag(array $data): string|object;

    public function updateTag($id, array $data): string|object;

    public function deleteTag($id);
}