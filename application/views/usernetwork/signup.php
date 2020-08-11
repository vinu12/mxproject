
		
		<div class="signup-page">
			<div class="container">
			
			
			 
     <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if(!empty($error))
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" id='clsid' class="close" data-dismiss="alert" aria-hidden="true" style="top:-11px;">×</button>
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
    
			<?php
			$logid=$this->session->userdata('logid');
			$baseurl=base_url();

			if($logid!="")
			{
			redirect($baseurl, 'refresh');
			}
			else
			{
			?>
			
			
				<div class="row">
					<!-- user-login -->			
					<div class="col-sm-6 col-sm-offset-3">
						<div class="ragister-account account-login">		
							<h1 class="section-title title">User Signup</h1>
							
							
							<form id="registation-form" name="registation-form" method="post" action="<?php  echo base_url()?>UserNetwork/signup">
								
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="name" class="form-control" autocomplete="off" required>
								</div>
                                
                                <div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control"  autocomplete="off" required>
								</div>
                                
                                
                                
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" autocomplete="off" required>
								</div>
								<!-- checkbox -->
								
								<div class="submit-button text-center signin-btn">
									<button type="submit" name="submit" value="submit" class="btn btn-primary"> Signup</button>
								</div>
                               
                            
                                <label class="my-sigup"> <a href="<?php echo base_url() ?>UserNetwork/login"> Sign in </a>  </label>
							</form>	
                            
                            
							
							
						</div>
					</div><!-- user-login -->			
				</div><!-- row -->	
				<?php 
			}
			?>
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