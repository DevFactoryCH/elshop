<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;
use \Devfactory\Media\MediaTrait;

class Brand extends Model
{
    use SoftDeletes, Sluggable, MediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = FALSE;
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
