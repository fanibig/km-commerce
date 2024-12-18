<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxRuleController extends Controller
{
    public function index()
    {
        $taxRules = TaxRule::with(['country', 'state', 'category'])->paginate(10);
        return view('admin.tax_rules.index', compact('taxRules'));
    }

    public function create()
    {
        return view('admin.tax_rules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'type' => 'required|in:percentage,fixed',
        ]);

        TaxRule::create($request->all());
        return redirect()->route('admin.tax-rules.index')->with('success', 'Tax Rule created successfully.');
    }

    public function edit(TaxRule $taxRule)
    {
        return view('admin.tax_rules.edit', compact('taxRule'));
    }

    public function update(Request $request, TaxRule $taxRule)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'type' => 'required|in:percentage,fixed',
        ]);

        $taxRule->update($request->all());
        return redirect()->route('admin.tax-rules.index')->with('success', 'Tax Rule updated successfully.');
    }

    public function destroy(TaxRule $taxRule)
    {
        $taxRule->delete();
        return redirect()->route('admin.tax-rules.index')->with('success', 'Tax Rule deleted successfully.');
    }
}