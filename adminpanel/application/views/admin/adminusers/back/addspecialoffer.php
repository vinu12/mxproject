<script src="<?php  echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php  echo base_url();?>template/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/plugins/ckeditor/samples/css/sample.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Special Offers 
        <small>Add Special Offers</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">News</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/addspecialofferData" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Product Name:</label>
                                        <input type="text" class="form-control required" value="" id="name"  autocomplete="off" name="name" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                
								<?php 

								$photo = $news_result[0]['image'];
								if($photo!="")
								{

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
								$uphoto = $basepath."images/No_Image_Available.jpg";

								}
								}
								?>
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">News Image</label>
                                        <input type="file" class="form-control" id="news_img" value="<?php echo set_value('Image'); ?>"  autocomplete="off" name="news_img" maxlength="128">
                                    </div>
                                </div>  
								
                            </div>
							
							
							
							<div class="row">
                             
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Price</label>
                                        <input type="text" class="form-control " value=""  autocomplete="off" id="Price" name="Price">
                                    </div>
                                </div>
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control " id="status" name="status">
										 
                                            <option value="active" >Active</option>
											 <option value="inactive">Inactive</option>
											
										  
											 
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
							
							<div class="row">
                               
								
									
								
								
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">From date</label>
										 <input class="form-control"  id="datetime3" name="fromdate" type="text" autocomplete="off"/>
                                    </div>
                                    
                                </div>
								
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">To date</label>
										
										  <input class="form-control" id="datetime2" name="todate" type="text" autocomplete="off"/>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
							
                            <div class="row">
                               
								
									
								
								
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Discount</label>
										 <input class="form-control" id="discount" name="discount" type="text" autocomplete="off"/>
                                    </div>
                                    
                                </div>
								
								
								
                            </div>
							
							
							
						 <input type="hidden" name="dealsid" id='dealsid' value="<?php echo $id; ?>">
							
							
							
							 
							
							
							
							
							
                           
								
							      
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
						$("#datetime3").datetimepicker({
							format: 'yyyy-mm-dd hh:ii',
							autoclose: true,
							todayBtn: true
						});
						$("#datetime4").datetimepicker();
					  </script>
</div>
