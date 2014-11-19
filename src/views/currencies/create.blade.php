@extends('layouts.admin')

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => $prefix . 'brands.store')) }}
        <div class="form-group">
          {{ Form::label('name', trans('brand.name')) }}
          {{ Form::text('name', Input::get('name'), array('class' => 'form-control')) }}
          {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
        </div>
        {{ Form::submit(trans('brand.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop