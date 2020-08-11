
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
        <small>Classified List</small>
      </h1>
	  
	  <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin_adminusers/cumulativelist/add"><i class="fa fa-plus"></i> Add New Category</a>
                </div>
            </div>
        </div>
	  
    </section>
    
	<?php
if($editdata)
{	


	?>
       
		<div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Category Name</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin_adminusers/editcategory" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Category Name</label>
                                        <input type="text" class="form-control " value="<?php echo $editdata->Category; ?>" id="categoryname" name="categoryname" maxlength="128" required>
                                    </div>
									<input type="hidden" name="updateid" value="<?php echo base64_encode($editdata->cat_id); ?>">
                                    
                                </div>
                                <div class="col-md-6">
                                
                                </div>
                            </div>
                            
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" name="update" id="update" class="btn btn-primary" value="update" />
                            
                        </div>
                    </form>
                </div>
		
		<?php
}

?>

    
	<?php
if($addcat=='add')
{	


	?>

<div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Category Name</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin_adminusers/addcategory" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Category Name</label>
                                        <input type="text" class="form-control " value="" autocomplete="off" id="categoryname" name="categoryname" maxlength="128" required>
                                    </div>
									                                    
                                </div>
                                <div class="col-md-6">
                                 
                                </div>
                            </div>
                            
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="submit" />
                            
                        </div>
                    </form>
                </div>

<?php
}
?>

		
		
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
<th>Top Category Name</th>
<th>Create Date</th>

<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($cumulativelist))
{
	$i=1;
foreach($cumulativelist as $record)
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

<td><a href="<?php echo base_url(); ?>admin_adminusers/subcatlist/<?php echo base64_encode($record['cat_id']); ?>"><?php echo $record['Category'] ?></a></td>


<td><?php  $dataval=explode("/",$record['postdate']); echo $data=$dataval[1]."-".$dataval[0]."-".$dataval[2	];?></td>



<td><?php echo $record['status']?></td>

<td class="text-center">
 
<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin_adminusers/cumulativelist/'.base64_encode($record['cat_id']); ?>" title="Edit"><i class="fa fa-pencil"></i></a>
<a class="btn btn-sm btn-danger deleteUser" href="javascript:void(0);" onclick="deleteuser('<?php echo base64_encode($record['cat_id']); ?>'); " title="Delete"><i class="fa fa-trash"></i></a>
</td>
</tr>



<?php
$i++;
//}
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
targets: [ 4 ],
orderData: [ 4, 0 ]
},


]
} );
    });
	
	
function deleteuser(del)
	{
		 var msg = 'delete this category';
		 
		  if (confirm("Are you sure to " + msg)) {
           
            url = "<?php echo base_url(); ?>admin_adminusers/deletecategory";
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
