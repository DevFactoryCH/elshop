@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'languages.create') }}" class="btn btn-primary">Add a language</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th class="text-center">Iso Code</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($languages as $language)
          <tr>
            <td>{{ $language->name }}</td>
            <td class="text-center">{{ $language->iso_code }}</td>
            <td class="text-center">{{ $language->default }}</td>
            <td class="text-right">
              {{ Form::open(array('route' => array($prefix . 'languages.destroy', $language->id), 'method' => 'DELETE')) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop