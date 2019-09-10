<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body" style="overflow: hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center bold">
                            	<table class="table table-bordered">
                                	<tr>
                                    	<th>Request User</th>
                                        <td style="text-align:justify;"><h5><?php echo e($deposit->sellmembers->name); ?></h5></td>
                                    </tr>
                                   
                                    <tr>
                                    	<th>Btc  Amount</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($deposit->btc_amount); ?></h5></td>
                                    </tr>
                                   
                                   
                                    <tr>
                                    	<th>User Get CFA Values</th>
                                    	<td style="text-align:justify;"><h5><?php echo e($deposit->cfa_amount); ?></h5></td>
                                    </tr>
                                    <tr>
                                    	<th>Status</th>
                                        <td style="text-align:justify;">
                                        	<?php if($deposit->status == 1 ): ?>
                                        		<span class="label label-success bold uppercase"><i class="fa fa-spinner"></i>Completed </span>
                                    		<?php elseif($deposit->status == 2): ?>
                                        		<span class="label label-danger  bold uppercase"><i class="fa fa-times"></i> Cancel</span>
                                                 <?php else: ?>
                                        		<span class="label label-warning bold uppercase"><i class="fa fa-times"></i> Pending</span>
                                    		<?php endif; ?>
                                        </td>
                                    </tr>
                                </table>                               
                                <br>
                                <?php if($deposit->status == 0 ): ?>
                                <hr>
                                <div class="col-md-3 col-md-offset-3">
                                    <button type="button" class="btn green-haze bold uppercase btn-block delete_button"
                                            data-toggle="modal" data-target="#DelModal"
                                            data-id="<?php echo e($deposit->buybitcoinId); ?>">
                                        <i class='fa fa-check'></i> Approve 
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn purple bold uppercase btn-block refund_button"
                                            data-toggle="modal" data-target="#cancelModal"
                                            data-id="<?php echo e($deposit->buybitcoinId); ?>">
                                        <i class='fa fa-times'></i> Reject
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Message : </h3><br>
                            <?php echo $deposit->message; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Confirm This Cash-in..?</strong>
                </div>
                <div class="modal-footer">

                    <form method="post" action="<?php echo e(url('admin/sellcoin-confirm/'.$deposit->buybitcoinId)); ?>" class="form-inline">
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
                    <strong>Are you sure you want to Refund This Cash-in..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(url('admin/sellcoin-reject/'.$deposit->buybitcoinId)); ?>" class="form-inline">
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


<?php $__env->startSection('scripts'); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>