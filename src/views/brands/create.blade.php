@extends('layouts.admin')

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => $prefix . 'brands.store')) }}
        <div class="form-group">
          {{ Form::label('name', trans('elshop::brand.name')) }} <span class="text-danger">*</span>
          {{ Form::text('name', Input::get('name'), array('class' => 'form-control')) }}
          {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('website', trans('elshop::brand.website')) }}
          <div class="input-group">
            <span class="input-group-addon">http://</span>
            {{ Form::text('website', Input::get('website'), array('class' => 'form-control')) }}
            {{ $errors->first('website', '<span class="text-danger">:message</span>') }}
          </div>
        </div>
        {{ Form::singleUpload('image', Lang::get('elshop::brand.form_image'), NULL, 'image') }}
        {{ Form::submit(trans('elshop::brand.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop

<div class="input-group">

  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
</div>
