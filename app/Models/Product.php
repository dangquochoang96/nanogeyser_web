<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable
        = [
            'id',
            'name',
            'image',
            'status',
            'des',
            'order',
            'keywords',
            'metades',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category', 'product_id', 'category_id');
    }

}
