<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">


            <div class="portlet light bordered">
                <div class="portlet-body" style="overflow: hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center bold">
                            	<table class="table table-bordered">
                                	<tr>
                                    	<th>Request User</th>
                                        <td style="text-align:justify;"><h5><?php echo e($idproof->user->name); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Gender</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->gender); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Nationality</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->nationality); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>birthdate</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->birthdate); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Employment Status</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->employment_status); ?></h5></td>
                                    </tr>                                  
                                    <tr>
                                    	<th>Industry Type</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->industry_type); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Job Position</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->job_position); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Company</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->company_name); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>ID Type</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->id_type); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>ID Number</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->id_number); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>ID Expiry Date</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($idproof->expiry_date); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>ID Image</th>
                                    	<td style="text-align:justify;"><img src="<?php echo e(asset('assets/images')); ?>/<?php echo e($idproof->image); ?>" alt="<?php echo e($idproof->image); ?>" /></td>
                                    </tr>
                                    <tr>
                                    	<th>Status</th>
                                        <td style="text-align:justify;">
                                        	<?php if($idproof->proof_status == 1 ): ?>
                                        		<span class="label label-success bold uppercase"><i class="fa fa-spinner"></i>Approved </span>
                                    		<?php elseif($idproof->proof_status == 2): ?>
                                        		<span class="label label-danger bold uppercase"><i class="fa fa-check"></i> Rejected</span>
                                    		<?php elseif($idproof->proof_status == 3): ?>
                                        		<span class="label label-warning bold uppercase"><i class="fa fa-times"></i> Pending</span>
                                    		<?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <?php if($idproof->proof_status == 3): ?>
                                <hr>
                                <div class="col-md-3 col-md-offset-3">
                                    <button type="button" class="btn green-haze bold uppercase btn-block delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="<?php echo e($idproof->id); ?>">
                                        <i class='fa fa-check'></i> Approve Proof
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn purple bold uppercase btn-block refund_button"
                                            data-toggle="modal" data-target="#cancelModal"
                                            data-id="<?php echo e($idproof->id); ?>">
                                        <i class='fa fa-times'></i> Reject Proof
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>

        </div>
    </div>
    
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Confirm This Proof..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('identity-confirm')); ?>" class="form-inline">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Rejetc this Proof..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('identity-reject')); ?>" class="form-inline">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>
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
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });

    </script>
<?php endif; ?>

<script>
	$(document).ready(function () {

		$(document).on("click", '.delete_button', function (e) {
			var id = $(this).data('id');
			$(".abir_id").val(id);

		});

	});
	$(document).ready(function () {

		$(document).on("click", '.refund_button', function (e) {
			var id = $(this).data('id');
			$(".abir_id").val(id);

		});

	});
</script>


<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>