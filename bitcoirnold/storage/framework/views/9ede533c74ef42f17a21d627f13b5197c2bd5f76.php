
<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">


            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">

                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>User Name</th>
                            <th>Withdraw Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i=0;?>
                        <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++;?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e(date('d-F-Y h:i A',strtotime($p->created_at))); ?></td>
                                <td><?php echo e($p->transaction_id); ?></td>
                                <td><?php echo e($p->user->username); ?></td>
                                <td><?php echo e($p->amount); ?> - <?php echo e($basic->symbol); ?></td>
                                <td>
                                    <?php if($p->status == 3 ): ?>
                                        <span class="label label-warning bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                    <?php elseif($p->status == 1): ?>
                                        <span class="label label-success bold uppercase"><i class="fa fa-check"></i> Complete</span>
                                    <?php elseif($p->status == 2): ?>
                                        <span class="label label-danger bold uppercase"><i class="fa fa-times"></i> Refund</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('single-withdraw-view',$p->id)); ?>" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-eye"></i> View</a>
                                   
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
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
                    <strong>Are you sure you want to Confirm This Withdraw..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('withdraw-confirm')); ?>" class="form-inline">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" class="abir_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes I'm Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-exclamation-triangle'></i><strong>Confirmation..!</strong> </h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Refund This Withdraw..?</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('withdraw-refund')); ?>" class="form-inline">
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
<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>
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