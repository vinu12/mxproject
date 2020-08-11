<script src="<?php  echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php  echo base_url();?>template/ckeditor/ckeditor.js"></script>
     


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Deals Management
        <small>Deals Update Deals</small>
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
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/adddealslist" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Name:</label>
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
                                        <label for="video">Owner Name</label>
                                        <input type="text" class="form-control " value=""  autocomplete="off" id="author" name="author">
                                    </div>
                                </div>
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Deals Status</label>
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
                                        <label for="role">Email</label>
										 <input class="form-control" id="email" name="email" type="text" autocomplete="off" autocomplete="off">
                                    </div>
                                    
                                </div>
								
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Contact</label>
										
										  <input class="form-control" id="contact" name="contact" type="text" autocomplete="off" autocomplete="off"/>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
							
							
							
							<div class="row">
							
							    <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Address</label>
										<div class="location">
										 <input name="address" id="address" class="form-control" autocomplete="off" autocomplete="off" onblur="checkdata(this)";>
										 
										<input type="text" name="latitude" id="latitude" value="">
										<input type="text" name="longitude" id="longitude" value="">
										 </div>
                                    </div>
                                    
                                </div>
							
							</div>
							
							
							
							
							
							
							
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Page Content</label>
                                        <textarea name="about"   autocomplete="off" id='about' rows="15"  class="control-label col-md-3 ckeditor">
          
					
    </textarea>
                                    </div>
                                </div>
								
								<script>

CKEDITOR.replace('description' ,{
filebrowserImageBrowseUrl : '<?php echo base_url('template/kcfinder');?>'
});
</script>
								
								
								</div>
								
							
							
							
							
							
							
							
						
							
							
								
								
								
                               
                            
						
								
                                  
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


<script>
function titleCase(str) {
   var splitStr = str.toLowerCase().split(' ');
   for (var i = 0; i < splitStr.length; i++) {
       // You do not need to check if i is larger than splitStr length, as your for does that for you
       // Assign it back to the array
       splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
   }
   // Directly return the joined string
   return splitStr.join(' '); 
}

//document.write(titleCase("I'm a little tea pot"));
</script>


<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript">

function checkdata(x)
{
	
	var address=titleCase(x.value);
	var mainaddress=address.split(/[ ,]+/).join(',');
	var finaladdress=mainaddress.trim();
	
var geocoder = new google.maps.Geocoder();
var address = address;

geocoder.geocode( { 'address': address}, function(results, status) {

if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
	
	document.getElementById("latitude").value=latitude;
	document.getElementById("longitude").value=longitude;
    //alert(latitude);
	//alert(longitude);
    } 
}); 
}
</script>
