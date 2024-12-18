<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryStoreRequest;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class CategoryController extends Controller
{
    protected $limit;
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->limit = config('common.default_per_page');
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'Category List';

        $params = [
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort'),
            'order' => $request->input('order')
        ];

        $categoriesData = $this->categoryRepository->getList($params);
        $childSeparator = config('common.child_separator');

        return view('admin.categories.index', [
            'pageTitle' => $pageTitle,
            'categories' => $categoriesData['categories'],
            'categoriesCount' => $categoriesData['categoriesCount'],
            'categoriesPlural' => Str::plural('Item', $categoriesData['categoriesCount']),
            'childSeparator' => $childSeparator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $pageTitle = 'Add Category';
        $categories = Category::withDepth()->defaultOrder()->get();

        return view('admin.categories.create', [
            'pageTitle' => $pageTitle,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $category = [
                'title' => $request->title,
                'status' => $request->status,
                'description' => strip_tags($request->description),
                'slug' => $request->slug ? $request->slug : Str::slug($request->title),
                'parent_id' => $request->parent_id ? $request->parent_id : null,
                'meta_keywords' => $request->meta_keywords,
            ];

            if ($request->hasFile('image')) {
                $filename     = $request->file('image');
                $originalName = pathinfo($filename->getClientOriginalName() . '.' . $filename->getClientOriginalExtension(), PATHINFO_FILENAME);
                $path         = 'category';

                // Store the image in the 'public/category' directory
                $storedPath = $filename->storeAs($path, $originalName, 'public');

                // Optimize the stored image
                $fullPath = Storage::disk('public')->path($storedPath);
                $optimizerChain = OptimizerChainFactory::create();
                $optimizerChain->optimize($fullPath);

                // Save the optimized image path in the database
                $category['image'] = $storedPath;
            }
            $this->categoryRepository->createCategory($category);
            Alert::toast('Successfully created category', 'success')->autoClose(2000);
            return redirect()->route('admin.categories.list');
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(10000);
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Category';
        $category = Category::findOrFail($id);

        $categories = Category::where('id', '!=', $category->id)->withDepth()->defaultOrder()->get();

        return view('admin.categories.edit', [
            'pageTitle' => $pageTitle,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        try {
            $category = [
                'title' => $request->title,
                'status' => $request->status,
                'description' => strip_tags($request->description),
                'slug' => $request->slug ? $request->slug : Str::slug($request->title),
                'parent_id' => $request->parent_id ? $request->parent_id : null,
                'meta_keywords' => $request->meta_keywords,
            ];

            if ($request->hasFile('image')) {
                $filename     = $request->file('image');
                $originalName = pathinfo($filename->getClientOriginalName() . '.' . $filename->getClientOriginalExtension(), PATHINFO_FILENAME);
                $path         = 'category';

                // Check if there's an existing image and delete it from storage
                if ($category['image'] && Storage::disk('public')->exists($category['image'])) {
                    Storage::disk('public')->delete($category['image']);
                }

                // Store the image in the 'public/category' directory
                $storedPath = $filename->storeAs($path, $originalName, 'public');

                // Optimize the stored image
                $fullPath = Storage::disk('public')->path($storedPath);
                $optimizerChain = OptimizerChainFactory::create();
                $optimizerChain->optimize($fullPath);

                // Save the optimized image path in the database
                $category['image'] = $storedPath;
            }
            $this->categoryRepository->updateCategory($category['id'], $category);
            Alert::toast('Successfully updated category', 'success')->autoClose(2000);
            return redirect()->route('admin.categories.list');
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(10000);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function statusChange(Request $request, $id)
    {
        $catStatus = Category::findOrFail($id);

        $catStatus->status = $request->status;
        $catStatus->update();
        return response()->json(['message' => 'status changed successfully', 'status' => 200]);
    }
}