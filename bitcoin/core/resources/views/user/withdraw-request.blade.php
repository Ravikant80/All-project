@extends('layouts.user-frontend.dashboard')
@section('style')
@endsection

@section('content')

<style type="text/css">
  .featured-outlets__outlet {
       background: #fff;
    border-radius: 4px;
    border: 1px solid transparent;
    padding: 10px;
    margin: 5px;
   
    height: auto;
    min-height: 90px;
    color: #888;
    -webkit-transition: color .15s ease-in-out,border-color .15s ease-in-out;
    transition: color .15s ease-in-out,border-color .15s ease-in-out;
    box-shadow: 0 2px 1px 0 rgba(0,0,0,.05), 0 0 2px 0 rgba(0,0,0,.22);
    text-align: center;
   
}
.ember-view:hover {
  border: 1px solid #39a8df;
}

.featured-outlets__logo {
    max-width: 100%;
    max-height: 40px;
}

.featured-outlets__name {
    line-height: 18px;
    margin-top: 15px;
}

.btn-group{
  display: none;
}

.sw-theme-arrows > ul.step-anchor > li {
    width: 130px;
    padding-right: 61px;
}
.content-wrapper {
    padding: 2.2rem;
    margin-left: 18%;
}





.clearfix:after {
    clear: both;
    content: "";
    display: block;
    height: 0;
}

.container {
  font-family: 'Lato', sans-serif;
  width: 1000px;
  margin: 0 auto;
}

.wrapper {
  display: table-cell;
  height: 100px;
  vertical-align: middle;
}

.nav {
  margin-top: 40px;
}

.pull-right {
  float: right;
}

a, a:active {
  color: #333;
  text-decoration: none;
}

a:hover {
  color: #999;
}

/* Breadcrups CSS */

.arrow-steps .step {
  font-size: 18px;
  text-align: center;
  color: #666;
  cursor: default;
    margin: 0 2px;
    padding: 10px 10px 10px 30px;
    min-width: 205px;
  float: left;
  position: relative;
  background-color: #d9e3f7;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none; 
  transition: background-color 0.2s ease;
}

.arrow-steps .step:after, .arrow-steps .step:before {
    content: " ";
    position: absolute;
    top: 0;
    right: -17px;
    width: 0;
    height: 0;
    border-top: 23px solid transparent;
    border-bottom: 23px solid transparent;
    border-left: 17px solid #d9e3f7;
    z-index: 2;
    transition: border-color 0.2s ease;
}

.arrow-steps .step:before {
  right: auto;
  left: 0;
  border-left: 17px solid #fff; 
  z-index: 0;
}

.arrow-steps .step:first-child:before {
  border: none;
}

.arrow-steps .step:first-child {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.arrow-steps .step span {
  position: relative;
}

.arrow-steps .step span:before {
  opacity: 0;
  content: "✔";
  position: absolute;
  top: -2px;
  left: -20px;
}

.arrow-steps .step.done span:before {
  opacity: 1;
  -webkit-transition: opacity 0.3s ease 0.5s;
  -moz-transition: opacity 0.3s ease 0.5s;
  -ms-transition: opacity 0.3s ease 0.5s;
  transition: opacity 0.3s ease 0.5s;
}

.arrow-steps .step.current {
  color: #fff;
  background-color: #39a8df;
}

.arrow-steps .step.current:after {
  border-left: 17px solid #39a8df;  
}

.content-wrapper {
    padding: 2.2rem;
    margin-left: 15%;
}
.sw-theme-arrows .step-content {
  
    background-color: #f4f5fa !important; 
 
}
.sw-theme-arrows {
    border-radius: 5px;
    border: none!important;
}
</style>


<div class="container"> 
  <div class="wrapper"> 
    <div class="arrow-steps clearfix">
        <div class="step current"> <span> Method</span> </div>
       <!--  <div class="step"> <span> Amount</span> </div> -->
        <div class="step"> <span>Payment</span> </div>
    </div>
  </div>
</div>
<div class="row" style="width:100%;" align="center">
           
            
         
                <div id="smartwizard">
                    <ul style="display: none;">
                        <li><a href="#step-1">Method</a></li>
                        <li><a href="#step-3">Payment</a></li>
                    </ul>

                    <div>
                  <div id="step-1" style="height:400px; width:100%; background-color: none !important;" class="">
                            <div id="wallet">
                    <div class="">
                      <div class="ca-page-title ca-center-align">
                            <h3 style="text-align: center;padding-top: 30px; padding-bottom: 20px;">How would you like to Cash-In?</h3>
                          </div>
                   <div class="card-content collapse show">
                 
                    
                    <fieldset>

           
   <div class="col-md-12" style="display:  inline-flex;">

       <div class="col-md-4">
        <a href="{{ url('user/withdraw-payment') }}" style="text-decoration: none;">
         <div class="form-group">

          <div id="ember1570" class="ember-view featured-outlets__outlet"><div class="featured-outlets__content ">

            <div>
              <img class="featured-outlets__logo" src="{{asset('assets/img/mtnmoney.jpg')}}">
            </div>

            <div class="featured-outlets__name">
              MTN Mobile Cash In
              <span class="featured-outlets__estimate">
                <strong>Instant</strong> after payment
              </span>
            </div>
          </div>
        </div>


       </div></a>
       </div>
       <div class="col-md-4" title="Comming Soon!">
       
         <div class="form-group">
                          
                          <div id="ember1570" class="ember-view featured-outlets__outlet"><div class="featured-outlets__content ">

                              <div>
                                <img class="featured-outlets__logo" src="{{asset('assets/img/paypal-logo.png')}}">
                              </div>

                              <div class="featured-outlets__name">
                               Paypal Mobile Cash In
                                  <span class="featured-outlets__estimate">
                                        <strong>Instant</strong> after payment
                                  </span>
                              </div>
                            </div>
                            </div>
                  
                          
                        </div>
       </div>
       <div class="col-md-4" title="Comming Soon!">
       
           <div class="form-group">
                          
                          <div id="ember1570" class="ember-view featured-outlets__outlet"><div class="featured-outlets__content ">

                              <div>
                                <img class="featured-outlets__logo" src="{{asset('assets/img/paytm1.jpg')}}" >
                              </div>

                              <div class="featured-outlets__name">
                               Paytm Mobile Cash In
                              
                                  <span class="featured-outlets__estimate">
                                        <strong>Instant</strong> after payment
                                  </span>
                              </div>
                            </div>
                            </div>
                  
                          
                        </div>
       </div>
   </div>


                    
                    </fieldset>
          
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>





@endsection

