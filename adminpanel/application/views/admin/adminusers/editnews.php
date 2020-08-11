<script src="<?php  echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php  echo base_url();?>template/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/plugins/ckeditor/samples/css/sample.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> News Management
        <small>Update News</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
            
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">News Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/updatenewsdata" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Page Title:</label>
                                        <input type="text" class="form-control required" value="<?php echo $news_result[0]['page_title']; ?>" id="page_title"  autocomplete="off" name="page_title" maxlength="128">
                                    </div>
                                    
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Uploaded video/Image</label>
							
								
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
                                
								<?php 

								$photo = $news_result[0]['image'];
								$basepath=base_url();
								if($photo=='')
								{
								 $uphoto = $basepath."images/No_Image_Available.jpg";

								}
								if($photo!="")
								{

								$basepath=base_url();
								$data=parse_url($photo, PHP_URL_SCHEME);

								if($data=='http' || $data=='https')
								{
								$uphoto = $photo;
								}



								else if($data!='http' || $data!='https'){

								$uphoto = $basepath.$photo;

								}
								else
								{

								}

								
								}
								?>
								
								
                                        <img src="<?php 
										
										
										
										
										
										
										echo $uphoto;
									
										?>" style="width:150px; height:150px;" >
										<?php
									   }
									   ?>
                                    </div>
                                </div>
                            </div>
							
							
							
							<div class="row">
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">News Image</label>
                                        <input type="file" class="form-control" id="news_img" value="<?php echo set_value('Image'); ?>"  autocomplete="off" name="news_img" maxlength="128">
                                    </div>
                                </div>  
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Video </label>
                                        <input type="file" class="form-control " name="video" id='video'  autocomplete="off">
                                    </div>
                                </div>
                            </div>
							
							
							
                            <div class="row">
                               
								
									<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">News Status</label>
                                        <select class="form-control " id="status" name="status">
										  <?php
										   $status=$news_result[0]['status'];
										   
										  ?>
                                            <option value="active" 
											
											<?php 
											if($status=='active')
										   {  echo "selected";}
											?>
											
											>Active</option>
											 <option value="inactive"
											<?php 
											if($status=='inactive')
										   {  echo "selected";}
											?> >Inactive</option>
											
										  
											 
                                            
                                        </select>
                                    </div>
                                    
                                </div>
								
								
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Column Priority</label>
										<select class="form-control " id="priority" name="priority">
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
							
							
							
							<div class="row">
                               
								
									<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Date</label>
										
										  <input class="form-control" id="date" name="date" type="text" autocomplete="off" value="<?php echo $news_result[0]['date']; ?>"/>
                                        
                                    </div>
									
									
									
									
                                    
                                </div>
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Author</label>
										
										  <input class="form-control" id="author" name="author" type="text" autocomplete="off" value="<?php echo $news_result[0]['author']; ?>"/>
                                        
                                    </div>
									</div>
								
								
		<link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
      
		<link href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min11.js"></script>
     	        <script src="<?php echo base_url() ?>assets/js/bootstrap11.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
       
    	<script src="<?php echo base_url() ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	
    
	<script type="text/javascript">
						$("#datetime").datetimepicker({
							format: 'yyyy-mm-dd hh:ii'
						});
						$("#datetime2").datetimepicker({
							format: 'yyyy-mm-dd hh:ii',
							autoclose: true
						});
						
					  </script>
							
							
                            
                                
                            </div>
							
							 <div class="row">
							<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Read time</label>
										
										  <input class="form-control" id="readtime" name="readtime" type="text" autocomplete="off" value="<?php echo $news_result[0]['readtime']; ?>"/>
                                        
                                    </div>
									</div>
									
									  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Hash tags</label>
                                        <input type="text" class="form-control "   autocomplete="off" id="hastags" name="hastags" value="<?php echo $news_result[0]['hashtags']; ?>">
                                    </div>
                                </div>
									</div>
									
									
							
							 <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Block Content</label>
                                        <textarea name="blockcontent"   autocomplete="off" id='blockcontent' rows="15"  class="control-label col-md-3 ckeditor" id="description">
          <?php echo $news_result[0]['blockcontent']; ?>
					
    </textarea>
                                    </div>
                                </div>
								
								<script>

CKEDITOR.replace('blockcontent' ,{
filebrowserImageBrowseUrl : '<?php echo base_url('template/kcfinder');?>'
});
</script>
								
								
								</div>
							
							
							
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Page Content</label>
                                        <textarea name="description"   autocomplete="off" id='description' rows="15"  class="control-label col-md-3 ckeditor" id="description">
          
					<?php echo $news_result[0]['description']; ?>
    </textarea>
                                    </div>
                                </div>
								
								<script>

CKEDITOR.replace('description' ,{
filebrowserImageBrowseUrl : '<?php echo base_url('template/kcfinder');?>'
});
</script>
								
								
								</div>
								
							
							
							
							
							
							
							
						
							
							
								
								
								
                               
                            
								
							<input type="hidden" name="flagdata" value="<?php  echo $user_blog;?>">	
							<input type="hidden" name="userid" id="userid" value="<?php echo $news_result[0]['userid']; ?>">	
							<input type="hidden" name="updateid" id="updateid" value="<?php echo $news_result[0]['id']; ?>">	
								
                                  
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" name="Submit" value="Submit" />
                           
                        </div>
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
