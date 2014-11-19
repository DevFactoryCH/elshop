@extends('layouts.admin')

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => array($prefix . 'brands.update', $brand->id), 'method' => 'PUT')) }}
        <div class="form-group">
          {{ Form::label('name', trans('brand.name')) }}
          {{ Form::text('name', $brand->name, array('class' => 'form-control')) }}
          {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
        </div>
        {{ Form::submit(trans('brand.edit'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop