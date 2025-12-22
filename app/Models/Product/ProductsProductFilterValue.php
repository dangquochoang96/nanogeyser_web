<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductsProductFilterValue extends Model
{
    protected $table = 'products_products_filter_value';

    protected $fillable
        = [
            'product_id',
            'filter_value_id',
        ];

}
