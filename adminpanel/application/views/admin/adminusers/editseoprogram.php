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
        <i class="fa fa-users"></i> Page SEO Management
        <small>EDit  Program</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Program Details</h3>
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
                    <form role="form" id="addprogram" action="<?php echo base_url() ?>admin_adminusers/updateseoprogram" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Meta Page name:</label>
                                        <input type="text" class="form-control" value="<?php echo $edit_result_seo[0]['page_name']; ?>" id="page_name"  autocomplete="off" name="page_name" maxlength="128" required>
                                    </div>
                                    
                                </div>
								
								
								
								
								
                            </div>
							
							
                           
							
							 <div class="row"> 

								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Meta Title</label>
                                        <input type="text" class="form-control" required value="<?php echo $edit_result_seo[0]['title']; ?>"  autocomplete="off" id="title" name="title" required>
                                    </div>
                                </div>

							 
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Meta Keywords</label>
                                        <input type="text" class="form-control " required value="<?php echo $edit_result_seo[0]['meta_keywords']; ?>"  autocomplete="off" id="meta_keywords" name="meta_keywords" required>
                                    </div>
                                </div>
								</div>
								
								
							
						
							
							    <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Meta Description</label>
                                        <textarea name="description"  required  autocomplete="off" id='description' rows="15"  class="control-label col-md-3 ckeditor" id="description" required>
          
					<?php echo $edit_result_seo[0]['meta_description']; ?>
    </textarea>
                                    </div>
                                </div>
								
								<script>

CKEDITOR.replace('blockcontent' ,{
filebrowserImageBrowseUrl : '<?php echo base_url('template/kcfinder');?>'
});
</script>
								
								
								</div>
							
							
						
                               
                            
								
							
							
							<input type="hidden" name="updateid" id="updateid" value="<?php echo $edit_result_seo[0]['id']; ?>">	
								
                                  
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
