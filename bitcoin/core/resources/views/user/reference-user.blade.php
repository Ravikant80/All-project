@extends('layouts.user-frontend.dashboard')
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
                <div class="col-md-12">
                    <div class="col-md-12">
        
                        
                         <p>Number of  Referrals user : {{ $refer }} </p>
                         <p>  Referrals Bonus Amount :  {{ $amountsum }} CFA </p>
                         <p>
                             <strong>YOUR REFERRAL LINK:</strong></p>
                        <div class="input-group mb15">
                            <input type="text" class="form-control input-lg" id="user_reference_user_text" value="{{ route('auth.reference-register',Auth::user()->username) }}"/>
                            <span class="input-group-btn">
                                <button  class="btn btn-success btn-lg"  onclick="copyReferenceText()">COPY TO CLIPBOARD</button>
                            </span>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div id="recent-transactions" class="col-12">
                <div class="card">
                	<div class="card-header">
                         <div class="caption font-dark">
                    	 </div>
                    	 <div class="tools"> </div>     
                   	</div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">

                                <thead>
                                <tr>
                                    <th>ID#</th>
                                    <th>Register Date</th>
                                    <th>User Name</th>
                                    <th>Username</th>
                                    <th>User Email</th>
                                    <th>User Phone</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
        
                                <tbody>
                                @php $i=0;@endphp
                                @foreach($reference_user as $p)
                                    @php $i++;@endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->username }}</td>
                                        <td>{{ $p->email }}</td>
                                        <td>{{ $p->phone }}</td>
                                        <td>
                                            @if($p->status == 1)
                                                <span class="label bold label-danger bold uppercase"><i class="fa fa-user-times"></i> Blocked</span>
                                            @else
                                                <span class="label bold label-success bold uppercase"><i class="fa fa-check"></i> Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
        
                                </tbody>
                            </table>
                    	</div>
                	</div>
            	</div>
        	</div>
     	</div>
       
    </div>
</div>
@endsection

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/bootstrap-tooltip.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/clipboard.min.js') }}"></script>
<script>


        $('.has').tooltip({
            trigger: 'click',
            placement: 'bottom'
        });

        function setTooltip(btn, message) {
            $(btn).tooltip('hide')
                    .attr('data-original-title', message)
                    .tooltip('show');
        }

        function hideTooltip(btn) {
            setTimeout(function() {
                $(btn).tooltip('hide');
            }, 1000);
        }

        // Clipboard


        $(document).ready(function () {

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
        $('#btnYes').click(function() {
            $('#formSubmit').submit();
        });
    </script>
    
    
    <script>
        /*new Clipboard('.has');*/

    </script>
    <script>
        (function() {

            'use strict';
			
            // click events
            document.body.addEventListener('click', copy, true);

            // event handler
            function copy(e) {

                // find target element
                var
                        t = e.target,
                        c = t.dataset.copytarget,
                        inp = (c ? document.querySelector(c) : null);

                // is element selectable?
                if (inp && inp.select) {

                    // select text
                    inp.select();

                    try {
                        // copy text
                        document.execCommand('copy');
                        inp.blur();

                        // copied animation
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }
                    catch (err) {
                        alert('please press Ctrl/Cmd+C to copy');
                    }

                }

            }

        })();

    </script>
    <script>
function copyReferenceText() {
  var copyText = document.getElementById("user_reference_user_text");
  copyText.select();
  document.execCommand("copy");

}
</script>
    