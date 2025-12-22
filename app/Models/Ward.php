<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bcategory;

class Ward extends Model
{
    protected $table = 'wards';
    protected $fillable
        = [
            'id',
            'district_code',
            'name',
            'code',
            'status',
            'order',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

}
