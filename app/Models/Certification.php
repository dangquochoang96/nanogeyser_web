<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications';

    // Loại chứng chỉ
    const TYPE_CHUNG_NHAN = 1;
    const TYPE_XET_NGHIEM = 2;

    public static $typeLabels = [
        self::TYPE_CHUNG_NHAN => 'Chứng Nhận',
        self::TYPE_XET_NGHIEM => 'Xét Nghiệm',
    ];

    protected $fillable
        = [
            'name',
            'slug',
            'meta',
            'view',
            'description',
            'keyword',
            'status',
            'type',
        ];

    public function getTypeLabelAttribute()
    {
        return self::$typeLabels[$this->type] ?? 'Không xác định';
    }

    public function certificationImages()
    {
        return $this->hasMany(CertificationImages::class, 'certification_id')->orderBy('thumbnail','DESC');
    }
}
