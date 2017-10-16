<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use LaravelLocalization;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($model, $object_id)
    {
        $model_singular = $this->get_singular_model($model);
        $object = $model_singular::find($object_id);
        return view('admin.translations.index')->with('object', $object)->with('model', $model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($model, $object_id)
    {
        $model_singular = $this->get_singular_model($model);
        $object = $model_singular::find($object_id);
        $languages = [];
        foreach(LaravelLocalization::getSupportedLocales() as $locale_code => $properties){
            if(!$object->hasTranslation($locale_code))
                $languages[$locale_code] = $properties['native'];                                  
        }
        return view('admin.translations.create')->with('object', $object)->with('languages', $languages)->with('model', $model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $model, $object_id)
    {
        $model_singular = $this->get_singular_model($model);
        $object = $model_singular::find($object_id);
        $rules = [];
        $rules['language'] = 'required';
        foreach($object->translatedAttributes as $attribut){
            if($attribut == 'slug')
                continue;
            if(is_null($object->translation_not_required) || !in_array($attribut, $object->translation_not_required))
                $rules[$attribut] = 'required';
        }
        $this->validate($request, $rules);
        foreach($object->translatedAttributes as $attribut){ 
           $object->translateOrNew($request->input('language'))->$attribut = $request->input($attribut);
        }
        $object->save();
        return redirect()->route('admin.translations.index', [$model, $object->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($model, $object_id, $language){
        $model_singular = $this->get_singular_model($model);
        $object = $model_singular::find($object_id);
        return view('admin.translations.edit')->with('object', $object)->with('model', $model)->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $model, $object_id, $language)
    {
        $model_singular = $this->get_singular_model($model);
        $object = $model_singular::find($object_id);
        $rules = [];
        foreach($object->translatedAttributes as $attribut){
            if($attribut == 'slug')
                continue;
            if(is_null($object->translation_not_required) || !in_array($attribut, $object->translation_not_required))
                $rules[$attribut] = 'required';
        }
        $this->validate($request, $rules);
        foreach($object->translatedAttributes as $attribut){ 
           $object->translateOrNew($language)->$attribut = $request->input($attribut);
        }
        $object->save();
        return redirect()->route('admin.translations.index', [$model, $object->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($model, $object_id, $language){
        $model_singular = $this->get_singular_model($model); 
        $object = $model_singular::find($object_id);
        $object->deleteTranslations($language);
        return redirect()->route('admin.translations.index', [$model, $object->id]);
    }

    /**
     * Get the singular name of a model
     *
     * @param  string  $model
     * @return string
     */
    function get_singular_model($model){
        return "App\Models\\".ucfirst(str_singular(str_replace('-', '', $model))); //get the model by plurial
    }
}
