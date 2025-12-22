<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications';

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

    public function certificationImages()
    {
        return $this->hasMany(CertificationImages::class, 'certification_id')->orderBy('thumbnail','DESC');
    }
}
