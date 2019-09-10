<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

     <div class="content-body">      <div class="row"> 
    <div class="col-12 col-md-10">
        <section class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2 col-12">
                                <img src="<?php echo e(asset('assets/images')); ?>/<?php echo e($user->image); ?>" class="rounded-circle height-100" alt="<?php echo e($user->name); ?>" />
                            </div>
                            <div class="col-md-10 col-12">
                                <div class="row">
									<?php echo Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal form-user-profile row mt-2','files'=>true]); ?>

                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                            
                            			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            			<div>
                                        <span class="btn btn-info btn-file">
                                            <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                            <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                		<a href="javascript:;" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                            			</div>
                        			</div>
<!--                                    <div class="col-12 col-md-4">
                                        <p class="text-bold-700 text-uppercase mb-0">Transactions</p>
                                        <p class="mb-0">12/14</p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="text-bold-700 text-uppercase mb-0">Last login</p>
                                        <p class="mb-0">2018-04-30 16:44:04</p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="text-bold-700 text-uppercase mb-0">IP</p>
                                        <p class="mb-0">43.228.229.172</p>
                                    </div>
-->                                </div>
                                <hr/>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo e($user->name); ?>" required>
                                            <label for="first-name">First name</label>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo e($user->username); ?>" required>
                                            <label for="user-name">User name</label>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" name="email" id="email" value="<?php echo e($user->email); ?>" required>
                                            <label for="email-address">Email</label>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo e($user->phone); ?>" required>
                                            <label for="phone">Phone</label>
                                        </fieldset>
                                    </div>

                                    <!--<div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="password" class="form-control" id="old_password" name="old_password">
                                            <label for="old-password">Old password</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                            <label for="new-password">New password</label>
                                        </fieldset>
                                    </div>-->
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary my-1">Save</button>
                                    </div>
                                </form>
                                <h5>Referral Link</h5>
                                <hr/>
                                <form class="form-horizontal form-referral-link row mt-2" action="">
                                    <div class="col-12">
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" id="referral-link" value="<?php echo e(route('auth.reference-register',Auth::user()->username)); ?>" required="" autofocus>
                                            <label for="first-name">Referral link</label>
                                        </fieldset>
                                    </div>
                                </form>
                                <p>Share your promo code, and get a 10 CFA bonus for each verified referral.</p>
                                <!--<h5 class="mt-3">Security</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-9">
                                        <p>Two-factor authorization</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" id="switcherySize2" class="switchery" data-size="sm" checked/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                        <p>Login notification</p>
                                    </div>
                                    <div class="col-3">
                                        <input type="checkbox" id="switcherySize2" class="switchery" data-size="sm" />
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
        </div>
    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <?php if(session('message')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Success!", "<?php echo e(session('message')); ?>", "success");

            });

        </script>

    <?php endif; ?>



    <?php if(session('alert')): ?>

        <script type="text/javascript">

            $(document).ready(function(){

                swal("Sorry!", "<?php echo session('alert'); ?>", "error");

            });

        </script>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>