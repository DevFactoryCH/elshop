@extends('layouts.admin')

@section('content')

  <div class="row">

    <div class="col-sm-8">

      <div class="box">

        <div class="box-header">
          <h3 class="box-title">La Guilde - Commande Réf. {{ $order->reference }}</h3>
        </div>

        <div class="box-body">

          <div class="row">
            <div class="col-sm-6">
              {{ $order->invoice->email }}<br>
              {{ $order->invoice->firstname . ' ' . $order->invoice->lastname }}<br>
              {{ $order->invoice->address }}<br>
              {{ $order->invoice->zip . ' ' . $order->invoice->locality }}<br>
            </div>
            <div class="col-sm-6">
              {{ $order->delivery->email }}<br>
              {{ $order->delivery->firstname . ' ' . $order->invoice->lastname }}<br>
              {{ $order->delivery->address }}<br>
              {{ $order->delivery->zip . ' ' . $order->invoice->locality }}<br>
            </div>
          </div>

          <h3>Détails de la commande</h3>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Article</th>
              </tr>
            </thead>
            @foreach ($order->details()->get() as $article)
              <tr>
                <td>{{ $article->name }}</td>
                <td>{{ $article->quantity }}</td>
                <td class="text-right">{{ number_format($article->quantity * $article->price / 100, 2, '.', "'") }}</td>
              </tr>
            @endforeach
            <tr>
              <td>Total</td>
              <td>{{ $order->quantity() }}</td>
              <td class="text-right">{{ number_format($order->total(), 2, '.', "'") }}</td>
            </tr>
          </table>

        </div>


      </div>

    </div>

    <div class="col-sm-4">

    </div>

  </div>

@stop