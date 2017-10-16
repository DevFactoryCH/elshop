<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \Dimsav\Translatable\Translatable;
use \Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'name',
        'description',
        'slug'
    ];

    /**
     * The attributes that need to be display in textarea for translation form
     *
     * @var array
     */
    public $translation_textarea = [
        'description',
    ];

    /**
     * The attributes that are NOT required in the translation form
     * More logic to specify the NOT required because in general they are required and if they 
     * are all required (general case) you don't need to specify this array
     * @var array
     */
    public $translation_not_required = [
        'description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'name',
        'category_id',
        'description',
        'brand_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function category() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Category')->withTrashed();
	}

    public function get_variation($id) {
        return Variation::withTrashed()->find($id);
    }

    public function variations() {
        return $this->hasMany('Devfactory\Elshop\App\Models\Variation');
    }

    public function brand(){
        return $this->belongsTo('Devfactory\Elshop\App\Models\Brand')->withTrashed();
    }

    public function highlight() {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Variation', 'highlight_id');
    }

    public function discounts() {
        return $this->belongsToMany('Devfactory\Elshop\App\Models\Discount');
    }
}

class ProductTranslation extends Model
{
    use Sluggable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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
