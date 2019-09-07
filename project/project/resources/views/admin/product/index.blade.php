@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                   <div class="h1">
                      <a style="" href="{{url('admin/product-create')}}" class="btn btn-primary float-right">
                         Create Product
                      </a>
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
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Show</th>
                          </tr>
                         </thead>
                         <tbody>
                           @php $i=0;@endphp
                          @foreach($product as $products)
                          @php $i++;@endphp

                           <tr>
                            <td>{{$i}}</td>
                            <td>{{$products->id}}</td>
                            <td><img src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" height="100" width="100"/></td>
                            <td>{{$products->name}}</td>
                            <td>{{$products->product_category}}</td>
                            <td>{{$products->price}}</td>
                            <td><a href="{{url('admin/product/edit/'.$products->id)}}">Edit</a> </td>
                            <td><a href="{{url('admin/product/show/'.$products->id)}}">Show</a></td>
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
