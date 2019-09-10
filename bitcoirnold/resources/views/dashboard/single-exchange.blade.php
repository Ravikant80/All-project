@extends('layouts.dashboard')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center bold">
                                <h3>Request User : {{ $exchange->member->name }}</h3>
                                <h3>From Wallet : {{ $exchange->from_wallet }}</h3>
                                <h3>To Wallet : {{ $exchange->to_wallet}}</h3>
                                @if($exchange->from_wallet == "USD")
                                	<h3>USD Value : {{ $exchange->from_amount  }}</h3>
                                @else                    
                                	<h3>USD Value : {{ $exchange->to_amount }}</h3>
                                @endif
                                @if($exchange->from_wallet == "BTC")
                                 	<h3>BTC Value : {{ $exchange->from_amount  }}</h3>
                                @else                    
                                	<h3>BTC Value : {{ $exchange->to_amount }}</h3>
                                @endif
                                <br>
                                <h4>Status :
                                    @if($exchange->status == 1 )
                                        <span class="label label-success bold uppercase"><i class="fa fa-spinner"></i>Completed </span>
                                    @elseif($exchange->status == 2)
                                        <span class="label label-danger bold uppercase"><i class="fa fa-check"></i> Rejected</span>
                                    @elseif($exchange->status == 3)
                                        <span class="label label-warning bold uppercase"><i class="fa fa-times"></i> Pending</span>
                                    @endif
                                </h4>
                                @if($exchange->status == 3)
                                <hr>
                                <div class="col-md-3 col-md-offset-3">
                                    <button type="button" class="btn green-haze bold uppercase btn-block delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="{{ $exchange->id }}">
                                        <i class='fa fa-check'></i> Approve Exchange
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn purple bold uppercase btn-block refund_button"
                                            data-toggle="modal" data-target="#cancelModal"
                                            data-id="{{ $exchange->id }}">
                                        <i class='fa fa-times'></i> Reject Exchange
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Message : </h3><br>
                            {!! $exchange->message !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Confirm This Exchange..?</strong>
                </div>
                <div class="modal-footer">

                    <form method="post" action="{{ route('exchange-confirm') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Refund This Exchange..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('exchange-reject') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
        $(document).ready(function () {

            $(document).on("click", '.refund_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

@endsection
