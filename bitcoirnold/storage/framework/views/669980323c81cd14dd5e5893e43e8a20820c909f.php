<?php $__env->startSection('content'); ?>
<div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form method="POST" action="<?php echo e(url('admin/setcfa-values/'.$cfavalues->usdcfaId)); ?>" accept-charset="UTF-8" role="form" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                        
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">USD</strong></label>
                                    <div class="col-md-12">
                                        <input name="usd_value" class="form-control input-lg"  placeholder="Enter USD Values" required="" value="<?php echo e($cfavalues->usd_value); ?>">
                                    </div>
                                </div>

                             

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">CFA</strong></label>
                                    <div class="col-md-12">
                                        <input name="cfa_value" class="form-control input-lg"  placeholder="Enter CFA Values" required="" value="<?php echo e($cfavalues->cfa_value); ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    </form>
                  

                </div>
            </div>
        </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>