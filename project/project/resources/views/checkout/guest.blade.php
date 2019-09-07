@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')

<!-- Content -->
<div id="content">
  <!-- Linking -->
  <div class="linking">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Guest Checkout</li>
      </ol>
    </div>
  </div>

  <!-- Ship Process -->
  <div class="ship-process padding-top-30 padding-bottom-30">
    <div class="container">
      <ul class="row">

        <!-- Step 1 -->
        <li class="col-sm-4 current">
          <div class="media-left"> <i class="fa fa-check"></i> </div>
          <div class="media-body"> <span>Step 1</span>
            <h6>Billing Address</h6>
          </div>
        </li>

        <!-- Step 2 -->
        <!-- <li class="col-sm-4">
          <div class="media-left"> <i class="fa fa-check"></i> </div>
          <div class="media-body"> <span>Step 2</span>
            <h6>Delivery Methods</h6>
          </div>
        </li> -->

        <!-- Step 3 -->
        <li class="col-sm-4">
          <div class="media-left"> <i class="flaticon-business"></i> </div>
          <div class="media-body"> <span>Step 2</span>
            <h6>Payment Methods</h6>
          </div>
        </li>

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
      <form class="" action="{{route('step-one')}}" method="post" enctype="multipart/form-data">

        <div class="pay-method">
        <div class="row">
          <div class="col-md-6">
             {{csrf_field()}}
            <!-- Your information -->
            <div class="heading">
              <h2>Your information</h2>
              <hr>
            </div>

              <div class="row">

                <!-- Name -->
                <div class="col-sm-6">
                  <label> First name
                    <input class="form-control" type="text" name="firstname" required="">
                  </label>
                </div>

                <!-- Number -->
                <div class="col-sm-6">
                  <label> Last Name
                    <input class="form-control" type="text" name="lastame" required="">
                  </label>
                </div>

                <!-- Phone -->
                <div class="col-sm-6">
                  <label> Phone
                    <input class="form-control" type="text" name="phone" required="">
                  </label>
                </div>

                <!-- Number -->
                <div class="col-sm-6">
                  <label> Email
                    <input class="form-control" type="email" name="email" required="">
                  </label>
                </div>
                <!-- Address -->
                <div class="col-sm-12">
                  <label> Address
                    <input class="form-control" type="text" name="address" required="">
                  </label>
                </div>

                <div class="col-sm-6">
                  <label> City  </label>
                    <input class="form-control" type="text" name="city" required="">

                </div>
                <div class="col-sm-6">
                  <label> State  </label>
                    <input class="form-control" type="text" name="state" required="">

                </div>
                <div class="col-sm-6">
                  <label> Country  </label>
                    <input class="form-control" type="text" name="country" required="">

                </div>
                <!-- Zip code -->
                <div class="col-sm-6">
                  <label> Zip code
                    <input class="form-control" type="text" name="zipcode" required="">
                  </label>
                </div>

                <!-- Card Number -->
                <!-- <div class="col-sm-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <label> City </label>

                    </div>
                    <div class="col-xs-6">
                      <label> Country </label>

                    </div>

                  </div>
                </div> -->

              </div>

          </div>

          <!-- Select Your Transportation -->
          <div class="col-md-6">
            <div class="heading">
              <h2>Select Your Shipping Method</h2>
              <hr>
            </div>
            <div class="transportation">
              <div class="row">
               <fieldset id="group1">
                <!-- Free Delivery -->
                <div class="col-sm-8">
                  <div class="charges">
                    <h6>Free Delivery</h6>
                    <br>
                    <input type="radio" name="" value="">
                    <span>7 - 12 days</span> </div>
                </div>

                <!-- Free Delivery -->
                <div class="col-sm-8">
                  <div class="charges select">
                    <h6>Fast Delivery</h6>
                    <br>
                    <input type="radio" name="" value="">

                    <span>4 - 7 days</span> <span class="deli-charges"> + Rs 25 </span> </div>
                </div>
                <!-- Expert Delivery -->
                <div class="col-sm-8">
                  <div class="charges">
                    <h6>Expert Delivery</h6>
                    <br>
                    <input type="radio" name="" value="">

                    <span>24 - 48 Hours</span> <span class="deli-charges"> +Rs 75 </span> </div>
                </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Button -->
      <div class="pro-btn"> <a href="{{url('/')}}" class="btn-round btn-light">Continue Shopping</a>
        <input type="submit" class="btn-round"  value="Continue checkout">
        <!-- <a href="{{route('payment')}}" class="btn-round">Continue checkout</a> -->
      </div>
  </form>
    </div>
  </section>

</div>
<!-- End Content -->

@endsection
@push('scripts')

@endpush
