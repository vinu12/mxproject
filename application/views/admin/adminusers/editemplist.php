<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter  New Staff  Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addstaff" action="<?php echo base_url() ?>admin_adminusers/updateemplist" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">New Staff Member Name:	</label>
                                        <input type="text" class="form-control required" value="<?php echo $editemp[0]['name']; ?>" id="fname" name="fname" maxlength="128">
                                    </div>
                                    
                                </div>
								
								 
								
								
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="grade">Staff Designation / Grade:</label>
                                        <select class="form-control required" id="grade" name="grade">
                                            <option value="0">Select Grade</option>
                                            <?php
                                            if(!empty($grade_records))
                                            {
                                                foreach ($grade_records as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl['grade'] ?>" <?php if($rl['grade'] == $editemp[0]['grade']) {echo "selected=selected";} ?>><?php echo $rl['grade'] ?>(<?php echo $rl['grade_name'] ?>)</option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
								</div>
								<div class="row">
								 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="reporting">Line Manager Name:		</label>
                                        
										
										<select class="form-control required" id="reporting" name="reporting">
                                            <option value="0">Select Manager</option>
                                            <?php
                                            if(!empty($manager_records))
                                            {
                                                foreach ($manager_records as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl['name'] ?>" <?php if($rl['name'] == $editemp[0]['reporting_to']) {echo "selected=selected";} ?>><?php echo $rl['name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
										
                                    </div>
                                    
                                </div>
								
								
								 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="department">Department:		</label>
                                       
										
										<select class="form-control required" id="department" name="department">
                                            <option value="0">Select Department</option>
                                            <?php
                                            if(!empty($department_records))
                                            {
                                                foreach ($department_records as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl['department_name'] ?>" <?php if($rl['department_name'] == $editemp[0]['department']) {echo "selected=selected";} ?>><?php echo $rl['department_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
								</div>
										
										

										
								<div class="row">		
								 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="division">Division:		</label>
                                       
										<select class="form-control required" id="division" name="division">
                                            <option value="0">Select division</option>
                                            <?php
                                            if(!empty($division_records))
                                            {
                                                foreach ($division_records as $rl)
                                                {
													
													
													
                                                    ?>
                                                    <option value="<?php echo $rl['division_name'] ?>" <?php 
													if(trim($rl['division_name']) == trim($editemp[0]['division'])) {echo "selected=selected";} ?>><?php echo $rl['division_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
										
                                    </div>
                                    
                                </div>
								<?php
$joindate=explode("-",$editemp[0]['join_date']);
$mainjoindate=$joindate[2]."-".$joindate[1]."-".$joindate[0];									
								?>
								<div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="joindate">Date of Joining:</label>
                                        <input type="text" class="form-control required" value="<?php echo $mainjoindate; ?>" id="joindate" name="joindate" maxlength="128">
                                    </div>
                                    
                                </div>
								</div>
								<div class="row">
								<div class="col-md-6">                                
                                    <div class="form-group">
									<?php
										$prdate=explode("-",$editemp[0]['probation_date']);	
										$maindate=$prdate[2]."-".$prdate[1]."-".$prdate[0];
									?>
										<label for="Probation">Probation</label>
                                        <input type="text"  class="form-control required" value="<?php echo $maindate; ?>" id="probation_date" name="probation_date" maxlength="128">
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo $editemp[0]['email']; ?>" name="email" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Empcode">Emp Code</label>
                                        <input type="text" class="form-control required" id="Empcode" name="Empcode" value="<?php echo $editemp[0]['empcode']; ?>" maxlength="20">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo $editemp[0]['mobile_no']; ?>" name="mobile" maxlength="10">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div><!-- /.box-body -->
						<input type="hidden" name="updateid" id="updateid" value="<?php echo $editemp[0]['id'];?>">
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
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
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- Javascript -->
      <script>
         $(function() {
            $("#joindate").datepicker();
            $("#joindate").datepicker("setDate", "0");
			{ dateFormat: "yy-mm-dd" }
			$("#probation_date").datepicker();
            $("#probation_date").datepicker("setDate", "90");
			
			
         });
			$("#joindate").datepicker(
			{ dateFormat: "dd-mm-yy" }
			);
			$("#probation_date").datepicker(
			{ dateFormat: "dd-mm-yy" }
			);
      </script>
<script src="<?php echo base_url(); ?>assets/js/addstaff.js" type="text/javascript"></script>