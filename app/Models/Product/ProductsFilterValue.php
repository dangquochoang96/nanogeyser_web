<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductsFilterValue extends Model
{
    protected $table = 'products_filter_value';

    protected $fillable
        = [
            'filter_id',
            'name',
            'value',
            'order',
        ];

}
