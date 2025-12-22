<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    public $timestamps = false;
    protected $fillable
        = [
            'name',
            'logo',
            'email',
            'phone',
            'header',
            'footer',
            'about_us',
            'title',
            'keywords',
            'metades',
            'facebook',
            'youtube',
            'twitter',
            'pinterest',
            'address',
            'cskh',
            'open_time',
            'txt-middle',

        ];

    protected $hidden
        = [
            'pivot'
        ];

}
