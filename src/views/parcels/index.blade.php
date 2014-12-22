@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'parcels.create') }}" class="btn btn-primary">@lang('elshop::parcel.add')</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>@lang('elshop::parcel.min')</th>
            <th>@lang('elshop::parcel.max')</th>
            <th>@lang('elshop::parcel.price')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($parcels as $parcel)
          <tr>
            <td>{{ $parcel->min }}</td>
            <td>{{ $parcel->max }}</td>
            <td>{{ $parcel->price / 100 }}</td>
            <td class="text-right">
              {{ Form::open(array('route' => array($prefix . 'parcels.destroy', $parcel->id), 'method' => 'DELETE', 'class' => '')) }}
                {{ Form::submit(trans('elshop::parcel.delete'), array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
              {{ Form::open(array('route' => array($prefix . 'parcels.edit', $parcel->id), 'method' => 'GET', 'class' => '')) }}
                {{ Form::submit(trans('elshop::parcel.edit'), array('class' => 'btn btn-primary btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop
