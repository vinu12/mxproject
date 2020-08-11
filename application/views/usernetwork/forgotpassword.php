
<!-- Display user profile data -->
	
		
		
		
		
		
		
		
		
		<div class="signup-page">
			<div class="container">
			
			
			<div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" id='clsid' class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" id='clsid' class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
			
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
			
			
	
			
				<div class="row">
					<!-- user-login -->			
					<div class="col-sm-6 col-sm-offset-3">
						<div class="ragister-account account-login">		
							<h1 class="section-title title">Forgot password</h1>
							<div class="login-options text-center">
							
							
								
							</div>
							
							<form id="registation-form" name="registation-form" method="post" action="<?php echo base_url(); ?>UserNetwork/forgotpassword">
								
								<div class="form-group">
									<label>Email</label>
									<input type="email" id='email' name="email" placeholder="Enter your email or phone" class="form-control"  required>
								</div>
								
								<!-- checkbox -->
								
								<div class="submit-button text-left signin-btn">
									<button type="submit" name="submit" value="submit"  class="btn btn-primary_new"> Submit</button>
								</div>
							</form>	
							
							<br>
							
						</div>
					</div><!-- user-login -->			
				</div><!-- row -->	
			
			</div><!-- container -->
		</div>
        <!--end of signup-->
		
			<script>
			$(function() {

			$('#clsid').click(function() {
			$(".alert-success").hide();
			});

			});
			</script>

	 
		 
		