@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')

 <section class="slid-sec">
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="row">

          <!-- Main Slider  -->
          <div class="col-md-12 no-padding" style="height:280px;">

            <!-- Main Slider Start -->
            <div class="tp-banner-container">
              <div class="tp-banner">
                <ul>

                  <!-- SLIDE  -->
                  <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('ecommerce/assets/images/slider-img-1.jpg')}}"  alt="slider"  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat">

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-110"
                                     data-speed="800"
                                     data-start="800"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:30px; font-weight:500; color:#888888;  max-width: auto; max-height: auto; white-space: nowrap;">High Quality VR Glasses </div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-60"
                                     data-speed="800"
                                     data-start="1000"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 6; font-size:50px; color:#0088cc; font-weight:800; white-space: nowrap;">3D Daydream View </div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="10"
                                     data-speed="800"
                                     data-start="1200"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 7;  font-size:24px; color:#888888; font-weight:500; max-width: auto; max-height: auto; white-space: nowrap;">Starting at </div>

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="210"
                                     data-y="center" data-voffset="5"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:36px; font-weight:800; color:#000;  max-width: auto; max-height: auto; white-space: nowrap;">Rs 3500 </div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption lfb tp-resizeme scroll"
                                      data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="80"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     data-scrolloffset="0"
                                     style="z-index: 8;"><a href="#." class="btn-round big">Shop Now</a> </div>
                  </li>

                  <!-- SLIDE  -->
                  <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('ecommerce/assets/images/slider-img-2.jpg')}}"  alt="slider"  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat">

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-110"
                                     data-speed="800"
                                     data-start="800"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:30px; font-weight:500; color:#888888;  max-width: auto; max-height: auto; white-space: nowrap;">No restocking fee (2100 savings)</div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-60"
                                     data-speed="800"
                                     data-start="1000"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 6; font-size:50px; color:#0088cc; font-weight:800; white-space: nowrap;">M75 Sport Watch </div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="10"
                                     data-speed="800"
                                     data-start="1200"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 7;  font-size:24px; color:#888888; font-weight:500; max-width: auto; max-height: auto; white-space: nowrap;">Now Only </div>

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="210"
                                     data-y="center" data-voffset="5"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:36px; font-weight:800; color:#000;  max-width: auto; max-height: auto; white-space: nowrap;">Rs 3500 </div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption lfb tp-resizeme scroll"
                                      data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="80"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     data-scrolloffset="0"
                                     style="z-index: 8;"><a href="" class="btn-round big">Shop Now</a> </div>
                  </li>

                  <!-- SLIDE  -->
                  <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('ecommerce/assets/images/slider-img-3.jpg')}}"  alt="slider"  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat">

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-110"
                                     data-speed="800"
                                     data-start="800"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:30px; font-weight:500; color:#888888;  max-width: auto; max-height: auto; white-space: nowrap;">Get Free Bluetooth when buy </div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="-60"
                                     data-speed="800"
                                     data-start="1000"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 6; font-size:50px; color:#0088cc; font-weight:800; white-space: nowrap;">Flat SmartWatch </div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption sfl tp-resizeme"
                                     data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="0"
                                     data-speed="800"
                                     data-start="1200"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     style="z-index: 7;  font-size:24px; color:#888888; font-weight:500; max-width: auto; max-height: auto; white-space: nowrap;">Combo Only:</div>

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfr tp-resizeme"
                                     data-x="left" data-hoffset="240"
                                     data-y="center" data-voffset=" -5"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-elementdelay="0.03"
                                     data-endelementdelay="0.4"
                                     data-endspeed="300"
                                     style="z-index: 5; font-size:36px; font-weight:800; color:#000;  max-width: auto; max-height: auto; white-space: nowrap;">Rs 3500 </div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption lfb tp-resizeme scroll"
                                      data-x="left" data-hoffset="60"
                                     data-y="center" data-voffset="80"
                                     data-speed="800"
                                     data-start="1300"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-endspeed="300"
                                     data-scrolloffset="0"
                                     style="z-index: 8;"><a href="" class="btn-round big">Shop Now</a> </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Main Slider  -->
          <!-- <div class="col-md-3 no-padding">


            <div class="product">
              <div class="like-bnr">
                <div class="position-center-center">
                  <h5>New line required</h5>
                  <h4>Smartphone s7</h4>
                  <span class="price">$259.99</span> </div>
              </div>
            </div>


            <div class="week-sale-bnr">
              <h4>Weekly <span>Sale!</span></h4>
              <p>Saving up to 50% off all online
                store items this week.</p>
              <a href="#." class="btn-round">Shop now</a> </div>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <!-- Content -->
  <div id="content">

      @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{session()->get('success_message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif

    <!-- Sample Product Listing -->
 
 <!-- Main Tabs Sec -->
  <section class="main-tabs-sec padding-top-60 padding-bottom-0">
      <div class="container">
        <ul class="nav margin-bottom-40" role="tablist">
          <li role="presentation" class="active"><a href="#tv-au" aria-controls="featur" role="tab" data-toggle="tab"> <i class="flaticon-computer"></i> TV & Audios </a></li>
          <li role="presentation"><a href="#smart" aria-controls="special" role="tab" data-toggle="tab"><i class="flaticon-smartphone"></i>Smartphones </a></li>
          <li role="presentation"><a href="#deks-lap" aria-controls="on-sal" role="tab" data-toggle="tab"><i class="fas fa-shoe-prints"></i>Shoes </a></li>
          <li role="presentation"><a href="#game-com" aria-controls="special" role="tab" data-toggle="tab"><i class="fas fa-glasses"></i>Sunglasses</a></li>
          <li role="presentation"><a href="#watches" aria-controls="on-sal" role="tab" data-toggle="tab"><i class="far fa-clock"></i>Watches </a></li>
          <li role="presentation"><a href="#access" aria-controls="on-sal" role="tab" data-toggle="tab"><i class="flaticon-keyboard"></i>Accessories </a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <!-- TV & Audios -->
          <div role="tabpanel" class="tab-pane active fade in" id="tv-au">

            <!-- Items -->
            <div class="item-slide-5 with-bullet no-nav">
               
              @foreach ($tvaudio as $products)
              <!-- Product -->
             
              <div class="product">
                <article>
                  <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                    <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                  </a>
                  <!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.4<i class="fa fa-star"></i></span>
                       <span class="rating-user">(87)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p>
                 
                  <div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
            @endforeach


            </div>
          </div>

          <!-- Smartphones -->
          <div role="tabpanel" class="tab-pane fade" id="smart">
            <!-- Items -->
            <div class="item-col-5">
                
              @foreach ($smartphone as $smartphones)
              <!-- Product -->
              <div class="product">
                <article>
                  <a href="{{url('/product/'.str_slug($smartphones->product_category).'/'.str_slug($smartphones->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$smartphones->image)}}" alt="" height="243px">
                </a>
                <!-- Content -->
                  <span class="tag">{{$smartphones->product_category}}</span> <a href="{{url('/product/'.str_slug($smartphones->product_category).'/'.str_slug($smartphones->name))}}" class="tittle">{{$smartphones->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.5<i class="fa fa-star"></i></span>
                       <span class="rating-user">(57)</span>
                       @if($smartphones->discount)
                      <span class="discount_class">{{$smartphones->discount}}% Off</span>
                      @endif
                      
                  </p>
                  <div class="price">{{$smartphones->price}} </div>
                  <a href="{{url('addToCart/p/'.$smartphones->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
            @endforeach



            </div>
          </div>
          <!-- Shoes -->
          <div role="tabpanel" class="tab-pane fade" id="deks-lap">

            <!-- Items -->
            <div class="item-col-5">

              @foreach ($shoes as $shoe)
              <!-- Product -->
              
              <div class="product">
                <article>
                  <a href="{{url('/product/'.str_slug($shoe->product_category).'/'.str_slug($shoe->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$shoe->image)}}" alt="" height="243px">
                </a>
                <!-- Content -->
                  <span class="tag">{{$shoe->product_category}}</span> <a href="{{url('/product/'.str_slug($shoe->product_category).'/'.str_slug($shoe->name))}}" class="tittle">{{$shoe->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.1<i class="fa fa-star"></i></span>
                       <span class="rating-user">(37)</span>
                       @if($shoe->discount)
                      <span class="discount_class">{{$shoe->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$shoe->price}} </div>
                  <a href="{{url('addToCart/p/'.$shoe->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
              
            @endforeach


            </div>
          </div>
          <!-- Game Console -->
          <div role="tabpanel" class="tab-pane fade" id="game-com">

            <!-- Items -->
            <div class="item-col-5">

              @foreach ($sunglass as $sunglasses)
              <!-- Product -->
              <div class="product">
                <article> <a href="{{url('/product/'.str_slug($sunglasses->product_category).'/'.str_slug($sunglasses->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$sunglasses->image)}}" alt="" height="243px">
                </a>
                <!-- Content -->
                  <span class="tag">{{$sunglasses->product_category}}</span> <a href="{{url('/product/'.str_slug($sunglasses->product_category).'/'.str_slug($sunglasses->name))}}" class="tittle">{{$sunglasses->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($sunglasses->discount)
                      <span class="discount_class">{{$sunglasses->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$sunglasses->price}} </div>
                  <a href="{{url('addToCart/p/'.$sunglasses->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
            @endforeach


            </div>
          </div>
          <!-- Watches -->
          <div role="tabpanel" class="tab-pane fade" id="watches">

            <!-- Items -->
            <div class="item-col-5">

              @foreach ($watch as $products)
              <!-- Product -->
              <div class="product">
                <article> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                </a>
                <!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
            @endforeach


            </div>
          </div>
          <!-- Accessories -->
          <div role="tabpanel" class="tab-pane fade" id="access">

            <!-- Items -->
            <div class="item-col-5">

              @foreach ($accessories as $products)
              <!-- Product -->
              <div class="product">
                <article> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                </a>
                <!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
            @endforeach


            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- tab Section -->
   <section class="featur-tabs padding-top-60 padding-bottom-60">
      <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-pills margin-bottom-40" role="tablist">
          <li role="presentation" class="active"><a href="#featur" aria-controls="featur" role="tab" data-toggle="tab">Featured</a></li>
          <li role="presentation"><a href="#special" aria-controls="special" role="tab" data-toggle="tab">Special</a></li>
          <li role="presentation"><a href="#on-sal" aria-controls="on-sal" role="tab" data-toggle="tab">Onsale</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Featured -->
          <div role="tabpanel" class="tab-pane active fade in" id="featur">
            <!-- Items Slider -->
            <div class="item-slide-5 with-nav">
             
              @foreach ($featured as $products)
              <!-- Product -->
              
              <div class="product">
                <article>
                  <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                    <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                  </a>
                    <!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
               
            @endforeach
           

            </div>
          </div>

          <!-- Special -->
          <div role="tabpanel" class="tab-pane fade" id="special">
            <!-- Items Slider -->
            <div class="item-col-5">

              @foreach ($special as $products)
              <!-- Product -->
              
              <div class="product">
                <article> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                </a>
                  <!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p><div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
             
            @endforeach





            </div>
          </div>

          <!-- on sale -->
          <div role="tabpanel" class="tab-pane fade" id="on-sal">
            <!-- Items Slider -->
            <div class="item-col-5">

              @foreach ($onsale as $products)
            
              <div class="product">
                <article> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                  <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                </a><!-- Content -->
                  <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
                  <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p>
                  <div class="price">{{$products->price}} </div>
                  <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
              </div>
              
            @endforeach

            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Top Selling Week -->
    
    <section class="light-gry-bg padding-top-60 padding-bottom-30">
      <div class="container">

        <!-- heading -->
        <div class="heading">
          <h2>Top Selling of the Week</h2>
          <hr>
        </div>

        <!-- Items -->
        <div class="item-col-5">

          @foreach ($product as $products)
          <!-- Product -->
          <div class="product">
            <article>
               <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
                 </a>
            <!-- Content -->
              <span class="tag">{{$products->product_category}}</span> <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}" class="tittle">{{$products->name}}</a>
              <!-- Reviews -->
                  <p class="rev">
                      <span class="margin-left-10 rating">4.0<i class="fa fa-star"></i></span>
                       <span class="rating-user">(75)</span>
                       @if($products->discount)
                      <span class="discount_class">{{$products->discount}}% Off</span>
                      @endif
                      
                  </p>
                  <div class="price">{{$products->price}} </div>
              <a href="{{url('addToCart/p/'.$products->id)}}" class="cart-btn"><i class="icon-basket-loaded"></i></a> </article>
          </div>
        @endforeach

        </div>
      </div>
    </section>





   
       <!-- Shipping Info -->
    <section class="shipping-info">
      <div class="container">
        <ul>

          <!-- Free Shipping -->
          <li>
            <div class="media-left"> <i class="flaticon-delivery-truck-1"></i> </div>
            <div class="media-body">
              <h5>Free Shipping</h5>
              <span>On order over 100</span></div>
          </li>
          <!-- Money Return -->
          <li>
            <div class="media-left"> <i class="flaticon-arrows"></i> </div>
            <div class="media-body">
              <h5>Money Return</h5>
              <span>30 Days money return</span></div>
          </li>
          <!-- Support 24/7 -->
          <li>
            <div class="media-left"> <i class="flaticon-operator"></i> </div>
            <div class="media-body">
              <h5>Support 24/7</h5>
              <span>Hotline: (+91) 7055662266</span></div>
          </li>
          <!-- Safe Payment -->
          <li>
            <div class="media-left"> <i class="flaticon-business"></i> </div>
            <div class="media-body">
              <h5>Safe Payment</h5>
              <span>Protect online payment</span></div>
          </li>
        </ul>
      </div>
    </section>
        
    <!-- Top Selling Week -->
    <section class="padding-top-60 padding-bottom-60">
      <div class="container">

        <!-- heading -->
        <div class="heading">
         
        </div>
        

      </div>
    </section>
  </div>

@endsection
@push('scripts')

@endpush
