
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
                            <th>Deposit Date</th>
                            <th>Transaction ID</th>
                            <th>Deposit Method</th>
                            <th>Send Amount</th>
                            <th>Deposit Charge</th>
                            <th>Deposit Balance</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i=0;?>
                        <?php $__currentLoopData = $deposit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++;?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e(date('d-F-Y h:i A',strtotime($p->created_at))); ?></td>
                                <td><?php echo e($p->transaction_id); ?></td>
                                <td>
                                    <?php if($p->payment_type == 1): ?>
                                        <span class="label bold label-primary"><i class="fa fa-paypal"></i> Paypal</span>
                                    <?php elseif($p->payment_type == 2): ?>
                                        <span class="label bold label-primary"><i class="fa fa-money"></i> Perfect Money</span>
                                    <?php elseif($p->payment_type == 3): ?>
                                        <span class="label bold label-primary"><i class="fa fa-btc"></i> BTC - BlockChain</span>
                                    <?php elseif($p->payment_type == 4): ?>
                                        <span class="label bold label-primary"><i class="fa fa-credit-card"></i> Credit Card</span>
                                    <?php else: ?>
                                        <span class="label bold label-primary"><i class="fa fa-bank"></i> <?php echo e($p->bank->name); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4): ?>
                                        <?php echo e($p->net_amount); ?> - USD
                                    <?php else: ?>
                                        <?php echo e($p->net_amount); ?> - <?php echo e($basic->currency); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4): ?>
                                        <?php echo e($p->charge); ?> - USD
                                    <?php else: ?>
                                        <?php echo e($p->charge); ?> - <?php echo e($basic->currency); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($p->payment_type == 1 or $p->payment_type == 2 or $p->payment_type == 3 or $p->payment_type == 4): ?>
                                        <?php echo e($p->amount); ?> - <?php echo e($basic->currency); ?>

                                    <?php else: ?>
                                        <?php echo e($p->amount); ?> - <?php echo e($basic->currency); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($p->status == 1): ?>
                                        <span class="label bold label-primary"><i class="fa fa-check"></i> Completed</span>
                                    <?php elseif($p->status == 0): ?>
                                        <span class="label bold label-warning"><i class="fa fa-spinner"></i> Pending</span>
                                    <?php elseif($p->status == 2): ?>
                                        <span class="label bold label-danger"><i class="fa fa-times"></i> Cancel</span>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- ROW-->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>