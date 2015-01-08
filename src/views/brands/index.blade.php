@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'brands.create') }}" class="btn btn-primary">Add a brand</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>@lang('elshop::brand.name')</th>
            <th>@lang('elshop::brand.website')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($brands as $brand)
          <tr>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->website }}</td>
            <td class="text-right">
              {{ Form::open(array('route' => array($prefix . 'brands.destroy', $brand->id), 'method' => 'DELETE', 'class' => 'btn-group')) }}
                <a href="{{ route($prefix . 'brands.edit', $brand->id) }}" class="btn btn-success btn-xs">
                  @lang('elshop::brand.edit')
                </a>
                {{ Form::submit(trans('elshop::brand.delete'), array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop