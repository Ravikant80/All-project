@extends('layouts.frontend')

@section('content')

   <section class="padding-top-40 padding-bottom-60">
<div class="container">
      @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{session()->get('success_message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-md-6">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="name" class=" text-md-right">{{ __('Name') }}</label>


                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">
                            <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group ">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>


                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        </div>
                       
 
                        <div class="form-group">
                            <label for="gender" class=" col-form-label text-md-right">{{ __('Gender') }}</label><br/>
                                   <div class="col-sm-3 radio-inline">
           
                                <input name="gender" id="input-gender-male"  value="Male" type="radio"  {{ (old('gender') == 'Male') ? 'checked' : '' }} />Male
             
                                 </div>
                               <div class="col-sm-3 radio-inline">
           
                                <input name="gender" id="input-gender-female" value="Female" type="radio"  {{ (old('gender') == 'Female') ? 'checked' : '' }}/>Female
             
                                 </div>
                               @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="phone-number" class=" col-form-label text-md-right">{{ __('Phone Number') }}</label>


                            <input id="phone-number" type="number" class="form-control" name="phone_number" required value="{{ old('phone_number') }}">
                            @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class=" col-form-label text-md-right">{{ __('Address') }}</label>


                            <input id="address" type="text" class="form-control" name="address" required value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="city" class=" col-form-label text-md-right">{{ __('City') }}</label>


                            <input id="city" type="text" class="form-control" name="city" required value="{{ old('city') }}">
                            @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="state" class=" col-form-label text-md-right">{{ __('State') }}</label>


                            <input id="state" type="text" class="form-control" name="state" required value="{{ old('state') }}">
                            @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="pincode" class=" col-form-label text-md-right">{{ __('Pincode') }}</label>


                            <input id="pincode" type="text" class="form-control" name="pincode" required value="{{ old('pincode') }}">
                            @if ($errors->has('pincode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-round">
                                    {{ __('Register') }}
                                </button>
                                
                            </div>
                        </div>
                        
                    </form>
            <p>Already member? <a  href="{{ route('login') }}">
                                        {{ __('Login') }}
                                </a>
            </p>

        </div>
    </div>
</div>
</section>
@endsection
