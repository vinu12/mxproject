<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-color:#000000;">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">&nbsp;</h2>
              <p></p>
            </div>
          </div>
        </div>
      </div> 
    
    

    
    
	

   		
	
	
	<form name="form1" method="post" action="<?php echo base_url(); ?>User/contact">
    <div class="site-section">
	
	<section class="banner_area" data-stellar-background-ratio="0.5" style="background-position: 50% -5px;  
    background-color: #E31F33;     height: 104px;">
     
	
	
	<div class="elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-"><h2 class="elementskit-section-title" style="text-align:center;font-weight: 500; margin-bottom: 20px;
    font-size: 28px;  background-color: #E31F33; color:#ffff; font-weight:bold; padding-top:30px;">
					Contact Us
				</h2><div class="ekit_heading_separetor_wraper ekit_heading_elementskit-border-divider"><div class="elementskit-border-divider"></div></div></div>
	
	
	
        <!--<ol class="breadcrumb">
          <li><a href="https://www.gradhub.com.au/">Home</a></li>
            <li><a href="#" class="active">Contact Us</a></li>
        </ol>-->
    </section>
	
 <div class="col-md-12" style="padding:0px 0px 0px 0px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28026.142475443932!2d77.25781349726309!3d28.59174158277959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce25ebc547eb1%3A0x95ed9d3aecd20c9!2sKotla%20Mubarakpur%2C%20South%20Extension%20I%2C%20New%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1594361924619!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	
			 </div>
			
	
	
        <div class="container">
		
		
			<h2 class="elementskit-section-title " style="font-weight: 500; margin-bottom: 20px;
    font-size: 25px; margin-top:10px; color:#000;">
					Send us an Inquiry
				</h2>
				
				<div>
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
                    <div class="col-md-6">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
				
				
			
			
			
			
		
		
		<div  class="">
		
		
		
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-3 form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" class="form-control form-control-lg" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="eaddress">Email Address</label>
                    <input type="email" id="eaddress" name="eaddress" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-3 form-group">
                    <label for="tel">Tel. Number</label>
                    <input type="number" id="tel" name="tel" class="form-control form-control-lg" required>
                </div>
            </div>
			 <div class="row">
			<div class="col-md-6 form-group">
                    <label for="tel">Address</label>
                    <input type="text" id="address" name="address" class="form-control form-control-lg" required>
                </div>
			</div>
			
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message"  cols="30" rows="10" class="form-control" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <input type="submit" name="submit" value="Send Message" class="btn btn-primary_new btn-lg px-5 colorfill" style="background-color:#E31F33; color:#fff;">
                </div>
            </div>
			
			
			</div>
			
			
			
        </div>
    </div>
	</form>

 
 <br>
 
 
 
 