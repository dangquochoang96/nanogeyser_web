<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bcategory;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable
        = [
            'id',
            'province_code',
            'name',
            'code',
            'isInner',
            'status',
            'order',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

}
