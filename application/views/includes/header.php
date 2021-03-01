<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title><?php  if($title!="") { echo  $title; }  ?></title>




    <meta content="<?php  if($meta_keywords!="") { echo $meta_keywords;}  ?>" name="keywords">
    <meta content="<?php  if($meta_description!="") {echo  $meta_description; } ?>" name="description">
    <link href="<?php echo base_url(); ?>assets/images/favicone.png" rel="icon">
    <!-- Favicons -->
    <!--<link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <!--shyju added--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <!-- Main Stylesheet File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>


    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5d4bbb0de5ae967ef80f0638/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


    <!--==========================
    Header
  ============================-->

    <header id="header">
        <div class="toparea">

            <div class="topone">
                <ul>
                    <!--<li><i class="fa fa-phone" aria-hidden="true"></i><a href="Tel:+1234567890"> +91 - 9811758582 </a></li>-->
					
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">admissions@maxscholarship.com</a></li>
                    <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">info@maxscholarship.com</a></li>
                </ul>
            </div>
            <div class="topthree">
                <ul>
                    
                    <li>
                        <div class="apply-btn-area">
                            
							<a  class="apply-now-btn" href="<?php echo base_url(); ?>contactus">Conatct</a>
                        </div>
                    </li>
                </ul>
            </div>


        </div>

        <div class="header-two">

            <div id="logo" class="">
                <h1><a href="<?php echo base_url(); ?>" class="scrollto"><img src="<?php echo base_url(); ?>assets/img/logo.png" style="height:73px;"></a>
                    <!--<p style="text-align:right; font-size:16px; color:#fff">Solutions </p>-->
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>aboutus">About Us</a></li>
                    <li class="menu-has-children"><a href="<?php echo base_url();?>">OurProgram</a>


                        <ul>
                            <li class="menu-has-children"><a href="#">Diploma</a>


                                <ul>
                                    <li><a href="<?php echo base_url(); ?>diploma-in-it">Diploma in IT</a></li>
                                    <li><a href="<?php echo base_url(); ?>diploma-in-leadership-and-management">Diploma in Leadership and Management</a></li>
                                   


                                </ul>


                            </li>
                            <li class="menu-has-children"><a href="#">Bachelors</a>

                                <ul>
                                    <li><a href="<?php echo base_url(); ?>bachelor-in-itc">Bachelor in ICT</a></li>
                                    <li><a href="<?php echo base_url(); ?>bachelor-in-business">Bachelor in business</a></li>
                                    <li><a href="<?php echo base_url(); ?>bachelor-in-commerce">Bachelor in Commerce </a></li>
                                    <li><a href="<?php echo base_url(); ?>bachelor-of-information-system">Bachelor  of information system </a></li>
                                    


                                </ul>



                            </li>
                           
                           
                            <li class="menu-has-children"><a href="#">Masters</a>

                                <ul>
                                    <li><a href="<?php echo base_url(); ?>master-of-business-adminstrator">Master of Business Adminstrator </a></li>
                                    <li><a href="<?php echo base_url(); ?>master-of-professional-accounting">Master of Professional Accounting </a></li>
                                    <li><a href="<?php echo base_url(); ?>master-of-technology">Master Of Technology</a></li>
                                    


                                </ul>


                            </li>
							
							
							 <li class="menu-has-children"><a href="<?php echo base_url(); ?>profyear">Py Program</a>

                                <ul>
                                    <li><a href="<?php echo base_url(); ?>Courses/accountingpyp">Accounting PYP </a></li>
                                    <li><a href="<?php echo base_url(); ?>Courses/acsprofessionalyearprogram">ACS Professional year Program</a></li>
                                    
                                    


                                </ul>


                            </li>
                            
                        </ul>


                    </li>
                     
					 
					  
					 
					 

                    <li><a href="<?php echo base_url() ?>ourservices">Our Services</a></li>


                    <li class="menu-has-children"><a href="">Countries</a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>study-in-uk">UK</a></li>
                            <li><a href="<?php echo base_url(); ?>study-in-australia">AUS</a></li>
                            <li><a href="<?php echo base_url(); ?>study-in-new-zealand">NZ</a></li>
                            <li><a href="<?php echo base_url(); ?>study-in-canada">CAN</a></li>
                            <li><a href="<?php echo base_url(); ?>study-in-usa">USA</a></li>
                            <li><a href="<?php echo base_url(); ?>study-in-europe">EUROPE</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url(); ?>ielts">IELTS</a></li>

                    <!--<li><a href="<?php echo base_url(); ?>contactus">Contact</a></li>-->
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->