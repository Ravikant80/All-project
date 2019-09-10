
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

    <!--about us page content start-->
    <section class="section-padding about-us-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <?php echo $basic->about; ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>