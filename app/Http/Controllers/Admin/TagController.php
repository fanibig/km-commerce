<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Contracts\TagRepositoryInterface;

class TagController extends Controller
{
    protected $tagRepository;
    protected $limit;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->limit = config('common.default_per_page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'Tag List';

        $params = [
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort'),
            'order' => $request->input('order')
        ];

        $tagsData = $this->tagRepository->getList($params);

        return view('admin.tags.index', [
            'pageTitle' => $pageTitle,
            'tags' => $tagsData['tags'],
            'tagsCount' => $tagsData['tagsCount']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tag $tag)
    {
        $pageTitle = 'Add Tag';

        return view('admin.tags.create', [
            'pageTitle' => $pageTitle,
            'tag' => $tag
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $params = [
            'title' => $request->title,
            'slug' => $request->slug ? $request->slug : Str::slug($request->title),
            'description' => strip_tags($request->description),
            'meta_keywords' => $request->meta_keywords
        ];

        $this->tagRepository->createTag($params);

        Alert::toast('Successfully created tag', 'success')->autoClose(2000);

        return redirect()->route('admin.tags.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Tag';
        $tag = $this->tagRepository->getTagById($id);

        return view('admin.tags.edit', [
            'pageTitle' => $pageTitle,
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagUpdateRequest $request, string $id)
    {
        $tag = $this->tagRepository->getTagById($id);

        $params = [
            'title' => $request->title,
            'slug' => $request->slug ? $request->slug : Str::slug($request->title),
            'description' => strip_tags($request->description),
            'meta_keywords' => $request->meta_keywords
        ];

        $tag = $this->tagRepository->updateTag($tag->id, $params);

        Alert::toast('Successfully updated tag', 'success')->autoClose(2000);

        return redirect()->route('admin.tags.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = $this->tagRepository->getTagById($id);

        $this->tagRepository->deleteTag($tag->id);

        Alert::toast('Successfully deleted tag', 'error')->autoClose(2000);

        return redirect()->route('admin.tags.list');
    }
}