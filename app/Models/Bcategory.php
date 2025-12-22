<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Bcategory extends Model
{
    protected $table = 'bcategory';
    protected $fillable
        = [
            'id',
            'parent_id',
            'name',
            'status',
            'order',
            'keywords',
            'metades',
            'created_at',
            'updated_at'
        ];

    protected $hidden = [
        'pivot'
    ];

    public function blog()
    {
        return $this->belongsToMany('blog', 'blog_bcategory', 'bcategory_id', 'blog_id');
    }
    public function blogLimit()
    {
        return $this->belongsToMany(Blog::class, 'blog_bcategory', 'bcategory_id', 'blog_id')->take(4)->orderBy('created_at','DESC');
    }
    public function parentCategory()
    {
        return $this->hasOne(self::class,'id', 'parent_id');
    }


}
