
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Main Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <div class="col-md-3">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e(round($user_balance, $basic->deci)); ?>">0</span>
                                        </div>
                                        <div class="desc bold uppercase"> Total User Balance</div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?php echo e(route('repeat-history')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e($total_repeat); ?>">0</span>
                                            </div>
                                            <div class="desc  bold uppercase "> Total Repeat </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(route('user-deposit-history')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo e($basic->symbol); ?>  <span data-counter="counterup" data-value="<?php echo e($total_deposit); ?>">0</span>
                                            </div>
                                            <div class="desc  bold uppercase"> Total Deposit </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/withdraw-request-all')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e($total_withdraw); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Withdraw </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-handshake-o"></i> Support Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="<?php echo e(url('admin/admin-support')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-envelope-open"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_ticket); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase small14"> Total Open Support Ticket</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/admin-support-pending')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat yellow">
                                        <div class="visual">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_pending_ticket); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Pending Support Ticket </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/admin-support')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat green">
                                        <div class="visual">
                                            <i class="fa fa-reply-all"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_answer); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase small13"> Total Answer Support Ticket </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/admin-support')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_close); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase small13"> Total Close Support Ticket  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-users"></i> User Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="<?php echo e(url('admin/manage-user')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_user); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total User </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/show-block-user')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($block_user); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Block User </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/email-unverified-user')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-envelope-open"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($email_verify); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Email Unverified  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo e(url('admin/phone-unverified-user')); ?>">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($phone_verify); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Phone Unverified  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-cloud-download"></i> Deposit Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($deposit_method); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Deposit Method </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($deposit_number); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Number of Deposits </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e($total_deposit); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deposit </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-3">
                                    <div class="dashboard-stat yellow">
                                        <div class="visual">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($deposit_pending); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deposit Pending</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-th"></i> Investment Plan Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="">
                                <div class="col-md-4">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($total_plan); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-4">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($active_plan); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Active Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="">
                                <div class="col-md-4">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($deactive_plan); ?>">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deactivate Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-cloud-upload"></i> Withdraw Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">

                            <div class="row">
                                <a href="">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat purple">
                                            <div class="visual">
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="<?php echo e($withdraw_method); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Method </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat blue">
                                            <div class="visual">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e($total_withdraw); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Amount </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat red">
                                            <div class="visual">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <?php echo e($basic->symbol); ?> <span data-counter="counterup" data-value="<?php echo e($withdraw_charge); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Charge </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <br>
                            <div class="row">
                                <a href="">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat purple">
                                            <div class="visual">
                                                <i class="fa fa-sort-asc"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="<?php echo e($withdraw_number); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Number of Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="">

                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
                                            <div class="visual">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="<?php echo e($withdraw_success); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Success Withdraw </div>
                                            </div>
                                        </div>
                                    </div></a>
                                <a href="">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat yellow">
                                            <div class="visual">
                                                <i class="fa fa-spinner"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="<?php echo e($withdraw_pending); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Pending Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat red">
                                            <div class="visual">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="<?php echo e($withdraw_refund); ?>">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Refunded Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('assets/admin/js/jquery.waypoints.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/admin/js/jquery.counterup.min.js')); ?>" type="text/javascript"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>