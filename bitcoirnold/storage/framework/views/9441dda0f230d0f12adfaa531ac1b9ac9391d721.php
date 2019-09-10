
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

    <div class="map">
        <?php echo $basic->google_map; ?>

    </div><!--Map section end-->
    <!--Contact Form Start-->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="contact-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <h2 class="title">Send Your Message</h2>
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
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo e(session()->get('message')); ?>

                                    </div>
                                <?php endif; ?>
                                <br>
                                <form action="<?php echo e(route('contact-submit')); ?>" method="post">
                                    <?php echo csrf_field(); ?>

                                    <input type="text" class="name" name="name" required placeholder="Name">
                                    <input type="email" class="email" name="email" required placeholder="Email">
                                    <br>
                                    <br>
                                    <input type="text" class="name" name="subject" required placeholder="Subject">
                                    <input type="text" class="email" name="phone" required placeholder="Phone Number">
                                    <textarea name="message" id="message" cols="30" rows="10" required placeholder="Message"></textarea>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Send Message Now!">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Contact Form end-->
    <!--get in touch section start-->
    <section class="get-in-touch section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Get In Touch</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 ">
                    <div class="single-shape-box">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Call Us</h4>
                            <p><?php echo e($basic->phone); ?> </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="single-shape-box">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Address </h4>
                            <p><?php echo e($basic->address); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="single-shape-box">
                        <div class="get-in-tuch-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="get-in-touch-text">
                            <h4>Email</h4>
                            <p><?php echo e($basic->email); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>