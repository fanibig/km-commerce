<?php

namespace App\Repositories;

use Spatie\SchemaOrg\Schema;
use App\Contracts\SchemaRepositoryInterface;

class SchemaRepository implements SchemaRepositoryInterface
{
    public function getCompanySchema()
    {
        return Schema::organization()
            ->name("Your Company Name")       // Replace with your company name
            ->url(url('/'))                   // Company URL
            ->logo(asset('images/logo.png'))  // Path to your company logo
            ->contactPoint(
                Schema::contactPoint()
                    ->telephone("+123456789")  // Replace with actual contact number
                    ->contactType("Customer Service")
            )
            ->toScript();
    }

    public function getProductSchema($product)
    {
        return Schema::product()
            ->name($product->name)
            ->description($product->description)
            ->sku($product->sku)
            ->price($product->price)
            ->brand($product->brand)
            ->offers(
                Schema::offer()
                    ->price($product->price)
                    ->priceCurrency('USD') // Adjust based on your currency
                    ->availability('http://schema.org/InStock')
            )
            ->toScript();
    }

    public function getOrganizationSchema()
    {
        return Schema::organization()
            ->name("Your Company Name")
            ->url(url('/'))
            ->logo(asset('images/logo.png'))
            ->contactPoint(
                Schema::contactPoint()
                    ->telephone("+123456789")
                    ->contactType("Customer Service")
            )
            ->toScript();
    }
}