@foreach ($product as $products)
           
            <div class="product">
              <article>
                <a href="{{url('/product/'.str_slug($products->product_category).'/'.str_slug($products->name))}}">
                <img class="img-responsive" src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$products->image)}}" alt="" height="243px">
              </a>
             
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
          

