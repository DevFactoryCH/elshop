@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'parcels.create') }}" class="btn btn-primary">@lang('elshop::parcel.add')</a>
  </p>

  <div class="row">
    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">@lang('elshop::parcel.type')</th>
                <th class="text-center">@lang('elshop::parcel.min')</th>
                <th class="text-center">@lang('elshop::parcel.max')</th>
                <th class="text-center">@lang('elshop::parcel.price')</th>
                <th></th>
              </tr>
            </thead>
            @foreach ($parcels as $parcel)
              <tr>
                <td class="text-center">
                  @if (!$parcel->type)
                    @lang('elshop::parcel.between')
                  @elseif ($parcel->type == 2)
                    @lang('elshop::parcel.greater')
                  @else
                    @lang('elshop::parcel.less')
                  @endif
                </td>
                <td class="text-center">{{ number_format($parcel->min / 100, 2, '.', "'") }}</td>
                <td class="text-center">
                  @if ($parcel->max)
                    {{ number_format($parcel->max / 100, 2, '.', "'") }}
                  @endif
                </td>
                <td class="text-center">{{ number_format($parcel->price / 100, 2, '.', "'") }}</td>
                <td class="text-right">
                  {{ Form::open(array('route' => array($prefix . 'parcels.destroy', $parcel->id), 'method' => 'DELETE', 'class' => 'pull-right')) }}
                    {{ Form::submit(trans('elshop::parcel.delete'), array('class' => 'btn btn-danger btn-xs')) }}
                  {{ Form::close() }}
                  {{ Form::open(array('route' => array($prefix . 'parcels.edit', $parcel->id), 'method' => 'GET', 'class' => 'pull-right', 'style' => 'margin-right:5px')) }}
                    {{ Form::submit(trans('elshop::parcel.edit'), array('class' => 'btn btn-primary btn-xs')) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

@stop
