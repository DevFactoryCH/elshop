<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVariation extends Model
{

    public $timestamps = false;
    protected $table = 'type_variation';
    protected $fillable = [
        'variation_id',
        'type_id',
        'attribut_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

}
