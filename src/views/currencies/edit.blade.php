@extends('layouts.admin')

@section('content')

  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => array($prefix . 'currencies.update', $currencie->id), 'method' => 'PUT')) }}
      <div class="form-group">
        {{ Form::label('name', trans('elshop::currency.name')) }}
        {{ Form::text('name', $currencie->name, array('class' => 'form-control')) }}
        {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
      </div>
      <div class="form-group">
        {{ Form::label('iso_code', trans('elshop::currency.iso_code')) }}
        {{ Form::text('iso_code',  $currencie->iso_code, array('class' => 'form-control')) }}
        {{ $errors->first('iso_code', '<span class="text-danger">:message</span>') }}
      </div>
      <div class="form-group">
        {{ Form::label('sign', trans('elshop::currency.sign')) }}
        {{ Form::text('sign', $currencie->sign, array('class' => 'form-control')) }}
        {{ $errors->first('sign', '<span class="text-danger">:message</span>') }}
      </div>
      {{ Form::submit(trans('elshop::currency.add'), array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>
@stop
