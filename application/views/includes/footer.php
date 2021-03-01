
  <!--==========================
    Footer
  ============================-->
  
  <script src="http://localhost/maxprodevelopment2020/assets/js/jquery-3.2.1.min.js"></script>
  
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3><a href="<?php echo base_url(); ?>" class="scrollto"><img src="<?php echo base_url(); ?>assets/img/logo.jpg" style="height:50px;"></a></h3>
            <p>MAXSCHOLARSHIP was founded with the aim to provide students the whole world to explore and realize their dreams. When Dreams have no boundaries, why should education have? When our students get admitted to the most prestigious universities and colleges, we feel that the boundaries of education cease to exist. </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url(); ?>aboutus">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url(); ?>ourservices">Our Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url(); ?>ielts">IELTS</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url(); ?>contactus">contactus</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              PAN India<br>
              <!--<strong>Phone:</strong> +91 - 9811758582 |<br>
			   <strong> </strong> +61 - 871603522-->
			  <br>
			 
              <strong>Email:</strong> info@maxscholarship.com<br>
			  <strong></strong>  admissions@maxscholarship.com<br>
            </p>
			
			
			

            <div class="social-links">
              <a href="https://twitter.com/MaxScholarship" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/maxscholarship/" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://in.pinterest.com/maxscholarship/" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="https://plus.google.com/116632654964458052222" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <!--<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>-->
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Get In touch</h4>
           
			<p>Stay updated with MaxScholarship</p>
            <form name="form1" action="" method="post">
			<div>
			<div id='msgdata'></div>
              <div><p><input type="email" name="email" id="email" value="" required style="size:18;"></p></div>
			  <div><p><input type="button"   value="Subscribe" class="btn btn-primary_new rounded-0 px-4 colorfill waves-effect waves-light" style="float:left;" onclick="subscribethedata();"></p></div> &nbsp;
			  </div>
			  
			  	
            </form>
          </div>
		 

        </div>
      </div>
    </div>
	
	<script language="javascript">
	
	

	
	function subscribethedata()
	{
		var email=$("#email").val();
		
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    
		
		
		if(email=="")
		{
			document.getElementById("msgdata").innerHTML='Please enter  email id.';
			return false;
		}
		
		if (!filter.test(email)) {
			document.getElementById("msgdata").innerHTML='Please enter valid email id.';
			return false;
	}
		
		
		
		var dataString = 'email='+ email;
		
		
		$.ajax({type:"POST", url: "<?php echo base_url(); ?>User/ajaxRequest",
		data:dataString, success: function(response) {
		var txt=response;
		document.getElementById("msgdata").innerHTML=txt;
		}});
		
		
		
	}
	
	</script>

    <div class="container">
      <div class="copyright">
        &copy; Copyright  2018 - 2019<strong> Max Scholarship</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Created by <a href="<?php echo base_url(); ?>"> ATMC & Powered by Max Scholarship</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/lightbox/js/lightbox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/touchSwipe/jquery.touchSwipe.min.js"></script>

<!--shyju added--->

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<script>
        $(document).ready(function() {
            $("#testimonial-slider").owlCarousel({
                autoplay: true,
                lazyLoad: true,
                loop: true,
                margin: 20,
                /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
                responsiveClass: true,
                autoHeight: true,
                autoplayTimeout: 7000,
                smartSpeed: 800,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },

                    600: {
                        items: 3
                    },

                    1024: {
                        items: 3
                    },

                    1366: {
                        items: 3
                    }
                }
            });

            
            
        });
    </script>



</body>
</html>















 


















