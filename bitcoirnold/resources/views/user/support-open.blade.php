@extends('layouts.user-frontend.dashboard')

@section('style')

    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">

@endsection
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title" style="text-align: -webkit-center;">{!! $page_title  !!}</h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <div id="recent-transactions" class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="col-md-8 col-sm-12 col-md-offset-2">
                        {!! Form::open(['role'=>'form','id'=>'formSubmit','class'=>'form-horizontal','files'=>true]) !!}

                                <div class="form-body" style="margin-top:20px;">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-4"><strong style="text-transform: uppercase;"> SUBJECT :</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="form-control bold input-lg" id="subject" name="subject" value="" type="text" placeholder="Subject" required>
                                                    <span class="input-group-addon"><strong><i class="fa fa-podcast"></i></strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-4"><strong style="text-transform: uppercase;"> MESSAGE :</strong></label>
                                            <div class="col-md-8">
                                                <textarea name="message" id="" cols="30" rows="6"
                                                          class="form-control bold input-lg" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                        	<label class="col-md-4"></label>
                                            <div class="col-md-8">
                                                <button type="button" class="btn btn-primary btn-lg btn-block btn-block margin-top-10 delete_button"
                                                        data-toggle="modal" data-target="#DelModal">
                                                    <i class="fa fa-send"></i> Confirm and Open
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        {!! Form::close() !!}
                    	 </div>
                    </div>
                </div>
            </div>
         </div>

    </div>
</div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to Open a Support Ticket..?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" id="btnYes" class="btn btn-primary"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('script')

    <script type='text/javascript'>
		$(document).ready(function(e) {
            $("#formSubmit").validate({
				rules: {							
					subject: {
						required: true,
					},
					message: {
						required: true,
					}
				},
				messages: {						
					subject: {
						required: "Please enter a support ticket subject",
					},
					message: {
						required: "Please enter a support message",
					}
				}
			});
        });
        $('#btnYes').click(function() {
            $('#formSubmit').submit();
        });
    </script>

    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>




@endsection