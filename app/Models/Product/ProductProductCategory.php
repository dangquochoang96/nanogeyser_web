<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductProductCategory extends Model
{
    protected $table = 'product_product_categories';

    protected $fillable
        = [
            'product_id',
            'product_category_id',
        ];

    public $timestamps = false;
}
