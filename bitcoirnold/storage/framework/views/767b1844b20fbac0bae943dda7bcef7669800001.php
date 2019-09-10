
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

    <!--faq page content start-->
    <section class="section-padding padding-top-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion-option">
                        <h3 class="title">General Questions</h3>

                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne<?php echo e($f->id); ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#generalOne<?php echo e($f->id); ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo e($f->title); ?>

                                    </a>
                                </h4>
                            </div>
                            <div id="generalOne<?php echo e($f->id); ?>" class="panel-collapse collapse <?php echo e($key == 0 ? 'in' : ''); ?>" role="tabpanel" aria-labelledby="headingOne<?php echo e($f->id); ?>">
                                <div class="panel-body">
                                    <?php echo $f->description; ?>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center">
                            <?php echo $faqs->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>