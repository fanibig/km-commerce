<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BrandStoreRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\BrandUpdateRequest;
use App\Contracts\BrandRepositoryInterface;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request)
    {
        $pageTitle = 'Brand List';
        $params = [
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'sort' => $request->input('sort') ?? 'id',
            'order' => $request->input('order') ?? 'desc',
        ];

        $brands = $this->brandRepository->listBrands($params);

        return view('admin.brands.index', compact('pageTitle', 'brands'));
    }

    public function create(Brand $brand)
    {
        $pageTitle = 'Add New Brand';
        return view('admin.brands.create', compact('pageTitle', 'brand'));
    }

    public function store(BrandStoreRequest $request)
    {
        $params = [
            'title' => $request->title,
            'slug' => $request->slug ? $request->slug : Str::slug($request->title),
            'status' => $request->status,
            'description' => $request->description,
            'meta_keywords' => $request->meta_keywords,
            'brand_logo' => $request->file('brand_logo'),
        ];

        $this->brandRepository->createBrand($params);
        Alert::toast('Brand created successfully', 'success')->autoClose(2000);
        return redirect()->route('admin.brands.list');
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Brand';
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand', 'pageTitle'));
    }

    public function update(BrandUpdateRequest $request, string $id)
    {
        $params = [
            'title' => $request->title,
            'slug' => $request->slug ? $request->slug : Str::slug($request->title),
            'status' => $request->status,
            'description' => $request->description,
            'meta_keywords' => $request->meta_keywords,
            'brand_logo' => $request->file('brand_logo'),
        ];

        $this->brandRepository->updateBrand($id, $params);
        Alert::toast('Brand updated successfully', 'success')->autoClose(2000);
        return redirect()->route('admin.brands.list');
    }

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->brandRepository->deleteBrand($brand->id);
        Alert::toast('Brand deleted successfully', 'success')->autoClose(2000);
        return redirect()->route('admin.brands.list');
    }
}