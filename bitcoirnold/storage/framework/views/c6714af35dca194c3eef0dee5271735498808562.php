
<?php $__env->startSection('content'); ?>




        <div class="row">
            <div class="col-md-12">


                <div class="portlet box green-haze">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Proof Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i=0;?>
                            <?php $__currentLoopData = $identityproof; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++;?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($p->name); ?></td>
                                    <td>
                                        <?php if($p->status == 1): ?>
                                            <span class="badge badge-primary  bold uppercase"><i class="fa fa-check"></i>Active</span> 
                                        <?php else: ?>
                                            <span class="badge badge-warning  bold uppercase"><i class="fa fa-spinner"></i>In Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="<?php echo e(route('update-proof',$p->id)); ?>" data-container="body" data-placement="top" data-original-title="Edit" class="btn btn-info btn-sm bold tooltips"><i class="fa fa-edit"></i></a></td>

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