<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;

class Type extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function value($variation_id) {
        $attribut_id = TypeVariation::whereTypeId($this->id)
        ->whereVariationId($variation_id)
        ->first()
        ->attribut_id;

        return Attribut::find($attribut_id)->name;
    }
}
