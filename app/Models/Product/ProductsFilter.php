<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    protected $table = 'products_filter';

    protected $fillable
        = [
            'name',
            'order',
        ];
    public function getValues()
    {
        return $this->hasMany(ProductsFilterValue::class, 'filter_id')->orderBy('order','DESC');
    }    
}
