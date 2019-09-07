@extends('director.director_dashbord.dashboard')
@section('style')

<link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <strong class="uppercase"><i class="fa fa-info-circle"></i> {{ $page_title }}</strong>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body" style="overflow: hidden">

                <form method="post" id="add_restaurent_form_id" action=" {{ url('director/admin-register-store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">


                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-4" >
                                            <label class="control-label control_name">Name:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="inputTextBox" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required  value="{{ old('name') }}" />
                                         @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                         @endif


                                        </div>
                                    </div>
                                </div>
                            </div> 

                             <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-4" >
                                            <label class="control-label control_name">Email:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required  value="{{ old('email') }}" />
                                         @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                         @endif
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-4" >
                                            <label class="control-label control_name">Password:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required  value="{{ old('password') }}" />
                                         @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                         @endif
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-md-4" >
                                            <label class="control-label control_name">Confirm Password:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required  value="{{ old('password_confirmation') }}" />

                                         @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                         @endif
                                        </div>
                                    </div>
                                </div>
                            </div> 


                            <div class="row">
                            <div class="col-md-12">
                              <center>  <button class="btn btn-primary btn-block btn-lg" style="width: auto;"><i class="fa fa-send"></i> Register Admin</button></center>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- validation link -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
   $.validate();
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#inputTextBox").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    });
});
</script>

@endsection
