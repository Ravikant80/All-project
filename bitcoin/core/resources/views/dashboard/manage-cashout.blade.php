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
                                <th>Transaction ID</th>
                                <th>Name</th>
                                <th>Send Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($cashout as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                    <td>{{ $p->transaction_id }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $basic->bitcoin_currency }}{{ $p->amount }}/-.</td>
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
                                    	<a href="{{ route('cashout-view',$p->id) }}" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-eye"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>



@endsection
