@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')
<!-- Linking -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@if(isset($product))
<div class="linking">
   <div class="container">
      <ol class="breadcrumb">
         <li><a href="{{url('/')}}">Home</a></li>
         <li><a href="">{{$product->product_category}}</a></li>
         <li class="active">{{$product->name}}</li>
      </ol>
   </div>
</div>
<!-- Content -->
<div id="content">
   <!-- Products -->
   <section class="padding-top-40 padding-bottom-60">
      <div class="container">
         <div class="row">
<!-- Products -->
<div class="col-md-9">
   <div class="product-detail">
      <div class="product">
         <div class="row">
            <!-- Slider Thumb -->
            <div class="col-xs-5">
               <article class="slider-item on-nav">

                         <div id="slider" class="flexslider">
                           <ul class="slides">

                             <li>
                               <img src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$product->image)}}" alt="">
                             </li>

                             <!-- items mirrored twice, total of 12 -->
                           </ul>
                         </div>
                         <div id="carousel" class="flexslider">
                           <ul class="slides">
                             <li>
                                <img src="{{asset('assets/admin/upload/catalog/images/'.$product->image)}}" alt="">
                             </li>

                             <!-- items mirrored twice, total of 12 -->
                           </ul>
                         </div>
               </article>
            </div>
            <!-- Item Content -->
            <div class="col-xs-7">
               <span class="tags">{{$product->product_category}}</span>
               <h5>{{$product->name}}</h5>
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($product->discount)
                      <span class="discount_class">{{$product->discount}}% Off</span>
                      @endif
                      
                  </p>
                  <div class="row">
                  <div class="col-sm-6"><span class="price">Rs {{$product->price}}</span></div>
                  <div class="col-sm-6">
                     <p>Availability: <span class="in-stock">{{$product->in_stock}}</span></p>
                  </div>
               </div>
               <!-- List Details -->
               <ul class="bullet-round-list">
                  <li>{{$product->description}}</li>

               </ul>
               <!-- Colors -->
               <div class="row">
                <!--  <div class="col-xs-5">
                     <div class="clr"> <span style="background:#068bcd"></span> <span style="background:#d4b174"></span> <span style="background:#333333"></span> </div>
                  </div>
                  <-- Sizes -->
                  <!-- <div class="col-xs-7">
                     <div class="sizes"> <a href="#.">S</a> <a class="active" href="#.">M</a> <a href="#.">L</a> <a href="#.">XL</a> </div>
                  </div> -->
               </div>
               <form method="post" action="{{ url('add-to-cart') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                 <input type="hidden" value="{{$product->id}}" name="product_id" />
                 <input type="hidden" value="{{$product->price}}" name="price" />
                 <input type="hidden" value="{{$product->name}}" name="name" />
                 <input type="hidden" value="{{$product->image}}" name="image" />
               <!-- Compare Wishlist -->
             <!--  <ul class="cmp-list">
                  <li><a href="#."><i class="fa fa-heart"></i> Add to Wishlist</a></li>
                  <li><a href="#."><i class="fa fa-navicon"></i> Add to Compare</a></li>
                  <li><a href="#."><i class="fa fa-envelope"></i> Email to a friend</a></li>
               </ul> -->
               <!-- Quinty -->
               <div class="quinty">
                  <input type="number" value="01" name="quantity" />
               </div>
               <div class="clearfix"></div>
               <div class="float-left" style="margin-right: 5px;">
                   <button type="submit" class="btn btn-primary btn-round">
                      <i class="icon-basket-loaded margin-right-5"></i> Add to Cart
                   </button>
               </div>
           </form>
               <!-- <a href="#." class="btn-round"><i class="icon-basket-loaded margin-right-5"></i> Add to Cart</a> -->
            </div>
         </div>
      </div>
      <!-- Details Tab Section-->
      <div class="item-tabs-sec">
         <!-- Nav tabs -->
         <ul class="nav" role="tablist">
            <li role="presentation" class="active"><a href="#pro-detil"  role="tab" data-toggle="tab">Product Details</a></li>
            <!-- <li role="presentation"><a href="#cus-rev"  role="tab" data-toggle="tab">Customer Reviews</a></li>
            <li role="presentation"><a href="#ship" role="tab" data-toggle="tab">Shipping & Payment</a></li> -->
         </ul>
         <!-- Tab panes -->
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="pro-detil">
               <!-- List Details -->
               <ul class="bullet-round-list">

                  <li>{{$product->description}}</li>
               </ul>
              
            </div>
            <div role="tabpanel" class="tab-pane fade" id="cus-rev"></div>
            <div role="tabpanel" class="tab-pane fade" id="ship"></div>
         </div>
      </div>
   </div>
   <!-- Related Products -->

</div>
</div>
</div>
</section>
</div>
@endif

@endsection
@push('scripts')

@endpush
