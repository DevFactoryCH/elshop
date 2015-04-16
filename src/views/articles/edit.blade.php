@extends('layouts.admin')

@section('header')
  <h1>Articles</h1>
@stop

@section('content')

  <div class="row">

    <div class="col-sm-8">

      <div class="box box-primary">
        <div class="box-body">
          {{ Form::open(array('route' => array($prefix . 'articles.update', $article->id), 'method' => 'PUT')) }}
            <div class="row">
              <div class="form-group col-sm-8">
                {{ Form::label('name', trans('elshop::article.name')) }} <span class="text-danger">*</span>
                {{ Form::text('name', $article->content->name, array('class' => 'form-control')) }}
                {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-2">
                {{ Form::label('brand', trans('elshop::article.brand')) }}
                {{ Form::select('brand', $brands, $article->brand_id, array('class' => 'form-control')) }}
              </div>
              <div class="form-group col-sm-2">
                {{ Form::label('term', trans('elshop::article.term')) }}
                {{ Form::select('term', $categories, (isset($article->category_id)) ? $article->category_id : NULL, array('class' => 'form-control')) }}
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('teaser', trans('elshop::article.teaser')) }}
              {{ Form::textarea('teaser', $article->content->teaser, array('class' => 'form-control', 'rows' => 3)) }}
              {{ $errors->first('teaser', '<span class="text-danger">:message</span>') }}
            </div>
            <div class="form-group">
              {{ Form::label('description', trans('elshop::article.description')) }} <span class="text-danger">*</span>
              {{ Form::textarea('description', $article->content->description, array('class' => 'form-control')) }}
              {{ $errors->first('description', '<span class="text-danger">:message</span>') }}
            </div>
            <div class="row">
              <div class="form-group col-sm-3">
                {{ Form::label('price', trans('elshop::article.purchasing_price')) }} <span class="text-danger">*</span>
                {{ Form::text('price', $article->purchasing->price / 100, array('class' => 'form-control')) }}
                {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('currency', trans('elshop::article.currency')) }}
                {{ Form::select('currency', $currencies_purchase, $article->purchasing->currency_id, array('class' => 'form-control')) }}
                {{ $errors->first('currency', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('weight', trans('elshop::article.weight')) }}
                <div class="input-group">
                  {{ Form::text('weight', $article->weight, array('class' => 'form-control')) }}
                  <span class="input-group-addon">KGr.</span>
                </div>
                {{ $errors->first('weight', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('ean13', trans('elshop::article.ean13')) }}
                {{ Form::text('ean13', $article->ean13, array('class' => 'form-control')) }}
                {{ $errors->first('ean13', '<span class="text-danger">:message</span>') }}
              </div>
            </div>
            {{ Form::submit(trans('elshop::article.edit'), array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        </div>
      </div>

    </div>

    <div class="col-sm-4">
      <div class="box box-primary">
        @if ($currencies)
          <div class="box-body">
            {{ Form::open(array('route' => array($prefix . 'articles.store_price', $article->id))) }}
              <div class="row">
                <div class="form-group col-sm-9">
                  {{ Form::label('price', trans('elshop::article.sale_price')) }}
                  {{ Form::text('price', Input::get('price'), array('class' => 'form-control')) }}
                  {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
                </div>
                <div class="form-group col-sm-3">
                  {{ Form::label('currency', trans('elshop::article.currency')) }}
                  {{ Form::select('currency', $currencies, Input::get('sale_price'), array('class' => 'form-control')) }}
                  {{ $errors->first('currency', '<span class="text-danger">:message</span>') }}
                </div>
              </div>
              {{ Form::submit(trans('elshop::article.add'), array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
          </div>
        @endif
        <div class="box-body no-padding">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">@lang('elshop::article.price')</th>
                <th class="text-center">@lang('elshop::article.currency')</th>
                <th></th>
              </tr>
            </thead>
            @foreach ($article->prices()->get() as $price)
              <tr>
                <td class="text-right">{{ number_format($price->price / 100, 2, '.', "'") }}</td>
                <td class="text-center">{{ $price->currency->sign }}</td>
                <td class="text-right">
                  <a href="{{ route($prefix . 'articles.destroy_price', $price->id) }}" class="btn btn-xs btn-danger">
                    <i class="fa fa-times"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-picture"></i>
          <h3 class="box-title">Multiple file upload</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          {{ Form::multiUpload($article, 'images') }}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>

  </div><!-- .row -->

@stop
