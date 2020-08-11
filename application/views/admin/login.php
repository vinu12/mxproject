<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?php echo base_url(); ?>assets/images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Login</h2>
              
            </div>
          </div>
        </div>
      </div> 
   

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="<?php echo base_url(); ?>">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Login</span>
      </div>
    </div>
	
	
	
	
    <div class="site-section">
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
		
		
<div class="login-options text-center">
<a href="<?php echo base_url()?>UserNetwork/google_login" class="google-login"><i class="fab fa-google-plus-g"></i> Login with G Plus</a>
</div>

			<form name="formlogin" action="<?php echo base_url(); ?>User/loginuser" method="post"> 
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">User Email</label>
                            <input type="email" id="useremail" name="useremail" maxlength="40" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" id="pword" name="pword" class="form-control form-control-lg" maxlength="10" required>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" name="submit"  value="Log In" class="btn btn-primary_new btn-lg px-5">&nbsp;<a href="<?php echo base_url(); ?>UserNetwork/forgotpassword" class="pull-right ">Forgot Password </a>
                        </div>
                    </div>
                </div>
            </div>
            

          
        </div>
    </div>