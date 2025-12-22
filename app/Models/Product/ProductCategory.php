<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable
    = [
        'name',
        'description',
        'slug',
        'parent_id',
        'order',
        'keyword',
        'meta_description',
        'img',
        'status',
        'show_home'
    ];


    public function delete()
    {
        self::deleting(function ($category) {
            self::where('parent_id', $category->id)->delete();
        });

        return parent::delete();
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            ((new ProductProductCategory())->getTable()),
            'product_category_id',
            'product_id'
        );
    }
    public function productsLimit()
    {
        return $this->belongsToMany(
            Product::class,
            ((new ProductProductCategory())->getTable()),
            'product_category_id',
            'product_id'
        )
            ->where('show_category', 1)
            ->where('status', 1)
            ->where('permission', '!=', 1)
            ->take(16);
    }
    // public function getLimitProducts()
    // {
    //     return $this->products()
    //                 ->where('show_homes',1)
    //                 ->take(3);
    // }
    public function countProduct()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
