<script src="<?php  echo base_url();?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php  echo base_url();?>template/ckeditor/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php  echo base_url();?>assets/plugins/ckeditor/samples/css/sample.css">


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
                
                <?php
				
foreach($dealsedit as $val)
{
	
	
	$name= $val['name'];
	$email= $val['email'];
	$contactperson= $val['contactperson'];
	$address= $val['address'];
	$about= $val['about'];
	$contactno= $val['contact'];
	$uploadedimg=$val['image'];
	$status=$val['status'];
	$updateid=$val['id'];
	$latitude=$val['latitude'];
	$longitude=$val['longitude'];
	$totallikes=$val['totallikes'];
	$m_clicked=$val['m_clicked'];
	$nposition=$val['nposition'];
	
		
}	
				?>
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">News Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/updatedatadeal" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Name:</label>
                                        <input type="text" class="form-control required"  id="name" value="<?php echo $name; ?>"  autocomplete="off" name="name" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                
								<?php 

								$photo = $uploadedimg;
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

								if($photo=='')
								{
								$uphoto = $basepath."images/No_Image_Available.jpg";

								}
								}
								?>
								
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Uploaded img</label>
                                       <img src="<?php echo $uphoto; ?>" style="width:300px;">
                                    </div>
                                </div>  
								
								
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
                                        <input type="text" class="form-control " value="<?php echo $contactperson; ?>"  autocomplete="off" id="author" name="author">
                                    </div>
                                </div>
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Deals Status</label>
                                        <select class="form-control " id="status" name="status">
										 
                                            <option value="active" <?php if($status=='active') { echo "selected";} ?> >Active</option>
											 <option value="inactive" <?php if($status=='') { echo "selected";} ?>>Inactive</option>
											
										  
											 
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
							
							
							
                            <div class="row">
                               
								
									
								
								
								
							
							
                                <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Email</label>
										 <input class="form-control" id="email" name="email" type="text" value="<?php echo $email; ?>" autocomplete="off"/>
                                    </div>
                                    
                                </div>
								
								
								<div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Contact</label>
										
										  <input class="form-control" value="<?php echo $contactno; ?>" id="contact" name="contact" type="text" autocomplete="off"/>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
							
							
							
							<div class="row">
							
							    <div class="col-md-6">                                
                                   <div class="form-group">
                                        <label for="role">Address</label>
										 <input type="text" name="address" id="address"  class="form-control" autocomplete="off" value="<?php echo $address; ?>" onblur="checkdata(this);">
                                    </div>
                                    
                                </div>
							
							</div>
							
							
							<input type="text" name="latitude" id="latitude" value="<?php echo $latitude; ?>">
										<input type="text" name="longitude" id="longitude" value="<?php echo $longitude; ?>">
										
										<input type="hidden" name="totallikes" id="totallikes" value="<?php echo $totallikes; ?>">
										<input type="hidden" name="m_clicked" id="m_clicked" value="<?php echo $m_clicked; ?>">
										<input type="hidden" name="nposition" id="nposition" value="<?php echo $nposition; ?>">
										
										
										
							
							
							
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cpassword">Page Content</label>
                                        <textarea name="about"   autocomplete="off" id='about' rows="15"  class="control-label col-md-3 ckeditor"><?php echo $about; ?></textarea>
          
					
    </textarea>
                                    </div>
                                </div>
								
								<script>

CKEDITOR.replace('description' ,{
filebrowserImageBrowseUrl : '<?php echo base_url('template/kcfinder');?>'
});
</script>
								
								
								</div>
								
							
							
							
							
							
							
							
						
							
							
								
								
							<input type="hidden" name="updateid" id="updateid" value="<?php echo $updateid ?>">
                               
                            
						
								
                                  
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
