@extends('layouts.admin')

@section('content')

  <div class="row">

    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body">
          {{ Form::open(array('route' => array($prefix . 'parcels.update', $parcel->id), 'method' => 'PUT', 'files' => TRUE)) }}
           <div class="form-group">
              {{ Form::label('min', trans('elshop::parcel.min')) }}
              {{ Form::text('min', $parcel->min, array('class' => 'form-control')) }}
              {{ $errors->first('min', '<span class="text-danger">:message</span>') }}
            </div>
            <div class="form-group">
              {{ Form::label('max', trans('elshop::parcel.max')) }}
              {{ Form::text('max', $parcel->max, array('class' => 'form-control')) }}
              {{ $errors->first('max', '<span class="text-danger">:message</span>') }}
            </div>
            <div class="form-group">
              {{ Form::label('price', trans('elshop::parcel.price')) }}
              {{ Form::text('price', $parcel->price / 100, array('class' => 'form-control')) }}
              {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
            </div>
            {{ Form::submit(trans('elshop::parcel.edit'), array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  
  </div>


@stop
