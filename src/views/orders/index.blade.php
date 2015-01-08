@extends('layouts.admin')

@section('content')

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table">
        <thead>
          <tr>
            <th>@lang('elshop::article.name')</th>
            <th class="text-center">@lang('elshop::article.price')</th>
            <th class="text-center">@lang('elshop::article.purchasing_price')</th>
            <th class="text-center">@lang('elshop::article.brand')</th>
            <th class="text-center">@lang('elshop::article.weight')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($orders as $order)
          <tr>
            <td>
              <a href="{{ route($prefix . 'orders.edit', $order->id) }}">
                {{ $order->id }}
              </a>
            </td>
            <td>
              <a href="{{ route($prefix . 'orders.show', $order->id) }}">
                {{ $order->reference }}
              </a>
            </td>
            <td>{{ $order->details()->count() }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop