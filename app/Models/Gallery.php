<?php

namespace App\Models;
use App\Models\Product\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable
        = [
            'name',
            'slug',
            'meta',
            'view',
            'description',
            'keyword',
            'status',
        ];

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id')->orderBy('thumbnail','DESC');
    } 
}
