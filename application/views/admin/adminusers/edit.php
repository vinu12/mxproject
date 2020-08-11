
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>


			<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
            <script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery.simple-dtpicker.js"></script>
            <link href="<?php echo base_url(); ?>assets/css/admin/jquery.simple-dtpicker.css" rel="stylesheet" type="text/css">-->


<section id="content_wrapper">

<header class="content-topbar">
<div class="topbar-left">
<ol id="breadcrumb" class="breadcrumb-styled">
<li class="crumb-icon">
<a href="dashboard.html">
<span class="glyphicon glyphicon-home"></span>
</a>
</li>
<li class="crumb-link">
 <a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a> 
</li>
<li class="crumb-link">
	<a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
</li>
<li class="crumb-trail active">
 <a href="#">Update</a>
</li>
</ol>
 <div class="page-header">
        <h2>
          Updating Employee Attendance
        </h2>
      </div>
</div>
</header>


<section id="content" class="">

<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">

<div class="panel">
<div class="panel-heading">

 <?php

            echo validation_errors();
            ?>  
  <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class=" alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Updated successfully.';
          echo '</div>';       
        }else{
          echo '<div class=" alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
 if(@$_REQUEST['erroe']!=''){ echo   '<font color="#c51515">!Sorry Please upload max 3 MB file size.</font>'; } ?>
</div>
<div class="panel-body">
	<?php

	echo form_open('admin_adminusers/updateattendance/', $editrecord[0]['id']);

	?>

	  
	  
	
	  
	  

<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">EmpCode</label>
<div class="col-lg-8">
  <?php
  echo form_input(array('name' => 'EmpCode', 'value' => set_value('EmpCode'), 'id' => 'EmpCode', 'placeholder' => 'Emp Code', 'value' => $editrecord[0]['EmpCode'], 'class' => 'form-control'));
  ?>
  
</div>
</div>

<div class="form-group">
<label class="col-lg-3 control-label" for="textArea1">ArrTime</label>
<div class="col-lg-8">
<?php
echo  form_input(array('name' => 'ArrTim', 'value' => set_value('ArrTim'), 'id' => 'ArrTim', 'placeholder' => 'Arr Tim', 'value' => $editrecord[0]['ArrTim'], 'class' => 'form-control'));

 ?>
</div>
</div>




<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">DepTime</label>
<div class="col-lg-8">
	<?php
		 echo form_input(array('name' => 'DepTim', 'value' => set_value('DepTim'), 'id' => 'DepTim', 'placeholder' => 'Dep Tim', 'value' => $editrecord[0]['DepTim'], 'class' => 'form-control'));
		 ?>
	</div>
</div>


<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">Late Hrs</label>
<div class="col-lg-8">
	<?php
		 echo form_input(array('name' => 'LateHrs', 'value' => set_value('LateHrs'), 'id' => 'LateHrs', 'placeholder' => 'Email Id', 'value' =>$editrecord[0]['LateHrs'], 'class' => 'form-control'));
		 ?>
	</div>
</div>



<div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">Ovr Time</label>
<div class="col-lg-8">

<?php
echo form_input(array('name' => 'OvTim', 'value' => set_value('OvTim'), 'id' => 'OvTim', 'placeholder' => 'Over Time', 'value' => $editrecord[0]['OvTim'], 'class' => 'form-control')); 
?>

</div>
</div>


<div>
<br>
<br>
<br>
</div>

<div class="form-group">
 <label class="col-lg-3 control-label" for="textArea1">&nbsp;</label>
	<div class="col-lg-3">
<?php
echo form_input(array('name' => 'updateid', 'id' => 'updateid', 'type' => 'hidden', 'value' => $editrecord[0]['id']));
echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary" onclick="return data()"');
echo form_close();
?>

	</div>
</div>

</div>
</div>

</div>
</div>


</div>

</section>


<script>

function data()
{

var empname=$("#EmpCode").val();
var ArrTim=$("#ArrTim").val();
var DepTim=$("#DepTim").val();
var LateHrs=$("#LateHrs").val();
var OvTim=$("#OvTim").val();


if(empname=="")
{
	alert("EmpCode can not blank");
	return false;
}
if(ArrTim=="")
{
	alert("ArrTime can not blank");
	return false;
}

if(DepTim=="")
{
	alert("DepTime can not blank");
	return false;
}

if(LateHrs=="")
{
	alert("LateHrs can not blank");
	return false;
}

if(OvTim=="")
{
	alert("OverTime can not blank");
	return false;
}
else
{
	return true;
}



}
$('#updated_on').appendDtpicker({
"dateFormat": "DD-MM-YYYY hh:mm",
"autodateOnStart": false,
"closeOnSelected": true
});
</script>


<script>
$('#added_on').appendDtpicker({
"dateOnly": true,
"dateFormat": "DD-MM-YYYY",
"autodateOnStart": false,
});

</script>













