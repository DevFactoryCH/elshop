@extends('layouts.admin')

@section('content')

  <p>
    <a href="{{ route($prefix . 'orders.index') }}" class="btn btn-primary">@lang('elshop::order.back')</a>
  </p>

  <section class="content invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> La Guilde SA
          <small class="pull-right">Date : {{ $order->created_at->format('d.m.Y') }}</small>
        </h2>
      </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Facturation
        <address>
          <strong>{{ $order->invoice->firstname . ' ' . $order->invoice->lastname }}</strong><br>
          {{ $order->invoice->address }}<br>
          {{ $order->invoice->zip . ' ' . $order->invoice->locality }}<br>
          {{ $order->invoice->email }}<br>
        </address>
      </div><!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Livraison
        <address>
          <strong>{{ $order->delivery->firstname . ' ' . $order->invoice->lastname }}</strong><br>
          {{ $order->delivery->address }}<br>
          {{ $order->delivery->zip . ' ' . $order->invoice->locality }}<br>
          {{ $order->delivery->email }}<br>
        </address>
      </div><!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Commande Réf. :</b> {{ $order->reference }}<br>
        <b>Date de paiement :</b> {{ ($order->payment_at) ? $order->payment_at->format('d.m.Y') : '' }}<br>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->details()->get() as $article)
              <tr>
                <td>{{ $article->quantity }}</td>
                <td>{{ $article->name }}</td>
                <td>{{ number_format($article->quantity * $article->price / 100, 2, '.', "'") }} CHF</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <strong>Adresse de retour :</strong><br>
          La Guilde SA<br>
          Rue Dr César-Roux 26<br>
          1005 Lausanne
        </p>
      </div><!-- /.col -->
      <div class="col-xs-6">
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{ number_format($order->total(), 2, '.', "'") }} CHF</td>
              </tr>
              <tr>
                <th>Tax (8%)</th>
                <td>{{ number_format($tva, 2, '.', "'") }} CHF</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>{{ ($parcel) ? number_format($parcel->price / 100, 2, '.', "'") : '0.00' }} CHF</td>
              </tr>
              <tr>
                <th>Total :</th>
                <td>{{ number_format($total_order, 2, '.', "'") }} CHF</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
      </div>
    </div>
  </section>

@stop