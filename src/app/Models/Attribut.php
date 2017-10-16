<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;

class Attribut extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'name'
    ];
    
    protected $fillable = [
        'name',
    ];

    public $timestamps = FALSE;

    public function types() {
        return $this->belongsToMany('Devfactory\Elshop\App\Models', 'type_variation');
    }
}

class AttributTranslation extends Model
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
