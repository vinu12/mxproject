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
                    <form role="form" id="editUser" action="<?php echo base_url() ?>admin_adminusers/add_advertise" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Title:</label>
                                        <input type="text" class="form-control required" value="" id="name"  autocomplete="off" name="name" maxlength="128" required>
                                    </div>

                                </div>

                                <?php
                                $photo = $news_result[0]['image'];
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
                                                    <option value="<?php echo $data2['cat_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data2['Category']; ?></option>

                                                    <?php
                                                    $CI = & get_instance();
                                                    $CI->load->model('Category_model');
                                                    $result3 = $CI->Category_model->childcategory($level1);


                                                    foreach($result3 as $data3) {
                                                        ?>
                                                        <option value="<?php echo $data3['cat_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data3['Category']; ?></option>									

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

                                            <option value="active" >Active</option>
                                            <option value="inactive">Inactive</option>




                                        </select>
                                    </div>

                                </div>
                            </div>



                            <div class="row">


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Publisher:</label>
                                        <input class="form-control" id="publisher" name="publisher" type="text" autocomplete="off" autocomplete="off">
                                    </div>

                                </div>


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Price/Rate:</label>

                                        <input class="form-control" id="price" name="price" type="text" autocomplete="off" autocomplete="off"/>

                                    </div>

                                </div>

                            </div>



                            <div class="row">


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Email:</label>
                                        <input class="form-control" id="email" name="email" type="text" autocomplete="off" autocomplete="off">
                                    </div>

                                </div>


                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Contact:</label>

                                        <input class="form-control" id="contact" name="contact" type="text" autocomplete="off" autocomplete="off"/>

                                    </div>

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Address</label>
                                        <div class="location">
                                            <input name="address" id="address" class="form-control" autocomplete="off" autocomplete="off">


                                        </div>
                                    </div>

                                </div>
                                
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">Position</label>
                                        <div class="location">
                                                <select required="required" class="form-control" name="nposition" id="nposition">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
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
                                            <input name="fromdate" id="datetime3" class="form-control" autocomplete="off" >


                                        </div>
                                    </div>

                                </div>
                                 
                                 
                                  <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="role">TO Date</label>
                                        <div class="location">
                                            <input name="todate" id="datetime" class="form-control" autocomplete="off">


                                        </div>
                                    </div>

                                </div>

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