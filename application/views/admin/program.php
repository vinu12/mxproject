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
    

   <br>
   <br>
   
   
   

    <div class="site-section">
        <div class="container">
		
		<div class="elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-"><h2 class="elementskit-section-title" style="text-align:center;font-weight: 500; margin-bottom: 20px;
    font-size: 28px; color:#E31F33; font-weight:bold;;">
					OUR PROGRAMS
				</h2><div class="ekit_heading_separetor_wraper ekit_heading_elementskit-border-divider"><div class="elementskit-border-divider"></div></div></div>
		
		
            <div class="row">
                
				<?php
                if($courseslist!="")
				{
					foreach($courseslist as $val)
					{
				
				?>
				
				
				<div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                       
                        
                        </figure>
                        <div class="course-1-content pb-4" style="padding: 5px 5px 5px 5px;
    background-color: #ffffff; border: 1px solid;">
	 <a href="<?php echo base_url(); ?>courses/details/<?php echo base64_encode($val['id']); ?>"><img src="<?php echo base_url(); ?>adminpanel/images/courseimg/<?php echo $val['course_image']; ?>" alt="Image" class="img-fluid"></a>
                        
	<div style="color:#000; text-align:center;" class="category"><h3><?php echo $val['course_title']; ?></h3></div>  
                      
                        <p class="desc mb-4" style="color:#000;"><?php echo substr($val['short_coursedesc'],0,170); ?>...</p>
                        <p style="padding: 10px 10px 10px 10px;
    padding -top:20px; text-align:center;"><a href="<?php echo base_url(); ?>courses/details/<?php echo base64_encode($val['id']); ?>" class="btn btn-primary_new rounded-0 px-4 colorfill" style="color:#ffffff; font-weight:bold;">Enroll In This Program</a></p>
                        </div>
                    </div>
                </div>
				
				<?php
				}
				}
				?>
				
				
				


            </div>
        </div>
    </div>

 