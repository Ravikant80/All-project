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
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Deposit Date</th>
                                <th>Depositor Name</th>
<!--                                <th>Request For</th>-->
                                <th>BTC Amount</th>
                               
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($sellrequest as $p)
                                @php $i++;@endphp
                                <tr>
                                 <td>{{ $i }}</td>
                                 <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                 
                                 <td>{{ $p->sellmembers->name }}</td>
                                 <td>{{ $p->btc_amount }}</td>
                               
                                  <td>
                                        @if($p->status == 1)
                                            <span class="label label-primary  bold uppercase"><i class="fa fa-check"></i> Completed</span>
                                        @elseif($p->status == 2)
                                            <span class="label label-danger  bold uppercase"><i class="fa fa-times"></i> Cancel</span>
                                        @else
                                            <span class="label label-warning  bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                        @endif
                                    </td>
									<td>
                                    	<a href="{{ url('admin/sellcoin-view',$p->buybitcoinId) }}" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-eye"></i> View</a>
                                    </td>
                                    
                            @endforeach

                            </tbody>
                        </table>
                   
                    </div>
                </div>

            </div>
        </div><!-- ROW-->
        


@endsection
