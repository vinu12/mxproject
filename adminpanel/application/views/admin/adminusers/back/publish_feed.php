
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->


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


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<table id="example" class="display" cellspacing="0">
<thead>

<tr>
<th>Id</th>
<th>image/Video</th>
<th>Page title</th>
<th>News Category</th>
<th>Hash tags</th>

<th>Page Description</th>
<th>Author</th>
<th>Notification</th>
<th>Image Type</th>
<th>Status</th>

<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($punlishfeedlist))
{
	
foreach($punlishfeedlist as $record)
{
		

?>
<tr>
<td><?php echo $record['id']; ?></td>


<?php



?>

<td>
<?php 

if($record['video_link']!="")
{
?>
<iframe width="100" height="100" src="<?php echo base_url(); ?>/images/video/<?php echo $record['video_link']; ?>" frameborder="0" allowfullscreen></iframe>





<?php
}
else
{

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

?>



<img src="<?php echo $img;
?>" style="width:100px; width:80px;">

<?php
}
?>

</td>
<td><?php echo $record['page_title']; ?></td>

<td>
<?php echo $record['priority']; ?>
</td>

<td style="color:green;"><b>
#<?php echo $record['hashtags']; ?></b>
</td>



<td><?php $data= strip_tags($record['description']);  echo substr($data,0,30);?></td>
<td><?php echo $record['author'];?></td>

<td>



<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="View" onclick="sendnotification('<?php echo $record['id']; ?>');">Send Notification</a>
	<div id='process<?php echo $record['id']; ?>' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>	 

</td>
<?php $idval=$record['id']; ?>
<td>
	<div id='imgst<?php echo $idval; ?>'>
	
	<select name="imagetype" id="imagetype" onchange="checkimgstatus('<?php echo $idval;?>',this.value)">
	<option value="">Select Status</option>
	<option value="0" <?php if($record['imagetype']==0) { echo "selected";} ?>>Small</option>
	<option value="1" <?php if($record['imagetype']==1) { echo "selected";} ?>>Big</option>
	<option value="2" <?php if($record['imagetype']==2) { echo "selected";} ?>>Banner</option>
	
	</select>
	<div id='processimage<?php echo $record['id']; ?>' style="display:none; text-align: center;
    margin: 5px 45% !important;">
							<img src="<?php echo base_url(); ?>assets/images/loader.gif">
							</div>	
	</div>






</td>

<td><?php
                                                                    if ($record['status'] == 'active') {
                                                                        ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 'inactive'; ?>')">Publish				 </i>
                                                                           <?php
                                                                       } else {
                                                                           ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-danger btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 'active'; ?>')">OnHold				 </i>
                                                                        <?php
                                                                    }
                                                                    ?></td>



<td class="text-center">

 <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/viewsnews/'.base64_encode($record['id']); ?>/<?php echo base64_encode($record['priority']); ?>" title="Edit"> <i class="fa fa-eye" aria-hidden="true"></i></a>
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
				<?php echo '<div class="pagination">'.$links.'</div>'; ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>




<script type="text/javascript">
    
    
    
    function checkstatus(userid,status)
    {
        
        var msg = (status == 'active') ? 'active' : 'deactive';
       
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
	
	  function checkimgstatus(userid,status)
    {
        
		if(status==0)
		{
		var  msg='small';	
		}
		else if(status==1)
		{
		var	msg='big';
		}
		else
		{
			var msg='banner';
		}
        //var msg = (status == 0) ? 'small' : 'big';
       
        if (confirm("Are you sure to publish as a " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/updateimagestatus";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: userid, status: status},
				beforeSend:function(){
				$('#processimage'+userid).show();

				

				},
                success: function (data)
                {
					
                    $('#imgst'+userid).html(data);
					$('#processimage'+userid).hide();
					//location.reload();
                }
            });
        } 
        
    }
	
	
	
    
    
	
	function deleteuser(del)
	{
		 var msg = 'delete this feed';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/deletenews";
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
           
            url = "<?php echo base_url(); ?>admin_adminusers/sendnotification";
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
