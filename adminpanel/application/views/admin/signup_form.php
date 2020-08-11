


<section id="content_wrapper">
<style>
.alert { color:#d60000 !important; background-color::#fff !important;}
</style>
<header class="content-topbar">
<div class="topbar-left">
<ol id="breadcrumb" class="breadcrumb-styled">
<li class="crumb-icon">
<a href="dashboard.html">
<span class="glyphicon glyphicon-home"></span>
</a>
</li>
<li class="crumb-link">
 <a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1)); ?></a> 
</li>
<li class="crumb-trail active">
 <a href="#"><?php echo ucfirst($this->uri->segment(2)); ?></a>
</li>
</ol>
 
</div>
</header>


<section id="content" class="">

<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">

<div class="panel">
  <div style="background-color::#fff !important;">
  <?php
  
			//form validation
            echo validation_errors();
            ?>  	</div>
<div class="panel-heading" >
Create an account
            <?php
				$attributes = array('class' => 'form-horizontal');  
				echo '<br><br><div id="delmsg"><h4>'.$this->session->flashdata('delmsg').'</h4></div>';
            ?>
</div>
<div class="panel-body">
<?php
    echo form_open('admin/adminusers/create_member', $attributes);

      ?>


<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">First Name</label>
<div class="col-lg-8">
 <?php
echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name'),'id'=>'first_name','placeholder'=>'First name','class'=>'form-control'));
?><br>
</div>
</div>

<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">Last Name</label>
<div class="col-lg-8">
<?php
echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name'),'id'=>'last_name','placeholder'=>'Last name','class'=>'form-control'));

?><br>
</div>
</div>
<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">Email</label>
<div class="col-lg-8">
<?php
echo form_input(array('name'=>'email_address', 'value'=>set_value('email_address'),'id'=>'email_address','placeholder'=>'Email','class'=>'form-control'));
?>
<br>
</div>
</div>


<div class="form-group">
<label class="col-lg-3 control-label" for="textArea1">UserName</label> 
<div class="col-lg-8">
<?php
echo form_input(array('name'=>'username', 'value'=>set_value('username'),'id'=>'username','placeholder'=>'Username','class'=>'form-control'));
?><br>
</div>
</div>

<div class="form-group">
  <label class="col-lg-3 control-label" for="textArea1">Password</label>
	<div class="col-lg-8">
		<?php
echo form_input(array('name'=>'password','type'=>'password', 'value'=>set_value(''),'id'=>'username','placeholder'=>'password','class'=>'form-control'));
?><br>
	</div>
</div>

<div class="form-group">
  <label for="inputSelect" class="col-lg-3 control-label">Confirm password</label>
	<div class="col-lg-8">
		 <?php echo form_input(array('name'=>'password2','type'=>'password', 'value'=>set_value(''),'id'=>'username','placeholder'=>'Password confirm','class'=>'form-control')); ?><br>
	</div>
</div>



<div class="form-group">
 <label class="col-lg-3 control-label" for="textArea1">&nbsp;</label>
	<div class="col-lg-3"><br>
			<button class="btn btn-primary" type="submit">Save changes</button>
			<button class="btn btn-danger" type="reset">Cancel</button>
	</div>
</div>

 <?php echo form_close(); ?>
</div>
</div>

</div>
</div>


</div>

</section>

<script>


                    $('#updated_on').appendDtpicker({
                        "dateFormat": "DD-MM-YYYY hh:mm",
                        "closeOnSelected": true
                    });




                </script>


                <script>

                    $('#added_on').appendDtpicker({
                        "dateOnly": true,
                        "dateFormat": "DD-MM-YYYY",
                        "closeOnSelected": true
                    });


                </script>

 <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>



