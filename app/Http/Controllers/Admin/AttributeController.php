<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    protected $limit = 20;

    public function index(Request $request)
    {
        $pageTitle = 'Attribute List';
        $attributes = Attribute::paginate($this->limit)->appends($request->all());

        return view('admin.attributes.index', ['pageTitle' => $pageTitle, 'attributes' => $attributes]);
    }

    public function create()
    {
        $pageTitle = 'Create Attribute';
        return view('admin.attributes.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->save();

        $notify[] = ['success', 'Attribute has been created successfully'];
        return back()->withNotify($notify);
    }

    public function edit(Attribute $attribute)
    {
        $pageTitle = 'Edit Attribute';
        return view('admin.attributes.edit', compact('attribute', 'pageTitle'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        $notify[] = ['success', 'Attribute has been deleted successfully'];
        return back()->withNotify($notify);
    }
}