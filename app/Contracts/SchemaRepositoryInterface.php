<?php

namespace App\Contracts;

use Spatie\SchemaOrg\BaseType;

interface SchemaRepositoryInterface
{
    public function getCompanySchema();
    public function getProductSchema($product);
    public function getOrganizationSchema();
}