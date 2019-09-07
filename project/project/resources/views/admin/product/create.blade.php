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
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Create Product </strong>
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>

                        </div>
                    </div>

                            <form method="post" action="{{url('admin/product-store')}}">

                                <div class="card mt-3 mb-3">

                                    <div class="card-body">

                                      <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Product Name :</label>
                                        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ old('name') }}" autocomplete="off" placeholder="Category Name" name="name" />
                                       </div>

                                        <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Product Category</label>
                                           <select class="form-control " name="product_category" label="Product Category"  >
                                             @if(count($category)==0)
                                             <option>Simple Product</option>
                                             @else
                                             <option>Simple Product</option>
                                             @foreach($category as $categories)
                                             <option>{{$categories->name}}</option>
                                             @endforeach
                                             @endif

                                           </select>

                                         </div>


                                    </div>
                                </div>



                                  <div class="form-actions">
                                            {!! csrf_field() !!}
                                    <button type="submit" class="btn green"><i class="fa fa-sign-in"></i> Create & Continue</button>
                                     <a href="{{url('admin/product')}}" class="btn btn-default">Cancel</a>
                                  </div>

                            </form>

                </div>
            </div>
        </div>
    </div>








@endsection
@section('scripts')

    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection
