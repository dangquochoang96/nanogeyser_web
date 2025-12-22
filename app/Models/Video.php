<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $fillable
        = [
            'id',
            'name',
            'view',
            'image',
            'status',
            'des',
            'link',
            'order',
            'keywords',
            'metades',
            'created_at',
            'show_home',
            'category',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

}
