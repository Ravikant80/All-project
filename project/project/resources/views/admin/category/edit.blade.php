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
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Edit Category </strong>
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                           
                        </div> 
                    </div>


                            <form method="post" action="{{url('admin/category/update/'.$category->id)}}">

                                <div class="card mt-3 mb-3">
                                    <div class="card-header">Basic Details</div>
                                    <div class="card-body">

                                      <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Category Name :</label>
                                        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ $category->name }}" autocomplete="off" placeholder="Category Name" name="name" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Category Slug</label>
                                          <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Category Slug" name="slug"  value="{{ $category->slug }}"/> 
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Parent Category</label>
                                           <select class="form-control form-control-solid placeholder-no-fix" name="parent_id" label="Parent Category" value="{{ $category->parent_id }}">
                                             <option>{{ $category->parent_id }}</option>
                                            
                                           </select>
                                          
                                         </div>
                                        
                                    
                                    </div>
                                </div>

                                  <div class="card mt-3 mb-3">
                                    <div class="card-header">SEO</div>
                                    <div class="card-body">

                                      <div class="form-group">
                                        <label class="control-label visible-ie8 visible-ie9">Meta Name:</label>
                                        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="{{ $category->meta_title }}" autocomplete="off" placeholder="Meta Name" name="meta_title" />
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label visible-ie8 visible-ie9">Meta Desceription:</label>
                                          <textarea name="meta_description" label="Meta Desceription" class="form-control form-control-solid placeholder-no-fix" placeholder="Meta Desceription">{{ $category->meta_description }}</textarea> 
                                          
                                        </div> 
                                    </div>
                                  </div>

                                  <div class="form-actions">
                                            {!! csrf_field() !!}
                                    <button type="submit" class="btn green uppercase btn-block"><i class="fa fa-sign-in"></i> Create Category</button>
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