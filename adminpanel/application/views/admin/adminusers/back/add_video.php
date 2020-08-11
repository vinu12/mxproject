<script src="<?php  echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php  echo base_url();?>template/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/plugins/ckeditor/samples/css/sample.css">

<script type="text/javascript" src="<?php  echo base_url();?>simsalabim-sisyphus/sisyphus.min.js"></script>

<script>
$(document ).ready(function() {
$("#editUser" ).sisyphus(); //Autosave form2 only,
// or you can persist all forms data at one command
// $( "form" ).sisyphus();
} );
</script>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> News Management
        <small>Add New News</small>
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
					
					
					 <div class="col-md-12">
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
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/add_video" method="post" role="form" enctype="multipart/form-data">
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
								
								
                                
                            </div>
							
							
							
							
							<?php
							for($i=1;$i<10;$i++) { ?>
							<input type="text" name="texta[<?php echo $i;?>]"></textarea>
							<?php } ?>
							
						
							
							
							
							<div class="row">
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">News Image</label>
                                        <input type="file" class="form-control" id="news_img" value="<?php echo set_value('Image'); ?>"  autocomplete="off" name="news_img" maxlength="128">
                                    </div>
                                </div>  
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="video">Upload Video</label>
                                        <input type="file" class="form-control" id="video" name="video"   autocomplete="off">Allowed Extension (.avi.flv.wmv.mp4)
                                    </div>
                                    
                                </div>
							 
							
                               
							 
                                 <!--<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Video Link</label>
                                        <input type="text" class="form-control " value="<?php echo $news_result[0]['video_link']; ?>"  autocomplete="off" id="video" name="video">
                                    </div>
                                </div>-->
								
								
								
								
                            </div>
							
							
							
                            <div class="row">
                               
								
									
								
								
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Select news</label>
										<select class="form-control " id="priorityid" name="priorityid">
										<?php
foreach($newcategory as $cat)
{										
										?>
										<option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['Category'];?></option>
										
                                           <?php
}
?>
                                        </select>
                                    </div>
                                    
                                </div>
								
								
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Author</label>
                                        <input type="text" class="form-control " value=""  autocomplete="off" id="author" name="author">
                                    </div>
                                </div>
                                
                            </div>
							
							
							
							<div class="row">
                               
								
									
								
								 
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="video">Read time</label>
                                        <input type="text" class="form-control " value=""  autocomplete="off" id="readtime" name="readtime">
                                    </div>
                                    
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
							 <label for="">Image Type</label>
							 <select name="imagetype" id="imagetype" class="form-control" onchange="checkimgstatus('<?php echo $idval;?>',this.value)">
	<option value="">Select Status</option>
	<option value="0" <?php if($record['imagetype']==0) { echo "selected";} ?>>Small</option>
	<option value="1" <?php if($record['imagetype']==1) { echo "selected";} ?>>Big</option>
	<option value="2" <?php if($record['imagetype']==2) { echo "selected";} ?>>Banner</option>
	
	</select>   </div>
                                </div> 
								
                                
                            </div>
							
							
							
							
							
							
							
							    <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Block Content</label>
                                        <textarea name="blockcontent"   autocomplete="off" id='blockcontent' rows="15"  class="control-label col-md-3 ckeditor" id="description">
          
					
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
           
        </div>    
    </section>
    
</div>
