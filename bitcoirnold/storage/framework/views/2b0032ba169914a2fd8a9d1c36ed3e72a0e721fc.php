
<?php $__env->startSection('content'); ?>

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


    <!--login section start-->
    <div class="login-section section-padding login-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="main-login main-center">
                        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo Image Will Be Here"></a>
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

                        <form class="form-horizontal" method="POST" action="<?php echo e(route('email-verify-submit')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <h4 class="block">Email Verification Code:</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key fa-2x"></i></span>
                                <input name="code" id="code" class="form-control input-lg" placeholder="Verification Code" type="text" required="">
                            </div>
                            <br>
                            <button class="btn btn-success btn-lg btn-block" type="submit" id="btn-login">Verify Now</button>

                        </form>
                        <form style="margin-top: 10px;" class="form-horizontal" method="POST" action="<?php echo e(route('resend-verify-submit')); ?>">
                            <?php echo csrf_field(); ?>


                            <div class="form-group">
                                <div class="col-md-12 margin-top-10">
                                    <button type="submit" class="btn btn-block btn-danger">
                                        Resend Email for Verification
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>