<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'locations';
    protected $fillable
        = [
            'id',
            'district_code',
            'district_name',
            'province_code',
            'province_name',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];
}
