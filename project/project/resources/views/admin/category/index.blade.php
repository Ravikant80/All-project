@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                   <div class="h1">
                      <a style="" href="{{url('admin/category-create')}}" class="btn btn-primary float-right">
                         Create Category
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
                            <th>SNo </th>
                            <th>ID </th>
                            <th><a href="" class="">Name<i class="fa fa-sort"></i></a></th>
                            <th><a href="" class="">Slug<i class="fa fa-sort"></i></a></th>
                            <th>Edit </th>
                            <th>Show </th>
                          </tr>
                         </thead>
                         <tbody>
                          @php $i=0;@endphp
                          @foreach($category as $categories)
                          @php $i++;@endphp

                           <tr>
                            <td>{{$i}}</td>
                            <td>{{$categories->id}}</td>
                            <td>{{$categories->name}}</td>
                            <td>{{$categories->slug}}</td>
                        
                            <td><a href="{{url('admin/category/edit/'.$categories->id)}}">Edit</a> </td>
                            <td><a href="{{url('admin/category/view/'.$categories->id)}}">Show</a></td>
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

    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection