@extends('layouts.adashboard')
@section('style')
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

  <script type="text/javascript">
//      bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
//      bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area2'); });
  </script>
@endsection
@section('content')
<!-- <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Edit Product </strong>
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>

                        </div>
                    </div>


                <form method="post" action="{{url('admin/product/update/'.$product->id)}}" enctype="multipart/form-data">

                    <div class="card mt-3 mb-3">
                        <div class="card-header">Basic Details</div>
                        <div class="card-body">

                          <div class="form-group">
                            <label class="control-label">Product Name :</label>
                            <input class="form-control " type="text" value="{{ $product->name }}" autocomplete="off" placeholder="Category Name" name="name" />
                           </div>

                            <div class="form-group">
                              <label class="control-label ">Product Category</label>
                              <input class="form-control form-control-solid " type="text" value="{{ $product->product_category }}" autocomplete="off" placeholder="Category Name" name="product_category" />
                             
                             </div>
                           
                             <div class="form-group">
                               <label class="control-label">Short Description:</label>
                               <div class="col-md-12">
                                <textarea id="area1" class="form-control" rows="1" name="short_description">{{ $product->short_description }}</textarea>
                               </div>
                              </div>
                              <br/>
                              
                              <div class="form-group">
                                <label class="control-label">Description:</label>
                                <div class="col-md-12">
                                  <textarea id="area2" class="form-control" rows="5" name="description">{{ $product->description }}</textarea>
                                </div>
                               </div>
                              <br/>
                               <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">Pincode:</label>
                               
                                    <input type="number" class="form-control" value="{{ old( 'pincode', $product->pincode) }}" name="pincode"/> 
                                  
                                </div>
                               </div>
                              <br/>
                              
                               <div class="row">
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Selling Price :</label>
                                     <input class="form-control form-control-solid" type="number" value="{{ $product->price }}" autocomplete="off" placeholder="Price" name="price" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Cost Price :</label>
                                     <input class="form-control form-control-solid placeholder-no-fix" type="number" value="{{ $product->cost_price }}" autocomplete="off" placeholder="Cost price" name="cost_price" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Discount (in %):</label>
                                     <input class="form-control form-control-solid placeholder-no-fix" type="number" value="{{ $product->discount }}" autocomplete="off" placeholder="discount percent" name="discount" />
                                    </div>
                                 </div>
                               </div>
                              <br/>
                              <div class="row">
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Color :</label>
                                     <input class="form-control form-control-solid" type="text" value="{{ $product->color }}"  placeholder="Color" name="color" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Size :</label>
                                     <input class="form-control form-control-solid" type="text" value="{{ $product->size }}" placeholder="Size" name="size" />
                                    </div>
                                 </div>
                                 
                               </div>
                              <br/>
                               <div class="row">
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Featured Product :</label>
                                     @if($product->featured ="featured")
                                     <input class="form-control" type="checkbox" value="featured"  name="featured" checked/>
                                     @else
                                     <input class="form-control" type="checkbox" value="featured"  name="featured" />
                                     @endif
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Special Product :</label>
                                      @if($product->special ="special")
                                      <input class="form-control" type="checkbox" value="special" name="special" checked/>
                                     @else
                                     <input class="form-control" type="checkbox" value="special" name="special" />
                                     @endif
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">OnSale Products</label>
                                     @if($product->onsale ="onsale")
                                     <input class="form-control" type="checkbox" value="onsale"  name="onsale" checked/>
                                     @else
                                     <input class="form-control" type="checkbox" value="onsale"  name="onsale" />
                                     @endif
                                    </div>
                                 </div>
                               </div>
                              <br/>
                               <div class="row">
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Width :</label>
                                     <input class="form-control form-control-solid" type="number" value="{{ $product->width }}" autocomplete="off" placeholder="Width" name="width" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Height :</label>
                                     <input class="form-control form-control-solid" type="number" value="{{ $product->height }}" autocomplete="off" placeholder="height" name="height" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Length</label>
                                     <input class="form-control form-control-solid" type="number" value="{{ $product->length }}" autocomplete="off" placeholder="Length" name="length" />
                                    </div>
                                 </div>
                               </div>
                              <br/>
                               <div class="row">
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label ">Status :</label>
                                     <input class="form-control form-control-solid" type="text" value="{{ $product->status }}" autocomplete="off" placeholder="Status" name="status" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">In Stock :</label>
                                     <input class="form-control form-control-solid" type="text" value="{{ $product->in_stock }}" autocomplete="off" placeholder="Stock" name="in_stock" />
                                    </div>
                                 </div>
                                 <!-- <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label visible-ie8 visible-ie9">Product </label>
                                     <input class="form-control form-control-solid placeholder-no-fix" type="number" value="{{ $product->length }}" autocomplete="off" placeholder="Length" name="length" />
                                    </div>
                                 </div> -->
                               </div>
                              <br/>

                        </div>
                        </div>

                      <div class="card product-card mb-2 mt-2">
                       
                       
                          <div class="form-group">
                            <label class="control-label">Images </label>
                            <input class="form-control" type="file" value="{{ $product->image }}"  placeholder="Images" name="image" />
                           </div>
                      
                    </div>

                      <div class="form-actions">
                                {!! csrf_field() !!}
                        <button type="submit" class="btn green"><i class="fa fa-sign-in"></i> Save Product</button>
                         <a href="{{url('admin/product')}}" class="btn btn-default">Cancel</a>
                      </div>

               </form>

                </div>
            </div>
        </div>
    </div>
    <style>

        .image-preview {
            position: relative;
            display: table;
            margin: 8px;
            border: 1px solid #ddd;
            box-shadow: 1px 1px 5px 0 #a2958a;
            padding: 6px;
            float: left;
            text-align: center;
        }

        .image-preview .actual-image-thumbnail {
            height: 170px;
        }

        .image-preview .image-info .active.selected-icon {
            color: #00dd00;
        }

        .image-preview .image-info .image-title {
            margin-bottom: 15px;
        }

        .image-preview .image-info {
            position: relative;
            height: 70px;
        }
    </style>



<script>
    jQuery(document).ready(function () {


        jQuery(document).on('click', '.product-image-list .is_main_image_button', function (e) {
            e.preventDefault();
            e.stopPropagation();


            jQuery('.product-image-list .is_main_image_hidden_field').val(0);

            if (jQuery(this).hasClass('active')) {
                jQuery(this).removeClass('active');
                jQuery(this).children().removeClass('text-info');
                jQuery(this).parents('.image-preview:first').find('.is_main_image_hidden_field').val(0);

            } else {

                jQuery('.product-image-list .is_main_image_button').removeClass('active');
                jQuery('.product-image-list .ti-check-box').removeClass('text-info');

                jQuery(this).parents('.image-preview:first').find('.is_main_image_hidden_field').val(1);
                jQuery(this).addClass('active');
                jQuery(this).children().addClass('text-info');
            }

        });
        jQuery(document).on('click', '.product-image-list .image-preview .destroy-image', function (e) {


            var token = jQuery('.product-image-element').attr('data-token');
            var path = jQuery(e.target).parents('.image-preview:first').find('.img-tag').attr('data-path');
            var data = {_token: token, path: path};
            jQuery.ajax({
                url: '{{ URL::to("/admin/product-image/delete")}}',
                data: data,
                dataType: 'json',
                type: 'post',
                success: function (response) {
                    if (response.success == true) {
                        jQuery(e.target).parents('.image-preview:first').remove();
                    }

                }
            })
        });
        jQuery('.product-image-element').change(function (e) {
            var files = e.target.files;

            if (files.length <= 0) {
                return;
            }

            var formData = new FormData();

            formData.append('_token', jQuery(e.target).attr('data-token'));
            for (var i = 0, file; file = files[i]; ++i) {
                formData.append('image', file);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ URL::to("/admin/product-image/upload") }}', true);
            xhr.onload = function (e) {
                if (this.status == 200) {

                    jQuery('.product-image-list').append(this.response);
                    if (jQuery('.product-image-list .image-preview').length == 1) {
                        jQuery('.product-image-list .image-preview .is_main_image_button').trigger('click');
                    }
                }
            };

            xhr.send(formData);

            jQuery(".product-image-element").val('');
        });

    });
</script>


@endsection
@section('scripts')

    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection
