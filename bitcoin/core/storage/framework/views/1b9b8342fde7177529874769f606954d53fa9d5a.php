<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-12">

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <button id="btn_add" name="btn_add" class="btn btn-primary pull-right bold"><i class="fa fa-plus"></i> Add News</button>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">


                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Headlines</th>
                            <th>Story</th>
                            <th>Image</th>
                            <th>Video</th>
                            <th>Links</th>
                            <th>Actions</th>
                        </tr>
                        </thead>              
                        <tbody id="news-list" name="news-list">
                        <?php $__currentLoopData = $newsdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="news<?php echo e($news->news_id); ?>">
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($news->headlines); ?></td>
                                <td><?php echo e($news->story); ?></td>
                               
                                <?php if($news->image != null): ?>
                                <td><img src="<?php echo e(url('assets/images/news/'.$news->image)); ?>" height="50px" width="50px"></td>
                                <?php else: ?>
                                <td>No Image For this News</td>
                                <?php endif; ?>
                                <?php if($news->video != null): ?>
                                <td><video width="50px" height="50px" controls>
                                     <source src="<?php echo e(url('assets/images/news/'.$news->video)); ?>" type="video/mp4">
                                           Your browser does not support the video tag.
                                    </video>
                                </td>
                                 <?php else: ?>
                                <td>No Video For this News</td>
                                <?php endif; ?>
                                <?php if($news->otherlinks != null): ?>
                                <td><a href="<?php echo e($news->otherlinks); ?>">Link</td>
                                 <?php else: ?>
                                <td>No Other Links For this News</td>
                                <?php endif; ?>
                                <td>
                                    
                                    <!-- <a href="<?php echo e(url('admin/news-view/'.$news->news_id)); ?>" class="btn btn-primary btn-detail open_modal bold uppercase"><i class="fa fa-eye-slash"></i> View</a> -->
                                    <button id="newsView" class="btn btn-primary btn-detail  bold uppercase" value="<?php echo e($news->news_id); ?>"><i class="fa fa-eye-slash"></i> View</button>
                                    <button class="btn btn-primary btn-detail open_modal bold uppercase" value="<?php echo e($news->news_id); ?>"><i class="fa fa-edit"></i> EDIT</button>
                                     <a href="<?php echo e(url('admin/delete-news/'.$news->news_id)); ?>" class="btn btn-primary btn-detail open_modal bold uppercase" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
                                
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-list"></i> News Section</h4>
                </div>
                <div class="modal-body">
                    <form id="newsForm" name="newsform" class="form-horizontal" novalidate="" enctype="multipart/form-data" onsubmit="return validation()">
                        
                        <div class="form-group error">
                            <label for="headlines" class="col-sm-3 control-label bold uppercase">Headlines : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="headlines" name="headlines" placeholder="News headlines " value="" required>
                                    <span class="input-group-addon" id="headlinescheck"><i class="fa fa-file-text"></i></span>
                                    <span id="username" class="text-danger font-weight-bold"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Story" class="col-sm-3 control-label bold uppercase">Story : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea type="text"   class="form-control" id="story" name="story" rows="5" cols="43" placeholder="Story " value="" required></textarea>
                                    
                                    <span class="input-group-addon bold"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Image" class="col-sm-3 control-label bold uppercase">Image : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="file" class="form-control has-error bold " id="image" name="image" placeholder="Images " value="" required>
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Video" class="col-sm-3 control-label bold uppercase">Video : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="file" class="form-control has-error bold " id="video" name="video" placeholder="videos " value="" required>
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="otherlinks" class="col-sm-3 control-label bold uppercase">News Links : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="otherlinks" name="otherlinks" placeholder="Paste your Image Or Video Links " value="" required>
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-save" value="add" onsubmit="return validation()"><i class="fa fa-send"></i> Save News</button>
                    <input type="hidden" id="news_id" name="news_id" value="0">
                </div>
            </div>
        </div>
    </div>

    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    
    <!-- ===================== For View ======================-->
    <div class="modal fade" id="viewModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><i class="fa fa-list"></i> News Section View</h4>
                </div>
                <div class="modal-body">
                    
                        
                        <div class="form-group error">
                            <label for="headlines" class="col-sm-3 control-label bold uppercase">Headlines : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control has-error bold " id="viewheadlines" name="headlines" placeholder="News headlines " value="">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Story" class="col-sm-3 control-label bold uppercase">Story : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea type="text"   class="form-control" id="viewstory" name="story" rows="5" cols="43" placeholder="Story " value=""></textarea>
                                    
                                    <span class="input-group-addon bold"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="image" class="col-sm-3 control-label bold uppercase">Image : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <img src="<?php echo e(url('assets/images/news/')); ?>" height="200px" width="390px" id="viewImage">
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Video" class="col-sm-3 control-label bold uppercase">Video : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <video width="390px" height="200px" controls id="viewVideo">
                                     <source src="" type="video/mp4">
                                           Your browser does not support the video tag.
                                    </video>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group error">
                            <label for="Links" class="col-sm-3 control-label bold uppercase">Links : </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control has-error bold " id="viewLinks" name="viewLinks" placeholder="Url " value="">
                                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                </div>
                            </div>
                        </div>
                    <input type="hidden" id="newsView_id" name="newsView_id" value="0">
                      

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary bold uppercase" id="btn-cancel" value="ok"><i class="fa fa-send"></i> Close</button>
                    
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
//         var headlines =document.getElementById("headlinescheck").value;
//                if(headlines==""){
//                    alert('please insert ');
//                  //  document.getElementById('headlines').focus();
//                 //   document.getElementById('headlinescheck').innerHTML="Please enter Headlines";
//                 //   return false; 
//                }
      function validation(){
//                var headlines =document.getElementById("headlinescheck").value;
//                if(headlines==""){
//                    document.getElementById('headlines').focus();
//                    document.getElementById('headlinescheck').innerHTML="Please enter Headlines";
//                    return false; 
//                }

//                var pass =document.getElementById("password").value;
//                if(pass==""){
//                    document.getElementById('passwords').innerHTML="Please enter password";
//                    document.getElementById('password').focus();
//                    return false; 
//                }
//
//                var conpass =document.getElementById("confirmpassword").value;
//                if(conpass==""){
//                    document.getElementById('confirmpasswords').innerHTML="Please enter confirm password";
//                    document.getElementById('confirmpassword').focus();
//                    return false; 
//                }
//
//                if(conpass!=pass){
//                    document.getElementById('confirmpasswords').innerHTML="Confirm password does not match";
//                    document.getElementById('confirmpassword').focus();
//                    return false; 
//                }
//
//                var mobile =document.getElementById("mobile").value;
//                if(mobile==""){
//                    document.getElementById('mobiles').innerHTML="Please enter mobile";
//                    document.getElementById('mobile').focus();
//                    return false; 
//                }
//
//                var email =document.getElementById("email").value;
//                if(email==""){
//                    document.getElementById('emails').innerHTML="Please enter email id";
//                    document.getElementById('email').focus();
//                    return false; 
//                }
                
            }  
    var url = '<?php echo e(url('/admin/news-section')); ?>';
     $(document).on('click','.open_modal',function(){
            var news_id = $(this).val();

            $.get(url + '/' + news_id, function (data) {
                //success data
                console.log(data);
                $('#news_id').val(data.news_id);
                $('#headlines').val(data.headlines);
                $('#story').val(data.story);
                $('#image').attr('src',"<?php echo url('assets/images/news/') ?>"+data.image);
                $('#video').attr('src',"<?php echo url('assets/images/news/') ?>"+data.video);
                $('#otherlinks').val(data.otherlinks);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
         $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#newsForm').trigger("reset");
            $('#myModal').modal('show');
        });
         $("#btn-save").click(function (e) {
           //  validation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
             e.preventDefault();
             
            var headlines =$('#headlines').val(); 
            var story =$('#story').val(); 
            var image = document.getElementById("image").files[0]; 
            var video = document.getElementById("video").files[0]; 
            var otherlinks =$('#otherlinks').val(); 
           
            var formData = new FormData();
      
            formData.append("headlines", headlines); 
            formData.append("story", story); 
            formData.append("image", image); 
            formData.append("video", video);
            formData.append("otherlinks", otherlinks);
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var news_id = $('#news_id').val();;
            var my_url = url;
            if (state == "update"){
                type = "POST"; //for updating existing resource
                my_url += '/' + news_id;
            }
            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                  //  alert(data);
                    console.log(data);
//                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.compound + ' - Hours</td>';
//                    product += '<td><button class="btn btn-primary btn-detail open_modal bold uppercase" value="' + data.id + '"><i class="fa fa-edit"></i> EDIT</button>';
//                    if (state == "add"){ //if user added a new record
//                        $('#products-list').append(product);
//                    }else{ //if user updated an existing record
//                        $("#product" + product_id).replaceWith( product );
//                    }
                    $('#newsForm').trigger("reset");
                    $('#myModal').modal('hide');
                },
                error: function (data) {
                    //console.log('Error:', data);
                    document.write(data.responseText);
                }
            }).done(function() {
                swal('Success','News Successfully Saved.','success');
            });
        });
    
    
    </script>
    
    <script>
        var url1 = '<?php echo e(url('/admin/news-section')); ?>';
        $(document).on('click','#newsView',function(){
            var newsView_id = $(this).val();
   
            $.get(url1 + '/' + newsView_id, function (data) {
                //success data
               // alert(data.image);
                console.log(data);
                $('#news_id').val(data.news_id);
                $('#viewheadlines').val(data.headlines);
                $('#viewstory').val(data.story);
                $('#viewImage').attr('src','<?php echo e(url("assets/images/news/")); ?>/'+data.image);
                $('#viewVideo').attr('src',data.video);
                $('#viewLinks').val(data.otherlinks);
             //   $('#btn-save').val("update");
                $('#viewModal1').modal('show');
            })
        });
         $('#btn-cancel').click(function(){
            
            $('#viewModal1').modal('hide');
        });
    
    
    </script>
    
    
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>