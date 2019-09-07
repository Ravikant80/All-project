 <!-- Header -->


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <header>
    <div class="container">
      <div class="logo"> <a href="{{url('/')}}"><img src="{{asset('ecommerce/assets/images/logo.png')}}" alt="" ></a> </div>
      <div class="search-cate">
            <form action="{{url('search')}}" method="get" enctype="multipart/form-data">
                <input type="search" placeholder="Search entire store here..." name="query" id="search" value="{{request()->input('query')}}">
        
                 <button class="submit" type="submit"><i class="icon-magnifier"></i></button>
            </form>
      </div>
    
      <ul class="nav navbar-right1">
          @if(Auth::check())
        <li class="dropdown"> 
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
               <strong> My Account</strong> <br> 
          </a>
          <ul class="dropdown-menu">
             
           
           <li class=""> <a href="{{ url('my/profile') }}" class=""><i class="fa fa-user-circle-o"></i>  My Profile</a> </li>
           <li class=""> <a href="{{ url('my/orders') }}" class=""><i class="fa fa-opencart"></i> Orders</a>  </li>
           <li class=""> <a href="{{ url('my/wishlist') }}" class=""> <i class="fa fa-heart-o" aria-hidden="true"></i>  Wishlist</a> </li>
<!--           <li class=""> <a href="" class=""><i class="fa fa-power-off"></i>  Logout</a> </li>-->
            <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" class=""><i class="fa fa-power-off"></i>  Log Out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
          
           

        
          </ul>
        </li>
         @else

          <li><a href="{{ route('login') }}">Login </a></li>
          @endif
      </ul>
      
      
       <?php $cartItems = Cart::getContent();?>
        @if(isset($cartItems))
      <!-- Cart Part -->
      <ul class="nav navbar-right cart-pop">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="itm-cont">{{$cartItems->count()}}</span> <i class="flaticon-shopping-bag"></i> <!-- <strong>My Cart</strong> <br> -->
          <!-- <span>{{$cartItems->count()}} item(s) - Rs {{Cart::getTotal()}}</span> --></a>
          <ul class="dropdown-menu">
            @foreach($cartItems as $cartItem)
            <?php $pItems =getPoductDetails($cartItem->id);  ?>
            <li>
              <div class="media-left"> <a href="" class="thumb"> <img src="{{asset('ecommerce/assets/admin/upload/catalog/images/'.$pItems->image)}}" class="img-responsive" alt="" > </a> </div>
              <div class="media-body"> <a href="" class="tittle">{{$cartItem->name}}</a> <span>Qty:{{$cartItem->quantity}}</span> </div>
            </li>

            @endforeach
            <li class="btn-cart"> <a href="{{route('cart')}}" class="btn-round">View Cart</a> </li>
          </ul>
        </li>
      </ul>
      @endif

    </div>

    <!-- Nav -->
    <nav class="navbar ownmenu">
      <div class="container">

        

        <!-- Navbar Header -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span><i class="fa fa-navicon"></i></span> </button>
        </div>
        <!-- NAV -->
        <div class="collapse navbar-collapse" id="nav-open-btn">
          <ul class="nav">
            <li class="dropdown megamenu"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Grocery</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">
                
                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Beverages</h6>
                      <ul>
                        <li><a href="{{url('shop/biscuits/')}}">Biscuits </a></li>
                        <li><a href="{{url('shop/soft-drink/')}}"> Soft Drink </a></li>
                        <li><a href="{{url('shop/milk-glucose/')}}">Milk and Glucose </a></li>
                        <li><a href="{{url('shop/chips-namkeen/')}}">Chips Namkeen & Snacks. </a></li>

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Food Item</h6>
                      <ul>
                        <li><a href="{{url('shop/dal-pulse/')}}"> Dal and Pulses</a></li>
                        <li><a href="{{url('shop/ghee-oil/')}}"> Ghee and Oil</a></li>
                        <li><a href="{{url('shop/flours/')}}"> Flours</a></li>
                        <li><a href="{{url('shop/rice/')}}"> Rice</a></li>
                        <li><a href="{{url('shop/sugar-salt/')}}">Sugar And Salt</a></li>

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Packaged</h6>
                      <ul>
                        <li><a href="{{url('shop/noodels-pasta/')}}"> Noodels & Pasta</a></li>
                        <li><a href="{{url('shop/oats/')}}"> Oats</a></li>
                        <li><a href="{{url('shop/chocolates-sweet/')}}"> Chocolates & Sweet</a></li>
                        <li><a href="{{url('shop/jam-honey/')}}"> Jam & Honey</a></li>
                        <li><a href="{{url('shop/pickles/')}}"> Pickles</a></li>

                      </ul>
                    </div>
                    <!-- <div class="col-sm-4"> <img class=" nav-img" src="{{asset('ecommerce/assets/images/navi-img.png')}}" alt="" > </div> -->
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown megamenu"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Electronics</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Mobiles</h6>
                      <ul>
                        <li><a href="{{url('shop/mi/')}}">Mi</a></li>
                        <li><a href="{{url('shop/samsung/')}}">Samsung </a></li>
                        <li><a href="{{url('shop/oppo/')}}">OPPO</a></li>
                        <li><a href="{{url('shop/vivo/')}}">Vivo </a></li>
                        <li><a href="{{url('shop/honor/')}}">Honor </a></li>
                        <li><a href="{{url('shop/iphone/')}}">Iphone</a></li>

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Home Appliances</h6>
                      <ul>
                        <li><a href="{{url('shop/iron/')}}">Iron</a></li>
                        <li><a href="{{url('shop/water-purifier/')}}">Water Purifier</a></li>
                        <li><a href="{{url('shop/fan/')}}">Fan</a></li>
                        <li><a href="{{url('shop/voltage-stapilizer/')}}">Voltage stapilizer</a></li>
                        <li><a href="{{url('shop/refrigerator/')}}">Refrigerators</a></li>
                        <li><a href="{{url('shop/ac/')}}">Ac</a></li>
                        <li><a href="{{url('shop/cooler/')}}">Cooler</a></li>
                        <li><a href="{{url('shop/washig-machine/')}}">Washing Machine</a></li>

                        <!-- <li><a href="{{url('electronics/')}}"> Rice</a></li>
                        <li><a href="{{url('electronics/')}}">Sugar And Salt</a></li> -->

                      </ul>
                    </div>
                      <div class="col-sm-3">
                      <h6>Kitchen Appliances</h6>
                      <ul>
                        <li><a href="{{url('shop/microwave-oven/')}}">Microwave Toaster Oven</a></li>
                        <li><a href="{{url('shop/juicer-mixer-grinder/')}}">Juicer Mixer Grinder</a></li>
                        <li><a href="{{url('shop/cooktops/')}}">Cooktops</a></li>
                        <li><a href="{{url('shop/chimney/')}}">Chimney</a></li>
                        <li><a href="{{url('shop/hand-blender/')}}">Hand blender</a></li>
                        <li><a href="{{url('shop/sandwich-maker/')}}">Sandwich maker</a></li>
                        <li><a href="{{url('shop/toaster/')}}">Toaster</a></li>
                        <li><a href="{{url('shop/food-processor/')}}">Food processor</a></li>
                        <!-- <li><a href="{{url('electronics/')}}"> Rice</a></li>
                        <li><a href="{{url('electronics/')}}">Sugar And Salt</a></li> -->

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Home Entertainment</h6>
                      <ul>
                        <li><a href="{{url('shop/dth-set-up-box/')}}">DTH Set Up Box</a></li>
                        <li><a href="{{url('shop/home-theater/')}}">Home Theater</a></li>
                        <li><a href="{{url('shop/home-speaker/')}}">Home Speaker</a></li>


                      </ul>
                    </div>
                      
                    <!-- <div class="col-sm-4"> <img class=" nav-img" src="{{asset('assets/images/navi-img.png')}}" alt="" > </div> -->
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown megamenu"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Men</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Clothing</h6>
                      <ul>
                        <li><a href="{{url('shop/men-shirts/')}}">Shirts </a></li>
                        <li><a href="{{url('shop/men-suilts/')}}"> Suits </a></li>
                        <li><a href="{{url('shop/men-tshirt/')}}">T-Shirts </a></li>
                        <li><a href="{{url('shop/men-kurta-blazer/')}}">Kurtas  & Blazers </a></li>

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Bottom wear</h6>
                      <ul>
                        <li><a href="{{url('shop/men-jeans/')}}"> Jeans</a></li>
                        <li><a href="{{url('shop/men-trouser/')}}">Trouser</a></li>
                        <li><a href="{{url('shop/men-pants/')}}"> Pants</a></li>


                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Footwear</h6>
                      <ul>
                        <li><a href="{{url('shop/men-shoe/')}}"> Shoes</a></li>
                        <li><a href="{{url('shop/men-boots/')}}">Boots</a></li>
                        <li><a href="{{url('shop/men-loafers/')}}"> Loafers</a></li>


                      </ul>
                    </div>
                      <div class="col-sm-3">
                      <h6>others</h6>
                      <ul>
                        <li><a href="{{url('shop/men-sunglass/')}}">Sunglass</a></li>
                        <li><a href="{{url('shop/men-accessories/')}}">Accessories</a></li>
                        


                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown megamenu"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Women</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Clothing</h6>
                      <ul>
                        <li><a href="{{url('shop/women-saree/')}}">Saree </a></li>
                        <li><a href="{{url('shop/women-kurti/')}}"> Kurtis </a></li>
                        <li><a href="{{url('shop/women-suits/')}}"> Suits </a></li>
                        <li><a href="{{url('shop/women-blouse/')}}"> Blouse </a></li>


                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Western Wear</h6>
                      <ul>
                        <li><a href="{{url('shop/women-topt-shirts/')}}">Top t-shirts</a></li>
                        <li><a href="{{url('shop/women-dresses/')}}">Dresses</a></li>
                        <li><a href="{{url('shop/women-jeans/')}}">Jeans</a></li>
                        <li><a href="{{url('shop/women-leggings/')}}">Leggings</a></li>
                        <li><a href="{{url('shop/women-trouser/')}}"> Trousers</a></li>

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Footwear</h6>
                      <ul>
                        <li><a href="{{url('shop/women-sandals/')}}">Sandals</a></li>
                        <li><a href="{{url('shop/women-shoes/')}}">Shoes</a></li>
                        <li><a href="{{url('shop/women-boots/')}}">Boots</a></li>


                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>others</h6>
                      <ul>
                        <li><a href="{{url('shop/women-sunglass/')}}">Sunglass</a></li>
                        <li><a href="{{url('shop/women-accessories/')}}">Accessories</a></li>
                        <li><a href="{{url('shop/women-freshers/')}}">Fresheners</a></li>


                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown megamenu"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Baby Kids</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Kids Clothing</h6>
                      <ul>
                        <!-- <li><a href="{{url('grocery/')}}">Biscuits </a></li>
                        <li><a href="{{url('grocery/')}}"> Soft Drink </a></li>
                        <li><a href="{{url('grocery/')}}">Milk and Glucose </a></li>
                        <li><a href="{{url('grocery/')}}">Chips Namkeen & Snacks. </a></li> -->

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Kids Footwear</h6>
                      <ul>
                        <!-- <li><a href="{{url('grocery/')}}"> Dal and Pulses</a></li>
                        <li><a href="{{url('grocery/')}}"> Ghee and Oil</a></li>
                        <li><a href="{{url('grocery/')}}"> Flours</a></li>
                        <li><a href="{{url('grocery/')}}"> Rice</a></li>
                        <li><a href="{{url('grocery/')}}">Sugar And Salt</a></li> -->

                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Toys</h6>
                      <ul>
                        <!-- <li><a href="{{url('grocery/')}}"> Noodels & Pasta</a></li>
                        <li><a href="{{url('grocery/')}}"> Oats</a></li>
                        <li><a href="{{url('grocery/')}}"> Chocolates & Sweet</a></li>
                        <li><a href="{{url('grocery/')}}"> Jam & Honey</a></li>
                        <li><a href="{{url('grocery/')}}"> Pickles</a></li> -->

                      </ul>
                    </div>
                    <!-- <div class="col-sm-4"> <img class=" nav-img" src="{{asset('assets/images/navi-img.png')}}" alt="" > </div> -->
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown megamenu"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Furniture</a>
              <div class="dropdown-menu animated-2s fadeInUpHalf">
                <div class="mega-inside">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6>Home Furniture</h6>
                      <ul>
                        <li><a href="{{url('shop/furniture-sofa/')}}">Sofa </a></li>
                        <li><a href="{{url('shop/bed/')}}">Bed </a></li>
                        <li><a href="{{url('shop/tables/')}}">Tables </a></li>
                        <li><a href="{{url('shop/furniture-chairs/')}}">Chairs </a></li>
                        <li><a href="{{url('shop/almirah/')}}">Almirah </a></li>
                      </ul>
                    </div>
                    <div class="col-sm-3">
                      <h6>Kitchen Dining</h6>
                      <!-- <ul>
                        <li><a href="{{url('furniture/')}}"> Dal and Pulses</a></li>
                        <li><a href="{{url('grocery/')}}"> Ghee and Oil</a></li>
                        <li><a href="{{url('grocery/')}}"> Flours</a></li>
                        <li><a href="{{url('grocery/')}}"> Rice</a></li>
                        <li><a href="{{url('grocery/')}}">Sugar And Salt</a></li>

                      </ul> -->
                    </div>
                    <div class="col-sm-3">
                      <h6>Home Decor </h6>
                      <ul>
                        <li><a href="{{url('shop/lighting/')}}">Lighting</a></li>


                      </ul>
                    </div>
                      <div class="col-sm-3">
                      <h6>Other </h6>
                      <ul>
                        <li><a href="{{url('shop/other-furniture/')}}">Other Furniture</a></li>


                      </ul>
                    </div>
                    <!-- <div class="col-sm-4"> <img class=" nav-img" src="{{asset('assets/images/navi-img.png')}}" alt="" > </div> -->
                  </div>
                </div>
              </div>
            </li>
            <li class=""> <a href="{{url('shop/beauty-product/')}}" class="" >Beauty Products</a></li>
            <li class=""> <a href="{{url('shop/others/')}}" class="" >Others</a></li>

              

          </ul>
        </div>

      </div>
    </nav>
  </header>

