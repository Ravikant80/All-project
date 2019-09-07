@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')

<!-- Content -->
<div id="content">

  <!-- Oder-success -->
  <section>
    <div class="container">
      <!-- Payout Method -->
      <!-- {{$order}} -->

      <div class="order-success"> <i class="fa fa-check"></i>
        <h6>Thank you for your order</h6>
        <p>Order number is:{{$order['id']}}</p>
        <p>You will receive an email confirmation shortly on {{$order['billing_email']}}</p>

        <a href="{{url('/')}}" class="btn-round">Return to Shop</a> </div>
    </div>
  </section>

</div>
<!-- End Content -->

@endsection
@push('scripts')

@endpush
