<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable
    = [
        'name',
        'type',
        'slug',
        'price',
        'discount',
        'meta',
        'sale_price',
        'description',
        'keyword',
        'image',
        'content',
        'product_code',
        'product_category_id',
        'status',
        'show_home',
        'show_category',
        'best_sell',
        'order',
        'video',
        'model',
        'weight',
        'number_filter',
        'filter_technology',
        'filter_capacity',
        'producer',
        'ability_clean',
        'guarantee',
        'technical_special',
        'advantages',
        'intro_video',
        'options',
        'permission'
    ];
    protected $casts = [
        'options' => 'array',
    ];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('thumbnail', 'DESC');
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            ProductCategory::class,
            ((new ProductProductCategory())->getTable()),
            'product_id',
            'product_category_id'
        );
    }
    public function filters()
    {
        return $this->belongsToMany(
            ProductsFilterValue::class,
            ((new ProductsProductFilterValue())->getTable()),
            'product_id',
            'filter_value_id'
        );
    }
}
