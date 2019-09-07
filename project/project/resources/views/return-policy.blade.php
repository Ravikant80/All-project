@extends('layouts.frontend')
@push('styles')

@endpush

@section('content')
<div id="content"> 
    
    <!-- Linking -->
    <div class="linking">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">About Us</li>
        </ol>
      </div>
    </div>
    
    <!-- About Sec -->
    <section class="about-sec padding-top-60 padding-bottom-60">
      <div class="container"> 
        
        <!-- About Adds -->
        <div class="about-adds">
          <div class="position-center-center">
            <h2>SmartTech <small> Digital & Electronic PSD Template!</small></h2>
            <a href="#." class="btn-round">Shop with Us</a> </div>
        </div>
      </div>
    </section>
    
    <!-- Shipping Info -->
    <section class="shipping-info padding-bottom-60">
      <div class="container">
        <ul>
          <!-- Free Shipping -->
          <li>
            <div class="media-left"> <i class="flaticon-delivery-truck-1"></i> </div>
            <div class="media-body">
              <h5>Free Shipping</h5>
              <span>On order over $99</span></div>
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
              <span>Hotline: (+100) 123 456 7890</span></div>
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
    
    <!-- Skills -->
    <section class="skills padding-top-60">
      <div class="container"> 
        
        <!-- heading -->
        <div class="heading">
          <h2>Our Awesome Skills</h2>
          <hr>
        </div>
        
        <!-- progress-bars -->
        <div class="progress-bars"> 
          <!-- PHOTOSHOP -->
          <div class="bar">
            <div class="row">
              <div class="col-sm-2">
                <p>Adobe/Photoshop </p>
              </div>
              <div class="col-sm-10">
                <div class="progress" data-percent="90%">
                  <div class="progress-bar"> <span class="progress-bar-tooltip">90%</span></div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- HTML -->
          <div class="bar">
            <div class="row">
              <div class="col-sm-2">
                <p>UI Design</p>
              </div>
              <div class="col-sm-10">
                <div class="progress" data-percent="70%">
                  <div class="progress-bar"><span class="progress-bar-tooltip">70%</span> </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- ILLUSTRATION -->
          <div class="bar">
            <div class="row">
              <div class="col-sm-2">
                <p>Layout & Frame</p>
              </div>
              <div class="col-sm-10">
                <div class="progress" data-percent="80%">
                  <div class="progress-bar"><span class="progress-bar-tooltip">80%</span> </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- ILLUSTRATION -->
          <div class="bar">
            <div class="row">
              <div class="col-sm-2">
                <p>Typography</p>
              </div>
              <div class="col-sm-10">
                <div class="progress" data-percent="80%">
                  <div class="progress-bar"><span class="progress-bar-tooltip">80%</span> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Team -->
    <section class="padding-top-60 padding-bottom-60">
      <div class="container"> 
        
        <!-- heading -->
        <div class="heading">
          <h2>Meet Our Team</h2>
          <hr>
        </div>
        <div class="team">
          <div class="row">
            <div class="col-md-3"> <img class="img-responsive" src="images/team-img-1.jpg" alt="" >
              <h3>Tom Doe</h3>
              <span>Ceo/Founder SmartTech</span> </div>
            <div class="col-md-3"> <img class="img-responsive" src="images/team-img-2.jpg" alt="" >
              <h3>Tom Doe</h3>
              <span>Ceo/Founder SmartTech</span> </div>
            <div class="col-md-3"> <img class="img-responsive" src="images/team-img-3.jpg" alt="" >
              <h3>Tom Doe</h3>
              <span>Ceo/Founder SmartTech</span> </div>
            <div class="col-md-3"> <img class="img-responsive" src="images/team-img-4.jpg" alt="" >
              <h3>Tom Doe</h3>
              <span>Ceo/Founder SmartTech</span> </div>
          </div>
        </div>
      </div>
    </section>
    
   
    
    
  </div>
@endsection
@push('scripts')

@endpush

