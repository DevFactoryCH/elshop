<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;

use \Dimsav\Translatable\Translatable;

class Tax extends Model
{
    use Translatable;

	public $translatedAttributes = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rate',
        'name'
    ];

    public $timestamps = FALSE;

    public function countries() {
    	return $this->belongsToMany('Devfactory\Elshop\App\Models\Country', 'tax_rules');
    }

    public function regions() {
    	return $this->belongsToMany('Devfactory\Elshop\App\Models\Region', 'tax_rules');
    }
}
