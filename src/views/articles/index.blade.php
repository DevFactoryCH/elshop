@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'articles.create') }}" class="btn btn-primary">Add an article</a>
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
            <td>
              <a href="{{ route($prefix . 'articles.show', $article->id) }}">
                {{ $article->content->name }}
              </a>
            </td>
            <td class="text-center">{{ $article->purchasing->price / 100 }}</td>
            <td class="text-center">{{ 'test' }}</td>
            <td class="text-center">{{ $article->brand->name }}</td>
            <td class="text-center">{{ $article->weight }} KGr.</td>
            <td class="text-right">
              <div class="pull-right">
                <div class="btn-group">
                  {{ Form::open(array('route' => array($prefix . 'articles.edit', $article->id), 'method' => 'GET')) }}
                    {{ Form::button(trans('elshop::article.edit'), array('class' => 'btn btn-primary btn-xs', 'type' => 'submit')) }}
                  {{ Form::close() }}
                </div>
                <div class="btn-group">
                  {{ Form::open(array('route' => array($prefix . 'articles.destroy', $article->id), 'method' => 'DELETE')) }}
                    {{ Form::button(trans('elshop::article.delete'), array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                  {{ Form::close() }}
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>

@stop