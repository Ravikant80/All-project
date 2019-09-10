<?php $__env->startSection('content'); ?>

    <?php if(count($user)): ?>

        <div class="row">
            <div class="col-md-12">


                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="">

                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Register At</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i=0;?>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++;?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($p->created_at)->format('d F Y h:i A')); ?></td>
                                    <td><?php echo e($p->name); ?></td>
                                    <td><?php echo e($p->username); ?></td>
                                    <td><?php echo e($p->email); ?></td>
                                    <td><?php echo e($p->phone); ?></td>
                                    <td>
                                        <?php echo e($p->balance); ?> - <?php echo e($basic->currency); ?>

                                    </td>
                                    <td>
                                        <?php if($p->status == 0): ?>
                                            <button type="button" class="btn btn-danger bold uppercase btn-sm block_button"
                                                    data-toggle="modal" data-target="#blockModal"
                                                    data-id="<?php echo e($p->id); ?>">
                                                <i class='fa fa-times'></i> Block User
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-primary bold uppercase btn-sm block_button"
                                                    data-toggle="modal" data-target="#unblockModal"
                                                    data-id="<?php echo e($p->id); ?>">
                                                <i class='fa fa-check'></i> Unblock User
                                            </button>
                                        <?php endif; ?>
                                            <a href="<?php echo e(route('user-details',$p->id)); ?>" class="btn  bold uppercase btn-success btn-sm"><i class="fa fa-eye"></i> View Details</a>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                        <div class="text-center">
                            <?php echo $user->links(); ?>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- ROW-->

    <?php else: ?>

        <div class="text-center">
            <h3>No User Found</h3>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-times'></i> Block User!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Block this user ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('block-user')); ?>" class="form-inline">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="unblockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> <i class='fa fa-check'></i> Unblock User!</h4>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Unblock this user ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="<?php echo e(route('unblock-user')); ?>" class="form-inline">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes Sure..!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "<?php echo session('alert'); ?>", "error");

            });

        </script>

    <?php endif; ?>


    <script>
        $(document).ready(function () {

            $(document).on("click", '.block_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
        $(document).ready(function () {

            $(document).on("click", '.unblock_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>