@extends('layouts.admin')

@section('content')


  @if ($orders->count())
    <div class="box box-primary">
      <div class="box-body no-padding">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">@lang('elshop::order.id')</th>
              <th class="text-center">@lang('elshop::order.reference')</th>
              <th class="text-center">@lang('elshop::order.quantity')</th>
              <th class="text-right">@lang('elshop::order.total')</th>
            </tr>
          </thead>
          @foreach ($orders as $order)
            <tr>
              <td class="text-center">
                {{ $order->id }}
              </td>
              <td class="text-center">
                <a href="{{ route($prefix . 'orders.show', $order->id) }}">
                  {{ $order->reference }}
                </a>
              </td>
              <td class="text-center">{{ $order->details()->count() }}</td>
              <td class="text-right">{{ number_format($order->total(), 2, '.', "'") }}</td>
              <td class="text-right">
                {{ Form::open(array('route' => array($prefix . 'orders.destroy', $order->id), 'method' => 'DELETE')) }}
                  {{ Form::button(trans('elshop::order.delete'), array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @else
    @lang('order.no_order')
  @endif

@stop