@extends('layouts.dashboard')
@section('style')


@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">Payment Gateway</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>
                                        <i class="fa fa-picture-o"></i> Logo
                                    </th>
                                    <th>
                                        <i class="fa fa-credit-card"></i> Gateway Name
                                    </th>
                                    <th>
                                        Conversion Rate
                                    </th>
                                    <th>
                                        Charge Per Transaction
                                    </th>

                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gateways as $gateway)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/') }}/{{$gateway->image}}" width="50">
                                        </td>
                                        <td>
                                            {{$gateway->name}}
                                        </td>
                                        <td>
                                            1 USD = <strong>{{$gateway->rate}} </strong> {{$basic->currency}}
                                        </td>
                                        <td>
                                            Fixed: <strong>{{$gateway->fix}} {{ $basic->currency }}</strong> <br/>   Percentage: <strong>{{$gateway->percent}} %</strong>
                                        </td>
                                        <td>
                                            {{ $gateway->status == "1" ? 'Active' : 'Deactive' }}
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-outline btn-circle btn-sm blue" data-toggle="modal" data-target="#viewModal{{$gateway->id}}">
                                                <i class="fa fa-eye"></i> View </a>
                                            <a href="" class="btn btn-outline btn-circle btn-sm purple" data-toggle="modal" data-target="#Modal{{$gateway->id}}">
                                                <i class="fa fa-edit"></i> Edit </a>
                                        </td>

                                    </tr>
                                    <!--View Modal -->
                                    <div id="viewModal{{$gateway->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{$gateway->name}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <h5>Logo</h5>
                                                        </div>

                                                        <div class="col-md-9">
                                                            <img src="{{ asset('assets/images/') }}/{{$gateway->image}}" class="img-responsive" width="80">
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <hr/>
                                                        <div class="col-md-3">
                                                            <h5>Gateway Name</h5>
                                                        </div>
                                                        <div class="col-md-9">
                                                            {{$gateway->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <hr/>
                                                        <div class="col-md-3">
                                                            <h5>Conversion Rate</h5>
                                                        </div>
                                                        <div class="col-md-9">
                                                            1 USD = <strong>{{$gateway->rate}} </strong> {{$basic->currency}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <hr/>
                                                        <div class="col-md-3">
                                                            <h5>Charge per Transaction</h5>
                                                        </div>
                                                        <div class="col-md-9">
                                                            Fixed: <strong>{{$gateway->fix}}</strong> <br/>   Percentage: <strong>{{$gateway->percent}} %</strong>
                                                        </div>
                                                    </div>
                                                    @if($gateway->id==1)

                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>PAYPAL BUSINESS EMAIL</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val1}}
                                                            </div>
                                                        </div>
                                                    @elseif($gateway->id==2)
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>PM USD ACCOUNT</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val1}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>ALTERNATE PASSPHRASE</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val2}}
                                                            </div>
                                                        </div>
                                                    @elseif($gateway->id==3)
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>API KEY</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val1}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>XPUB CODE</h5>
                                                            </div>
                                                            <div class="col-md-9" style="-ms-word-wrap: break-word; word-wrap: break-word;">
                                                                {{$gateway->val2}}
                                                            </div>
                                                        </div>
                                                    @elseif($gateway->id==4)
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>SECRET KEY</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val1}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>PUBLISHABLE KEY</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val2}}
                                                            </div>
                                                        </div>
                                                    @elseif($gateway->id==5)
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-md-3">
                                                                <h5>Wallet ID</h5>
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{$gateway->val1}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <hr/>
                                                        <div class="col-md-3">
                                                            <h5>Status</h5>
                                                        </div>
                                                        <div class="col-md-9">
                                                            {{ $gateway->status == "1" ? 'Active' : 'Deactive' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--Edit Modal -->
                                    <div class="modal fade" id="Modal{{$gateway->id}}" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit {{$gateway->name}} Information</h4>
                                                </div>
                                                <form role="form" method="POST" action="{{url('admin/deposit-method')}}/{{$gateway->id}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put')}}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <span class="btn green fileinput-button">
                                                                <i class="fa fa-plus"></i>
                                                                <span> Upload Logo </span>
                                                                <input type="file" name="image" class="form-control input-lg">
                                                            </span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name">Name of Gateway</label>
                                                            <input type="text" value="{{$gateway->name}}" class="form-control" id="name" name="name" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="rate">USD CONVERSION RATE</label>
                                                            <input type="text" value="{{$gateway->rate}}" class="form-control" id="rate" name="rate" >
                                                        </div>

                                                        <hr/>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="charged">Fixed Charge for Transaction</label>
                                                                    <input type="text" value="{{$gateway->fix}}" class="form-control" id="fix" name="fix" >
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="chargep">Percentage Charge of Transaction</label>
                                                                    <input type="text" value="{{$gateway->percent}}" class="form-control" id="percent" name="percent" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if($gateway->id==1)

                                                            <div class="form-group">
                                                                <label for="val1">PAYPAL BUSINESS EMAIL</label>
                                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                                            </div>
                                                        @elseif($gateway->id==2)
                                                            <div class="form-group">
                                                                <label for="val1">PM USD ACCOUNT</label>
                                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="val2">ALTERNATE PASSPHRASE</label>
                                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                                            </div>
                                                        @elseif($gateway->id==3)
                                                            <div class="form-group">
                                                                <label for="val1">API KEY</label>
                                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="val2">XPUB CODE</label>
                                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                                            </div>
                                                        @elseif($gateway->id==4)
                                                            <div class="form-group">
                                                                <label for="val1">SECRET KEY</label>
                                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="val2">PUBLISHABLE KEY</label>
                                                                <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                                                            </div>

                                                        @elseif($gateway->id==5)
                                                            <div class="form-group">
                                                                <label for="val1">Wallet ID</label>
                                                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                                                            </div>
                                                        @endif

                                                        <hr/>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" name="status">
                                                                <option value="1" {{ $gateway->status == "1" ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $gateway->status == "0" ? 'selected' : '' }}>Deactive</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <tbody>
                            </table>
                        </div>

                    </div><!-- row -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('assets/pages/scripts/components-bootstrap-switch.min.js') }}" type="text/javascript"></script>

@endsection