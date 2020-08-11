<section id="content_wrapper">
<section id="content" class="">

<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">
<ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider"></span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(3));?>
        </li>
      </ul>
<div class="panel">
<div class="panel-heading">
<span class="panel-title">
Update an account

</span>
</div>
<div class="panel-body">

<div class="form-group">

<?php 

echo '<br><br><div id="delmsg"><h4>'.$this->session->flashdata('delmsg').'</h4></div>';
?>

<?php
$attributes = array('class' => 'form-horizontal');   
echo form_open('admin/adminusers/updatemember/',$recordUserData[0]['id']);


echo'<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">First Name</label>
<div class="col-lg-8">
';
echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name'),'id'=>'first_name','placeholder'=>'First name','class'=>'form-control','value'=>$recordUserData[0]['first_name']));


echo '</div>

</div>';

echo '<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Last Name</label>
<div class="col-lg-8">
';
echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name'),'id'=>'last_name','class'=>'form-control','placeholder'=>'Last name','value'=>$recordUserData[0]['last_name']));


echo '</div>

</div>';

echo '<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">Email</label>
<div class="col-lg-8">
';


echo form_input(array('name'=>'email_address', 'value'=>set_value('email_address'),'id'=>'email_address','placeholder'=>'Email','class'=>'form-control','value'=>$recordUserData[0]['email_addres']));


echo '</div>

</div>';



echo '<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label">UserName</label>
<div class="col-lg-8">
';
echo form_input(array('name'=>'username', 'value'=>set_value('username'),'id'=>'username','placeholder'=>'Username','class'=>'form-control','value'=>$recordUserData[0]['user_name']));


echo '</div>

</div>';

echo form_input(array('name'=>'updateid','id'=>'updateid','type'=>'hidden','value'=>$recordUserData[0]['id']));

echo '<div class="form-group">
<label for="inputStandard" class="col-lg-3 control-label"></label>
<div class="col-lg-8"> <br>';
echo form_submit('submit', 'submit', 'class="btn btn-primary"');
echo '</div>

</div>';
echo form_close();
?>
</div>
</div>

</div>
</div>


</div>

</section> 
 
 
</section> 




<!--<div class="container top">
<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title></title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  </head>
  <body>
<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<?php



$attributes = array('class' => 'form-signin');   
echo form_open('admin/adminusers/updatemember/',$recordUserData[0]['id']);
echo '<h2 class="form-signin-heading">Update Account</h2>';
echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name'),'id'=>'first_name','placeholder'=>'First name','value'=>$recordUserData[0]['first_name']));
echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name'),'id'=>'last_name','placeholder'=>'Last name','value'=>$recordUserData[0]['last_name']));
echo form_input(array('name'=>'email_address', 'value'=>set_value('email_address'),'id'=>'email_address','placeholder'=>'Email','value'=>$recordUserData[0]['email_addres']));
echo form_input(array('name'=>'username', 'value'=>set_value('username'),'id'=>'username','placeholder'=>'Username','value'=>$recordUserData[0]['user_name']));
echo form_input(array('name'=>'updateid','id'=>'updateid','type'=>'hidden','value'=>$recordUserData[0]['id']));
echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    
  </body>
</html>     
</div>-->


