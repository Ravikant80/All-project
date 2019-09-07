@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')
<!-- Linking -->
<div class="linking">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li class="active">Search</li>
    </ol>
  </div>
</div>
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
   @if($product->count() > 0)
  <!-- Products -->
  <section class="padding-top-40 padding-bottom-60">
    <div class="container">
      <div class="row">

        <!-- Shop Side Bar -->
        <div class="col-md-3">
          <div class="shop-side-bar">

            <h6>Price</h6>
           
            <h6>Size</h6>
         
            <h6>Colors</h6>
           
          </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">

          <!-- Short List -->
          <div class="short-lst">
            <h2>Search Results <span style="float:right">{{$product->count()}} Item(s) for {{request()->input('query')}}  </span></h2>
            
          </div>

          <!-- Items -->
              
          <div class="item-col-4">
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
           {{ $product->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
  @else
  <!-- Oder-success -->
    <section>
      <div class="container">
        <!-- Payout Method -->

        <div class="order-success"> <i class="fa fa-check"></i>
          <h6>No Product found !</h6>

          <a href="{{url('/')}}" class="btn-round">Return to Shop</a> </div>
      </div>
    </section>
  @endif


</div>
<!-- End Content -->
<script src="{{asset('ecommerce/assets/js/vendors/jquery.nouislider.min.js')}}"></script>
<script>


</script>
@endsection
@push('scripts')

@endpush

