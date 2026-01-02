<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    
    protected $fillable = [
        'district_code',
        'district_name',
        'province_code',
        'province_name'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}