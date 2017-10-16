<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;
use \Cviebrock\EloquentSluggable\Sluggable;
use \Devfactory\Media\MediaTrait;

class Category extends Model
{
    use Translatable, SoftDeletes, MediaTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public $translatedAttributes = [
        'name',
        'slug'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function parent() {
        return $this->belongsTo($this, 'parent_id')
        ->withTrashed();
	}
}

class CategoryTranslation extends Model
{
    use Sluggable;

    public $timestamps = FALSE;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

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
