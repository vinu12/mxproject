
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<div class="content-wrapper">


			
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Publish Feed Management
        <small>Publish Feed List</small>
      </h1>
    </section>
    <section class="content">
       
		
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
<th>Page title</th>
<th>Page Description</th>
<th>Author</th>

<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($punlishfeedlist))
{
	$i=1;
foreach($punlishfeedlist as $record)
{
		

?>
<tr>
<td><?php echo $i; ?></td>


<td><img src="<?php 
$basurlpath=base_url().'';
if($record['image']!="")
{


echo $record['image'];

}
else
{
echo $basurlpath."images/No_Image_Available.jpg";
}
?>" style="width:100px; width:80px;"></td>
<td><?php echo $record['page_title']; ?></td>

<td><?php $data= strip_tags($record['description']);  echo substr($data,0,30);?></td>
<td><?php echo $record['author'];?></td>
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
 
<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/editnews/'.base64_encode($record['id']); ?>/<?php echo base64_encode($record['priority']); ?>" title="Edit"><i class="fa fa-pencil"></i></a>
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
targets: [ 6 ],
orderData: [ 6, 0 ]
},


]
} );
    });
	
	


</script>


<script type="text/javascript">
    
    
    
    function checkstatus(userid,status)
    {
        
        var msg = (status == 'active') ? 'Deactivate' : 'Activate';
       
        if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/updateactivestatus";
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
           
            url = "<?php echo base_url(); ?>admin_adminusers/deletenews";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: del},
                success: function (data)
                {
                    //location.reload();
                }
            });
        }
	}
    
    
</script>
