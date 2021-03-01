

<br>
<br>


 <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
        <div class="contactusheader">
        <div class="container">

            <div class="section-contactpage">
                <h3>Contact Us</h3>
                <p></p>
            </div>
        </div>
    </div>
      <div class="container">

        
        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>PAN India</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+9899185034">+91 9811758582 
			  
			  
			  </a></p>
			  <p><a href="tel:+871603522">+61 - 871603522
			  
			  
			  </a></p>
			  
			  
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@maxscholarship.com">info@maxscholarship.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
		
		
		   <div class="col-md-12">
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
		
		
		
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form  name="form1" action="<?php echo base_url(); ?>User/contactus" method="post"  class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" required id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" required id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
			
			
			<div class="form-row">
			
			 <div class="form-group col-md-6">
              <input type="text" class="form-control" name="phone" required id="phone" placeholder="Phone" data-rule="minlen:4" data-msg="Please enter the Phone No">
              <div class="validation"></div>
            </div>
			
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="course" required id="course" placeholder="Course" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
			</div>
			
			<div class="form-row">
			
			 <div class="form-group col-md-6">
              <input type="text" class="form-control" name="Location" required id="Location" placeholder="Location" data-rule="minlen:4" data-msg="Please enter the Phone No">
              <div class="validation"></div>
            </div>
			
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="country" required id="country" placeholder="Country" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
			</div>
			
			
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><input type="submit" name="submit" value="submit" class="btn btn-primary_new rounded-0 px-4 colorfill waves-effect waves-light" ></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>





<!--==========================
    Footer
  ============================-->
 