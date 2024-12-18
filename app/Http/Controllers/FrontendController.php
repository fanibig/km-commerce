<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TaxCalculator;

class FrontendController extends Controller
{
    public function calculateOrderTotal(Request $request)
    {
        $products = Product::whereIn('id', $request->product_ids)->get();
        $location = [
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
        ];

        $total = 0;
        $totalTax = 0;

        foreach ($products as $product) {
            $tax = TaxCalculator::calculate($product, $location);
            $totalTax += $tax;
            $total += $product->price + $tax;
        }

        return response()->json([
            'subtotal' => $total - $totalTax,
            'tax' => $totalTax,
            'total' => $total,
        ]);
    }
}