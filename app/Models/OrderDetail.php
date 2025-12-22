<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable
        = [
            'id',
            'order_id',
            'product_id',
            'product_name',
            'product_image',
            'number',
            'price',
            'created_at',
            'updated_at'
        ];

    protected $hidden
        = [
            'pivot'
        ];
    public function product()
    {
        return $this->belongsTo(Product\Product::class, 'product_id');
    }    
}
