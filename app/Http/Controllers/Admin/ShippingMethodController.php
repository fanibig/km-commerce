<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $methods = ShippingMethod::all();
        return view('admin.shipping.methods.index', compact('methods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        ShippingMethod::create($validated);

        return redirect()->back()->with('success', 'Shipping method created successfully.');
    }



    // Frontend functionality make new controller for frontend...
    /* public function calculateShippingRates(Request $request)
    {
        $cartWeight = $request->input('cart_weight');
        $address = $request->input('address');

        $zone = ShippingZone::whereHas('locations', function ($query) use ($address) {
            $query->where('country', $address['country'])
                ->where('state', $address['state']);
        })->first();

        if (!$zone) {
            return response()->json(['error' => 'No shipping zone available'], 404);
        }

        $rates = ShippingRate::where('shipping_zone_id', $zone->id)
            ->where(function ($query) use ($cartWeight) {
                $query->where('min_weight', '<=', $cartWeight)
                    ->where('max_weight', '>=', $cartWeight);
            })
            ->get();

        return response()->json($rates);
    } */
}