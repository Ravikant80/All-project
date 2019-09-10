<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Wynotech">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($site_title); ?> | <?php echo e($page_title); ?></title>
    <link rel="apple-touch-icon" href="<?php echo e(asset('assets/dashboard/app-assets/images/ico/apple-icon-120.png')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/css/vendors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/vendors/css/charts/chartist.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/vendors/css/charts/chartist-plugin-tooltip.css')); ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/css/app.css')); ?>">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/css/core/menu/menu-types/vertical-compact-menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/vendors/css/cryptocoins/cryptocoins.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/css/pages/timeline.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/app-assets/css/pages/dashboard-ico.css')); ?>">
    <!-- END Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/admin/css/sweetalert.css')); ?>">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/owl.carousel.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/owl.theme.default.min.css')); ?>">
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
    <!-- Smart Wizard -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/smart_wizard.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/smart_wizard_theme_circles.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/smart_wizard_theme_arrows.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/dashboard/assets/css/smart_wizard_theme_dots.css')); ?>">

    <!-- END Custom CSS-->
    <link href="<?php echo e(asset('assets/admin/css/datatables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/admin/css/datatables.bootstrap.css')); ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
      .dashboarNav{
        padding: 2.5rem 1rem 1.6rem 6rem !important;
      }
      .menu-title{
        font-size: 1.15rem !important;
    color: #6B6F82 !important;

      }
  </style> 
 </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
  
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
      <div class="navbar-wrapper">
        <div class="navbar-header d-md-none">
          <ul class="nav navbar-nav flex-row">
            
            <li class="nav-item d-md-none"><a class="navbar-brand" href="<?php echo route('user-dashboard'); ?>"><img class="brand-logo d-none d-md-block" alt="crypto ico admin logo" src="<?php echo e(asset('assets/images/logo.png')); ?>"><img class="brand-logo d-sm-block d-md-none" alt="crypto ico admin logo sm" src="<?php echo e(asset('assets/images/logo.png')); ?>"></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v">   </i></a></li>
          </ul>
        </div>
        <div class="navbar-container">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
            
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main" href="<?php echo e(url('user/wallet')); ?>"><img style="width: 100px !important;" class="brand-logo" alt="CT Pay user logo" src="<?php echo e(asset('assets/images/logo.png')); ?>"/></a></li>
              
<!--                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="<?php echo e(url('user/wallet')); ?>"><img style="width: 100px !important;" class="brand-logo" alt="crypto ico admin logo" src="<?php echo e(asset('assets/images/logo.png')); ?>"/></a></li>-->
                 
                              <li class="dropdown dropdown-notification nav-item dashboarNav" class="<?php echo e((\Request::route()->getName() == 'wallet') ? 'active' : 'nav-item'); ?>"><a href="<?php echo e(route('wallet')); ?>"><i class="icon-wallet" style="font-size: 1.5rem;"></i><span class="menu-title" data-i18n="">My Wallet</span></a></li>
                              <li class="dropdown dropdown-notification nav-item dashboarNav" class=""><a href="<?php echo e(url('payment/dashboard')); ?>"><i class="icon-layers" style="font-size: 1.5rem;"></i><span class="menu-title" data-i18n="">Cash In</span></a></li>
                              
                              <li class="dropdown dropdown-notification nav-item dashboarNav" class="<?php echo e((\Request::route()->getName() == 'withdraw-request') ? 'active' : 'nav-item'); ?>"><a href="<?php echo route('withdraw-request'); ?>"><i class="fa fa-money" style="font-size: 1.5rem;"></i><span class="menu-title" data-i18n="">Cash Out</span></a></li>
                              
                                  
                                </ul>
            <ul class="nav navbar-nav float-right">         
<!--              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="<?php echo e(route('wallet')); ?>"><i class="ficon icon-wallet"></i></a></li>-->
               <?php if(Auth::check()): ?>
              <li class="dropdown dropdown-user nav-item">
              	<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             
              	<span class="avatar avatar-online">
                <?php if(Auth::user()->image != '' || Auth::user()->image != NULL): ?>
                	<img src="<?php echo e(asset('assets/images')); ?>/<?php echo e(Auth::user()->image); ?>" alt="<?php echo e(Auth::user()->name); ?>" />
                <?php else: ?>
                	<img src="<?php echo e(asset('assets/dashboard/app-assets/images/portrait/small/avatar-s-1.png')); ?>" alt="avatar">
                <?php endif; ?>
                </span><span class="mr-1"><?php echo e(Auth::user()->name); ?></span></a>
                <div class="dropdown-menu dropdown-menu-right">             
                    <a class="dropdown-item" href="<?php echo e(route('edit-profile')); ?>"><i class="ft-user"></i> Profile</a>
                    <a class="dropdown-item" href="<?php echo e(route('investment-verify-general')); ?>"><i class="ft-check-circle"></i> Id Verification</a>
<!--                    <a class="dropdown-item" href="<?php echo e(route('g2fa')); ?>"><i class="fa fa-key"></i> Security</a>-->
                    <a class="dropdown-item" href="<?php echo e(route('change-password')); ?>"><i class="fa fa-cubes"></i> Change Password</a>
                    <a class="dropdown-item" href="<?php echo e(route('user-activity')); ?>"><i class="ft-check-square"></i> Transactions</a>
                    <a class="dropdown-item" href="<?php echo e(route('reference-user')); ?>"><i class="fa fa-group"></i> Reference User</a>
                  	<div class="dropdown-divider"></div>
                  	<a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onClick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                    
                                    
                    
                                     
                    
                            
                                        
                </div>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    
    
    
    <div class="app-content content">
      	<div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    
    <footer class="footer footer-static footer-transparent">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; <?=date("Y")?> <a class="text-bold-800 grey darken-2" href="<?php echo e(asset('')); ?>" target="_blank">CT Pay Inc</a>, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block"></span></p>
    </footer>
    
  <!-- BEGIN VENDOR JS-->
    <script src="<?php echo e(asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')); ?>" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
   <!-- <script src="<?php echo e(asset('assets/dashboard/app-assets/vendors/js/charts/chartist.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/dashboard/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')); ?>" type="text/javascript"></script>-->
    <script src="<?php echo e(asset('assets/dashboard/app-assets/vendors/js/timeline/horizontal-timeline.js')); ?>" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
	<script src="<?php echo e(asset('assets/admin/js/bootstrap-fileinput.js')); ?>"></script>

    <!-- BEGIN MODERN JS-->
    <script src="<?php echo e(asset('assets/dashboard/app-assets/js/core/app-menu.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/dashboard/app-assets/js/core/app.js')); ?>" type="text/javascript"></script>
    <!-- END MODERN JS-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

    <script src="<?php echo e(asset('assets/dashboard/app-assets/js/scripts/pages/dashboard-ico.js')); ?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="<?php echo e(asset('assets/dashboard/assets/js/jquery.smartWizard.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/dashboard/assets/js/owl.carousel.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('assets/dashboard/assets/js/highlight.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/dashboard/assets/js/app.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/admin/js/sweetalert.min.js')); ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo e(asset('assets/admin/js/datatable.js')); ?>" type="text/javascript"></script>
	<script src="<?php echo e(asset('assets/admin/js/datatables.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/admin/js/datatables.bootstrap.js')); ?>"type="text/javascript"></script>
   <!-- <script src="<?php echo e(asset('assets/admin/js/table-datatables-buttons.min.js')); ?>" type="text/javascript"></script>-->
	<script src="<?php echo e(asset('assets/dashboard/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <script>
		$('#expiry_date').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'dd-mm-yyyy',
			autoclose:true
		});
	</script>
	<script>
		$('#birthdate').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'dd-mm-yyyy',
			autoclose:true
		});
	</script>
    <script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 2,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true
        });        
    });
    </script>
     <script type="text/javascript">
        $(document).ready(function(){

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
							 .addClass('btn btn-info')
							 .on('click', function(){
									if( !$(this).hasClass('disabled')){
										var elmForm = $("#myForm");
										if(elmForm){
											elmForm.validator('validate');
											var elmErr = elmForm.find('.has-error');
											if(elmErr && elmErr.length > 0){
												alert('Oops we still have error in the form');
												return false;
											}else{
												alert('Great! we are ready to submit form');
												elmForm.submit();
												return false;
											}
										}
									}
								});
								
            /*var btnCancel = $('<button></button>').text('Cancel')
							 .addClass('btn btn-danger')
							 .on('click', function(){
									$('#smartwizard').smartWizard("reset");
									$('#myForm').find("input, textarea").val("");
								});*/



            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarExtraButtons: false
                                    },
                    anchorSettings: {
                                markDoneStep: true, // add done css
                                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                            }
                 });

            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                var elmForm = $("#form-step-" + stepNumber);
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward' && elmForm){
                    elmForm.validator('validate');
                    var elmErr = elmForm.children('.has-error');
                    if(elmErr && elmErr.length > 0){
                        // Form validation failed
                        return false;
                    }
                }
                return true;
            });

            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 2){
                    $('.btn-finish').removeClass('disabled');
                }else{
                    $('.btn-finish').addClass('disabled');
                }
            });

        });
    </script>
      <?php if(session()->has('message')): ?>
    <script>
        swal({
            title: "<?php echo session()->get('title'); ?>",
            text: "<?php echo session()->get('message'); ?>",
            type: "<?php echo session()->get('type'); ?>",
            confirmButtonText: "OK"
        });
	</script>
        <?php session()->forget('message') ?>
    <?php endif; ?>

   <script type='text/javascript' src='<?php echo e(asset('assets/js/bootbox.min.js')); ?>'></script> 
  </body>
</html>


