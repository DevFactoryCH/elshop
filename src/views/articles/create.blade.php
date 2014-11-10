@extends('layouts.admin')

@section('content')

  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => 'articles.store')) }}
        <div class="row">
          <div class="form-group col-sm-10">
            {{ Form::label('name', trans('article.name')) }}
            {{ Form::text('name', Input::get('name'), array('class' => 'form-control')) }}
            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-2">
            {{ Form::label('brand', trans('article.brand')) }}
            {{ Form::select('brand', $brands, Input::get('brand'), array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('teaser', trans('article.teaser')) }}
          {{ Form::textarea('teaser', Input::get('teaser'), array('class' => 'form-control', 'rows' => 3)) }}
          {{ $errors->first('teaser', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('description', trans('article.description')) }}
          {{ Form::textarea('description', Input::get('name'), array('class' => 'form-control')) }}
          {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="row">
          <div class="form-group col-sm-3">
            {{ Form::label('price', trans('article.price')) }}
            {{ Form::text('price', Input::get('price'), array('class' => 'form-control')) }}
            {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('sale_price', trans('article.sale_price')) }}
            {{ Form::text('sale_price', Input::get('sale_price'), array('class' => 'form-control')) }}
            {{ $errors->first('sale_price', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('weight', trans('article.weight')) }}
            <div class="input-group">
              {{ Form::text('weight', Input::get('weight'), array('class' => 'form-control')) }}
              <span class="input-group-addon">KGr.</span>
            </div>
            {{ $errors->first('weight', '<span class="text-danger">:message</span>') }}
          </div>
          <div class="form-group col-sm-3">
            {{ Form::label('ean13', trans('article.ean13')) }}
            {{ Form::text('ean13', Input::get('ean13'), array('class' => 'form-control')) }}
            {{ $errors->first('ean13', '<span class="text-danger">:message</span>') }}
          </div>
        </div>
        {{ Form::submit(trans('article.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>

@stop