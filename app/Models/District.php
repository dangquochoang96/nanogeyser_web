<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    
    public $timestamps = false;
    
    protected $fillable = [
        'province_code',
        'name',
        'code'
    ];

    public function locations()
    {
        return $this->hasMany(Location::class, 'district_code', 'code');
    }
}