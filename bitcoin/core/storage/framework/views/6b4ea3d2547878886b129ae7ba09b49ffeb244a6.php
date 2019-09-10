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
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-<?php echo e(session()->get('type')); ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session()->has('status')): ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo e(session()->get('status')); ?>

                            </div>
                        <?php endif; ?>
                        <form class="form-horizontal myform" method="POST" action="<?php echo e(route('login')); ?>">
							<div align="center" class="signup-form__title">Welcome back!</div>
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">User Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>-->
                                        <input type="text" class="form-control md-input__input" name="username" id="username" required placeholder="Enter your User Name"/>
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
                                <div class="cols-sm-10 cols-sm-offset-2">
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            <label style="font-size: 13px;">
                                                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a class="btn btn-link" style="font-size: 13px;" href="<?php echo e(route('password.request')); ?>">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="submit-btn btn btn-block">Login</button>
                            </div>
							
							<div class="signup-form__footer" align="center">
							<span>
							Don't have an account?<a href="<?php echo e(asset('register')); ?>"> Sign Up</a>
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