
<?php

if($courseslistByid!="")
{
	
}
 
?>

<script src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-color:#000;')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">&nbsp;<br></h2>
              
            </div>
          </div>
        </div>
      </div> 
	  
	  <br>
	  
	  <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?php base_url(); ?>assets/images/bg_1.jpg'); ">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-12" style="padding: 10px 10px 10px 10px;
    background-color: #434343; color:#fff; text-align:center; font-size: 25px;">
              <h1 class="mb-0"><?php echo $courseslistByid[0]['course_title']; ?></h1>
              
            </div>
          </div>
        </div>
      </div> 
	  
    

  

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <img src="<?php echo base_url(); ?>adminpanel/images/courseimg/<?php echo $courseslistByid[0]['course_image']; ?>" alt="Image" class="img-fluid" style="border-style: dashed;
    border-radius: 20px 20px 20px 20px; ">
	<?php echo $courseslistByid[0]['course_desc']; ?>
                    </p>
					
                </div>
				
				
					

				
				
				
				
                <div class="col-lg-12 ml-auto align-self-center">
                        
                        <p></p>
						
    
                     

                        <p>
						
						<p style="color:#000;"> For more information download the pdf <a target="_blank" href="<?php echo base_url(); ?>adminpanel/images/coursepdf/<?php echo $courseslistByid[0]['coursepdf'];  ?>"><img src="<?php echo  base_url();?>adminpanel/images/bookpdf.png" style="width:100px;"></a></p>
						
						
						
				         <!--<div class="panel-body">
      
        <div class="card-errors"></div>
		
       
        <form action="" method="POST" id="paymentFrm">
            <div class="form-group">
                <label>NAME</label>
                <input type="text" name="name" id="name" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" id="email" placeholder="Enter email" required="">
            </div>
            <div class="form-group">
                <label>CARD NUMBER</label>
                <input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="">
            </div>
            <div class="row">
                <div class="left">
                    <div class="form-group">
                        <label>EXPIRY DATE</label>
                        <div class="col-1">
                            <input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" required="">
                        </div>
                        <div class="col-2">
                            <input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" required="">
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label>CVC CODE</label>
                        <input type="text" name="card_cvc" id="card_cvc" placeholder="CVC" autocomplete="off" required="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="payBtn">Submit Payment</button>
        </form>
    </div>-->
	
	
	
	
</div>		
						
					
						
						
						
						
						
    
                    </div>
            </div>
        </div>
    </div>

	  
<?php
$pulisher= $this->config->item('stripe_publishable_key');
?>
	 
	 
	  <script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo $pulisher; ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        // Enable the submit button
        $('#payBtn').removeAttr("disabled");
        // Display the errors on the form
        $(".card-errors").html('<p>'+response.error.message+'</p>');
    } else {
        var form$ = $("#paymentFrm");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}

$(document).ready(function() {
    // On form submit
    $("#paymentFrm").submit(function() {
        // Disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
		
        // Create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
        }, stripeResponseHandler);
		
        // Submit from callback
        return false;
    });
});
</script>