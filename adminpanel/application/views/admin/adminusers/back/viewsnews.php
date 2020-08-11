<script src="<?php  echo base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/plugins/ckeditor/samples/css/sample.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Publish Feed Management
        <small>View Feed</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Feed Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin_adminusers/addnews" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        
                                       <h2> <?php echo $news_result[0]['page_title']; ?></h2>
                                    </div>
                                    
                                </div>
                               
                            </div>
							
							
							<div class="row">
							 <div class="col-md-12">
                                    <div class="form-group">
                                       
									   
									   <?php
									   if($news_result[0]['video_link']!=="")
									   {
										   ?>
										   <iframe width="500" height="300" src="<?php echo base_url(); ?>/images/video/<?php echo $news_result[0]['video_link']; ?>?rel=0&amp;autoplay=0"  frameborder="0" rel="0" allowfullscreen></iframe>
										   <?php
									   }
									   else
									   {
									   ?>
									   
									   
									   
                                        <img src="
										
										<?php

										
																$basepath=base_url();
																$maining=$news_result[0]['image'];
																$data=parse_url($maining, PHP_URL_SCHEME);

																if($data=='http' || $data=='https')
																{
																$img = $maining;
																}



																else if($data!='http' || $data!='https'){

																$img = $basepath.$maining;

																}
																else
																{

																}

																if($maining=='')
																{
																$img = $basepath."images/No_Image_Available.jpg";

																}
										
										   echo $img;

										 ?>" style="width:500px">
										 
										 <?php
									   }
										 ?>
                                    </div>
                                </div>
								<?php
                               /* if($news_result[0]['video_link']!="")
								{	
								?>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Video Link</label>
										<iframe width="500" height="330"
										src="<?php echo $news_result[0]['video_link']; ?>">
										</iframe>
                                    </div>
                                </div>
								</div>
								<?php 
								} */  
								?>
							
							
                            
                                
                            </div>
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                       
                                        <?php  echo $news_result[0]['description'];?>
                                    </div>
                                </div>
								
								
								</div>
								<div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Author:</label>
                                        <input type="text" class="form-control " value="<?php echo $news_result[0]['author']; ?>" id="author"    autocomplete="off" name="author" maxlength="500" readonly>
                                    </div>
                                    
                                </div>
								
								 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Read Time</label>
										
										<?php if($news_result[0]['readtime']!="")
										{
										?>
										
										<input type="text" class="form-control " value="<?php echo $news_result[0]['readtime']; ?>" id="seotitle"  autocomplete="off" name="seotitle" maxlength="500" readonly>
										<?php
										}
										?>
										

									
                                    </div>
                                    
                                </div>
                               
                            </div>
							
							
							<div class="row">
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">News Status</label>
                                        <select class="form-control " id="status" name="status" readonly>
										   <?php
										 
												if($news_result[0]['status']=='active')
												{
												
										   ?>
                                            <option value="active">Active</option>
											<?php 
												}
												else
												{
												?>
											 <option value="inactive">Inactive</option>
											 <?php 
												}
												?>
											 
                                            
                                        </select>
                                    </div>
									</div>
									
									 <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Select News</label>
										<select class="form-control " id="priority" name="priority" readonly>
										<?php
foreach($newcategory as $cat)
{										
										?>
										<option value="<?php echo $cat['cat_id']; ?>" <?php if($cat['cat_id']==$news_result[0]['priority']) { echo "selected";} ?>><?php echo $cat['Category'];?></option>
										
                                           <?php
}
?>
                                        </select>
                                    </div>
                                    
                                </div>
								
                            </div>
							
							
							
							
							
							
							
								
								
								
								
                                  
                            </div>
                        </div><!-- /.box-body -->
    
                        <!--<div class="box-footer">
                            <input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>-->
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
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
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>