<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bcategory;

class Page extends Model
{
    protected $table = 'page';
    protected $fillable
        = [
            'id',
            'name',
            'slug',
            'image',
            'status',
            'des',
            'order',
            'keywords',
            'metades',
            'created_at',
            'updated_at'
        ];

}
