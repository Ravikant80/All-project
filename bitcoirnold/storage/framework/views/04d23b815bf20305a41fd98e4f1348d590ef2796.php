
<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('assets/admin/css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase"><?php echo e($page_title); ?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Present Logo</div>
                                <div class="panel-body">
                                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" class="img-responsive" width="50%" height="50">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Present Icon</div>
                                <div class="panel-body">
                                    <img src="<?php echo e(asset('assets/images/favicon.png')); ?>" class="img-responsive" width="50%" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form role="form" method="POST" action="<?php echo e(route('manage-logo')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                            <span> Upload New Logo </span>
                                            <input type="file" name="logo" class="form-control input-lg"> </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload New Icon </span>
                                                <input type="file" name="favicon" class="form-control input-lg">
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right col-md-12">
                                <button type="submit" class="btn blue btn-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div><!---ROW-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "<?php echo session('alert'); ?>", "error");

            });

        </script>

    <?php endif; ?>

    <script src="<?php echo e(asset('assets/admin/js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>