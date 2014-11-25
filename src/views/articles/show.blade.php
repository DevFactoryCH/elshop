@extends('layouts.admin')

@section('content')

 <p>
    <a href="{{ route($prefix . 'articles.create') }}" class="btn btn-primary">Add an article</a>
  </p>

  <div class="row">

    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Prix</th>
              </tr>
            </thead>
            <tr>
              <td>Name</td>
              <td class="text-center">{{ $article->content->name }}</td>
            </tr>
            <tr>
              <td>Purchasing price</td>
              <td class="text-center">{{ $article->purchasing->price / 100 }}</td>
            </tr>
            <tr>
              <td>Purchasing price</td>
              <td class="text-center">{{ $article->brand->name }}</td>
            </tr>
          </table>
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

  <div class="col-md-6">
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

  </div>

@stop