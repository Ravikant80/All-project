<?php $__env->startSection('style'); ?>

    <link href="<?php echo e(asset('assets/admin/css/bootstrap-toggle.min.css')); ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <strong><?php echo e($page_title); ?></strong>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">


                    <?php echo Form::model($basic,['route'=>['basic-update',$basic->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]); ?>

                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Website Title</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="title" value="<?php echo e($basic->title); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-file-text-o"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Website Color </strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="color" style="background: #<?php echo e($basic->color); ?>" class="form-control bold input-lg" value="<?php echo e($basic->color); ?>" required>
                                            <span class="input-group-addon"><i class="fa fa-tint"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Website Started Date </strong></label>
                                    <div class="col-md-12">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type="text" name="start_date" class="form-control bold input-lg" value="<?php echo e($basic->start_date); ?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BASE CURRENCY</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="currency" value="<?php echo e($basic->currency); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-money"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">currency SYMBOL</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="symbol" value="<?php echo e($basic->symbol); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-exclamation-circle"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">DECIMAL AFTER POINT</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="deci" value="<?php echo e($basic->deci); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-arrows-h"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">User Registration</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->user_reg == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="user_reg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Email Verification</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->email_verify == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="email_verify">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Phone Verification</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->phone_verify == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="phone_verify">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Withdraw Status</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->withdraw_status == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="withdraw_status">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Email Notification</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->email_notify == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="email_notify">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Phone Notification</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->phone_notify == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="phone_notify">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Investment Repeat Status</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->repeat_status == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="repeat_status">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Reference BonUS</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="reference_bonus" value="<?php echo e($basic->reference_bonus); ?>" type="text" required>
                                            <span class="input-group-addon"><strong>CFA</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Reference Deposit BonUS</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="reference_percent" value="<?php echo e($basic->reference_percent); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-percent"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Cash In Commission</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="cashin_commission" value="<?php echo e($basic->cashin_commission); ?>" type="text" required>
                                            <span class="input-group-addon"><strong>CFA</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Cash Out Commission</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="cashout_commission" value="<?php echo e($basic->cashout_commission); ?>" type="text" required>
                                            <span class="input-group-addon"><strong>CFA</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Exchange Commission</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="exchange_commission" value="<?php echo e($basic->exchange_commission); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-money"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Withdraw Commission</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="withdraw_commission" value="<?php echo e($basic->withdraw_commission); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-money"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BTC BUY COMMISSION</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="btc_buy_commision" value="<?php echo e($basic->btc_buy_commision); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><?php echo e($basic->currency); ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">BTC SELL COMMISSION</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="btc_sell_commision" value="<?php echo e($basic->btc_sell_commision); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><?php echo e($basic->currency); ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Google reCaptcha Verification</strong></label>
                                    <div class="col-md-12">
                                        <input data-toggle="toggle" <?php echo e($basic->google_recap == '1' ? 'checked' : ''); ?> data-onstyle="success" data-offstyle="danger" data-width="100%" data-size="large" type="checkbox" name="google_recap">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Google reCaptcha Site Key</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="google_site_key" value="<?php echo e($basic->google_site_key); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-key"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Google reCaptcha Secret Key</strong></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control bold input-lg" name="google_secret_key" value="<?php echo e($basic->google_secret_key); ?>" type="text" required>
                                            <span class="input-group-addon"><strong><i class="fa fa-key"></i></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br> <br>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn blue btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                            </div>
                        </div>
                        <br>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div><!---ROW-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>


    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "<?php echo session('alert'); ?>", "error");

            });

        </script>

    <?php endif; ?>


    <script src="<?php echo e(asset('assets/admin/js/bootstrap-toggle.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD hh:mm:ss'
            });
        });
    </script>

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>