
<?php $__env->startSection('title', 'Slider'); ?>
<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject font-green bold uppercase">Slider Settings</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addslide">
                            <i class="icon-plus"></i> New Slide
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Slide <?php echo e($slider->id); ?></div>
                                    <div class="panel-body">
                                        <img src="<?php echo e(asset('assets/images/slider')); ?>/<?php echo e($slider->image); ?>" class="img-responsive">
                                        <h3>
                                            <?php echo e($slider->title); ?>

                                        </h3>
                                        <p>
                                            <?php echo e($slider->subtitle); ?>

                                        </p>
                                    </div>
                                    <div class="panel-footer">
                                        <a class="btn btn-circle btn-warning" data-toggle="modal" data-target="#editslide<?php echo e($slider->id); ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a class="btn btn-circle btn-danger"  href="<?php echo e(route('slider.destroy', $slider)); ?>" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Slide?">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Slide -->
                            <div id="editslide<?php echo e($slider->id); ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Slide <?php echo e($slider->id); ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="<?php echo e(route('slider.update',$slider->id)); ?>" enctype="multipart/form-data">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('put')); ?>

                                                <div class="form-group">
                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Image </span>
                                                <input type="file" name="image" class="form-control input-lg">
                                            </span>
                                                    <span class="btn-danger">Standard Image Size: 1440 x 750 px</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo e($slider->title); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subtitle">Subtitle</label>
                                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo e($slider->subtitle); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-success" >Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Slide -->
    <div id="addslide" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Slide</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="<?php echo e(route('slider.store')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                        <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Upload Image </span>
                                                <input type="file" name="image" class="form-control input-lg">
                                            </span>
                            <span class="btn-danger">Standard Image Size: 1440 x 750 px</span>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" >
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success" >Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);

            });

        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>