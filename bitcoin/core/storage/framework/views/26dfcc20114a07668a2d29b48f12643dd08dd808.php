
<!--Style Css-->
<link href="<?php echo e(asset('assets/css/mystyle.css')); ?>" rel="stylesheet">
<?php $__env->startSection('content'); ?>

    <!--header section start-->
    <!--<section style="background-image: url('<?php echo e(asset('assets/images')); ?>/<?php echo e($basic->breadcrumb); ?>')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><?php echo e($page_title); ?></h1>
                </div>
            </div>
        </div>
    </section>--><!--Header section end-->


    <!--login section start-->
    <div class="login-section section-padding login-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="main-login main-center">
                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" class="formlogo" alt="Logo Image Will Be Here"></a>
                        <br>
                        <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $error; ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
						<form class="form-horizontal myform" method="POST" action="<?php echo e(route('register')); ?>">
                            <div align="center" class="signup-form__title"><span class="blue" style="color: #30a2f3;">Sign up</span> for a free account!</div>
							<?php echo e(csrf_field()); ?>

                            <?php if($reference == '0'): ?>
                            <div class="form-group" style="display:none;">
                                <label for="name" class="cols-sm-2 control-label">Reference ID</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="under_reference" id="under_reference" value="<?php if($reference): ?><?php echo e($reference); ?><?php endif; ?>" placeholder="Reference ID"/>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                                <input type="hidden" class="form-control" name="under_reference" id="under_reference" value="<?php if($reference): ?><?php echo e($reference); ?><?php endif; ?>" placeholder="Reference ID"/>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="name" id="name" required placeholder="Enter your Name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="username" id="username" required placeholder="Enter your Username"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="email" id="email" required placeholder="Enter your Email"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Phone</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="phone" id="phone" required placeholder="Enter your Phone Number"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>-->
                                        <input type="password" class="form-control md-input__input" name="password" id="password" required placeholder="Enter your Password"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>-->
                                        <input type="password" class="form-control md-input__input" name="password_confirmation" id="password_confirmation" required placeholder="Confirm your Password"/>
                                    </div>
                                </div>
                            </div>

                            <?php if($basic->google_recap == 1): ?>
                            <div class="form-group">
                                <div class="cols-sm-10">
                                    <?php echo app('captcha')->display(); ?>

                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group ">
                                <button type="submit" class="submit-btn btn btn-lg btn-block login-button">Register</button>
                            </div>
							
							<div class="signup-form__footer" align="center">
							<span>
							<!-- react-text: 147 -->Already have an account?<!-- /react-text --><!-- react-text: 148 --> <!-- /react-text --><a href="<?php echo e(asset('login')); ?>">Sign in</a>
							</span>
							</div>
							
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->
	
	<!--header section start-->
    <section style="background-image: url('<?php echo e(asset('assets/images')); ?>/<?php echo e($basic->breadcrumb); ?>')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1><?php echo e($page_title); ?></h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('.price-quoter').show();
});
</script>
<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>