
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<div class="content-wrapper">


			
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Cumulative Management
        <small>Sub child Category list</small>
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
<th>Sub child Category Name</th>
<th>Create Date</th>

<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($check_childsubcat))
{
	$i=1;
foreach($check_childsubcat as $record)
{
		//$cat_id=$record['cat_id'];  
		//$CI =& get_instance();
		//$CI->load->model('Category_model');
		//$result= $CI->Category_model->check_subcat($cat_id); 		

	
	
	//foreach($result as $subcat)
	//{
	
	
?>
<tr>
<td><?php echo $i; ?></td>

<td><a href="<?php echo base_url(); ?>admin_adminusers/subcatlist/<?php echo $record['cat_id'] ?>"><?php echo $record['Category'] ?></a></td>


<td><?php  $dataval=explode("/",$record['postdate']); echo $data=$dataval[1]."-".$dataval[0]."-".$dataval[2	];?></td>



<td><?php echo $record['status']?></td>

<td class="text-center">
 
<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/editnews/'.base64_encode($record['id']); ?>/<?php echo base64_encode($record['priority']); ?>" title="Edit"><i class="fa fa-pencil"></i></a>
<a class="btn btn-sm btn-danger deleteUser" href="#" onclick="deleteuser('<?php echo base64_encode($record['id']); ?>'); " title="Delete"><i class="fa fa-trash"></i></a>
</td>
</tr>



<?php
$i++;
//}
}
}
else
{
?>
<tr>
<td colspan="6" style="text-align:center;">No category found</td>
</tr>


<?php 
}	
?> 

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
	
	
function deleteuser(del)
	{
		 var msg = 'delete this user';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/deletesnews";
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
