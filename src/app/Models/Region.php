<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;

class Region extends Model
{
    use Translatable, SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public $translatedAttributes = [
        'name'
    ];
    
    public $timestamps = FALSE;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_id'
    ];

    public function country() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Country')
        ->withTrashed();
    }

    public function vat() {
        return $this->belongsToMany('Devfactory\Elshop\App\Models\Tax', 'tax_rules', 'region_id', 'tax_id');
    }
}

class RegionTranslation extends Model
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

