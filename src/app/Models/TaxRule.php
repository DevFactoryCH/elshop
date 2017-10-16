<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRule extends Model {
	public $timestamps = FALSE;
}

class TaxTranslation extends Model {
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
