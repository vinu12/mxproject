<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>template/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Advertise Management
            <small>Edit advertise</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Advertise Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/updateadvertise" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Title:</label>
                                        <input type="text" class="form-control required" value="<?php echo $recordcheck[0]['page_title']; ?>" id="name"  autocomplete="off" name="name" maxlength="128" required>
                                    </div>

                                </div>

                                <?php
                                $photo = $recordcheck[0]['image'];
                                if ($photo != "") {

                                    $basepath = base_url();
                                    $data = parse_url($photo, PHP_URL_SCHEME);

                                    if ($data == 'http' || $data == 'https') {
                                        $uphoto = $photo;
                                    } else if ($data != 'http' || $data != 'https') {

                                        $uphoto = $basepath . $photo;
                                    } else {
                                        
                                    }

                                    if ($photo == '') {
                                        $uphoto = $basepath . "images/No_Image_Available.jpg";
                                    }
                                }
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        
                                       
                                        <input type="file" class="form-control" id="news_img" value=""  autocomplete="off" name="news_img">
                                        
                                         <img src="<?php  echo $uphoto;?>" style=""width="100px;height:100px;">
                                    </div>
                                </div>  

                            </div>



                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Type of Cumulative</label>
                                        <select name="priority" class="form-control" id=category">


                                            <option value="0">--Top Level--</option>
                                            <?php
                                            $CI = & get_instance();
                                            $CI->load->model('Category_model');
                                            $result = $CI->Category_model->cumulativelist();

                                            foreach ($result as $data) {
                                                $level = $data['cat_id'];
                                                ?>


                                                <?php
                                                $CI = & get_instance();
                                                $CI->load->model('Category_model');
                                                $result2 = $CI->Category_model->subcategory($level);


                                                foreach ($result2 as $data2) {
                                                    $level1 = $data2['cat_id'];
                                                    ?>
                                                    <option value="<?php echo $data2['cat_id']; ?>" <?php if($recordcheck[0]['priority']==$level1){ echo "selected";} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data2['Category']; ?></option>

                                                    <?php
                                                    $CI = & get_instance();
                                                    $CI->load->model('Category_model');
                                                    $result3 = $CI->Category_model->childcategory($level1);
                                                   
                                                    

                                                    foreach($result3 as $data3) {
                                                        
                                                         $level2 = $data3['cat_id'];
                                                        ?>
                                                        <option value="<?php echo $data3['cat_id']; ?>" <?php if($recordcheck[0]['priority']==$level2){ echo "selected";} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data3['Category']; ?></option>									

                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>



                                           
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Deals Status</label>
                                        <select class="form-control " id="status" name="status">

                                            <option value="active" <?php if($recordcheck[0]['status']=='active') { echo "selected";} ?> >Active</option>
                                            <option value="inactive" <?php if($recordcheck[0]['status']=='inactive') { echo "selected";} ?>>Inactive</option>




                                        </select>
                                    </div>

                                </div>
                            </div>



                            <div class="row">


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Publisher:</label>
                                        <input class="form-control" id="publisher" name="publisher" type="text" value="<?php echo $recordcheck[0]['author']; ?>" autocomplete="off" autocomplete="off">
                                    </div>

                                </div>


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Price/Rate:</label>

                                        <input class="form-control" id="price" name="price" type="text" autocomplete="off"  value="<?php echo $recordcheck[0]['price']; ?>"/>

                                    </div>

                                </div>

                            </div>



                            <div class="row">


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Email:</label>
                                        <input class="form-control" id="email" name="email" type="text" autocomplete="off" value="<?php echo $recordcheck[0]['email']; ?>">
                                    </div>

                                </div>


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Contact:</label>

                                        <input class="form-control" id="contact" name="contact" type="text" autocomplete="off" value="<?php echo $recordcheck[0]['contact']; ?>"/>

                                    </div>

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Address</label>
                                        <div class="location">
                                            <input name="address" id="address" class="form-control" autocomplete="off" value="<?php echo $recordcheck[0]['address']; ?>">


                                        </div>
                                    </div>

                                </div>
                                
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Position</label>
                                        <div class="location">
                                                <select required="required" class="form-control" name="nposition" id="nposition">
                                                <option value="1" <?php if($recordcheck[0]['nposition']==1) { echo "selected";} ?> >1</option>
                                                <option value="2" <?php if($recordcheck[0]['nposition']==2) { echo "selected";} ?>>2</option>
                                                <option value="3" <?php if($recordcheck[0]['nposition']==3) { echo "selected";} ?>>3</option>
                                                <option value="4" <?php if($recordcheck[0]['nposition']==4) { echo "selected";} ?>>4</option>
                                                <option value="5" <?php if($recordcheck[0]['nposition']==5) { echo "selected";} ?>>5</option>
                                                <option value="6" <?php if($recordcheck[0]['nposition']==6) { echo "selected";} ?>>6</option>
                                                <option value="7" <?php if($recordcheck[0]['nposition']==7) { echo "selected";} ?>>7</option>
                                                <option value="8" <?php if($recordcheck[0]['nposition']==8) { echo "selected";} ?>>8</option>
                                                <option value="9" <?php if($recordcheck[0]['nposition']==9) { echo "selected";} ?>>9</option>
                                                <option value="10" <?php if($recordcheck[0]['nposition']==10) { echo "selected";} ?>>10</option>
                                                </select>


                                        </div>
                                    </div>

                                </div>


                            </div>
                            
                            
                            
                             <div class="row">

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">From Date</label>
                                        <div class="location">
                                            <input name="fromdate" id="datetime3" class="form-control" value="<?php echo $recordcheck[0]['fromdate']; ?>" autocomplete="off" >


                                        </div>
                                    </div>

                                </div>
                                 
                                 
                                  <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">TO Date</label>
                                        <div class="location">
                                            <input name="todate" id="datetime" class="form-control" autocomplete="off" value="<?php echo $recordcheck[0]['todate']; ?>">


                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                            
                           
















                            <input type="hidden" name="updateid" id="updateid" value="<?php echo $recordcheck[0]['id']; ?>">  








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
if ($error) {
    ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
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





        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
      
		<link href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		
      
     	        <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
       
    	<script src="<?php echo base_url() ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	
    
	<script type="text/javascript">
						$("#datetime").datetimepicker({
							format: 'yyyy-mm-dd hh:ii',
                                                        autoclose: true
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