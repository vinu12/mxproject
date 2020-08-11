
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<div class="content-wrapper">


			
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Special Offers 
        <small>View Special Offers</small>
      </h1>
    </section>
    <section class="content">
       
		  <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin_adminusers/addspecialoffer/<?php echo $catid; ?>"><i class="fa fa-plus"></i> Add Special offer</a>
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
<th>image</th>
<th>Offer Name</th>
<th>Price </th>
<th>Discount</th>

<th>From Date</th>
<th>To Date</th>
<th>Notification</th>
<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($dealslist))
{
	$i=1;
foreach($dealslist as $record)
{

?>
<tr>
<td><?php echo $i; ?></td>


<td><img src="<?php 

$basepath=base_url(); 
$maining=$record['image'];
$data=parse_url($maining, PHP_URL_SCHEME);

if($data=='http' || $data=='https')
  {
  $img = $maining;
  }
  
  
  
  else if($data!='http' || $data!='https'){
  
  $img = $basepath.$maining;
  
  }
  else
  {
   
  }
  
  if($maining=='')
  {
  $img = $basepath."images/No_Image_Available.jpg";

  }

echo $img;

?>" style="width:100px;"></td>
<td><?php echo $record['offername']; ?></td>
<td><?php echo $record['actualprice']; ?></td>
<td><?php echo $record['discount']; ?></td>


<td><?php echo $record['fromdate'];?></td>
<td><?php echo $record['todate'];?></td>

<td>



<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="View" onclick="sendnotification('<?php echo $record['id']; ?>');">Send Notification</a>
	<div id='process<?php echo $record['id']; ?>' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>	 

</td>


<td><?php
                                                                    if ($record['status'] == 'active') {
                                                                        ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 'deactive'; ?>')">Publish				 </i>
                                                                           <?php
                                                                       } else {
                                                                           ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-danger btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 'active'; ?>')">OnHold				 </i>
                                                                        <?php
                                                                    }
                                                                    ?></td>



<td class="text-center">

<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/editspecialoffer/'.base64_encode($record['id']); ?>/<?php echo base64_encode($record['dealsid']); ?>" title="Edit"><i class="fa fa-pencil"></i></a>
<a class="btn btn-sm btn-danger deleteUser" href="javacript:void(0);" onclick="deleteuser('<?php echo base64_encode($record['id']); ?>'); " title="Delete"><i class="fa fa-trash"></i></a>
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
      
		
		
		$('#example').DataTable( {
columnDefs: [ {
targets: [ 0 ],
orderData: [ 0, 1 ]
}, {
targets: [ 1 ],
orderData: [ 1, 0 ]
}, {
targets: [ 7 ],
orderData: [ 7, 0 ]
},


]
} );
    });
	
	


</script>


<script type="text/javascript">
    
    
    
    function checkstatus(userid,status)
    {
        
        var msg = (status == 'active') ? 'Activate' : 'Deactivate';
       
        if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/updatespecialactivestatus";
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
		 var msg = 'delete this special offer';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/deletespecialnews";
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
	
	function sendnotification(sendid)
{
	
			var msg = 'notification';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/senddealnotification";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: sendid},
				beforeSend:function(){
				$('#process'+sendid).show();

				

				},
                success: function (data)
                {
                    //location.reload();
					$('#process'+sendid).hide();
                }
            });
        }
	
}
    
    
</script>
