<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealers extends Model
{
    protected $table = 'dealers';
    protected $fillable
        = [
            'id',
            'name',
            'address',
            'district_id',
            'province_id',
            'phone',
            'is_active',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];
}
