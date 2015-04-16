@extends('layouts.admin')

@section('header')
  <h1>@lang('elshop::category.categories')</h1>
@stop

@section('content')
  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(['route' => [$prefix . 'categories.update', $category->id], 'method' => 'PUT']) }}
        <div class="form-group">
          {{ Form::label('category', trans('elshop::category.category')) }}
          {{ Form::text('category', $category->category, array('class' => 'form-control')) }}
          {{ $errors->first('category', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('parent', trans('elshop::category.parent')) }}
          {{ Form::select('parent', $categories , $category->category_id, array('class' => 'form-control')) }}
        </div>
        {{ Form::submit(trans('elshop::category.edit'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop