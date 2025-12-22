<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bcategory;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable
        = [
            'id',
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
