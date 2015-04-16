@extends('layouts.admin')

@section('header')
  <h1>Articles</h1>
@stop


@section('content')

  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => $prefix . 'articles.store')) }}
        <div class="row">
          <div class="form-group col-sm-8">
            {{ Form::label('name', trans('elshop::article.name')) }} <span class="text-danger">*</span>
            {{ Form::text('name', Input::get('name'), array('class' => 'form-control')) }}
            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-2">
            {{ Form::label('brand', trans('elshop::article.brand')) }}
            {{ Form::select('brand', $brands, Input::get('brand'), array('class' => 'form-control')) }}
          </div>
          <div class="form-group col-sm-2">
            {{ Form::label('category_id', trans('elshop::article.category')) }}
            {{ Form::select('category_id', $categories, Input::get('category_id'), array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('teaser', trans('elshop::article.teaser')) }}
          {{ Form::textarea('teaser', Input::get('teaser'), array('class' => 'form-control', 'rows' => 3)) }}
          {{ $errors->first('teaser', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('description', trans('elshop::article.description')) }} <span class="text-danger">*</span>
          {{ Form::textarea('description', Input::get('name'), array('class' => 'form-control')) }}
          {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="row">
          <div class="form-group col-sm-3">
            {{ Form::label('price', trans('elshop::article.purchasing_price')) }} <span class="text-danger">*</span>
            {{ Form::text('price', Input::get('price'), array('class' => 'form-control')) }}
            {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('currency', trans('elshop::article.currency')) }}
            {{ Form::select('currency', $currencies, Input::get('sale_price'), array('class' => 'form-control')) }}
            {{ $errors->first('currency', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('weight', trans('elshop::article.weight')) }}
            <div class="input-group">
              {{ Form::text('weight', Input::get('weight'), array('class' => 'form-control')) }}
              <span class="input-group-addon">KGr.</span>
            </div>
            {{ $errors->first('weight', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('ean13', trans('elshop::article.ean13')) }}
            {{ Form::text('ean13', Input::get('ean13'), array('class' => 'form-control')) }}
            {{ $errors->first('ean13', '<span class="text-danger">:message</span>') }}
          </div>
        </div>
        {{ Form::submit(trans('elshop::article.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>

@stop