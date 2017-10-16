<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;

class Country extends Model
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
        'name'
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

    public function currencies(){
        return $this->belongsToMany('App\Models\Currency');
    }

    public function vat() {
        return $this->belongsToMany('App\Models\Tax', 'tax_rules', 'country_id', 'tax_id');
    }
}

class CountryTranslation extends Model
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

