
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
          Edit Employee Invoice
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
  
 
  
  echo $this->session->flashdata('errmsg');

  
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class=" alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> manufacturer updated with success.';
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
						$record = array('onsubmit' => "return checkinvoiceValidation();");
                        echo form_open('admin_adminusers/updateemployeeinvoice/', $record);
                        //echo '<h2 class="form-signin-heading">Update Employee Attendance</h2>';
      ?>

	  
	  
	  <div class="form-group">
<label for="disabledInput" class="col-lg-3 control-label">Name</label>
<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'name', 'value' => set_value('name'), 'id' => 'name', 'placeholder' => 'name', 'value' => $editrecordinvoice[0]['Name'], 'class' => 'form-control'));
		 ?>
	</div>
	
	
	
	
	<label for="disabledInput" class="col-lg-3 control-label">invoice No</label>
<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'invoice_no', 'value' => set_value('invoice_no'), 'id' => 'invoice_no', 'placeholder' => 'invoice_no', 'value' => $editrecordinvoice[0]['invoice_no'], 'class' => 'form-control'));
		 ?>
	</div>
	
	<label for="disabledInput" class="col-lg-3 control-label">Currency</label>

	
	<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'Currency', 'value' => set_value('Currency'), 'id' => 'Currency', 'placeholder' => 'Currency', 'value' => $editrecordinvoice[0]['Currency'], 'class' => 'form-control'));
		 ?>
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Amount</label>
<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'Amount', 'value' => set_value('Amount'), 'id' => 'Amount', 'placeholder' => 'Amount', 'value' => $editrecordinvoice[0]['Amount'], 'class' => 'form-control'));
		 ?>
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Country</label>
<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'Country', 'value' => set_value('Country'), 'id' => 'name', 'placeholder' => 'Country', 'value' => $editrecordinvoice[0]['Country'], 'class' => 'form-control'));
		 ?>
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Approved By</label>
<div class="col-lg-8">
	<?php

		 echo form_input(array('name' => 'Approved_by', 'value' => set_value('Approved_by'), 'id' => 'Approved_by', 'placeholder' => 'Approved_by', 'value' => $editrecordinvoice[0]['Approved_by'], 'class' => 'form-control'));
		 ?>
	</div>
	
	
	
		<label for="disabledInput" class="col-lg-3 control-label">Nature</label>
<div class="col-lg-8">
<textarea name='Nature' class="form-control" id='Nature' rows="10" cols="88"><?php echo $editrecordinvoice[0]['Nature']; ?></textarea>
	
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Account Details</label>
<div class="col-lg-8">
	
		 
		  <textarea name='Account_Details' class="form-control" id='Account_Details' rows="10" cols="88"><?php echo $editrecordinvoice[0]['Account_Details']; ?></textarea>
	</div>
	
	
		<label for="disabledInput" class="col-lg-3 control-label">Remarks</label>
<div class="col-lg-8">

<textarea name='Remarks' id='Remarks'  class="form-control" rows="10" cols="88"><?php echo $editrecordinvoice[0]['Remarks']; ?></textarea>
	
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Email Id</label>
<div class="col-lg-8">
<?php
 echo form_input(array('name' => 'email_id', 'value' => set_value('email_id'), 'id' => 'email_id', 'placeholder' => 'Email ID', 'value' => $editrecordinvoice[0]['email_id'], 'class' => 'form-control'));
 ?>
	
	</div>
	
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Pan No</label>
<div class="col-lg-8">

<?php
 echo form_input(array('name' => 'pan_no', 'value' => set_value('pan_no'), 'id' => 'pan_no', 'placeholder' => 'Pan No', 'value' => $editrecordinvoice[0]['pan_no'], 'class' => 'form-control'));
 ?>	
	</div>
	
	
	<label for="disabledInput" class="col-lg-3 control-label">Address</label>
<div class="col-lg-8">

<textarea name='emp_address' id='emp_address'  class="form-control" rows="10" cols="88"><?php echo $editrecordinvoice[0]['emp_address']; ?></textarea>
	
	</div>
	
	
	
	
	
</div>
	  
	  




<br>
<br>
<br>
		

<div class="form-group">
 <label class="col-lg-3 control-label" for="textArea1">&nbsp;</label>
	<div class="col-lg-3">
<?php

echo form_input(array('name' => 'updateid', 'id' => 'updateid', 'type' => 'hidden', 'value' => $editrecordinvoice[0]['id']));
?>

<?php
echo form_submit('submit', 'Update', 'class="btn btn-large btn-primary"');
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

    function checkinvoiceValidation()
	{
		var name =$("#name").val();
		var invoice_no =$("#invoice_no").val();
		var Currency =$("#Currency").val();
		var Amount =$("#Amount").val();
		var Country =$("#Country").val();
		var Approved_by =$("#Approved_by").val();
		var Nature =$("#Nature").val();
		var Account_Details =$("#Account_Details").val();
		var email_id =$("#email_id").val();
		var pan_no =$("#pan_no").val();
		var emp_address=$("#emp_address").val();
		
		
		
		
		
		var NumberRegex = /^[0-9]*$/;
		if(name=="")
		{
			alert("Please enter Employee Name.");
			return false;
		}
		
		if(invoice_no=="")
		{
			alert("Please enter invoice no.");
			return false;
		}
		if(Currency=="")
		{
			alert("Please enter Currency.");
			return false;
		}
		
		if(Amount=="")
		{
			alert("Please enter Amount.");
			return false;
		}
		
		if(Country=="")
		{
			alert("Please enter Country.");
			return false;
		}
		
		if(Approved_by=="")
		{
			alert("Please enter apporverd by.");
			return false;
		}
		
		if(Nature=="")
		{
			alert("Please enter nature.");
			return false;
		}
		
		if(Account_Details=="")
		{
			alert("Please enter Account details.");
			return false;
		}
		
		
		if(email_id=="")
		{
			alert("Please enter email address.");
			return false;
		}
		
		if(pan_no=="")
		{
			alert("Please enter email address.");
			return false;
		}
		
		if(emp_address=="")
		{
			alert("Please enter email address.");
			return false;
		}
		
		else
		{
			
			return true;
		}
		
		
		
	}

  




</script>
















