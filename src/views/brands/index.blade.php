@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route('brands.create') }}" class="btn btn-primary">Add a brand</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Brand</th>
            <th class="text-center">Status</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($brands as $brand)
          <tr>
            <td>{{ $brand->name }}</td>
            <td class="text-center">
              @if ($brand->status)
                <a href="" class="btn btn-success btn-xs">Oui</a>
              @else
                Non
              @endif
            </td>
            <td class="text-right">
              {{ Form::open(array('route' => array('brands.destroy', $brand->id), 'method' => 'DELETE')) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop