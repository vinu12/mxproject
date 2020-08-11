
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




<script>


// Save user data to the database

function saveUserData(fbid,first_name,last_name,email,gender,locale,Picture,link){
	
	
	var userData = {"fbid":fbid, "first_name":first_name, "last_name":last_name,"email":email,"gender":gender,"locale":locale,"Picture":Picture,"linkurl":link};
	
	
    $.post('<?php echo base_url(); ?>UserNetwork/loginfacebook', 
	{
	oauth_provider:'facebook',
	userData: JSON.stringify(userData)}, 
	function(data)
	{
		
	if(data=="updated" || data=="inserted")
	{
		
		
		window.location.href = "<?php echo base_url(); ?>user/index";
		return true; 
	}
	else
	{	window.location.href = "<?php echo base_url(); ?>UserNetwork/login";
		return true; 
	}
	
	});
}



/*function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
		
        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
        document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
        document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>Locale:</b> '+response.locale+'</p><p><b>Picture:</b> <img src="'+response.picture.data.url+'"/></p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
        
		
		var fbid=response.id;
	
		var first_name=response.first_name;
		var last_name=response.last_name;
		var email=response.email;
		var gender=response.gender;
		var locale=response.locale;
		var	Picture=response.picture.data.url;
		var link=response.link;
        // Save user data
        saveUserData(fbid,first_name,last_name,email,gender,locale,Picture,link);
    });
} */







window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '223130391611745', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    
    // Check whether the user already logged in
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            //display user data
            getFbUserData();
        }
    });
};

// Load the JavaScript SDK asynchronously


// Facebook login with JavaScript SDK
function fbLoginnew(loginfb) {
	
	
	(function(d, s, id) {
	
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
	
	
	
	
    FB.login(function (response) {
		//alert(response.authResponse);
        if (response.authResponse) {
			
            // Get and display the user profile data
            //getFbUserData();
        } else {
			
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
		
		
			
			document.getElementById('fid').value = response.id;
         //document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        //document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
        //document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
        var ddd = '<p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>Locale:</b> '+response.locale+'</p><p><b>Picture:</b> <img src="'+response.picture.data.url+'"/></p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
		var fbid=response.id;
	
		var first_name=response.first_name;
		var last_name=response.last_name;
		var email=response.email;
		var gender=response.gender;
		var locale=response.locale;
		var	Picture=response.picture.data.url;
		var link=response.link;
        // Save user data
        saveUserData(fbid,first_name,last_name,email,gender,locale,Picture,link);
		
    });
}

// Logout from facebook
/*function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="<?php echo base_url(); ?>assets/images/fblogin.png"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
    });
} */
</script><!--signup-->
        
		
		<input type="hidden" name="fid" id='fid' value="">
		
		
		
		
<center><div id="status"></div></center>




<!-- Display user profile data -->
	
		
		
		
		
		
		
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
		<div class="signup-page">
			<div class="container">
				<div class="row">
					<!-- user-login -->			
					<div class="col-sm-6 col-sm-offset-3">
						<div class="ragister-account account-login">		
							<h1 class="section-title title">User Login</h1>
							<div class="login-options text-center">
							
								<!--<a href="javascript:void(0);" onclick="fbLoginnew('loginfb');" id="fbLink" class="facebook-login">
								<i class="fa fa-facebook"></i> Login with Facebook</a>-->
								<a href="<?php //echo base_url()?>UserNetwork/google_login" class="twitter-login"><i class="fa fa-google-plus"></i> Login with G Plus</a>
								
							</div>
							<div class="devider text-center">Or</div>
							<form id="registation-form" name="registation-form" method="post" action="<?php echo base_url(); ?>UserNetwork/loginuser">
								
								<div class="form-group">
									<label>Email id</label>
									<input type="email" name="email" class="form-control" autocomplete="off" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" autocomplete="off" required>
								</div>
								<!-- checkbox -->
								<div class="checkbox">
									<label class="pull-left"><input type="checkbox" name="signing" id="signing"> Keep Me Login </label>
									<a href="<?php  echo base_url();?>UserNetwork/forgotpassword" class="pull-right ">Forgot Password </a> 
								</div><!-- checkbox -->	
								<div class="submit-button text-center signin-btn">
									<button type="submit" class="btn btn-primary"> Login</button>
								</div>
								<label class="my-sigup"> Not registered Yet <a href="<?php echo base_url() ?>UserNetwork/signup"> Sign Up </a> NOW </label>
							</form>	
							
							
						</div>
					</div><!-- user-login -->			
				</div><!-- row -->	
			</div><!-- container -->
		</div>
        <!--end of signup-->
		<?php
		}
		?>
		<script>
$(function() {
	
	$('#clsid').click(function() {
		 $(".alert-success").hide();
	});
 
});
</script>

	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script> 
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.sticky-kit.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easy-ticker.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.subscribe-better.min.js"></script> 
    
		 
		