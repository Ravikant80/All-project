<?php $__env->startSection('style'); ?>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">

            <div class="row">

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bookmark"></i>Short Code</div>

                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> CODE </th>
                                        <th> DESCRIPTION </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr>
                                        <td> 1 </td>
                                        <td> <pre>{{message}}</pre> </td>
                                        <td> Details Text From Script</td>
                                    </tr>

                                    <tr>
                                        <td> 2 </td>
                                        <td> <pre>{{number}}</pre> </td>
                                        <td> Destination Number</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>

                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">

                        <div class="portlet-body form">
                            <form class="form-horizontal" action="<?php echo e(route('sms-setting')); ?>" method="post" role="form">
                                <?php echo csrf_field(); ?>

                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="col-md-12"><strong>SMS API</strong><br></label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="3" name="smsapi" placeholder="https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=E-Wallet&SMSText={{message}}&GSM={{number}}&type=longSMS"><?php echo $basic->smsapi; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn blue btn-block btn-lg">UPDATE</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>