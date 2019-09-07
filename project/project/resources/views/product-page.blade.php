@extends('layouts.frontend')
@push('styles')
<style>
    #text,#text2{
        width: 57px;
    border: none;
    resize: none;
    }
    .price-ratio{
        display: inline-flex;
    }
    #text2{
       margin-left: 16px;
    }
    .slider {
  -webkit-appearance: none;
  width: 100%;
  height: 25px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: #4CAF50;
  cursor: pointer;
}
</style>
@endpush

@section('content')
<!-- Linking -->


<div class="linking">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li class="active" id="product_breadcrum_data">{{$productbreakcrumbs}}</li>
    </ol>
  </div>
</div>
<!-- Content -->
<div id="content">
  @if($product->count() > 0)
  <!-- Products -->
  <section class="padding-top-40 padding-bottom-60">
    <div class="container">
      <div class="row">
        

        <!-- Shop Side Bar -->
        <div class="col-md-3">
          <div class="shop-side-bar">

            <h6>Price</h6>
<!--            <p id="price_show">500 - 7000</p>-->
            <div class="price-ratio">
            <textarea id="text">100</textarea> 
             <span>to</span> 
            <textarea id="text2">7000</textarea>
            </div>
            <input type="range" min="100" max="7000" value="100" class="slider" id="myRange" onmouseup="mouselog(event)">
            
<!--            <div class="cost-price-content">
              <div id="price-range" class="price-range"></div>
              <span id="price-min" class="price-min">Rs 20</span> to <span id="price-max" class="price-max">Rs 80</span>

            </div> -->


            <!-- Colors -->
<!--            <h6>Size</h6>
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector size" value="S"> S</label>
            </div>
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector size" value="M"> M</label>
            </div>
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector size" value="L"> L</label>
            </div>
            <div class="list-group-item checkbox">
                <label><input type="checkbox" class="common_selector size" value="XL"> XL</label>
            </div>-->
            <!--
            <div class="sizes"> <a href="#.">S</a> <a href="#.">M</a> <a href="#.">L</a> <a href="#.">XL</a> </div>
-->
            <!-- Colors -->
            <br/>
            <h6>Colors</h6>
<!--             <form action="{{url('filter_data')}}" method="get" enctype="multipart/form-data">-->
           <div class="checkbox checkbox-primary">
                <ul>
                <li>
                    <input id="colr1" class="styled common_selector color" name="color" type="checkbox" value="red">
                  <label for="colr1"> Red  </label>
                </li>
                <li>
                  <input id="colr2" class="styled common_selector color" name="color" type="checkbox" value="blue">
                  <label for="colr2"> Blue  </label>
                </li>
                <li>
                  <input id="colr3" class="styled common_selector color" name="color" type="checkbox" value="white">
                  <label for="colr3"> White  </label>
                </li>
                </ul>
               
                    
            </div>
<!--             </form>-->
            
            <!--
            <div class="checkbox checkbox-primary">
              <ul>
                <li>
                  <input id="colr1" class="styled" type="checkbox" >
                  <label for="colr1"> Red <span>(217)</span> </label>
                </li>
                <li>
                  <input id="colr2" class="styled" type="checkbox" >
                  <label for="colr2"> Yellow <span> (179) </span> </label>
                </li>
                <li>
                  <input id="colr3" class="styled" type="checkbox" >
                  <label for="colr3"> Black <span>(79)</span> </label>
                </li>
                <li>
                  <input id="colr4" class="styled" type="checkbox" >
                  <label for="colr4">Blue <span>(283) </span></label>
                </li>
                <li>
                  <input id="colr5" class="styled" type="checkbox" >
                  <label for="colr5"> Grey <span> (116)</span> </label>
                </li>
                <li>
                  <input id="colr6" class="styled" type="checkbox" >
                  <label for="colr6"> Pink<span> (29) </span></label>
                </li>
                <li>
                  <input id="colr7" class="styled" type="checkbox" >
                  <label for="colr7"> White <span> (38)</span> </label>
                </li>
                <li>
                  <input id="colr8" class="styled" type="checkbox" >
                  <label for="colr8">Green <span>(205)</span></label>
                </li>
              </ul>
            </div>
            -->
          </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">

          <!-- Short List -->
          <div class="short-lst">
            <h2 >{{$productbreakcrumbs}} <span style="float:right"> {{$product->count()}} Items </span></h2>
            <ul>
              <!-- Short List -->
              <!-- <li>
                <p>Showing 1–12 of 756 results</p>
              </li> -->
              <!-- Short  -->
              <!-- <li >
                <select class="selectpicker">
                  <option>Show 12 </option>
                  <option>Show 24 </option>
                  <option>Show 32 </option>
                </select>
              </li> -->
              <!-- by Default -->
              <!-- <li>
                <select class="selectpicker">
                  <option>Sort by Default </option>
                  <option>Low to High </option>
                  <option>High to Low </option>
                </select>
              </li> -->

              <!-- Grid Layer -->
<!--              <li class="grid-layer"> <a href="#."><i class="fa fa-list margin-right-10"></i></a> <a href="#." class="active"><i class="fa fa-th"></i></a> </li>-->
              <!-- <li>

                <select class="selectpicker">
                  <option>4 Columns </option>
                  <option>3 Columns </option>
                  <option>5 Columns</option>
                </select>
              </li> -->
            </ul>
          </div>

          <!-- Items -->
              
          <div class="item-col-4 filter_data">

            @include('fetchdata')
           {{ $product->links() }}
            <!-- pagination -->
            <!-- <ul class="pagination">
              <li> <a href="#" aria-label="Previous"> <i class="fa fa-angle-left"></i> </a> </li>
              <li><a class="active" href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li> <a href="#" aria-label="Next"> <i class="fa fa-angle-right"></i> </a> </li>
            </ul> -->
          </div>
<!--          <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>-->
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

  <!-- Your Recently Viewed Items -->
  <section class="padding-bottom-60">
    <div class="container">

      <!-- heading -->
      <div class="heading">
        <h2>Your Recently Viewed Items</h2>
        <hr>
      </div>
      <!-- Items Slider -->
      <div class="item-slide-5 with-nav">
        @foreach ($recentlyview as $products)
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


</div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>
<!-- End Content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
<script type="text/javascript">

function mouselog(event) {
  
  text.value = event.target.value;
filter_data();
}

</script>  

<script>
        
//$(document).ready(function(){
    
    /*
    $(".color").on("change", function () {
        var color = $(this).val();
      
        
        $.ajax({
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
            url:"{{url('filter_data')}}",
            method:"POST",
            data:{color:color},
            success:function(data){
               $('.filter_data').html(data);
                                  
                    
                
            }
        });

});
*/

//filter_data();
function filter_data(){
    
     var color = get_filter('color');
     var minimum_price = $('#text').val();
     var maximum_price = $('#text2').val();
   
     var beadcrums =$('#product_breadcrum_data').text();
     $.ajax({
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
            url:"{{url('filter_data')}}",
            method:"POST",
            data:{color:color,beadcrums:beadcrums,minimum_price:minimum_price,maximum_price:maximum_price},
            success:function(data){
               $('.filter_data').html(data);
                                  
                    
                
            }
        });
    
}
function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    
 $('.common_selector').click(function(){
        filter_data();
    });
    
//     $('#myRange').mouseout(function(){
//       
//      
//            alert('hhhhhrr');
//            filter_data();
//       
//    });
//});

</script>

@endsection
@push('scripts')

@endpush
