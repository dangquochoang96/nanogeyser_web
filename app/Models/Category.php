<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $table = 'Category';
    protected $fillable
        = [
            'id',
            'name',
            'url',
            'parent_id',
            'order',
            'status',
            'shordes',
            'keywords',
            'metades',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

    public function product()
    {
        return $this->belongsToMany('product', 'product_category', 'category_id', 'product_id');
    }

    public function parentCategory()
    {
        return $this->hasOne(self::class,'id', 'parent_id');
    }


}
