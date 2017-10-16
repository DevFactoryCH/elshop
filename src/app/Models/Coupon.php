<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'discount_percent',
        'discount_price',
        'code',
        'number_of_use',
        'infinite'
    ];

    public $timestamps = FALSE;

}
