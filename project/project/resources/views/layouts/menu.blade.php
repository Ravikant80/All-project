<div class="top-bar">
    <div class="container">
      <p>Welcome to ETW Shopping Mall!</p>
      <div class="right-sec">
        <ul>
          @if(Auth::check())
          <li><a href="#">Hi. {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>
              <ul class="sub-menu">
                  <li><a href="{{ url('user/my-account') }}">My Account</a></li>
                  <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" class="">Log Out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
          </li>
          @else

            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>

          @endif
          
          <!-- <li><a href="{{route('login')}}">Login/Register </a></li> -->
          <li><a href="{{url('/')}}">Store Location </a></li>
          <li><a href="{{url('/')}}">FAQ </a></li>
          <li><a href="{{url('/')}}">Newsletter </a></li>
          <!-- <li>
            <select class="selectpicker">
              <option>French</option>
              <option>German</option>
              <option>Italian</option>
              <option>Japanese</option>
            </select>
          </li> -->
          <!-- <li>
            <select class="selectpicker">
              <option>(USD)Dollar</option>
              <option>GBP</option>
              <option>Euro</option>
              <option>JPY</option>
            </select>
          </li> -->
        </ul>
        <div class="social-top"> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i class="fa fa-twitter"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> <a href="#."><i class="fa fa-dribbble"></i></a> <a href="#."><i class="fa fa-pinterest"></i></a> </div>
      </div>
    </div>
  </div>
