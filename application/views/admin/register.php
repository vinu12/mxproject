  
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?php echo base_url(); ?>assets/images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Register</h2>
              
            </div>
          </div>
        </div>
      </div> 
 
 
 
 <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="<?php echo base_url(); ?>">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Register</span>
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


            <div class="row justify-content-center">
			<form name="formregister" action="<?php echo base_url(); ?>User/register" method="post">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="password" id="pword" name="pword" class="form-control form-control-lg" required>
                        </div>
                        <!--<div class="col-md-12 form-group">
                            <label for="pword2">Re-type Password</label>
                            <input type="password" id="pword2" class="form-control form-control-lg">
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" name="submit" value="Register" class="btn btn-primary_new btn-lg px-5">
                        </div>
                    </div>
                </div>
            </div>
            

          
        </div>
    </div>