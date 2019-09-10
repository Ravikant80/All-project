
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page_title" style="text-align: -webkit-center;"><?php echo $page_title; ?></h3>
                <hr>
            </div>
        </div>
        
        <div class="row">
            <div id="recent-transactions" class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">

                                <thead>
                                    <tr>
                                        <th>ID#</th>
                                        <th>Date</th>
                                        <th>Transaction ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                       <!-- <th>Post Balance</th>-->
                                        <th>Details</th>
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
                                        <td>
                                            <?php if($p->amount_type == 1): ?>
                                                <span class="label bold label-primary"><i class="fa fa-cloud-download"></i> Deposit</span>
                                            <?php elseif($p->amount_type == 2): ?>
                                                <span class="label bold label-danger"><i class="fa fa-minus"></i> Active</span>
                                            <?php elseif($p->amount_type == 3): ?>
                                                <span class="label bold label-success"><i class="fa fa-plus"></i> Reference</span>
                                            <?php elseif($p->amount_type == 4): ?>
                                                <span class="label bold label-success"><i class="fa fa-exchange"></i> Repeat</span>
                                            <?php elseif($p->amount_type == 5): ?>
                                                <span class="label bold label-primary"><i class="fa fa-cloud-upload"></i> Withdraw</span>
                                            <?php elseif($p->amount_type == 6): ?>
                                                <span class="label bold label-warning"><i class="fa fa-cloud-download"></i> Refund</span>
                                            <?php elseif($p->amount_type == 8): ?>
                                                <span class="label bold label-success"><i class="fa fa-plus"></i> Add </span>
                                            <?php elseif($p->amount_type == 9): ?>
                                                <span class="label bold label-danger"><i class="fa fa-minus"></i> Convert </span>
                                            <?php elseif($p->amount_type == 10): ?>
                                                <span class="label bold label-danger"><i class="fa fa-bolt"></i> Charge </span>
                                            <?php elseif($p->amount_type == 15): ?>
                                                <span class="label bold label-success"><i class="fa fa-recycle"></i> Cash-in </span>
                                            <?php elseif($p->amount_type == 14): ?>
                                                <span class="label bold label-success"><i class="fa fa-cloud-upload"></i> Cash-out </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($p->amount); ?> - <?php echo e($basic->symbol); ?>

                                        </td>
                                       <!-- <td>
                                            <?php echo e($p->post_bal); ?> - <?php echo e($basic->symbol); ?>

                                        </td>-->
                                        <td>
                                            <?php echo e($p->description); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                                </tbody>
                    		</table>
                    	</div>
                	</div>
            	</div>
        	</div>
     	</div>
        
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>