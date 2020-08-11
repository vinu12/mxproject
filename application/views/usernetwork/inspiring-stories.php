
        

<!-- responsive nav for mobile END-->

	
		
        
        
		<div class="container">
			<div class="page-breadcrumbs">
				<h1 class="section-title quots-ttl"> 
                    <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                    Inspiring Stories </h1>	
				<div class="world-nav cat-menu">         
					<ul class="list-inline">                       
						
						
						
						<li class="active"><a href="<?php echo base_url(); ?>highereducation"> Higher Education  </a></li>
						<li><a href="<?php echo base_url(); ?>general-news">General News </a></li>
						<li><a href="<?php echo base_url(); ?>inspiring-stories"> Inspiring Stories</a></li>
						<li><a href="<?php echo base_url(); ?>quotes">Quotes</a></li>
						
					</ul> 					
				</div>
			</div>
			<div class="section">
				<div class="row">
					<div class="col-sm-9">
                        
                        
                        <div class="quotes-left">
                        
                          
                          <div class="clearfix"> </div>
                            
							<?php
							
							if(!empty($stories_result))
							{
							foreach($stories_result as $valdata)
							{
								
								
							?>
							
							
                            <div class="quote-dtl">
                               <a href="<?php echo base_url(); ?>inspiring-stories/<?php echo $valdata['slug']; ?>/<?php echo base64_encode($valdata['id']); ?>">
                            <div class="col-lg-4 quote-image">
                                
                            <img src="<?php echo base_url(); ?>adminpanel/<?php 
							
							
							if($valdata['image']!="")
							{
							echo $valdata['image'];
							}
							else
							{
							echo 'images/No_Image_Available.jpg';
							}
							
							
							?>" alt="quote" width="100%" height="100%">
                            
                            </div>
                            
                            
                              <div class="col-lg-8 quots-txt">
                                <h3>
                                  
                                    
                                    <?php echo $valdata['page_title']; ?>
                                   
                                  
                                  </h3>      </a> 
                                  
                                  <div class="quote-info">
                                  <div class="quote-tag">
                                     <a href="#"> inspiring stories</a>
                                      
                                      </div>
                                      
                                      
                                       <div class="quoter-name">
                                       By <strong><a href="#">  <?php echo $valdata['author']; ?> </a> </strong>
                                      
                                      </div>
                                      <div class="clearfix"> </div>
                                      
                                       <div class="quoter-para">
                                    <p>
                                         <?php echo substr($valdata['description'],0,150); ?>... 
                                      </p> 
                                      </div>
                                      
                                      
                                  </div>
                                  
                                  
                                  
                            </div><!--quotes txt-->
                            
                         
                                   <div class="clearfix"> </div>
                            </div> <!--quote dtl-->
							
							
							
							<?php
							}
							}
							?>
                      
                            
                                 
                                  
                                  
                            <div><?php echo '<div class="pagination">'.$links.'</div>'; ?></div>
                      
                            
                            
                            
                            
                            
                    </div> <!--inspiring stories-left-->
                        
                        
                <div class="quote-pagination">
                        
                       
					   
					  
                    
                    
                    <div class="clearfix"></div>
                        
                        </div> <!--quote-pagination-->        
                        
                        
						
                        
					</div><!--/.col-sm-9 -->	
					
                    
                    
                    
					<?php $this->load->view('news/commanleft'); ?>
				
                
                
                </div>				
			</div><!--/.section-->
		</div><!--/.container-->
        
        
      
        
      <script>
                function sendtosubscriber() {

                                    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                    var email = $("#subemail").val();
                                    if (email == "")
                                    {
                                        $("#error").html('Please enter email.');
										$('#error').css("color", "red");
                                        return false;
                                    }

                                    if (email != "")
                                    {
                                        if (!email.match(mailformat))
                                        {

                                            $("#error").html('You have entered an invalid email address!');
											$('#error').css("color", "red");
                                            $("#subemail").focus();
                                            return false;
                                        }
                                    }


                                    $.ajax({type: 'POST', url: "<?php echo base_url(); ?>news/sendsubemail",
                                        data: {email: email},
                                        beforeSend: function () {
                                            //$('#btemail').html('Please Wait...');
                                            $('#btemail').attr('disabled', true);

                                        }

                                        , success: function (response) {
                                            //console.log(response);

                                            if (response == 'success')
                                            {

                                                $('#error').html('Subscribe successfully');
                                                $('#error').css("color", "white");
                                                $('#subemail').val('');
                                                $('#btemail').val('Subscribe');
                                                //$('#success').delay(1000).hide(500); 

                                                $('#btemail').attr('disabled', false);
                                            } else
                                            {

                                                $('#error').html('Email already exist');
												$('#error').css("color", "red");
                                                $('#error').show();
                                                $('#subemail').val('');
                                                $('#btemail').html('Subscribe');
                                                $('#btemail').attr('disabled', false);
                                            }

                                        }});


                                }
	
	
	 
                </script>
        
      
      