<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable
        = [
            'id',
            'name',
            'image',
            'status',
            'des',
            'address',
            'order',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

}
