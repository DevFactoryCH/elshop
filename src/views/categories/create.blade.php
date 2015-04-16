@extends('layouts.admin')

@section('header')
  <h1>@lang('elshop::category.categories')</h1>
@stop

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => $prefix . 'categories.store')) }}
        <div class="form-group">
          {{ Form::label('category', trans('elshop::category.category')) }}
          {{ Form::text('category', Input::get('category'), array('class' => 'form-control')) }}
          {{ $errors->first('category', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('parent', trans('elshop::category.parent')) }}
          {{ Form::select('parent', $categories , Input::get('parent'), array('class' => 'form-control')) }}
        </div>
        {{ Form::submit(trans('elshop::category.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop