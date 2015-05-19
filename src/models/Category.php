<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

  public static $rules = [
    'category' => 'required',
  ];

  protected $fillable = [
    'category',
    'category_id',
    'status',
  ];

  public function categories() {
    return $this->hasMany('Devfactory\Elshop\Models\Category');
  }

  public function articles() {
    return $this->belongsToMany('Devfactory\Elshop\Models\Article', 'articles_categories');
  }

  /**
   * Get all children from a category
   * 
   * @return array array with all children id
   */
  public function getChildren() {
    $categories[] = $this->id;
    foreach ($this->categories()->get() as $category) {
      $categories[] = $category->id;
      foreach ($category->categories()->get() as $children) {
        $categories[] = $children->id;
      }
    }

    return $categories;
  }

  public function parent() {
    if ($this->category_id) {
      return $this->belongsTo('Devfactory\Elshop\Models\Category', 'category_id');
    }

    return FALSE;
  }
}