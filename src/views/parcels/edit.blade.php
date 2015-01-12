@extends('layouts.admin')

@section('content')

  <div class="row">

    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body">
          {{ Form::open(array('route' => array($prefix . 'parcels.update', $parcel->id), 'method' => 'PUT', 'files' => TRUE)) }}
            <div class="row">
              <div class="form-group col-sm-3">
                {{ Form::label('type', trans('elshop::parcel.type')) }}
                {{ Form::select('type', $types, $parcel->type, array('class' => 'form-control')) }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('min', trans('elshop::parcel.min')) }}
                {{ Form::text('min', $parcel->min / 100, array('class' => 'form-control')) }}
                {{ $errors->first('min', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('max', trans('elshop::parcel.max')) }}
                {{ Form::text('max', $parcel->max / 100, array('class' => 'form-control')) }}
                {{ $errors->first('max', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('price', trans('elshop::parcel.price')) }}
                {{ Form::text('price', $parcel->price / 100, array('class' => 'form-control')) }}
                {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
              </div>
            </div>
            {{ Form::submit(trans('elshop::parcel.edit'), array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  
  </div>


@stop
