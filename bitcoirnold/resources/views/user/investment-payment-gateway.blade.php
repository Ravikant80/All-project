@extends('layouts.user-frontend.dashboard')
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<h3 class="page_title" style="text-align: -webkit-center;color:green; text-transform: lowercase;">Payment Processing Please wait...</h3>
				<div align="center"><img src="{{ asset('assets/images/loader.gif') }}" style="width: 8%;"></div>
			</div>
		</div>
	</div>
</div><!---ROW-->
	

@endsection

<script src="{{ asset('assets/dashboard/assets/js/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
		setInterval(function(){ 
			window.location.href="{{ asset('user/dashboard?reg=1') }}";
		}, 8000);
    });
</script>
