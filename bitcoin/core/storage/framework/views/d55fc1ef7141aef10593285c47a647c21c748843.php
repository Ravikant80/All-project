<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin | Log In</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/uniform.default.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/components-rounded.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/plugins.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/css/login.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END STYLES -->

    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" />

</head>

<body class=" login">
<div class="menu-toggler sidebar-toggler"></div>
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="#"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="-" style="max-width: 150px"/> </a>
</div>
<!-- END LOGO -->





<div class="content">
    <?php echo Form::open(['route'=>'admin.login.post','class'=>'login-form']); ?>

    <h3 class="form-title font-green">Admin Log In</h3>

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter User Name and password. </span>
    </div>

    <?php if(session()->has('message')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $error; ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">User Name :</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" value="<?php echo e(old('username')); ?>" autocomplete="off" placeholder="User Name" name="username" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
    <div class="form-actions">
        <?php echo csrf_field(); ?>

        <button type="submit" class="btn green uppercase btn-block"><i class="fa fa-sign-in"></i> Login</button>
    </div>


<?php echo Form::close(); ?>

<!-- END LOGIN FORM -->

</div>
<div class="copyright"><?php echo date("Y");?> &copy; All Copyright Reserved.</div>

<!-- BEGIN SCRIPTS -->
<script src="<?php echo e(asset('assets/admin/js/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/js.cookie.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/bootstrap-hover-dropdown.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/jquery.blockui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/additional-methods.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/app.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/js/login.min.js')); ?>" type="text/javascript"></script>
<!-- END SCRIPTS -->

</body>
</html>
