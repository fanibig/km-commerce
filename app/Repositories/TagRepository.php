<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Contracts\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    protected $model;
    protected $limit;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
        $this->limit = config('common.default_per_page');
    }

    public function getList(array $params = [])
    {
        $query = $this->model->query()->with(['products']);

        // Search by title or description
        $query->when(!empty($params['search']), function ($q) use ($params) {
            $q->where('title', 'like', '%' . $params['search'] . '%')
                ->orWhere('description', 'like', '%' . $params['search'] . '%');
        });

        // Sorting
        $query->when(!empty($params['sort']) && !empty($params['order']), function ($q) use ($params) {
            $q->orderBy($params['sort'], $params['order']);
        });

        // Fetch paginated results and total count
        $tags = $query->paginate($this->limit)->appends($params);

        return [
            'tags' => $tags,
            'tagsCount' => $tags->total(),
        ];
    }

    public function getTagById($id)
    {
        return $this->model->with(['products'])->find($id);
    }

    public function createTag(array $data): string|object
    {
        return $this->model->create($data);
    }

    public function updateTag($id, array $data): string|object
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function deleteTag($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}