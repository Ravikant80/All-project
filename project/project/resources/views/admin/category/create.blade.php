@extends('layouts.adashboard')
@section('style')

@endsection
@section('content')

<style type="text/css">
  .visible-ie9 {
    display: block !important;
}
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Create Category </strong>
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                           
                        </div> 
                    </div>

                            <form method="post" action="{{url('admin/category-store')}}">

                                <div class="card mt-3 mb-3">
                                    <div class="card-header">Basic Details</div>
                                    <div class="card-body">

                                      <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Category Name :</label>
                                        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ old('name') }}" autocomplete="off" placeholder="Category Name" name="name" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Category Slug</label>
                                          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Category Slug" name="slug"  value="{{ old('slug') }}"/> 
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Parent Category</label>
                                           <select class="form-control form-control-solid placeholder-no-fix" name="parent_id" label="Parent Category" >
                                            @if(count($category)==0)
                                             <option>Default Category</option>
                                             @else

                                             <option>Default Category</option>
                                             @foreach($category as $categories)
                                             <option>{{$categories->name}}</option>
                                             @endforeach
                                             @endif
                                           </select>
                                          
                                         </div>
                                        
                                    
                                    </div>
                                </div>

                                  <div class="card mt-3 mb-3">
                                    <div class="card-header">SEO</div>
                                    <div class="card-body">

                                      <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Meta Name:</label>
                                        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ old('meta_title') }}" autocomplete="off" placeholder="Meta Name" name="meta_title" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Meta Desceription:</label>
                                          <textarea name="meta_description" label="Meta Desceription" class="form-control form-control-solid placeholder-no-fix" placeholder="Meta Desceription"></textarea> 
                                          
                                        </div> 
                                    </div>
                                  </div>

                                  <div class="form-actions">
                                            {!! csrf_field() !!}
                                    <button type="submit" class="btn green"><i class="fa fa-sign-in"></i> Create Category</button>
                                     <a href="{{url('admin/category')}}" class="btn btn-default">Cancel</a>
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