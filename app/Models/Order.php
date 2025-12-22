<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable
        = [
            'id',
            'name',
            'phone',
            'address',
            'province',
            'district',
            'ward',
            'payment_type',
            'status',
            'total_price',
            'total',
            'created_at',
            'updated_at'
        ];

    protected $hidden
        = [
            'pivot'
        ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }           
}
