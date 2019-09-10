

<?php $__env->startSection('style'); ?>
    <style>
        input[type="tel"],
        input[type="url"],
        input[type="password"] {
            width: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    <form class="form-horizontal" action="<?php echo e(asset('/user/change-password')); ?>" method="post" name="change-password" id="change-password" role="form">
                        <div class="form-body">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Current Password</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="current_password"
                                           placeholder="Current Password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>New Password</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="password" placeholder="New Password"
                                           type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>New Password Again</strong></label>

                                <div class="col-md-6">
                                    <input class="form-control input-lg" name="password_confirmation"
                                           placeholder="New Password Again" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg bold">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!---ROW-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(session('message')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Success!", "<?php echo e(session('message')); ?>", "success");

            });

        </script>

    <?php endif; ?>



    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");

            });

        </script>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>