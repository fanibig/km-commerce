<?php

namespace App\Http\Services;

use App\Models\TaxRule;

class TaxCalculator
{
    public static function calculate($product, $location)
    {
        $taxRules = TaxRule::query()
            ->when($location['country_id'], fn($query) => $query->where('country_id', $location['country_id']))
            ->when($location['state_id'], fn($query) => $query->where('state_id', $location['state_id']))
            ->when($product->category_id, fn($query) => $query->where('category_id', $product->category_id))
            ->get();

        $totalTax = 0;

        foreach ($taxRules as $rule) {
            $rate = $rule->rate;
            $amount = $rule->type === 'percentage'
                ? $product->price * ($rate / 100)
                : $rate;

            $totalTax += $amount;
        }

        return $totalTax;
    }
}