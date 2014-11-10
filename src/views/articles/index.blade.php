@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Add an article</a>
  </p>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Prix de vente</th>
            <th class="text-center">Marque</th>
            <th class="text-center">Poids</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($articles as $article)
          <tr>
            <td>{{ $article->content->name }}</td>
            <td class="text-center">{{ $article->price / 100 }}</td>
            <td class="text-center">{{ $article->sale_price / 100 }}</td>
            <td class="text-center">{{ $article->brand->name }}</td>
            <td class="text-center">{{ $article->weight }} KGr.</td>
            <td class="text-right">
              <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-success btn-xs pull-right">
                Edit
              </a>
              {{ Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'DELETE')) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs pull-right')) }}
              {{ Form::close() }}
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop