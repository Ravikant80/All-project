@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                  
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Category Details</strong>
                            </div>

                            <div class="tools">
                               
                            </div>
                        </div>
                        <div class="portlet-body">
                        <table class="table table-striped table-bordered">
                        
                         <tbody>
                         
                           <tr><td>Product Name</td><td>{{$product->name}}</td></tr>
                           <tr><td>Product Category</td><td>{{$product->product_category}}</td></tr>
                           <tr><td>Product Short Description</td><td>{{$product->short_description}}</td></tr>
                           <tr><td>Product Description</td><td>{{$product->description}}</td></tr>
                           <tr><td>Product Price</td><td>{{$product->price}}</td></tr>
                           
                           
                         
                         </tbody>
                       </table> 
                       <a href="{{url('admin/product/delete/'.$product->id)}}" class="btn green">Delete</a> 
                        <a href="{{url('admin/product')}}" class="btn btn-default">Cancel</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   






@endsection
@section('scripts')

    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection