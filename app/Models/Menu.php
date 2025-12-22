<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable
        = [
            'id',
            'name',
            'url',
            'type_url',
            'parent_id',
            'order',
            'image',
            'status',
            'is_big_menu',
            'is_left_menu',
            'created_at',
            'updated_at'
        ];

    protected $hidden
        = [
            'pivot'
        ];

}
