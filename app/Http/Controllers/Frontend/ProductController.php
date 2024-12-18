<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\SchemaRepositoryInterface;
use App\Models\Product;

class ProductController extends Controller
{
    protected $schemaRepository;

    public function __construct(SchemaRepositoryInterface $schemaRepository)
    {
        $this->schemaRepository = $schemaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, string $id)
    {
        $schemaProduct = $this->schemaRepository->getProductSchema($product);
        $schemaOrganization = $this->schemaRepository->getOrganizationSchema();

        return view('product.show', compact('product', 'schemaProduct', 'schemaOrganization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}