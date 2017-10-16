<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'provider',
        'url',
        'number',
        'order_id'
    ];

    public $timestamps = FALSE;
}
