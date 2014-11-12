@extends('layouts.admin')

@section('content')

  <div class="box box-primary">
    <div class="box-body">
      {{ Form::open(array('route' => $prefix . 'languages.store')) }}
        <div class="form-group">
          {{ Form::label('language', 'Language') }}
          {{ Form::text('language', Input::get('language'), array('class' => 'form-control')) }}
          {{ $errors->first('language', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('iso_code', 'Iso Code') }}
          {{ Form::text('iso_code', Input::get('iso_code'), array('class' => 'form-control')) }}
          {{ $errors->first('iso_code', '<span class="text-danger">:message</span>') }}
        </div>
        <div class="form-group">
          {{ Form::label('code', 'Code') }}
          {{ Form::text('code', Input::get('code'), array('class' => 'form-control')) }}
          {{ $errors->first('code', '<span class="text-danger">:message</span>') }}
        </div>
        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
      {{ Form::close() }}
    </div>
  </div>

@stop