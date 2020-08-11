<div class="container">
    <div class="section">
        <div class="row">

            <div class="site-content col-lg-12">
                <div class="row">

                    <div class="col-lg-3 sid-prflfxd">

                        
                        
                            <div class="prfl-dtls">
                            
                           <div class="ntwrk-usr prfl-info"> 
                           <div class="col-lg-12">
                          
                               <?php
                               $logid = $this->session->userdata('logid');   
                               if($logid == $profile_result[0]['id']) { ?>
                               
                               <button  onclick="profiledetail('<?php echo $logid ; ?>')" id='<?php echo 'myBtn'.$logid; ?>' class="edit-prfl"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</button> 
                           
                              <?php
                               }
                               
                               ?>
                           
                           </div>
                         
                           <!-- The Modal -->





                           
                           
                           
                           
                           <a href="#">
                               
                                <?php
								
								

									$photo = $profile_result[0]['photo'];

									$basepath=base_url();
									$data=parse_url($photo, PHP_URL_SCHEME);

									if($data=='http' || $data=='https')
									{
									$uphoto = $photo;
									}



									else if($data!='http' || $data!='https'){

									$uphoto = $basepath.'adminpanel/'.$photo;

									}
									else
									{

									}

									if($photo=='')
									{
									$uphoto = $basepath."assets/images/nophoto.png";

									}
									$logid = $this->session->userdata('logid'); 
									
									
									
									
									
										if ($uphoto!= "") {

										$logid = $this->session->userdata('logid');
										if($logid==$profile_result[0]['id'])
										{
								
                                        ?>
										
										<div id='targetLayermain' class="img-responsive img-circle">
                                        <img id='hdprofiledocu' src="<?php echo $uphoto; ?>" style="width:100px; height:100px;" class="img-responsive img-circle" alt="user">
										</div>
										
										<i class="fa fa-camera mycmr"> </i>
										<input type="file" name="file" id="file" class="inputFile fa fa-camera myphoto">
										<span id="uploaded_image"></span>
										<div id="errorimg"></div>
                                        <?php
                                    }
else
{
	
	?>
	<div id='targetLayermain' class="img-responsive img-circle">
                                        <img id='hdprofiledocu' src="<?php echo $uphoto; ?>" style="width:100px; height:100px;" class="img-responsive img-circle" alt="user">
										</div>
										
										
									
										<span id="uploaded_image"></span>
										<div id="errorimg"></div>
	<?php
	
}	
									}
                                        ?>
										
										
									
										
										
			<script>
			$(document).ready(function(){
			$(document).on('change', '#file', function(){
			var name = document.getElementById("file").files[0].name;
			var form_data = new FormData();
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
			{
			$("#errorimg").html("Invalid Image File only gif,png,jpg,jpeg file allowed");
			
			$("#errorimg").css("borderColor", "red");
			$("#errorimg").css("color", "red");
			$("#errorimg").css("text-align", "center");	
			}
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file").files[0]);
			var f = document.getElementById("file").files[0];
			var fsize = f.size||f.fileSize;
			if(fsize > 2000000)
			{
			$("#errorimg").html("Image File Size is very big");
			$("#errorimg").css("borderColor", "red");
			$("#errorimg").css("color", "red");
			$("#errorimg").css("text-align", "center");	
			}
			else
			{
			form_data.append("file", document.getElementById('file').files[0]);
			
			
			$.ajax({
			url:"<?php echo base_url(); ?>UserNetwork/uploadprofilenews",
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
			//$("#errorimg").html("");
			$('#targetLayermain').html("<label class='text-success'>Image Uploading...</label>");
			},   
			success:function(data)
			{
			$('#targetLayermain').html(data);
			
			}
			});
			}
			});
			});
			</script>

										
										
										
										
									
           
                                        
                                        
                                          <span class="ntwrk-usrname"> <?php echo ucfirst($profile_result[0]['user_name']); ?> </span>
                                    <p class="occupation ntwrk-occupation"> <?php echo ucfirst($profile_result[0]['position']); ?> </p>
                                    <p class="ntwrk-shrt-bio"><?php echo ucfirst($profile_result[0]['bio']); ?></p>
                                        
                             
                                                      </a> 
                           
                           
                           
                           <div class="ntwrk-flw">
                           <?php
                            $logid = $this->session->userdata('logid');
                            if($logid!=$profile_result[0]['id'])
                            {
                           ?>
                           
                           <?php
                                        $logid = $this->session->userdata('logid');
                                        if ($logid != "") {
                                         $userid= base64_decode($profileid);
                                            
                                           
                                            
                                            
                                        $CI =& get_instance();
                                        $CI->load->model('Users_model');
                                        $resultData = $CI->Users_model->checkfollowinguser($userid);
										
                                         $resultDatauser = $CI->Users_model->followinguserlistid($userid);
										 
                                       
                                        
                                     
                                      
                                       
                                        if ($resultData==$userid && $logid==$resultDatauser)
										{
                                         
										 
                                         ?>
										 
										 
										 
                                        <div id='followu<?php echo $userid; ?>'>
                                        <a  id='followdata<?php echo $userid; ?>' href="javascript:void(0);" onclick="followuser(<?php echo $userid; ?>);" ><button   class="follow-userside ntwrk-flw-btn"> Following  </button> </a> 
										
										
                                        <a href="javascript:void(0);" id='hired' onclick="hiredusers('<?php echo $userid; ?>','<?php if($profile_result[0]['user_email']!="") { echo $profile_result[0]['user_email']; } ?>');"><button class="follow-userside ntwrk-hire-btn" id='hireduser' > Hire  </button></a>
                                        </div>
										
										
										
										<div id='loadershow' style="display:none; text-align: center;
										margin: 5px 45% !important;">
										<img src="<?php echo base_url(); ?>assets/images/27.gif">
										</div>	
										
                                        <?php 
                                         }
                                         else
                                         {
										
                                          ?>   
                                         <div id='followu<?php echo $userid; ?>'>
                                        <a  id='followdata<?php echo $userid; ?>' href="javascript:void(0);" onclick="followuser(<?php echo $userid; ?>);" ><button   class="follow-userside ntwrk-flw-btn"> Follow  </button> </a> 
										
										<?php
										$otherid= base64_decode($profileid);
										$data=$CI->Users_model->checkhired($logid,$otherid);
								         $hirdeddata=$data['hiredid'];
										if($otherid==$hirdeddata)
										{
										?>
										 <a href="javascript:void(0);" id='hired' onclick="hiredusers('<?php echo $userid; ?>','<?php if($profile_result[0]['user_email']!="") { echo $profile_result[0]['user_email']; } ?>');"><button class="follow-userside ntwrk-hire-btn" id='hireduser'> Notified  </button></a>
										<?php 										
										}
										else
										{
										?>
										
                                         <a href="javascript:void(0);" id='hired' onclick="hiredusers('<?php echo $userid; ?>','<?php if($profile_result[0]['user_email']!="") { echo $profile_result[0]['user_email']; } ?>');"><button class="follow-userside ntwrk-hire-btn" id='hireduser'> Hire  </button></a>
										<?php
										}
                                         ?>
                                        </div>
                                             
                                          <?php   
                                         }
                                        }
                                         
                                         
                                         
                                         ?>
                           
                           
                           
                           
                           
                           
                            
                         <!-- <button class="follow-userside ntwrk-flw-btn"> Follow  </button>--> 
                          
                          
                          
                           <?php 
                            }
                            ?>
                          
                           </div>
                         
                             
                            <div class="prsnl-dtls"> <a href="#">
                             <p class="prfl-eml"> <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo ucfirst($profile_result[0]['user_email']); ?>  </p> </a>
                             
                           <a href="#">  <p class="prfl-eml"> <i class="fa fa-phone" aria-hidden="true"></i> <?php echo ucfirst($profile_result[0]['user_mobile']); ?>   </p> </a>
                             
                             </div>
                             
                             
                              <div class="col-lg-12 nopadd flwrs-show ">
                              
							  <?php
                                //print_r($profile_result[0]['id']);
								
								
							  ?>
                              
                              <div class="col-lg-6 nopadd flwrs-info flwr-padd prfl-edit-flw ">
                                  <a class="colchange" href="<?php echo base_url(); ?>UserNetwork/followers/<?php echo base64_encode($profile_result[0]['id']); ?>">Followers (<?php  echo $profile_result[0]['followers']; ?>)</a>
                              
                              </div>
                              
                              
                              
                                
                              <div class="col-lg-6 nopadd flwr-padd prfl-edit-flw edit-flwng">
                                  
                                  <a  class="colchange" href="<?php echo base_url(); ?>UserNetwork/following/<?php echo base64_encode($profile_result[0]['id']); ?>">Following (<?php   echo $profile_result[0]['following']; ?>)</a>
                              
                              </div>
                              
                              
                               </div>
                              
                              
                             </div> 
                             
                                                      
                             
                            <div class="clearfix"> </div>
                            
                            
                            </div>  
							
							
							 <!--Qualification-->
                            <div class="prsnl-allinfo-new qlfction">
							
							<div class="prfl-qulification-ttl">
							
							<h3> Qualification </h3>
							
							<a href="#" data-toggle="tooltip" data-placement="top" title="add your qualification">
							<?php
							$logid=$this->session->userdata('logid');
if($profile_result[0]['id']==$logid)
{	
							?>
							<i class="fa fa-plus add-icn" aria-hidden="true" id='addnewqual' ></i> 
							<?php
}
?>
							
							</a>

                            <div class="clearfix"> </div>
							
							</div>
							
							<ul class="col-lg-12 nopadd">
							<?php
							if(!empty($educationdetails))
							{
								foreach($educationdetails as $educationdetails)
								{
							?>
							<li class="col-lg-12 nopadd my-educations">
							<div class=" col-lg-4 nopadd">
				
							<div class="education-icn nopadd">

							 <i class="fa fa-university" aria-hidden="true"></i>  
							</div>
							
							</div>
							
							
							<div class=" col-lg-7 nopadd">
							<div class="prfl-edu-ttl"> <?php echo ucfirst($educationdetails['collegename']); ?>
							</div>
							
							<div class="prfl-edu-strm"> <?php echo ucfirst($educationdetails['qualification']); ?> </div>
							
							<div class="prfl-edu-year"> <?php $maindata=explode("/",$educationdetails['fromyear']); echo $maindata[2]; ?> - <?php  if($educationdetails['toyear']=='Present'){ echo $educationdetails['toyear'];} else { $data= explode("/",$educationdetails['toyear']) ; echo $data['2']; }?> </div>
							</div>
							<?php
							 $logid=$this->session->userdata('logid');
							 
							if($profile_result[0]['id']==$logid)
{
							 
							?>
							<div class=" col-lg-1 nopadd prfl-edu-edit">
							<button class="myBtnedu" name="editprofile" id="<?php echo $educationdetails['id']; ?>"> 
							
							
							 
							
							<i class="fa fa-pencil" aria-hidden="true"></i> </button>	
							</div>
							<?php 
							 }
							 ?>
							
							</li>
							
							
							
							
							
							<!-- EUU-->
							
							
							<!--- edu-->


	


							
							
							
							
							
							<?php
								}
							}
							else
							{
							?>
							
							<div class="prfl-edu-ttl"> Add Qualification.
							</div>
<?php						
							}
							?>
							
							
							
							
							</ul>
							
							
							
							
							
							 <div class="clearfix"> </div>
                            
                            </div> <!--end of prnl info-->
                            
                            <!--end of qualification-->


						  <div class="prsnl-allinfo-new">
							
							<div class="prfl-qulification-ttl">
							
							<h3> Experience </h3>
							
							<a href="#" data-toggle="tooltip" data-placement="top" title="add your qualification">
								<?php
								$logid=$this->session->userdata('logid');
								if($profile_result[0]['id']==$logid)
								{	
								?>
								<i class="fa fa-plus add-icn" aria-hidden="true" id="addnewexp" onclick="addnewexperice(<?php echo $profile_result[0]['id'];?>)" ></i> 
								<?php 
								}
								?>
							</a>

                            <div class="clearfix"> </div>
							
							</div>
							
							<ul class="col-lg-12 nopadd">
							<?php 
							if(!empty($experiencedetails))
							{
							foreach($experiencedetails as $expdetails)
							{
							?>
							<li class="col-lg-12 nopadd my-educations">
							<div class=" col-lg-4 nopadd">
							<div class="education-icn nopadd">
							 <i class="fa fa-briefcase" aria-hidden="true"></i> 
							</div>
							</div>
							
							
							<div class=" col-lg-7 nopadd">
							<div class="prfl-edu-ttl"><?php echo $expdetails['designation']; ?>
							</div>
							
							<div class="prfl-edu-strm"> <?php echo $expdetails['companyname']; ?> </div>
							
							<div class="prfl-edu-year">  <?php $maindate=explode("/",$expdetails['fromdate']); echo $maindate[2]; ?> -  <?php  
							if($expdetails['todate']!='Present')
							{
							 $todatemain=explode("/",$expdetails['todate']); echo $todatemain[2];
							}
							else
							{
								echo $expdetails['todate'];
							}


							?>  </div>
							</div>
							
							<?php
							$logid=$this->session->userdata('logid');	
							if($logid==$profile_result[0]['id'])
							{
							?>
							<div class=" col-lg-1 nopadd prfl-edu-edit">
							<button class="myBtnexpuser" id="<?php echo $expdetails['id']; ?>" name="myBtnexpuser">
							<i class="fa fa-pencil" aria-hidden="true"></i> </button>	
							</div>
							<?php 
							}
							?>
							
							
							</li>
							<?php
							}
							}
							else 
							{
								?>
								<div class="prfl-edu-ttl"> Add Experience.
							</div>
								<?php 
							}
							?>
												
					
							</ul>
							
							
							
							
							
							 <div class="clearfix"> </div>
                            
                            </div> <!-- experience-->
                            


                    </div><!-- End of profile col3-->

					
					
					
					
					
					

                    <div class="col-lg-9">



                        <div class="panel panel-primary">
                            <div class="panel-heading my-blg">

                                <div class="col-lg-12 nopadd">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs  nopadd">
                                       <li class="active col-lg-12 nopadd"><a href="#tab1" data-toggle="tab">Published</a></li>


                                    </ul>
                                    <div class="clearfix"> </div>
                                </div>


                            </div>
                            <div class="panel-body">
                                <div class="tab-content">

                                        <div class="tab-pane active" id="tab1">
                        
                           <div class="section">
				<div class="row">
					<div class="col-sm-12">
                        
                        
                        <div class="quotes-left">
                        
                          
                          <div class="clearfix"> </div>
                            
							<?php

if (!empty($userBlog)) {
	foreach($userBlog as $valdata)
	{
		
									$priority=$valdata['priority'];
									 $uid=$valdata['userid'];
									 
								
									if($priority==1)
									{
										$type='schooling';
									}
									if($priority==2)
									{
										$type='highereducation';
									}
									if($priority==3)
									{
										$type='research-others';
									}
									if($priority==4)
									{
										$type='general-news';
									}
									
									if($priority==8)
									{
										$type='inspiring-stories';
									}
									if($priority==7)
									{
										$type='quotes';
									}
									if($uid==41  || $uid=='admin' || $priority==5)
									{
										$type='blog';
									}
		
 ?>							
							
							
                            <div class="quote-dtl blg-pg">
                              <a href="<?php echo base_url(); ?><?php echo $type; ?>/<?php echo ($valdata['slug']); ?>/<?php echo base64_encode($valdata['id']); ?>">
                            <div class="col-lg-4 quote-image">
                                
                            <img src="<?php echo base_url(); ?>adminpanel/<?php echo $valdata['image']; ?>" alt="quote" width="100%" height="100%">
                            
                            </div>
                            
                            
                              <div class="col-lg-8 quots-txt">
                           
                                       <h3>
                                   
                                    <?php echo $valdata['page_title']; ?>
                                   
                                  
                                  </h3>      
                                   </a> 
                                  <div class="quote-info">
                                  <div class="entry-meta">
														<ul class="list-inline">
															<li class="posted-by"> <a href="#"> <i class="fa fa-user"></i><?php echo $valdata['author']; ?></a></li>
															<li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> <?php echo $valdata['readtime']; ?></a></li>
															<li class="views"><a href="#"><i class="fa fa-eye"></i><?php echo $valdata['click_count']; ?></a></li>
															<li class="loves"><a href="#"><i class="fa fa-heart-o"></i> <?php    echo $valdata['likes']; ?></a></li>
															
														</ul>
													</div>
                                      
                                      
                                       
                                      <div class="clearfix"> </div>
                                      
                                       <div class="quoter-para">
                                      <p>
                                        <?php echo substr($valdata['description'],0,150); ?>
                                      </p> 
                                      </div>
                                      
                                      
                                  </div>
                                  
                                  
                                  
                            </div><!--quotes txt-->
                            
                         
                                  <div class="clearfix"> </div>
                            </div> <!--quote dtl-->
							
							
							
							<?php 
}
?>
<div style="margin:left;"><?php echo '<div class="pagination">'.$links.'</div>'; ?></div>  
<?php
}
else
{
	?>
	
											<div class="tab-pane active" id="tab1">



												<center>No record found. </center>








											</div>
	<?php 	
		
	}
								?>
						  
								
									 
						  
								
								
								
									 
						  
								
								
								
								
								 
									 
						  
								
								
								
									  
						  
								
								
								
									  
						  
								
								
								
									 
								
								
								
								
								
						</div> <!--inspiring stories-left-->
							
							
						
							
							
							
							
						</div><!--/.col-sm-9 -->	
						
						
						
						
						
					
					
					
					</div>				
				</div><!--/.section-->
	 
								 
	 
	 
	 
	 
	 
				
							
							</div>

	



                                </div>
                            </div>
                        </div>

                    </div> <!--end col8-->


















                </div>

            </div>  <!-- End of profile row-->



        </div> 

    </div> <!--end of row--> 

</div><!--End section--> 





<div id="myModal" class="modal" id='profilearea'>

  <!-- Modal content -->
  <div class="modal-content">
     
  
  <div class="prfl-bg nopadd">
   <span class="close">&times;</span>
    
   <div class="edit-prfl-ttl"> <h1>Edit Profile</h1>
     	
        </div>
        
          <div class="col-md-12 upload-pic-profile">
      
      <div class="col-lg-4"> </div>
      
      
     
      
      
             
        <div class="text-center col-lg-4 upload-pic" id='newsnap'> 
     
		 
          <img id='userphoto' name='userphoto' src="<?php echo base_url(); ?>assets/images/prfl-pic.jpg" class="avatar img-circle" alt="avatar">
		  
	
         
        </div>
		
        
		<!--<div id="body-overlay"><div><img src="<?php //echo base_url() ?>assets/images/loader.gif" width="64px" height="64px"/></div></div>-->
        
        <div class="col-lg-4"> </div>
        
      </div>
      
      
      <div class="clearfix"> </div>
      
      </div>
      
	  
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
                <div class="alert alert-success alert-dismissable" >
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
            </div> 
	  
      
	<div class="row">
	
      <!-- left column -->
    <div id='showsuccessdata'></div>
      <!-- edit form column -->
      <div class="col-md-12 personal-info" >
        
    
        
        <form class="form-horizontal" role="form">
          <div class="form-group col-md-6">
            <label class="col-lg-3 control-label spacingcng" >Name:</label>
            <div class="col-lg-8 spacingcng">
              <input class="form-control" type="text" name="name" id="name" value="" autocomplete="off">
			  <div id='nameerror'></div>
            </div>
          </div>
          <input  type="hidden" name="updateid" id="updateid" value="">
          <div class="form-group col-md-6 spacingcng">
            <label class="col-lg-3 control-label">Occupation:</label>
            <div class="col-lg-8">
              <input class="form-control" name="Occupation" id="Occupation" type="text" value="" autocomplete="off">
			  <div id='Occupationerror'></div>
            </div>
          </div>
          
          
          <div class="form-group col-md-6 spacingcng">
            <label class="col-lg-3 control-label">BIO:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text"  name="bio" id="bio" value="" autocomplete="off">
			  <div id='bioerror'></div>
            </div>
          </div>
          
          
          <div class="form-group col-md-6 spacingcng">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="email" id="email" value="" autocomplete="off">
			    <div id='emailerror'></div>
            </div>
          </div>
          
          <div class="form-group col-md-6 spacingcng">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="number" name="phoneno" id="phoneno" value=""  autocomplete="off">
			    <div id='phonenoerror'></div>
			  
            </div>
          </div>
          
			<div id='processprofileloader' style="display:none; text-align: center;
			margin: 5px 45% !important;">
			<img src="<?php echo base_url(); ?>assets/images/loader.gif">
			</div>	
          
           
          <div class="form-group col-md-6 spacingcng">
            <label class="col-lg-3 control-label">DOB:</label>
            <div class="col-lg-8">
             
			 <input class="form-control" id="dob" name="dob" type="text" autocomplete="off"/>
			  
			   <div id='doberror'></div>
            </div>
          </div>
          
          
        
          
      
          
                    
          
          <div class="form-group col-md-6 spacingcng">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="password" id='password' value="" autocomplete="off">
			   <div id='passworderror'></div>
            </div>
          </div>
          <div class="form-group col-md-6 spacingcng">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="cpassword" id="cpassword" value="" autocomplete="off">
			  <div id='cpassworderror'></div>
            </div>
          </div>
		  
          <div class="form-group col-md-12">
           
            <div class="col-md-12">
            <div class="edit-profile-btns">
              <input type="button" name="submit" value="submit" onclick="updateprofile()" class="btn btn-primary">
              <span></span>
              <!--<input type="reset" class="btn btn-default prfl-cancel" id='cancelprofile' onclick="canceldata();" value="Cancel">-->
              </div>
              
            </div>
          </div>
        </form>
      </div>
  </div>

<hr>
    
    
  </div>

</div>



<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
     
  
  <div class="prfl-bg nopadd">
   <span class="close1">&times;</span>
    
   <div class="edit-prfl-ttl eductn "> <h1 class="ttl-sub">Edit qualification</h1>
     	
        </div>
        
   
      
      <div class="clearfix"> </div>
      
      </div>
      
      
	<div class="row">
      <!-- left column -->
    
      <!-- edit form column -->
      <div class="col-md-12 personal-info">
        
    
        
        <form class="form-horizontal" role="form" method="post" action="">
		
		
		<div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Title:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="title" id='title' autocomplete="off">
            </div>
			<div id='editqualtitleerror'></div>
          </div>
          
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">School:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="schoolname" id='schoolname' autocomplete="off">
            </div>
			<div id='editschoolnametitleerror'></div>
          </div>
		
		
		
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Address:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="address" id="address" autocomplete="off" >
            </div>
			<div id='editaddresstitleerror'></div>
          </div>
          
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Description:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" id="description" name="description" autocomplete="off">
            </div>
			<div id='editdescriptiontitleerror'></div>
          </div>
				<div id='deletequalificationprocess' style="display:none; text-align: center;
				margin: 5px 45% !important;">
				<img src="<?php echo base_url(); ?>assets/images/loader.gif">
				</div>
          
				<div class="form-group frm-pddng col-md-6">
				<label class="col-lg-3 control-label pdng">From Year:</label>
				<div class="col-lg-8">

				<?php

				$startdate = 1960;

				//year to end with - this is set to current year. You can change to specific year
				$enddate = date("Y");

				$years = range ($startdate,$enddate);

				
				
				?>
				
				<select class="form-control optn" name="frmyeardata" id="frmyeardata">
				<option value="Year">Year</option>
				<?php
				foreach($years as $year)
				{
				?>
				<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
				<?php
				}

				?>
				

				</select>

				<div id='editqualfromyearerror'></div>

				</div>
				</div>
          
          
          <div class="form-group frm-pddng col-md-6" >
            <label class="col-lg-3 control-label pdng">To Year: </label>
            <div class="col-lg-8">
              
		<select class="form-control optn" name="toyeardata" id='toyeardata'>
		<option value="Year">Year</option>
		<?php
		foreach($years as $year)
		{
		?>
		<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
		<?php
		}

		?>

		</select>
		<div id='editttoyeardatayearerror'></div>
  
            </div>
          </div>
         
          
          <!--<div class="form-group  col-md-12">

	<div class="col-md-12">
	<div class="chkbx">

	<input type="checkbox" name="editcurrentlyworkhere" id='editcurrentlyworkhere' value=""> I currently work here

	</div>

	</div>


	</div>-->
           
      <script>


$('#editcurrentlyworkhere').click(function() {
  if ($(this).is(':checked')) {
   
	$("#edittoyear").attr('disabled', true); 
	$("#editcurrentlyworkhere").val("Present");
  }
  else
  {
	 
	$("#edittoyear").attr('disabled', false); 
	$("#editcurrentlyworkhere").val("");
  }
});



</script>    
        
          <div class="form-group frm-pddng col-md-12">
            
            <div class="col-md-12">
            <div class="edit-profile-btns">
			<input type="hidden" name="deletedid" id="deletedid" value="">
              <input type="button" name="submit"  class="btn btn-primary" value="Save" onclick="updatequalification();">
			  <input type="button" name="delete" onclick="deletequalification();"  class="btn btn-primary" value="Delete">
              <span></span>
              
              
            </div>
          </div>
        </form>
      </div>
  </div>

<hr>
    
    
  </div>

</div>
</div>
 
	<!-- add new quali-->
	<div id="myModalnewqual" class="modal">

	
	<div class="modal-content">
	
	
	<div class="prfl-bg nopadd">
   <span class="closeqal">&times;</span>
    
   <div class="edit-prfl-ttl eductn "> <h1 class="ttl-sub">Add qualification</h1>
     	
        </div>
        
   
      
      <div class="clearfix"> </div>
      
      </div>
      
      
	<div class="row">
      <!-- left column -->
    
      <!-- edit form column -->
      <div class="col-md-12 personal-info">
        
		<div id='datavalqual'></div>
        
        <form class="form-horizontal" role="form" method="post" action="">
		
		
		<div class="col-md-6">
            <label class="col-lg-3 control-label pdng">Title:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="addtitle" id='addtitle' autocomplete="off">
			  <div id='titleerror'></div>
            </div>
			
          </div>
          
          <div class=" col-md-6">
            <label class="col-lg-3 control-label pdng">School:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="addschoolname" id='addschoolname' autocomplete="off">
			  <div id='schoolnameerror'></div>
            </div>
          </div>
		
		
		
          <div class="col-md-6">
            <label class="col-lg-3 control-label pdng">Address:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="addaddress" id="addaddress" autocomplete="off" >
			   <div id='addresserror'></div>
            </div>
          </div>
          
          <div class="col-md-6">
            <label class="col-lg-3 control-label pdng">Description:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" id="adddescription" name="adddescription" autocomplete="off" >
			   <div id='descriptionerror'></div>
            </div>
          </div>
          
          
				<div class="col-md-6" >
				<label class="col-lg-3 control-label pdng">From Year:</label>
				<div class="col-lg-8">

				<?php

				$startdate = 1960;

				//year to end with - this is set to current year. You can change to specific year
				$enddate = date("Y");

				$years = range ($startdate,$enddate);

				
				
				?>
				
				<select class="form-control optn" id='addfrmyeardata' name='addfrmyeardata'>
				<option value="0">Year</option>
				<?php
				foreach($years as $year)
				{
				?>
				<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
				<?php
				}

				?>
				

				</select>
				<div id='addfromyeardataerror'></div>


				</div>
				</div>
          
          
          <div class=" col-md-6">
            <label class="col-lg-3 control-label pdng">To Year: </label>
            <div class="col-lg-8">
              
		<select class="form-control optn" name="addtoyeardata" id='addtoyeardata'>
		<option value="0">Year</option>
		<?php
		foreach($years as $year)
		{
		?>
		<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
		<?php
		}

		?>

		</select>
		<div id='addtoyeardataerror'></div>
  
            </div>
          </div>
         
             <div class="form-group  col-md-12">

	<!--<div class="col-md-12">
	<div class="chkbx">

	<input type="checkbox" name="addnewcurrentlyworkhere" id='addnewcurrentlyworkhere' value=""> I currently work here

	</div>

	</div>-->


	</div>
          
           
          
        
          <div class="form-group frm-pddng col-md-12">
            
            <div class="col-md-12">
            <div class="edit-profile-btns">
              <input type="button" name="submit"  class="btn btn-primary" value="Save" onclick="addnewqualification(<?php echo $profile_result[0]['id']; ?>)">
              <span>
			  
			  </span>
              
              
            </div>
          </div>
        </form>
      </div>
  </div>

<hr>
    
    
  </div>
	
	
	
	</div>
	</div>
	
	
	
	<!--end new quali-->
 
 <script>


$('#addnewcurrentlyworkhere').click(function() {
  if ($(this).is(':checked')) {
  
	$("#addtoyeardata").attr('disabled', true); 
	$("#addnewcurrentlyworkhere").val("Present");
  }
  else
  {
	
	$("#addtoyeardata").attr('disabled', false); 
	$("#addnewcurrentlyworkhere").val("");
  }
});



</script>
 
   
   
   
	<!-- Add new exp-->

	<div id="myModalnewexp" class="modal">

	
	<div class="modal-content">

	<div class="prfl-bg nopadd">
	<span class="closeexp">&times;</span>

	<div class="edit-prfl-ttl eductn "> <h1 class="ttl-sub">Add Experience</h1>
	
	</div>



	<div class="clearfix"> </div>

	</div>
	<div id='addedprocess'></div>
	<div class="row">
	
	<div class="col-md-12 personal-info">



	<form class="form-horizontal" role="form">
	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">Title:</label>
	<div class="col-lg-8">
	<input class="form-control" name="addexptitle" id='addexptitle' autocomplete="off" type="text" value="">
	<div id='titleexpdataerror'></div>
	</div>
	
	</div>

	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">Company:</label>
	<div class="col-lg-8">
	<input class="form-control" name="addexpcompany" id='addexpcompany'  autocomplete="off" type="text" value="">
	<div id='addexpcompanyerror'></div>
	</div>
	
	</div>


	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">Location:</label>
	<div class="col-lg-8">
	<input class="form-control" type="text"  name="addexplocation"   autocomplete="off" id='addexplocation' value="">
	<div id="addexplocationerror"></div>
	</div>
	
	</div>

<div id='processaddnewexperience' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>

	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">Description:</label>
	<div class="col-lg-8">
	<input class="form-control" type="text" name="addexpdescription"  autocomplete="off" id='addexpdescription'  value="">
	<div id="addexpdescriptionerror"></div>
	</div>
	
	</div>

	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">From:</label>
	<div class="col-lg-4">
	<select class="form-control optn" name="addexpfrommonth" id='addexpfrommonth'  autocomplete="off">
	<option value="0">Month</option>
		<?php

		for ($i = 1; $i <= 12; $i++)
		{
		$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
		?>
		
		<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo ucfirst($month_name); ?></option>
		<?php 
		}
		?>

	</select>
	<div id="addexpfrommontherror"></div>
	</div>

	<div class="col-lg-4">

	<select class="form-control optn" name="addexpfromyear" id='addexpfromyear'  autocomplete="off">
	<option value="0">Year</option>
	<?php

				$startdate = 1960;

				
				$enddate = date("Y");

				$years = range ($startdate,$enddate);

				
				foreach($years as $year)
				{
				?>
				<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
				<?php
				}

				?>

	</select>
	
	<div id="addexpfromyearerror"></div>


	</div>

	</div>


	<div class="form-group frm-pddng col-md-6">
	<label class="col-lg-4 control-label pdng">To: </label>



	<div class="col-lg-4">

	<select class="form-control optn" name="addexptomonth" id="addexptomonth"  autocomplete="off">
	<option value="0">Month</option>
	
	
		<?php

		for ($i = 1; $i <= 12; $i++)
		{
		$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
		?>
		
		<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo ucfirst($month_name); ?></option>
		<?php 
		}
		?>

	</select>
	<div id="addexptomontherror"></div>

	



	</div>

	<div class="col-lg-4">

	<select class="form-control optn" name="addexptoyear" id="addexptoyear"  autocomplete="off">
	<option value="0">Year</option>
	<?php

				$startdate = 1960;

				
				$enddate = date("Y");

				$years = range ($startdate,$enddate);

				
				foreach($years as $year)
				{
				?>
				<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
				<?php
				}

				?>

	</select>

<div id="addexptoyearerror"></div>

	</div>


	</div>

	<div class="form-group  col-md-12">

	<div class="col-md-12">
	<div class="chkbx">

	<input type="checkbox" name="currentlyworkhere" id='currentlyworkhere' value=""> I currently work here

	</div>

	</div>


	</div>

<script>


$('#currentlyworkhere').click(function() {
  if ($(this).is(':checked')) {
   $("#addexptomonth").attr('disabled', true); 
	$("#addexptoyear").attr('disabled', true); 
	$("#currentlyworkhere").val("Present");
  }
  else
  {
	 $("#addexptomonth").attr('disabled', false); 
	$("#addexptoyear").attr('disabled', false); 
	$("#currentlyworkhere").val("");
  }
});






</script>



	<div class="form-group frm-pddng col-md-12">

	<div class="col-md-12">
	<div class="edit-profile-btns">
	<input type="button" class="btn btn-primary" name="submit"  onclick="addnewexperience(<?php echo $profile_result[0]['id']; ?>)" value="Save">
	<span></span>
	
	</div>

	</div>


	</div>
	</form>
	</div>
	</div>
	</div>
	</div>



<!----Start Experience---->
	
	
	<div id="myModal4" class="modal4">

  <!-- Modal content -->
  <div class="modal4-content">
     
  
  <div class="prfl-bg nopadd">
   <span class="close2">&times;</span>
    
   <div class="edit-prfl-ttl eductn "> <h1 class="ttl-sub">Edit Experience</h1>
     	
        </div>
        
   
      
      <div class="clearfix"> </div>
      
      </div>
      
      
	<div class="row">
	<div id='showexpData'></div>
      <!-- left column -->
    
      <!-- edit form column -->
      <div class="col-md-12 personal-info">
        
      <div id='Updateexpprocessmsgshow'></div>
        
        <form class="form-horizontal" role="form">
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Title:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" id="edittitle" name="edittitle" autocomplete="off" value="">
            </div>
			<div id='edittitleerror'></div>
          </div>
          
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Company:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text"  name="editcompanyname" id="editcompanyname" autocomplete="off" value="">
            </div>
			<div id='editcompanynameerror'></div>
          </div>
		  
		  
		  <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Location:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="editlocation" id="editlocation" autocomplete="off" value="" >
            </div>
			<div id="editlocationerror"></div>
          </div>
		  
		  
		  
		  <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">Description:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="" name="editdescription" id="editdescription" autocomplete="off" value="">
            </div>
			<div id="editdescriptionerror"></div>
          </div>
		  
		  
		  
		  <div id='processdel' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>	
		  
		    <div id='Updateexpprocess' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>
          
          
		<div class="form-group frm-pddng col-md-6">
		<label class="col-lg-3 control-label pdng">From:</label>


		<div class="col-lg-4">

		<select class="form-control optn" name="editfromexpmonth" id="editfromexpmonth">
		<?php

		for ($i = 1; $i <= 12; $i++)
		{
		$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
		?>
		
		<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo ucfirst($month_name); ?></option>
		<?php 
		}
		?>

		</select>
			  
			<div id="editfromexpmontherror"></div>  
			  
            </div>
			
			
			
			
			
			
            <div class="col-lg-4">
              
			  <select class="form-control optn" name="editfromexpYear" id="editfromexpYear">
  <option value="Year">Year</option>
	<?php

	$startdate = 1960;


	$enddate = date("Y");

	$years = range ($startdate,$enddate);


	foreach($years as $year)
	{
	?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php
	}

	?>
 
</select>
<div id="editfromexpYearerror"></div>
			  
			  
			  
            </div>
			
			
			
			
			
          </div>
          
          
          <div class="form-group frm-pddng col-md-6">
            <label class="col-lg-3 control-label pdng">To: </label>
			

			
		<div class="col-lg-4">

		<select class="form-control optn" name="editexptomonth" id="editexptomonth">
		<?php

		for ($i = 1; $i <= 12; $i++)
		{
		$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
		?>
		
		<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo ucfirst($month_name); ?></option>
		<?php 
		}
		?>


		</select>

		<div id="editexptomontherror"></div>

		</div>
			
			
			
			
			
			
<div class="col-lg-4">

<select class="form-control optn" name="editexptoyear" id="editexptoyear">
<option value="Year">Year</option>
<?php

$startdate = 1960;


$enddate = date("Y");

$years = range ($startdate,$enddate);


foreach($years as $year)
{
?>
<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
<?php
}

?>

</select>

<div id="editexptoyearerror"></div>

</div>
			

		</div>
          
          <div class="form-group  col-md-12">
            
            <div class="col-md-12">
            <div class="chkbx">
			
           <input type="checkbox"id="editexpworkinghere" name="editexpworkinghere" value="" onclick="filldataexp();"> I currently work here
		   
              </div>
              
            </div>
			
			
          </div>
          
           <script>
				$('#editexpworkinghere').click(function() {
				
				if ($(this).is(':checked')) {
				
				$("#addexptomonth").attr('disabled', true); 
				$("#addexptoyear").attr('disabled', true); 
				$("#editexpworkinghere").val("Present");
				}
				else
				{
				
				$("#addexptomonth").attr('disabled', false); 
				$("#addexptoyear").attr('disabled', false); 
				$("#editexpworkinghere").val("");
				}
				});
		   </script>
          
        
          <div class="form-group frm-pddng col-md-12">
            
            <div class="col-md-12">
            <div class="edit-profile-btns">
			<input type="hidden" name="deletedexpid" id="deletedexpid" value="">
              <input type="button" class="btn btn-primary" value="Save" onclick="updateuserexperience();">
              <span></span>
              <input type="reset" class="btn btn-default prfl-cancel" value="Delete" onclick="deleteuserexperience();">
              </div>
              
            </div>
			
			
          </div>
        </form>
      </div>
  </div>

<hr>
    
    
  </div>

</div>





    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> 
	
<script>
        function followuser(userid)
        {
        $.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/followuserData",
		data:{userid:userid},
		beforeSend:function(){
		$('#process').show();
		
		
		}

		,success:function(response){
		if(response==1)
                {
                    
                    
                    $("#followu"+userid).html('<a  id="unfollowdata'+userid+' href="javascript:void(0);" onclick="unfollowData('+userid+');" ><button   class="follow-userside ntwrk-flw-btn"> Following  </button> </a>  <button class="follow-userside ntwrk-hire-btn"> Hire  </button>');
                     window.location.reload();
                }
		
		
		
		}});
            
            
            
    }
    
    
    function unfollowData(userid)
            {
                
        $.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/unfollowuserData",
		data:{userid:userid},
		beforeSend:function(){
		$('#process').show();
		
		
		}

		,success:function(response){
		if(response==1)
                {
                  
                    $("#followu"+userid).html('<a  id="followdata'+userid+' href="javascript:void(0);" onclick="followuser('+userid+');" ><button   class="follow-userside ntwrk-flw-btn"> Follow  </button> </a>  <button class="follow-userside ntwrk-hire-btn"> Hire  </button>');
                     window.location.reload();
                }
		
		
		
		}});
                
            }
        </script>
		
		<script>
		
		function addnewexperience(addnewqualid)
		{
		var addnewqualid=addnewqualid;
		var addexptitle=$("#addexptitle").val();
		var addexpcompany=$("#addexpcompany").val();
		var addexplocation=$("#addexplocation").val();
		var addexpdescription=$("#addexpdescription").val();
		var addexpfrommonth=$("#addexpfrommonth").val();
		var addexpfromyear=$("#addexpfromyear").val();
		var addexptomonth=$("#addexptomonth").val();
		var addexptoyear=$("#addexptoyear").val();
		var currentlyworkhere=$("#currentlyworkhere").val();
		
		
		if(addexptitle=="")
		{
			
			$("#titleexpdataerror").html("Please enter title.");
			$("#addexptitle").focus();
			$("#addexptitle").css("borderColor", "red");
			$("#titleexpdataerror").css("color", "red");
			$("#titleexpdataerror").css("text-align", "center");
			return false;
		}
		else
		{
			$("#titleexpdataerror").html("");
			$("#addexptitle").css("borderColor", "");
		}
		
		
		if(addexpcompany=="")
		{
			
			$("#addexpcompanyerror").html("Please enter company name.");
			$("#addexpcompany").focus();
			$("#addexpcompanyerror").css("color", "red");
			$("#addexpcompanyerror").css("borderColor", "red");
			$("#addexpcompanyerror").css("text-align", "center");
			
			return false;
		}
		else
		{
			
			$("#addexpcompany").css("borderColor", "");
			$("#addexpcompanyerror").html("");
		}
		
		
		if(addexplocation=="")
		{
			
			$("#addexplocation").focus();
			$("#addexplocationerror").html("Please enter location.");
			$("#addexplocationerror").css("color", "red");
			$("#addexplocationerror").css("borderColor", "red");
			$("#addexplocationerror").css("text-align", "center");			
			return false;
		}
		else
		{
			$("#addexplocationerror").html("");			
			$("#addexplocation").css("borderColor", "");
		}
		
		if(addexpdescription=="")
		{
			$("#addexpdescriptionerror").html("Please enter description.");
			$("#addexpdescriptionerror").css("color", "red");
			$("#addexpdescriptionerror").css("borderColor", "red");
			$("#addexpdescriptionerror").css("text-align", "center");		
			$("#addexpdescription").focus();
				
			return false;
		}
		else
		{
			$("#addexpdescriptionerror").html("");
			$("#addexpdescription").css("borderColor", "");
		}
		
		
		if(addexpfrommonth=="0")
		{
			
			$("#addexpfrommontherror").html("Please select from month.");
			$("#addexpfrommontherror").css("borderColor", "red");
			$("#addexpfrommontherror").css("text-align", "center");	
			$("#addexpfrommontherror").css("color", "red");
			$("#addexpfrommonth").focus();
			$("#addexpfrommonth").css("borderColor", "red");		
			return false;
		}
		else
		{
			$("#addexpfrommontherror").html("");
			$("#addexpfrommonth").css("borderColor", "");
		}
		
		
		if(addexpfromyear=="0")
		{
			$("#addexpfromyearerror").html("Please select from Year.");
			$("#addexpfromyearerror").css("borderColor", "red");
			$("#addexpfromyearerror").css("color", "red");
			$("#addexpfromyearerror").css("text-align", "center");	
			$("#addexpfromyear").focus();
				
			return false;
		}
		else
		{
			
			
			$("#addexpfromyearerror").html("");
			$("#addexpfromyear").css("borderColor", "");
		}
		
		if($('#currentlyworkhere').attr('checked', false) && currentlyworkhere!='Present')
		{
			var addexptomonth=$("#addexptomonth").val();
			
			
			if(addexptomonth=="0")
			{
			
			$("#addexptomontherror").html("Please select to Month.");
			$("#addexptomontherror").css("borderColor", "red");
			$("#addexptomontherror").css("color", "red");
			$("#addexptomontherror").css("text-align", "center");	
			$("#addexptomonth").focus();
			$("#addexptomonth").css("borderColor", "red");		
			return false;
		}
		else
		{
			$("#addexptomontherror").html("");
			$("#addexptomonth").css("borderColor", "");
		}
		
		if($('#addnewcurrentlyworkhere').attr('checked', false) && currentlyworkhere!='Present')
		{
		var addexptoyear=$("#addexptoyear").val();
		if(addexptoyear=="0")
		{
			
			$("#addexptoyearerror").html("Please select to year.");
			$("#addexptoyearerror").css("borderColor", "red");
			$("#addexptoyearerror").css("color", "red");
			$("#addexptoyearerror").css("text-align", "center");	
			
			$("#addexptoyear").focus();
			$("#addexptoyear").css("borderColor", "red");		
			return false;
		}
		else
		{
			$("#addexptoyearerror").html("");
			$("#addexptoyear").css("borderColor", "");
		}
		}
			
			
		}
		
		
		$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/addnewexperience",
		data:{addnewqualid:addnewqualid,addexptitle:addexptitle,addexpcompany:addexpcompany,addexplocation:addexplocation,addexpdescription:addexpdescription,addexpfrommonth:addexpfrommonth,addexpfromyear:addexpfromyear,addexptomonth:addexptomonth,addexptoyear:addexptoyear,currentlyworkhere:currentlyworkhere},
		beforeSend:function(){
		
		$('#processaddnewexperience').show();
		}

		,success:function(response){
		
		$("#addedprocess").html(response); 
		location.reload();
		$('#processaddnewexperience').hide();
		 
		
		}}); 
		
		}
		</script>
		
		
		
		
		
		
		
		
		
		
		<script>
		function addnewqualification(addnewqualid)
		{
			
	
		var addnewqualid=addnewqualid;
		var title=$("#addtitle").val();
		var schoolname=$("#addschoolname").val();
		var address=$("#addaddress").val();
		var description=$("#adddescription").val();
		var frmyeardata=$("#addfrmyeardata").val();
		var toyeardata=$("#addtoyeardata").val();	
		var addnewcurrentlyworkhere=$("#addnewcurrentlyworkhere").val();
		
		
		
		if(title=="")
		{
			var nameerro="Please enter qualification title!";
			$("#titleerror").html(nameerro);
			$("#addtitle").focus();
			$("#addtitle").css("borderColor", "red");
			$("#titleerror").css("color", "red");
			$("#titleerror").css("text-align", "center");
			return false;
		}
		
		
		else if (!/^[a-zA-Z]*$/g.test(title)) 
		{
		var nameerro="Please enter characters only!";
		$("#titleerror").html(nameerro);
		$("#addtitle").focus();
		$("#addtitle").css("borderColor", "red");
		$("#titleerror").css("color", "red");
		$("#titleerror").css("text-align", "center");
		
		return false;
		}
		
		
		
		else if(schoolname=="")
		{
			var nameerro="Please enter schoolname!";
			$("#schoolnameerror").html(nameerro);
			$("#addschoolname").focus();
			$("#addschoolname").css("borderColor", "red");
			$("#schoolnameerror").css("color", "red");
			return false;
		}
		
		
		
		else if (!/^[a-zA-Z]*$/g.test(schoolname)) 
		{
		var nameerro="Please enter characters only!";
		$("#schoolnameerror").html(nameerro);
		$("#addschoolname").focus();
		$("#addschoolname").css("borderColor", "red");
		$("#schoolnameerror").css("color", "red");
		$("#schoolnameerror").css("text-align", "center");
		
		return false;
		}
		
		
		else if(address=="")
		{
			var nameerro="Please enter address!";
			$("#addresserror").html(nameerro);
			$("#addaddress").focus();
			$("#addaddress").css("borderColor", "red");
			$("#addresserror").css("color", "red");
			return false;
		}
		
		
		else if(description=="")
		{
			var nameerro="Please enter description!";
			$("#descriptionerror").html(nameerro);
			$("#adddescription").focus();
			$("#adddescription").css("borderColor", "red");
			$("#descriptionerror").css("color", "red");
			return false;
		}
		
		
		
		
		
		else if(frmyeardata==0)
		{
			var nameerro="Please select from year!";
			$("#addfromyeardataerror").html(nameerro);
			$("#addfrmyeardata").focus();
			$("#addfrmyeardata").css("borderColor", "red");
			$("#addfromyeardataerror").css("color", "red");
			return false;
		}
		
		
		
		else if($('#addnewcurrentlyworkhere').attr('checked', false) && $('#addnewcurrentlyworkhere').val()!='Present' )
		{
		var toyeardata=$("#addtoyeardata").val();	
		if(toyeardata==0)
		{
			var nameerro="Please select to year!";
			$("#addtoyeardataerror").html(nameerro);
			$("#addtoyeardata").focus();
			$("#addtoyeardata").css("borderColor", "red");
			$("#addtoyeardataerror").css("color", "red");
			return false;
		}
		
		}
		else 
		{
		
		
			
		$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/addnewqualification",
		data:{addnewqualid:addnewqualid,title:title,schoolname:schoolname,address:address,description:description,frmyeardata:frmyeardata,toyeardata:toyeardata,addnewcurrentlyworkhere:addnewcurrentlyworkhere},
		beforeSend:function(){
		$('#process').show();}

		,success:function(response){
		
		$("#datavalqual").html(response); 
		
		$("#datavalqual").addClass("alert alert-success alert-dismissable");
		location.reload();
		 
		
		}}); 
			
			
		}
			
		}
		</script>
		
		

<!-- edcucation-->
<script>

function deletequalification()
{
	
	var deleteid=$("#deletedid").val();
	$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/deletequalification",
		
		data:{deleteid:deleteid},
		beforeSend:function(){
		$('#deletequalificationprocess').show();}

		,success:function(response){
			$('#deletequalificationprocess').hide();
			location.reload();


		}});
	
	
}


function updateuserexperience()
{
	var updateid=$("#deletedexpid").val();
	
	var edittitle=$("#edittitle").val();
	var editcompanyname=$("#editcompanyname").val();	
	var editlocation=$("#editlocation").val();
	var editdescription=$("#editdescription").val();
	var editfromexpmonth=$("#editfromexpmonth").val();
	var editfromexpYear=$("#editfromexpYear").val();
	var editexpworkinghere=$("#editexpworkinghere").val();
	var editexptomonth=$("#editexptomonth").val();
	var editexptoyear=$("#editexptoyear").val()
	
	if(edittitle=="")
	{
	$("#edittitleerror").html("Please enter title");
	$("#edittitle").focus();
	$("#edittitle").css("borderColor", "red");
	$("#edittitleerror").css("borderColor", "red");
	$("#edittitleerror").css("color", "red");
	$("#edittitleerror").css("text-align", "center");	
	return false;
	}
	else
	{
	$("#edittitleerror").html("");
	$("#titleerror").html("");
	$("#edittitle").css("borderColor", "");
	}
	
	
	if(editcompanyname=="")
	{
	$("#editcompanynameerror").css("text-align", "center");	
	$("#editcompanynameerror").css("color","red");	
	$("#editcompanynameerror").html("Please enter companyname");
	$("#editcompanyname").focus();
	$("#editcompanyname").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editcompanynameerror").html("");
	$("#editcompanyname").css("borderColor", "");
	}
	
	if(editlocation=="")
	{
	$("#editlocationerror").html("Please enter location");
	$("#editlocationerror").css("text-align", "center");	
	$("#editlocationerror").css("color","red");	
	$("#editlocation").focus();
	$("#editlocation").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editlocationerror").html("");
	$("#editlocation").css("borderColor", "");
	}
	
	
	if(editdescription=="")
	{
	$("#editdescriptionerror").html("Please enter description");
	$("#editdescriptionerror").css("text-align", "center");	
	$("#editdescriptionerror").css("color","red");	
	$("#editdescription").focus();
	$("#editdescription").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editdescriptionerror").html("");
	
	$("#editdescription").css("borderColor", "");
	}
	
	
	if(editfromexpmonth=="0")
	{
	$("#editfromexpmontherror").html("Please select month");
	$("#editfromexpmontherror").css("text-align", "center");	
	$("#editfromexpmontherror").css("color","red");	
	
	$("#editfromexpmonth").focus();
	$("#editfromexpmonth").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editfromexpmontherror").html("");
	$("#editfromexpmonth").css("borderColor", "");
	}
	
	if(editfromexpYear=="0")
	{
	$("#editfromexpYearerror").html("Please select year");
	$("#editfromexpYearerror").css("text-align", "center");	
	$("#editfromexpYearerror").css("color","red");	
	$("#editfromexpYear").focus();
	$("#editfromexpYear").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editfromexpYearerror").html("");
	$("#editfromexpYear").css("borderColor", "");
	}
	
	if(editexpworkinghere!='Present')
	{
	
	if(editexptomonth=="0")
	{
	
	$("#editexptomontherror").html("Please select month");
	$("#editexptomontherror").css("text-align", "center");	
	$("#editexptomontherror").css("color","red");	
	$("#editexptomonth").focus();
	$("#editexptomonth").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editexptomontherror").html("");
	$("#editexptomonth").css("borderColor", "");
	}
	
	if(editexptoyear=="0")
	{
	$("#editexptoyearerror").html("Please enter year");
	$("#editexptoyearerror").css("text-align", "center");	
	$("#editexptoyearerror").css("color","red");	
	$("#editexptoyear").focus();
	$("#editexptoyear").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editexptoyearerror").html("");
	$("#editexptoyear").css("borderColor", "");
	}
	}
	
	
	
	
	
	
	$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/updateexperienceData",
		
		data:{updateid:updateid,edittitle:edittitle,editcompanyname:editcompanyname,editlocation:editlocation,editdescription:editdescription,editfromexpmonth:editfromexpmonth,editfromexpYear:editfromexpYear,editexptomonth:editexptomonth,editexptoyear:editexptoyear,editexpworkinghere:editexpworkinghere},
		beforeSend:function(){
		$('#Updateexpprocess').show();}

		,success:function(response){
			$('#Updateexpprocess').hide();
			$("#Updateexpprocessmsgshow").html(response);
			$("#Updateexpprocessmsgshow").show();
			$("#Updateexpprocessmsgshow").addClass("alert alert-success alert-dismissable");
			location.reload();


		}});
	
	
	
	
	
	
	
}


function updatequalification()
{
	
	
	var updateid=$("#deletedid").val();
	var title=$("#title").val();
	var schoolname=$("#schoolname").val();	
	var address=$("#address").val();
	var description=$("#description").val();
	var editfromyear=$("#frmyeardata").val();
	
	var edittoyear=$("#toyeardata").val();
	var editcurrentlyworkhere=$("#editcurrentlyworkhere").val();
	
	
	if(title=="")
	{
	$("#editqualtitleerror").html("Please enter title.");
	$("#editqualtitleerror").css("text-align", "center");
	$("#editqualtitleerror").css("color", "red");
	$("#title").focus();
	$("#title").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editqualtitleerror").html("");
	$("#title").css("borderColor", "");
	}
	
	
	if(schoolname=="")
	{
	$("#editschoolnametitleerror").html("Please enter school name.");
	$("#editschoolnametitleerror").css("text-align", "center");
	$("#editschoolnametitleerror").css("color", "red");
	$("#schoolname").focus();
	$("#schoolname").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editschoolnametitleerror").html("");
	$("#schoolname").css("borderColor", "");
	}
	
	if(address=="")
	{
	$("#editaddresstitleerror").html("Please enter address.");
	$("#editaddresstitleerror").css("text-align", "center");
	$("#editaddresstitleerror").css("color", "red");

	$("#address").focus();
	$("#address").css("borderColor", "red");
	return false;
	}
	else
	{
	
	$("#address").css("borderColor", "");
	}
	
	if(description=="")
	{
	$("#editdescriptiontitleerror").html("Please enter description.");
	$("#editdescriptiontitleerror").css("text-align", "center");
	$("#editdescriptiontitleerror").css("color", "red");

	$("#description").focus();
	$("#description").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editdescriptiontitleerror").html("");
	$("#description").css("borderColor", "");
	}
	
	if(editfromyear==0)
	{
	$("#editqualfromyearerror").html("Please select from year.");
	$("#editqualfromyearerror").css("text-align", "center");
	$("#editqualfromyearerror").css("color", "red");
	
	$("#editfromyear").focus();
	$("#editfromyear").css("borderColor", "red");
	return false;
	}
	else
	{
	$("#editqualfromyearerror").html("");
	$("#editfromyear").css("borderColor", "");
	}
	
	if(editcurrentlyworkhere!='Present')
	{
	if(edittoyear=="0")
	{
	$("#editttoyeardatayearerror").html("Please select to year.");
	$("#editttoyeardatayearerror").css("text-align", "center");
	$("#editttoyeardatayearerror").css("color", "red");

	$("#toyeardata").focus();
	$("#toyeardata").css("borderColor", "red");
	return false;
	}
	else
	{
	
	$("#toyeardata").css("borderColor", "");
	}
	}
	
	
	
	
	$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/updatequalification",
		
		data:{updateid:updateid,title:title,schoolname:schoolname,address:address,description:description,editfromyear:editfromyear,edittoyear:edittoyear,editcurrentlyworkhere:editcurrentlyworkhere},
		beforeSend:function(){
		$('#deletequalificationprocess').show();}

		,success:function(response){
			$('#deletequalificationprocess').hide();
			location.reload();


		}});
	
}




$(document).ready(function() {
$(".myBtnedu").button().on( "click", function() {
		openEditBox($(this).attr("id"));
	});
});

function openEditBox(editid)	
{

// Get the modal
var modal1 = document.getElementById('myModal2');



// Get the button that opens the modal
var btn = document.getElementById(editid);

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal1.style.display = "block";
	
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal1.style.display = "none";
	//window.location.reload();
}

window.onclick = function(event) {
   
	var modal1 = document.getElementById('myModal2');
	
	 if (event.target == modal1) {
		
        modal1.style.display = "none";
		
    }
}



		$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/editqualification",
		
		data:{editid:editid},
		beforeSend:function(){
		$('#process').show();}

		,success:function(response){
		
			res = response.split("#");
			$("#title").val(res[0]);
			$("#schoolname").val(res[1]);
			$("#address").val(res[2]);
			$("#description").val(res[3]);
			$("#frmyeardata").html(res[4]);
			$("#toyeardata").html(res[5]);
			$("#deletedid").val(res[6]);
			
			if(res[5]=='Present')
			{
				$("#editcurrentlyworkhere").val(res[5]);
				$("#editcurrentlyworkhere").prop('checked', true);
				$("#toyeardata").html(res[7]);
			
			}
			else
			{
				$("#editcurrentlyworkhere").prop('checked', false);
				$("#editcurrentlyworkhere").val("");
			}



		}});

}


  

</script>		
		
<script language="javascript">


$(document).ready(function() {
$(".myBtnexpuser").button().on( "click", function() {
	
	
		openEditExpBox($(this).attr("id"));
	});
});

function openEditExpBox(editid)	
{


var modal4 = document.getElementById('myModal4');

// Get the button that opens the modal
var btn = document.getElementById(editid);


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
modal4.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal4.style.display = "none";
}

window.onclick = function(event) {

var modal4 = document.getElementById('myModal4');

if (event.target == modal4) {
modal4.style.display = "none";
}
}


$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/editexperience",

data:{editid:editid},
beforeSend:function(){
$('#process').show();}

,success:function(response){


res = response.split("#");

	 $("#editexptomonth").html(res[9]);
	 $("#editexptoyear").html(res[10]);

if(res[4]=='Present')
{
	$("#editexpworkinghere").prop('checked', true);
	$("#editexpworkinghere").val("Present");
	 $("#editexptomonth").html(res[9]);
	 $("#editexptoyear").html(res[10]);
	
}
else
{
	$("#editexptomonth").html(res[4]);
	$("#editexptoyear").html(res[7]);
	$("#editexpworkinghere").prop('checked', false);
}
$("#edittitle").val(res[0]);
$("#editcompanyname").val(res[1]);
$("#editlocation").val(res[2]);
$("#editdescription").val(res[3]);

$("#editfromexpYear").html(res[5]);
$("#editfromexpmonth").html(res[6]);

$("#deletedexpid").val(res[8]);







}});



}

</script>	



<script>

var modalnewexp = document.getElementById('myModalnewexp');

// Get the button that opens the modal
var btn = document.getElementById('addnewexp');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeexp")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modalnewexp.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modalnewexp.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalnewexp) {
        modalnewexp.style.display = "none";
		
    }
}
</script>



<script>

var modalnewqual = document.getElementById('myModalnewqual');

// Get the button that opens the modal
var btn = document.getElementById('addnewqual');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeqal")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modalnewqual.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modalnewqual.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalnewqual) {
        modalnewqual.style.display = "none";
		
    }
}
</script>


<script type="text/javascript">
function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
		
		
		
        fileReader.onload = function (e) {
			/*var fileName=$("#userImage").val();
			if(fileName=='')
			{

			$("#imgerror").html("Please select image file.");
			$("#imgerror").css({"color": "white"});
			$("#userImage").focus();

			return false;
			}
			var updateid= $("#updateid").val();
			var btn = document.getElementById('myBtn'+updateid);
			alert(btn);
			
			var modal = document.getElementById('myModal');
			btn.onclick = function() {
			modal.style.display = "block";
			}*/
		
		
            $("#targetLayer").html('<img src="'+e.target.result+'" class="avatar img-circle" width="150px" alt="avatar" class="upload-preview" />');
			
        }
		fileReader.readAsDataURL(objFileInput.files[0]);
    }
}


$(document).ready(function (e) {
	
	
	
	
	$("#uploadForm").on('submit',(function(e) {
		
		
		
		e.preventDefault();
		$.ajax({
        	url: "<?php echo base_url() ?>UserNetwork/uploadprofile",
			type: "POST",
			data:  new FormData(this),
			beforeSend: function(){$("#body-overlay").show();},
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
			$("#targetLayer").css('opacity','1');
			setInterval(function() {$("#body-overlay").hide(); },500);
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});


</script>
 <link href="<?php echo base_url(); ?>assets/css/userprofile.css" rel="stylesheet">	


<!--/#scripts--> 
<script>
function profiledetail(editid)
{
	
	
 var basepath='<?php echo base_url(); ?>';

	// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById('myBtn'+editid);

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
		
    }
	var modal1 = document.getElementById('myModal2');
	
	 if (event.target == modal1) {
		
        modal1.style.display = "none";
		
    }
	
 
	
}


		$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/getprofileDetails",
		data:{editid:editid},
		beforeSend:function(){
		$('#process').show();


		}

		,success:function(response){
		
		res = response.split("#");
		
		
		$("#name").val(res[0]);
		$("#email").val(res[1]);
		$("#Occupation").val(res[2]);
		$("#bio").val(res[3]);
		$("#phoneno").val(res[4]);
		$("#dob").val(res[5]);
		$("#password").val(res[6]);
		$("#cpassword").val(res[6]);
		$("#updateid").val(res[8]);
		
		$(".model").modal("show");
		
		$('#newsnap').html('<form id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data" action="'+basepath+'UserNetwork/uploadprofile"><div class="targetOuter"><div id="targetLayer"><img src="'+res[7]+'" class="img-responsive img-circle" style="width:150px;height:150px; margin:0px auto!important;" alt="avatar"  /></div><div class="sicon-choose-image"> </div></div><div><br><br><div id="imgerror"></div><input type="hidden" name="updatephotoid" id="updatephotoid" value="'+res[8]+'"></form></div>');
		}});
		
	

	
	
	
}
<!--$('#newsnap').html('<form id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data" action="'+basepath+'UserNetwork/uploadprofile"><div class="targetOuter"><div id="targetLayer"><img src="'+res[7]+'" class="img-responsive img-circle" style="width:100px;height:100px;" alt="avatar"  /></div><div class="icon-choose-image"><input type="file" id="userImage" name="userImage" class="img-responsive img-circle" style="width:100px;height:100px;"  onChange="showPreview(this);"> </div></div><div><br><br><input type="submit" name="submit" value="Upload Photo" class="btn btn-primary" /><div id="imgerror"></div><input type="hidden" name="updatephotoid" id="updatephotoid" value="'+res[8]+'"></form></div>');-->



function checkfiletype()
{
var fileName=$("#userImage").val();

var idxDot = fileName.lastIndexOf(".") + 1;
var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

if(fileName=='')
{

$("#imgerror").html("Please select image file.");
$("#imgerror").css({"color": "white"});
$("#userImage").focus();

return false;
}
else
	
{
		$('#uploadForm').submit();
		return true;
}
/*if(fileName!='')
{
	alert("ASDasd");
	var idxDot = fileName.lastIndexOf(".") + 1;
	var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

	if (extFile=="jpg" || extFile=="jpeg" ||  extFile=="png"  || extFile=="gif"){
	   
	  
	   
	   
	}
	else
	{
		//alert("Only jpg/jpeg and png files are allowed!");
		 $("#imgerror").html("Only jpg/jpeg and png files are allowed!.");
		 $("#imgerror").css({"color": "white"});
		  $("#userimage").focus();
			return false;
	}

} */
	
       
        
	 
}
		   

function deleteuserexperience()
{
	var deletedexpid=$("#deletedexpid").val();
	$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/deleteuserexperienceData",
		data:{deletedexpid:deletedexpid},
		beforeSend:function(){
		$('#processdel').show();

		}

		,success:function(response){
			if(response)
			{
			$("#showexpData").html(response);
			$("#showexpData").addClass("alert alert-success alert-dismissable");
			
			$('#processdel').hide();
			location.reload();	
			}
		
		}});
	
}


	
	
	 /*function filldataexp()
	 {
		 
		 var deletedexpid=$("#deletedexpid").val();
		 
        $('#editexpworkinghere').click(function(){
            if($(this).prop("checked") == true){
              
			   alert("asdasdas");
			   
            }
            else if($(this).prop("checked") == false){
                
			 
			 callbackdata(deletedexpid);
				
				
            }
        });
	 } */
	
	
	
	
	
	


function updateprofile()
{
		var updateid=$("#updateid").val();
		var name=$("#name").val();
		var Occupation=$("#Occupation").val();
		var bio=$("#bio").val();
		var email=$("#email").val();
		var phoneno=$("#phoneno").val();
		var dob=$("#dob").val();
		var password=$("#password").val();
		var cpassword=$("#cpassword").val();
		
		if(name=="")
		{
			var nameerro="Please enter name!";
			$("#nameerror").html(nameerro);
			$("#name").focus();
			$("#name").css("borderColor", "red")
			$("#nameerror").css("color", "red")
			return false;
		}
		else
		{
			$("#nameerror").html("");
			$("#name").css("borderColor", "")
		}
		if(Occupation=="")
		{
			var nameerro="Please enter Occupation!";
			$("#Occupationerror").html(nameerro);
			$("#Occupation").focus();
			$("#Occupation").css("borderColor", "red")
			$("#Occupationerror").css("color", "red")
			return false;
		}
		else
		{
			$("#Occupationerror").html("");
			$("#Occupation").css("borderColor", "")
		}
		
		if(bio=="")
		{
			var nameerro="Please enter Bio!";
			$("#bioerror").html(nameerro);
			$("#bio").focus();
			$("#bio").css("borderColor", "red")
			$("#bioerror").css("color", "red")
			return false;
		}
		else
		{
			$("#bioerror").html("");
			$("#bio").css("borderColor", "")
		}
		
		
		if(email=="")
		{
			var nameerro="Please enter email address!";
			$("#emailerror").html(nameerro);
			$("#email").focus();
			$("#email").css("borderColor", "red");
			$("#emailerror").css("color", "red");
			return false;
		}
		
		if(email!="")
		{
			var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
			if (testEmail.test(email))
			{
				$("#emailerror").html("");
				$("#email").css("borderColor", "");
				$("#emailerror").css("color", "");
			}
			else
				
			{
				var nameerro="Please enter valid email address!";
				$("#emailerror").html(nameerro);
				$("#email").css("borderColor", "red");
				$("#emailerror").css("color", "red");
				return false;
			}
		}
		
		if(phoneno=="")
		{
			
			var nameerro="Please enter mobile no!";
			$("#phonenoerror").html(nameerro);
			$("#phoneno").focus();
			$("#phoneno").css("borderColor", "red");
			$("#phonenoerror").css("color", "red");
			return false;
			
		}
		else
		{
			$("#phonenoerror").html("");
			$("#phoneno").css("borderColor", "");
			$("#phonenoerror").css("color", "");
		}
		
		
		var name=$("#name").val();
		var Occupation=$("#Occupation").val();
		var bio=$("#bio").val();
		var email=$("#email").val();
		var phoneno=$("#phoneno").val();
		var dob=$("#dob").val();
		var password=$("#password").val();
		var cpassword=$("#cpassword").val();
		
		
		
		$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/updateuserselfprofile",
		data:{updateid:updateid,name:name,Occupation:Occupation,bio:bio,email:email,phoneno:phoneno,dob:dob,password:password,cpassword:cpassword},
		beforeSend:function(){
		$('#processprofileloader').show();

		}

		,success:function(response){
			if(response)
			{
			$("#showsuccessdata").html(response);
			$('#processprofileloader').hide();
			$("#showsuccessdata").addClass("alert alert-success alert-dismissable");
			$("#showsuccessdata").css('');
			
			
			}
		
		}});
	
}


/*$("#showsuccessdata").show().delay(1000).queue(function(n) {
  $(this).hide(); n();
});*/


function hiredusers(hiredid,email)
{
	
	
	
	
		var subject='<?php echo $profilejob[0]['jobtitle'];  ?>';      
		var email =email;
		var name='<?php echo $this->session->userdata('uname'); ?>';
		var useremail='<?php echo $this->session->userdata('email'); ?>';
		var phone='';
		var otherdetails = 'Name: ' + name +  escape ("\n\n")  + 'Email: ' + useremail + escape ("\n\n") + 'Phoneno: ' + phone+' '+ escape ("\n\n")+'Please find attached resume';

		var body = 'Hi: ' + email + escape ("\n\n") + 'I wish to apply for the position of: ' + subject +' Hope to here from you soon please find below details.'+ escape ("\n\n");


		location.href = "mailto:"+email+"?subject=Job application for "+subject+"&body="+body+' \n\n'+otherdetails; 
	
	
	
	$.ajax({type:'POST',url:"<?php echo base_url();?>UserNetwork/hireduser",
	data:{hiredid:hiredid,email:email},
	beforeSend:function(){
	$('#loadershow').show();

	},
	success:function(data)
	{
	
	$('#hired').html(data);
	
	$('#loadershow').hide();
	}
	});

}








</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript">
	$(document).ready(function(){
		var date_input=$('input[name="dob"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
	});

</script>
<!--<script type="text/javascript">
	$(document).ready(function(){
	$(".upload-click").click(function(e){ 
	alert("Asdasdas");

	$('#file').trigger('click');
	});

	$('#file').live('change', function()			{ 
	$("#newsnap").html('');
	$("#newsnap").html('<img src="<?php //echo base_url(); ?>/images/loader.gif" alt="Uploading...."/>');
	$("#imageform").ajaxForm({	

	target: '#newsnap'}).submit();

	});

</script>-->





