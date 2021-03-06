@extends('layouts.admin')

@section('content')

  <div class="row">
    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-body">
          {{ Form::open(array('route' => $prefix . 'parcels.store')) }}
            <div class="row">
              <div class="form-group col-sm-3">
                {{ Form::label('type', trans('elshop::parcel.type')) }}
                {{ Form::select('type', $types, NULL, array('class' => 'form-control')) }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('min', trans('elshop::parcel.min')) }}
                {{ Form::text('min', Input::get('min'), array('class' => 'form-control')) }}
                {{ $errors->first('min', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('max', trans('elshop::parcel.max')) }}
                {{ Form::text('max', Input::get('max'), array('class' => 'form-control')) }}
                {{ $errors->first('max', '<span class="text-danger">:message</span>') }}
              </div>
              <div class="form-group col-sm-3">
                {{ Form::label('price', trans('elshop::parcel.price')) }}
                {{ Form::text('price', Input::get('price'), array('class' => 'form-control')) }}
                {{ $errors->first('price', '<span class="text-danger">:message</span>') }}
              </div>
            </div>
            {{ Form::submit(trans('elshop::parcel.add'), array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  
@stop
