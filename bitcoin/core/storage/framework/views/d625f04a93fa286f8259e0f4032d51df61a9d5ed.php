

<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-bank"></i> <?php echo e($page_title); ?></strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">

                    <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-sm-3 text-center">
                            <div class="panel panel-primary panel-pricing">
                                <div class="panel-heading">
                                    <h3 style="font-size: 28px;"><b><?php echo e($p->name); ?></b></h3>
                                </div>
                                <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                    <img class="" style="width: 35%;border-radius: 5px" src="<?php echo e(asset('assets/images')); ?>/<?php echo e($p->image); ?>" alt="">
                                </div>
                                <ul style='font-size: 15px;' class="list-group text-center bold">
                                    <li class="list-group-item">Minimum - <?php echo $p->withdraw_min; ?> <?php echo e($basic->currency); ?> </li>
                                    <li class="list-group-item">Maximum - <?php echo $p->withdraw_max; ?> <?php echo e($basic->currency); ?> </li>
                                    <li class="list-group-item"> Fix Charge - <?php echo e($p->fix); ?> <?php echo e($basic->currency); ?></li>
                                    <li class="list-group-item"> Percentage - <?php echo e($p->percent); ?><i class="fa fa-percent"></i></li>
                                    <li class="list-group-item">Processing Time - <?php echo $p->duration; ?> Days </li>
                                    <li class="list-group-item"><span class="aaaa"><?php echo e($p->status == 1 ? "Active" : 'DeActive'); ?></span></li>
                                </ul>
                                <div class="panel-footer" style="overflow: hidden">
                                    <div class="col-sm-12">
                                        <a class="btn btn-block btn-primary bold uppercase" href="<?php echo e(route('withdraw-edit',$p->id)); ?>"><i class="fa fa-edit"></i> EDIT</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>