<?php

namespace App\Grabber\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    /** @var string  */
    protected $table = 'cars';

    /** @var array  */
    protected $fillable = [
        'link',
        'image',
        'title',
        'description',
        'message',
        'age',
        'price_rub',
        'price_usd',
        'location',
    ];
}

