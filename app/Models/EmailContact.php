<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContact extends Model
{
    protected $table = 'email_contacts';

    protected $fillable
        = [
            'email',
            'name',
            'phone',
            'content',
            'is_check',
            'type',
        ];
}
