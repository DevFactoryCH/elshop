@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'currencies.create') }}" class="btn btn-primary">@lang('elshop::currency.add')</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>@lang('elshop::currency.name')</th>
            <th class="text-center">@lang('elshop::currency.sign')</th>
            <th class="text-center">@lang('elshop::currency.default')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($currencies as $currency)
          <tr>
            <td>{{ $currency->name }}</td>
            <td class="text-center">{{ $currency->sign }}</td>
            <td class="text-center">
              @if ($currency->default)
                Yes
              @else
                No
              @endif
            </td>
            <td class="text-right">
              {{ Form::open(array('route' => array($prefix . 'currencies.destroy', $currency->id), 'method' => 'DELETE', 'class' => 'btn-group')) }}
                <a href="{{ route($prefix . 'currencies.edit', $currency->id) }}" class="btn btn-success btn-xs">
                  @lang('elshop::currency.edit')
                </a>
                {{ Form::submit(trans('elshop::currency.delete'), array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop