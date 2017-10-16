<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {

    use SoftDeletes;

    protected $fillable = [
        'street',
        'street_number',
        'zip',
        'city',
        'first_name',
        'last_name',
        'user_id',
        'country_id',
        'region_id'
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
    
    public function region() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Region')
        ->withTrashed();
    }

    public function country() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Country')
        ->withTrashed();
    }

    public function user() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\User')
        ->withTrashed();
    }
}
