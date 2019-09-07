@extends('layouts.frontend')
@push('styles')
<style media="screen">
   .inc,.dec{
     width: 28px;
    height: 28px;
    background: linear-gradient(#fff,#f9f9f9);
    display: inline-block;
    border: 1px solid #c2c2c2;
    cursor: pointer;
    font-size: 16px;
    border-radius: 50%;
    padding-top: 1px;
    line-height: 1;
   }
   .qtnt{
     display: inline-block;
padding: 3px 6px;
width: calc(100% - 60px);
height: 100%;
width: 46px;
height: 28px;
border-radius: 2px;
background-color: #fff;
border: 1px solid #c2c2c2;
margin: 0 9px;
   }
 </style>
@endpush

@section('content')
  <!-- Linking -->
  <div class="linking">
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="active">Cart</li>
      </ol>
    </div>
  </div>
  <div id="content">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif


 

  <!-- Shopping Cart -->
  @if(Cart::getContent()->count() > 0)
   <div class="heading">
          <h2 class="text-center">{{count($cartdata)}} item(s) in Shopping Cart .</h2>
          <hr>
   </div>
  <section class="shopping-cart padding-bottom-60">
    <div class="container">
        <div style="overflow-x:scroll">
          <table class="table">
            <thead>
              <tr>
                <th>Items</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Total Price </th>
                <th>&nbsp; </th>
              </tr>
            </thead>
            <tbody>
              @foreach($cartdata as $cartdatas)
             <?php $pdata =getPoductDetails($cartdatas->id);  ?>
              <!-- Item Cart -->
              <tr>
                <td><div class="media">
                    <div class="media-left"> <a href="#."> <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$pdata->image)}}" alt="" > </a> </div>
                    <div class="media-body">
                      <p>{{$cartdatas->name}}</p>
                    </div>
                  </div></td>
                  <input type="hidden" name="product_id" value="{{$cartdatas->id}}" id="product_id">
                <td class="text-center padding-top-60">Rs {{$cartdatas->price}}</td>
                <td class="text-center"><!-- Quinty -->
    
                  <div class="quinty padding-top-20">
                    <input type='button' name='add' onclick='javascript: document.getElementById("qty").value++;' value='+'/>
    			          <input type='button' name='subtract' onclick='javascript: subtractQty();' value='-'/>
                    <button class="dec custombutton">-</button>
                    <input type="number" size="2"name="quantity" value="{{$cartdatas->quantity}}" id="quantity" readonly class="qtnt">
    
                    <button class="inc custombutton">+</button>
    
                  </div></td>
                <td class="text-center padding-top-60">Rs {{Cart::get($cartdatas->id)->getPriceSum()}}</td>
                <td class="text-center padding-top-60"><a href="{{url('cart/item/remove/'.$cartdatas->id)}}" class="remove"><i class="fa fa-close"></i></a></td>
              </tr>
    
              @endforeach
    
    
            </tbody>
          </table>
        </div>
      <!-- Promotion -->
      <div class="promo">
        <div class="coupen">
          <label> Promotion Code
            <input type="text" placeholder="Your code here">
            <button type="submit"><i class="fa fa-arrow-circle-right"></i></button>
          </label>
        </div>

        <!-- Grand total -->
        <div class="g-totel">
          <h5>Grand total: <span>Rs {{Cart::getTotal()}}</span></h5>
        </div>
      </div>

      <!-- Button -->
      <div class="pro-btn"> <a href="{{url('/')}}" class="btn-round btn-light">Continue Shopping</a> <a href="{{url('checkout/init')}}" class="btn-round">Go Checkout</a> </div>
    </div>
  </section>
 @else


    <!-- Oder-success -->
    <section>
      <div class="container">
        <!-- Payout Method -->

        <div class="order-success"> <i class="fa fa-check"></i>
          <h6>No Item in Cart!</h6>

          <a href="{{url('/')}}" class="btn-round">Return to Shop</a> </div>
      </div>
    </section>

  @endif


</div>

<!-- End Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
$(".custombutton").on("click", function() {

  var $button = $(this);
  var oldValue = $button.parent().find("input").val();


  if ($button.text() == "+") {
    var newVal = parseFloat(oldValue) + 1;
  } else {
   // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }

  $button.parent().find("input").val(newVal);
  var quantity = $('#quantity').val();
  var product_id = $('#product_id').val();
//alert(product_id);
        //  e.preventDefault();
      //  alert(newVal);
           $.ajax({
              url: "{{ url('cart/quantity/update') }}",
              method: "post",
              data: {_token: '{{ csrf_token() }}', id: product_id, quantity: newVal},
              success: function (response) {
              //  alert(response);
                  window.location.reload();

              }
           });

});

</script>



@endsection
@push('scripts')

@endpush
