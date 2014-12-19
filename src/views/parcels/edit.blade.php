@extends('layouts.admin')

@section('content')

  <div class="row">

    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body">
          {{ Form::open(array('route' => array($prefix . 'brands.update', $brand->id), 'method' => 'PUT', 'files' => TRUE)) }}
            <div class="form-group">
              {{ Form::label('name', trans('brand.name')) }}
              {{ Form::text('name', $brand->name, array('class' => 'form-control')) }}
              {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
            </div>
            <div class="form-group">
              {{ Form::label('website', trans('elshop::brand.website')) }}
              {{ Form::text('website', $brand->website, array('class' => 'form-control')) }}
              {{ $errors->first('website', '<span class="text-danger">:message</span>') }}
            </div>
            {{ Form::singleUpload('image', Lang::get('pages.form_image'), $brand, 'image') }}
            {{ Form::submit(trans('brand.edit'), array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  
  </div>


@stop