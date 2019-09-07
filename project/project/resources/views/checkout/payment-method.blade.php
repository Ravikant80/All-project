@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')
<!-- Content -->
<div id="content">

  <!-- Ship Process -->
  <div class="ship-process padding-top-30 padding-bottom-30">
    <div class="container">
      <ul class="row">

        <!-- Step 1 -->
        <li class="col-sm-4">
          <div class="media-left"> <i class="fa fa-check"></i> </div>
          <div class="media-body"> <span>Step 1</span>
            <h6> Billing Address</h6>
          </div>
        </li>

        <!-- Step 2 -->
        <li class="col-sm-4 current">
          <div class="media-left"> <i class="flaticon-business"></i> </div>
          <div class="media-body"> <span>Step 2</span>
            <h6>Payment Methods</h6>
          </div>
        </li>

        <!-- Step 3 -->
        <!-- <li class="col-sm-3">
          <div class="media-left"> <i class="flaticon-delivery-truck"></i> </div>
          <div class="media-body"> <span>Step 3</span>
            <h6>Delivery Methods</h6>
          </div>
        </li> -->

        <!-- Step 4 -->
        <li class="col-sm-4">
          <div class="media-left"> <i class="fa fa-check"></i> </div>
          <div class="media-body"> <span>Step 3</span>
            <h6>Confirmation</h6>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <!-- Payout Method -->
  <section class="padding-bottom-60">
    <div class="container">
      <!-- Payout Method -->
      <div class="pay-method">
        <div class="row">
          <div class="col-md-6">

            <!-- Your Card -->
            <div class="heading">
              <h2>Billing information</h2>
              <hr>
            </div>

            <p>{{ Auth::user()->name }} </p>
            <p>{{ Auth::user()->email }}, {{ Auth::user()->phone_number }}</p>
            <p>{{ Auth::user()->address }} </p>
            <p>{{ Auth::user()->city }} </p>
            <p>{{ Auth::user()->state }}-{{ Auth::user()->pincode }}</p>
            <button class="change_address" id='change_address'>Change</button>
            
          <hr>
          
          <form method="POST" action="{{ url('checkout/update/billing-address') }}" id="update_address">
                        @csrf

                        <div class="form-group ">
                            <label for="name" class=" text-md-right">{{ __('Name') }}</label>


                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>
     
                        <div class="form-group">
                            <label for="phone-number" class=" col-form-label text-md-right">{{ __('Phone Number') }}</label>


                            <input id="phone-number" type="number" class="form-control" name="phone_number" value="{{ Auth::user()->phone_number }}"required>
                            @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class=" col-form-label text-md-right">{{ __('Address') }}</label>


                            <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                            @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="city" class=" col-form-label text-md-right">{{ __('City') }}</label>


                            <input id="city" type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" required>
                            @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="state" class=" col-form-label text-md-right">{{ __('State') }}</label>


                            <input id="state" type="text" class="form-control" name="state" value="{{ Auth::user()->state }}" required>
                            @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="pincode" class=" col-form-label text-md-right">{{ __('Pincode') }}</label>


                            <input id="pincode" type="text" class="form-control" name="pincode" value="{{ Auth::user()->pincode }}" required>
                            @if ($errors->has('pincode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-round">
                                    {{ __('SAVE AND DELIVER HERE') }}
                                </button>
                                <button class="cancel_update" id="cancel_update">CANCEL</button>
                            </div>
                        </div>
                        
                        
                    </form>
          
          
          <div class="heading">
            <h2>Payment Method</h2>
            <hr>
          </div>
          <fieldset>

            <div>
           <!--    <label for="contactChoice1">Credit/Debit/Netbanking</label>
              <input type="radio" id="contactChoice1"
               name="payment" value="internetbanking" checked> -->

              <label for="contactChoice2">Cash On Delivery</label>
              <input type="radio" id="contactChoice2"
               name="payment" value="cod" checked>

              <!-- <label for="contactChoice3">Check/Money Order</label>
              <input type="radio" id="contactChoice3"
               name="contact" value="mail"> -->

            </div>
            <!-- <div>
              <button type="submit">Submit</button>
            </div> -->
            <div class="pro-btn"> <a href="{{url('checkout/place-order')}}" class="btn-round">Place Order</a> </div>
          </fieldset>


          </div>
          <div class="col-md-6">

            <!-- Your information -->
            <div class="heading">
              <h2>Order Summary</h2>
              <hr>
            </div>
            <section class="shopping-cart">

                <table class="table">

                  <tbody>
                    <?php $cartdata = Cart::getContent();?>
                    @foreach($cartdata as $cartdatas)
                   <?php $pdata =getPoductDetails($cartdatas->id);  ?>
                    <!-- Item Cart -->
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-left"> <a href="#."> <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$pdata->image)}}" alt="" > </a>
                          </div>

                        </div>
                      </td>
                      <td>
                      <div class="media-body">
                        <p>{{$cartdatas->name}}</p>
                        <p><span>Quantity : {{$cartdatas->quantity}} </span>,  <span>Sub Total :Rs {{Cart::get($cartdatas->id)->getPriceSum()}} </span></p>


                      </div>
                    </td>
                    </tr>

                    @endforeach


                  </tbody>
                </table>

                <!-- Promotion -->
                <div class="promo">


                  <!-- Grand total -->
                  <div class="g-totel">
                    <h5> Grand Total: <span>Rs {{Cart::getTotal()}}</span></h5>
                  </div>
                </div>


            </section>

          </div>
        </div>
      </div>

      <!-- Button -->
      <!-- <div class="pro-btn"> <a href="#." class="btn-round btn-light">Back to Shopping Cart</a> <a href="#." class="btn-round">Go Delivery Methods</a> </div> -->

    </div>
  </section>


</div>
<!-- End Content -->

@endsection
@push('scripts')
<script>
    $('#update_address').hide();
   $('#change_address').click(function(){
      $('#update_address').toggle();
   });
   $('#cancel_update').click(function(){
      $('#update_address').hide();
   });
   
</script>
@endpush
