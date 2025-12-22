<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
	protected $table = 'popup';
    protected $fillable
        = [
            'image_link',
            'name',
            'link',
            'type',
            'text',
            'status',
            'type',
            'order',
        ];
}
