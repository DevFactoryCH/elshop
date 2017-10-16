<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'percentage',
        'new_price',
        'start_date',
        'end_date'
    ];

    public $timestamps = FALSE;

    public function products() {
        return $this->belongsToMany('Devfactory\Elshop\App\Models\Product');
    }
}
