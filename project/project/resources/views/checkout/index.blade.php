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
        <li class="active">Checkout</li>
      </ol>
    </div>
  </div>

  <!-- Blog -->
  <section class="login-sec padding-top-30 padding-bottom-100">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
          <!-- Login Your Account -->
          <h5>Login Registered User</h5>

          <!-- FORM -->
           <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">
                            <label for="password" class=" text-md-right">{{ __('Password') }}</label>


                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="form-group">
                            @if (Request::has('previous'))
                                <input type="hidden" name="previous" value="{{ Request::get('previous') }}">
                            @else
                                <input type="hidden" name="previous" value="{{ URL::previous() }}">
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-round">
                                    {{ __('Login') }}
                                </button>

                                 @if (Route::has('password.request'))
                                    <a class="btn btn-round" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                     </a>
                                 @endif
                                
                            
                                
                            </div>
                        </div>
                        
                    </form>
          <p> not a member ?  <a  href="{{ route('register') . '?previous=' . Request::fullUrl() }}">
                                        {{ __('Register') }}
                                </a>
                </p>
        </div>
       

      </div>
      </div>

        <div class="col-md-6">
          <h5>Order Summary</h5>
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
                      <p>Sub Total :Rs {{Cart::get($cartdatas->id)->getPriceSum()}}</p>
                      <p>Quantity : {{$cartdatas->quantity}}</p>
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
  </section>




</div>
<!-- End Content -->

@endsection
@push('scripts')

@endpush
