@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                   <div class="h1">
                   
                    </div>
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
                            <th>SNo.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Pincode</th>
                          </tr>
                         </thead>
                         <tbody>
                           @php $i=0;@endphp
                          @foreach($customers as $customer)
                          @php $i++;@endphp

                           <tr>
                            <td>{{$i}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone_number}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->city}}</td>
                            <td>{{$customer->state}}</td>
                            <td>{{$customer->pincode}}</td>
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








@endsection
@section('scripts')

   


@endsection

