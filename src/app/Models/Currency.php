<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;

class Currency extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iso_code',
        'conversion_rate',
        'name',
        'symbol'
    ];

    public $timestamps = FALSE;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function countries() {
        return $this->belongsToMany('App\Models\Country');
    }
}

class CurrencyTranslation extends Model
{
    public $timestamps = FALSE;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}

