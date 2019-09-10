
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
                <div class="portlet-body" style="overflow: hidden">
				<?php echo Form::open(['route' => 'submit-proofs','method'=>'post','class'=>'form-horizontal','files'=>true]); ?>

                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Proof Name</strong></label>
                                    <div class="col-sm-12">
                                         <input class="form-control input-lg" name="name" required type="text" placeholder="Proof Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12"><strong>Proof Status</strong></label>
                                    <div class="col-sm-12">
                                      	<select name="status" id="status" class="form-control">
                                            <option value="">----Proof Status----</option>
                                            <option value="1" selected>Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn green-haze btn-block btn-lg">Add Proof</button>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php if(session('success')): ?>
	<script type="text/javascript">
        $(document).ready(function(){
            swal("Success!", "<?php echo e(session('success')); ?>", "success");
        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "<?php echo session('alert'); ?>", "error");
        });
    </script>
<?php endif; ?>

    <script src="<?php echo e(asset('assets/admin/js/bootstrap-toggle.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>