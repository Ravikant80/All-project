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
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Request Date</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Bitcoin</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i=0;@endphp
                            @foreach($exchange as $p)
                                @php $i++;@endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ date('d-F-Y h:i A',strtotime($p->created_at))  }}</td>
                                    <td>{{ $p->member->name }}</td>
                                    <td>{{ $p->from_amount }}</td>
                                    <td>{{ $p->to_amount }}</td>
                                    <td>
                                        @if($p->status == 1)
                                            <span class="label label-primary  bold uppercase"><i class="fa fa-check"></i> Completed</span>
                                        @elseif($p->status == 2)
                                            <span class="label label-danger  bold uppercase"><i class="fa fa-times"></i> Canceled</span>
                                        @else
                                            <span class="label label-warning  bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('single-exchange',$p->id) }}" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-eye"></i> View</a></td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <!--<div class="text-center">
                            {!! $exchange->links() !!}
                        </div>-->
                    </div>
                </div>

            </div>
        </div><!-- ROW-->



@endsection
