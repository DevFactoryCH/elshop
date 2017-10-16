<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;

class PaymentMethod extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'name'
    ];

    public $timestamps = false;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'enable',
    ];
}

class PaymentMethodTranslation extends Model
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
