<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bcategory;

class Blog extends Model
{
    protected $table = 'blog';
    protected $fillable
        = [
            'id',
            'name',
            'image',
            'status',
            'des',
            'order',
            'view',
            'time_view',
            'keywords',
            'metades',
            'shortdes',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Bcategory', 'blog_bcategory', 'blog_id', 'bcategory_id');
    }

}
