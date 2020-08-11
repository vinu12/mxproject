
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<div class="content-wrapper">


			
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Program Management
        <small>Program  List</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin_adminusers/addprogram"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
		
		
		<div class="col-md-12">
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
		
		
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
               <!-- <div class="box-header">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin_adminusers/userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>--><!-- /.box-header -->
                <div class="box-body table-responsive no-padding"  >
               






<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">


<div class="panel">


<div class="panel-body">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<table id="example" class="display" cellspacing="0">
<thead>

<tr>
<th>Id</th>
<th>Program Image</th>
<th>Program Price</th>
<th>Program Desc</th>
<th>Program Pdf</th>
<th class="text-center">Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($publishprogramlist))
{
foreach($publishprogramlist as $record)
{
?>
<tr>
<td><?php echo $record['course_title'] ?></td>
<td><img src="<?php echo base_url(); ?>images/courseimg/<?php echo $record['course_image'];?>" style="width:100px;height:100px;"></td>

<td><?php echo $record['course_price'] ?></td>
<td><?php echo substr($record['course_desc'],0,100); ?></td>
<td><?php echo $record['coursepdf']?></td>


 <td><?php
                                                                    if ($record['status'] == 1) {
                                                                        ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 0 ?>')">Active				 </i>
                                                                           <?php
                                                                       } else {
                                                                           ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-danger btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 1 ?>')">Deactive				 </i>
                                                                        <?php
                                                                    }
                                                                    ?></td>



<td class="text-center">
<!--<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record['userId']; ?>" title="Login history"><i class="fa fa-history"></i></a> |--> 
<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/editprogram/'.base64_encode($record['id']); ?>" title="Edit"><i class="fa fa-pencil"></i></a>

<a class="btn btn-sm btn-danger deleteUser" href="#" onclick="deleteuser('<?php echo base64_encode($record['id']); ?>'); " title="Delete"><i class="fa fa-trash"></i></a>


</td>
</tr>



<?php
$i++;
}
}?> 
</tbody>
</table>








</div>
</div>


</div>
</div>


</div>



                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
		
		
		$('#example').DataTable( {
columnDefs: [ {
targets: [ 0 ],
orderData: [ 0, 1 ]
}, {
targets: [ 1 ],
orderData: [ 1, 0 ]
}, {
targets: [ 5 ],
orderData: [ 5, 0 ]
},


]
} );
    });
	
	
	
	  function checkstatus(userid,status)
    {
        
        var msg = (status == '0') ? 'Deactivate' : 'Activate';
       
        if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/updateactivestatusmain";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: userid, status: status},
                success: function (data)
                {
                    location.reload();
                }
            });
        } 
        
    }
	

function deleteuser(del)
	{
		
		 var msg = 'delete this user';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/deleteprogram";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: del},
                success: function (data)
                {
                    location.reload();
                }
            });
        }
	}
	


</script>
