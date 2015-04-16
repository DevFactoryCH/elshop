@extends('layouts.admin')

@section('header')
  <h1>@lang('elshop::category.categories')</h1>
@stop

@section('content')

  <p>
    <a href="{{ route($prefix . 'categories.create') }}" class="btn btn-primary">@lang('elshop::category.add')</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center">@lang('elshop::category.level_1')</th>
            <th class="text-center">@lang('elshop::category.level_2')</th>
            <th class="text-center">@lang('elshop::category.level_3')</th>
            <th class="text-center">@lang('elshop::category.status')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($categories as $l1_category)
          <tr>
            <td class="text-center">{{ $l1_category->category }}</td>
            <td></td>
            <td></td>
            <td class="text-center">
              @if ($l1_category->status)
                <a href="{{ route($prefix . 'categories.status', $l1_category->id) }}" class="btn btn-success btn-xs">Actif</a>
              @else
                <a href="{{ route($prefix . 'categories.status', $l1_category->id) }}" class="btn btn-danger btn-xs">Inactif</a>
              @endif
            </td>
            <td class="text-right">
              {{ Form::open(array('route' => array($prefix . 'categories.destroy', $l1_category->id), 'method' => 'DELETE', 'class' => '')) }}
                <a href="{{ route($prefix . 'categories.edit', $l1_category->id) }}" class="btn btn-success btn-xs">
                  @lang('elshop::category.edit')
                </a>
                {{ Form::submit(trans('elshop::category.delete'), array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
          @foreach ($l1_category->categories()->get() as $l2_category)
            <tr>
              <td></td>
              <td class="text-center">{{ $l2_category->category }}</td>
              <td></td>
              <td class="text-center">
                @if ($l2_category->status)
                  <a href="{{ route($prefix . 'categories.status', $l2_category->id) }}" class="btn btn-success btn-xs">Actif</a>
                @else
                  <a href="{{ route($prefix . 'categories.status', $l2_category->id) }}" class="btn btn-danger btn-xs">Inactif</a>
                @endif
              </td>
              <td class="text-right">
                {{ Form::open(array('route' => array($prefix . 'categories.destroy', $l2_category->id), 'method' => 'DELETE', 'class' => '')) }}
                  <a href="{{ route($prefix . 'categories.edit', $l2_category->id) }}" class="btn btn-success btn-xs">
                    @lang('elshop::category.edit')
                  </a>
                  {{ Form::submit(trans('elshop::category.delete'), array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
              </td>
            </tr>
            @foreach ($l2_category->categories()->get() as $l3_category)
              <tr>
                <td></td>
                <td></td>
                <td class="text-center">{{ $l3_category->category }}</td>
                <td class="text-center">
                  @if ($l3_category->status)
                    <a href="{{ route($prefix . 'categories.status', $l3_category->id) }}" class="btn btn-success btn-xs">Actif</a>
                  @else
                    <a href="{{ route($prefix . 'categories.status', $l3_category->id) }}" class="btn btn-danger btn-xs">Inactif</a>
                  @endif
                </td>
                <td class="text-right">
                  {{ Form::open(array('route' => array($prefix . 'categories.destroy', $l3_category->id), 'method' => 'DELETE', 'class' => '')) }}
                    <a href="{{ route($prefix . 'categories.edit', $l3_category->id) }}" class="btn btn-success btn-xs">
                      @lang('elshop::category.edit')
                    </a>
                    {{ Form::submit(trans('elshop::category.delete'), array('class' => 'btn btn-danger btn-xs')) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          @endforeach
        @endforeach
      </table>
    </div>
  </div>

@stop