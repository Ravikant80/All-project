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
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Id Proof</th>
                        <th>Id Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i=0;?>
                    <?php $__currentLoopData = $idproofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++;?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($p->user->name); ?></td>
                            <td><?php echo e($p->id_type); ?></td>
                            <td><?php echo e($p->id_number); ?></td>
                            <td>
                                <?php if($p->status == 1): ?>
                                    <span class="label label-primary  bold uppercase"><i class="fa fa-check"></i> Approved</span>
                                <?php elseif($p->status == 2): ?>
                                    <span class="label label-danger  bold uppercase"><i class="fa fa-times"></i> Canceled</span>
                                <?php elseif($p->status == 3): ?>
                                    <span class="label label-warning  bold uppercase"><i class="fa fa-spinner"></i> Pending</span>
                                <?php endif; ?>
                            </td>
                            <td><a href="<?php echo e(route('identity-verify',$p->id)); ?>" class="btn btn-primary btn-sm bold uppercase"><i class="fa fa-eye"></i> View</a></td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
                
            </div>
        </div>

    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>