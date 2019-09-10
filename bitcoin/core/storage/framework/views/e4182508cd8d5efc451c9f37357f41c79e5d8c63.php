<?php $__env->startSection('style'); ?>

    <link href="<?php echo e(asset('assets/admin/css/bootstrap-toggle.min.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><i class="fa fa-info-circle"></i> <?php echo e($page_title); ?></strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">


                    <?php echo Form::model($basic,['route'=>['contact-setting-update',$basic->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]); ?>

                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Phone</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="phone" class="form-control bold input-lg" value="<?php echo e($basic->phone); ?>" required>
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Email</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="email" class="form-control bold input-lg" value="<?php echo e($basic->email); ?>" required>
                                            <span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Contact Address</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="address" class="form-control bold input-lg" value="<?php echo e($basic->address); ?>" required>
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Google Map Embedded Code</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="google_map" class="form-control bold input-lg" value="<?php echo e($basic->google_map); ?>" required>
                                            <span class="input-group-addon"><i class="fa fa-golbe"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    <?php echo Form::close(); ?>

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


    <script src="<?php echo e(asset('assets/admin/js/bootstrap-toggle.min.js')); ?>"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>