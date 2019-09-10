

<?php $__env->startSection('content'); ?>
  
	<style type="text/css">
	.table th, .table td {
		border-top: none !important;
		border-bottom: none !important;
	}
	.table .table {
		background-color: white !important;
	}
	.form-control{
		padding: 0.50rem 0.50rem !important;
	}
	
	.form-group {
		margin-bottom:0px !important;
	}
	.sw-main {
		width: 850px !important;
	}
	.genderBtn{
		padding: 10px 30px;
	}
	.genderActiveBtn{
		border-color: #1EC481 !important;
		background-color: #28D094 !important;
		color: #FFFFFF;
	}
	.genderInactiveBtn{
		background-color: white;
		border: 1px solid #d6d4d4;
		color: #333;
	}
	.title{
		font-weight:600;
	}
	label{
		font-weight:bold;
	}
	input[type="radio"]{
		margin-left:1%;
	}
	
	input[type="checkbox"]{
		margin-right:4%;
	}
	
	/***********************/
	.upload-btn-wrapper {
	  position: relative;
	  overflow: hidden;
	  display: inline-block;
	}

	.upload-btn {
		border: 2px solid #268cab;
		color: #268cab;
		background-color: white;
		padding: 5px 40px;
		border-radius: 8px;
		font-size: 15px;
		font-weight: bold;
	}

	.upload-btn-wrapper input[type=file] {
	  font-size: 100px;
	  position: absolute;
	  left: 0;
	  top: 0;
	  opacity: 0;
	}
	/***********************/
	</style>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="page_title" style="text-align: -webkit-center;"><?php echo $page_title; ?></h3>
                    <hr>
                </div>
            </div>
            <div class="row" style="width:100%;" align="center">
            <form action="<?php echo e(route('identity-verification')); ?>" id="myForm" role="form" data-toggle="validator" enctype="multipart/form-data" method="post" style="width:100%;">
            <?php echo e(csrf_field()); ?>

            	<div id="smartwizard">
                    <ul>
                        <li><a href="#step-1">General</a></li>
                        <li><a href="#step-2">Source Of Funds</a></li>
                        <li><a href="#step-3">ID Upload</a></li>
                    </ul>

                    <div>
                        <div id="step-1" style="min-height:300px; width:100%;" class="">
							<div align="center" style="padding-top: 30px;">
							<h3 style="color: #268cab;">Tell Us About Your Self</h3>
							</div>
							
							<div class="table-responsive">
								<table class="table table-de mb-0">
									<tr>
									<td style="width:30%">
										<table class="table table-de mb-0">
										<tr>
											<td align="center" colspan="2"><span class='title'>What is your gender?</span></td>            
										</tr>
										<tr>
											<td><input type="radio" name="gender" id="gender" checked value="Male" >Male</td>
											<td><input type="radio" name="gender" id="gender" value="Female">Female</td>                        
										</tr>
										</table>
									</td>
									<td style="width:70%">
										<table class="table table-de mb-0">
										<tr>
											<td align="center"><span class='title'>What is your nationality and birth date?</span></td>            
										</tr>
										<tr>
											<td>
											<div class="form-group">
												<label for="name">Nationality</label>
												<select class="form-control" name="nationality" id="nationality" required>
													<option value="">--Select Country--</option>
												<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($country->country_code); ?>"><?php echo e($country->country_name); ?></option>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<div class="help-block with-errors"></div>
											</div>
											</td>                        
										</tr>
										<tr>
											<td>
											<div class="form-group">
												<label for="name">Birth Date</label>											
                                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                  <input type="text" autocomplete="off" name="birthdate" id="birthdate" class="form-control date-picker" required>
                                                </div>
												<div class="help-block with-errors"></div>
											</div>
											</td>                        
										</tr>
										</table>
									</td>
									</tr>
								</table>
							</div>
							
                        </div>
                        <div id="step-2" style="min-height:400px;" class="">
                            
							<div align="center" style="padding-top: 30px;">
							<h3 style="color: #268cab;">Source Of Funds</h3>
							</div>
							
							<p style="text-align: center;margin-top: 5%;margin-bottom: 4%;">To comply with local regulations, we need to understand the source of the money you will use in your Coins account. Please be as specific as possible. It will help us verify your account faster!</p>
							
							<div class="table-responsive">
								<table class="table table-de mb-0">
								<tr>
									<td colspan="2"><label>What is your employment status?</label></td>            
								</tr>
								<tr>
									<td>
									<input type="radio" name="employment_status" id="employment_status" value="Employed">Employed
									<input type="radio" name="employment_status" id="employment_status" value="Self-employed">Self-employed
									<input type="radio" name="employment_status" id="employment_status" value="Retired">Retired
									<input type="radio" name="employment_status" id="employment_status" value="Unemployed">Unemployed
									<input type="radio" name="employment_status" id="employment_status" value="Student">Student
									</td>
								</tr>
								</table>
										
								<table class="table table-de mb-0">
									<tr>
									<td style="width:50%">
										<table class="table table-de mb-0">
										<tr>
											<td>
											<div class="form-group">
												<label for="name">Please choose your Industry</label>
												<select class="form-control" name="industry_type" id="industry_type" required>
													<option value="">--Select Industry--</option>
                                                 <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($industry->name); ?>"><?php echo e($industry->name); ?></option>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
											</td>         
										</tr>
										</table>
									</td>
									<td style="width:50%">
										<table class="table table-de mb-0">
										<tr>
											<td>
											<div class="form-group">
												<label for="name">What is your job title or position?</label>
												<input type="text" class="form-control" name="job_position" id="job_position" autocomplete="off" placeholder="" required>
												<div class="help-block with-errors"></div>
											</div>
											</td>                        
										</tr>
										<tr>
											<td>
											<div class="form-group">
												<label for="name">What is the name of your employer or the company you work for?</label>
												<input type="text" class="form-control" name="company_name" id="company_name" autocomplete="off" placeholder="" required>
												<div class="help-block with-errors"></div>
											</div>
											</td>                        
										</tr>
										</table>
									</td>
									</tr>
								</table>
							</div>
							
                        </div>
                        <div id="step-3" style="min-height:300px;" class="">
                            
							<div id= "idferifyPath">
								<div align="center" style="padding-top: 30px;">
								<h3 style="color: #268cab;">Upload Government Issued ID</h3>
								</div>
								
								<div class="table-responsive">
									<table class="table table-de mb-0">
										<tr>
										<td style="width:50%">
											<table class="table table-de mb-0">
											<tr>
												<td>
												<div class="form-group">
													<label for="name">Select ID Type</label>
													<select class="form-control" name="id_type" id="id_type" required>
														<option value="">--Select ID Proof--</option>
                                                    <?php $__currentLoopData = $identityproofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $identity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($identity->name); ?>"><?php echo e($identity->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
												</td>         
											</tr>
											<tr>
												<td>
												<div class="form-group">
													<label for="name">What is the expiration date?</label>
													<input type="text" class="form-control datepicker" name="expiry_date" id="expiry_date" autocomplete="off" placeholder="Expiration Date" required>
													<div class="help-block with-errors"></div>
												</div>
												</td>         
											</tr>
											<tr>
												<td>
												<div class="form-group">
													<label for="name">What is your ID number?</label>
													<input type="text" class="form-control" name="id_number" id="id_number" autocomplete="off" placeholder="ID Number" required>
													<div class="help-block with-errors"></div>
												</div>
												</td>         
											</tr>
											</table>
										</td>
										<td style="width:50%">
											<table class="table table-de mb-0">
											<tr>
												<td>
												<div class="form-group">
													<label for="name">Upload Image of ID <i class="fa fa-question-circle"></i></label>
													<div class="upload-btn-wrapper">
													  <button class="upload-btn">Upload ID Image</button>
													  <input type="file" name="image" id="image" />
													</div>
												</div>
												</td>         
											</tr>
											</table>
										</td>
										</tr>
									</table>
									
									<table class="table table-de mb-0">
									<tr>
										<td>
										<input type="checkbox" name="agree" id="agree" value="Accepted">I hereby declare that the information contained in this form is complete, valid and truthful.
										</td>
									</tr>
									</table>
									
								</div>
							</div>
							
							
							<div id= "idferifyPath2" style="display:none;">
								<div align="center" style="padding-top: 30px;">
								<h3 style="color: #5b5e5f;width: 50%;">Almost Done! Want your account to be verified faster?</h3>
								
								<p style="text-align: center;width: 50%; margin-top: 5%; margin-bottom: 2%;">Check the boxes below if you've properly completed the steps. If you have not done something right, go back and fix it!</p>
								
								</div>
								
								<div class="table-responsive">
									<table class="table table-de mb-0">
										<tr>
										<td style="width:50%">
											<table class="table table-de mb-0">
											<tr>
												<td>
													<input type="checkbox" name="valid_government_id" id="valid_government_id" value="1">Upload images of your <b>government ID</b>?
												</td>         
											</tr>
											<tr>
												<td>
													<input type="checkbox" name="not_blurry" id="not_blurry" value="2">Make sure the writing on your ID is <b>not blurry</b>?
												</td>         
											</tr>
											</table>
										</td>
										<td style="width:50%">
											<table class="table table-de mb-0">
											<tr>
												<td>
													<input type="checkbox" name="not_expired" id="not_expired" value="3">Make sure your ID is <b>not expired</b>?
												</td>         
											</tr>
											<tr>
												<td>
													<input type="checkbox" name="funds_come_from" id="funds_come_from" value="4">Clarify where your <b>funds</b> come from?
												</td>         
											</tr>
											</table>
										</td>
										</tr>
									</table>
									
								</div>
							</div>
							
							
							
                        </div>
                        
                    </div>
        		</div>
             </form>
                
            </div>
        </div>
    </div>
	

<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('assets/dashboard/assets/js/jquery-1.12.4.min.js')); ?>"></script>

<?php if(session('success')): ?>
	<script type="text/javascript">
        $(document).ready(function(){

            swal("Success!", "<?php echo e(session('success')); ?>", "success");

        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });

    </script>
<?php endif; ?>
<script>
$(document).ready(function() {
	$(document).on('click','.sw-btn-next',function(){
		var pageURL = $(location).attr("href");
		var url_solit		= pageURL.split("#");
		var current_step	= url_solit[1];
		
		if(current_step == 'step-3'){
			//$(".sw-btn-next").removeAttr('disabled');
			$(".sw-btn-next").hide();
			var btn_field	= "<input type='submit' name='final' id='final' class='btn btn-success done-btn' value='Done'>";
			$(".sw-btn-prev").hide();
			$(".sw-btn-group").append(btn_field);
		} else {
			$(".sw-btn-next").show();
			$(".sw-btn-prev").show();
			$(".done-btn").hide();
		}
	});
	
	$(document).on('click','.sw-btn-prev, .nav-link',function(){
		$(".sw-btn-next").show();
		$(".done-btn").hide();
	});
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
		$("#myForm").validate({
			rules: {							
				gender: {
					required: true,
				},
				nationality: {
					required: true,
				},
				birthdate: {
					required: true,
				},
				employment_status: {
					required: true,
				},
				industry_type: {
					required: true,
				},
				job_position: {
					required: true,
				},
				id_type: {
					required: true,
				},
				expiry_date: {
					required: true,
				},
				id_number: {
					required: true,
				},			
				agree: "required"
			},
			messages: {						
				gender: {
					required: "Please choose your gender",
				},
				nationality: {
					required: "Please select your country",
				},
				birthdate: {
					required: "Please enter your birthdate",
				},
				employment_status: {
					required: "Please choose your current employment status",
				},
				industry_type: {
					required: "Please select which industry you belongs to",
				},
				job_position: {
					required: "Please provide your designation",
				},
				id_type: {
					required: "Please select identity proof",
				},
				expiry_date: {
					required: "Please enter a proof expire date",
				},				
				agree: {
					required: "Please accept our policy",
				}
			}
		});
    });
</script>

<?php echo $__env->make('layouts.user-frontend.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>