<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRule extends Model
{
    protected $table = 'tax_rules';
    protected $guard = ['admin'];
    protected $fillable = ['name', 'rate', 'type', 'country_id', 'state_id', 'category_id'];

    // public function country()
    // {
    //     return $this->belongsTo(Country::class);
    // }

    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}