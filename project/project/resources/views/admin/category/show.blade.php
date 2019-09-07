@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                  
                   <div class="portlet light bordered">
                     <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                       <div class="portlet-body">
                        <table class="table table-striped table-bordered">
                         <thead>
                          <!-- <tr>
                            <th><a href="" class="">Name<i class="fa fa-sort"></i></a></th>
                            <th><a href="" class="">Slug<i class="fa fa-sort"></i></a></th>
                            <th>Edit </th>
                            <th>Show </th>
                          </tr> -->
                         </thead>
                         <tbody>
                         
                           <tr><td>Category Name</td><td>{{$category->name}}</td></tr>
                           <tr><td>Category Slug</td><td>{{$category->slug}}</td></tr>
                           <tr><td>Meta Name</td><td>{{$category->meta_title}}</td></tr>
                           <tr><td>Meta Description</td><td>{{$category->meta_description}}</td></tr>
                           <tr><td>Parent Category </td><td>{{$category->parent_id}}</td></tr>
                         </tbody>
                       </table> 
                       <a href="{{url('admin/category/delete/'.$category->id)}}" class="btn green">Delete</a> 
                        <a href="{{url('admin/category')}}" class="btn btn-default">Cancel</a>
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