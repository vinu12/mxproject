
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
        <small>Edit Sub category</small>
      </h1>
	  

	  
    </section>
    
	
       
		
		
	

    
	
		
		
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
		
		
		
		
		 <section class="content">
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
<div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Sub Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin_adminusers/updatesubcategory" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">  
								
                                    <div class="form-group">
                                        <label for="fname">Category</label>
                                       <select name="category" name="category" class="form-control" disabled="disabled">
									   <option value="0">Select category</option>
									   <?php 
									   foreach($top_cat_list as $cat)
									   {
										  
									   ?>
									   <option value="<?php echo $cat['cat_id'] ?>" <?php if($cat_id==$cat['cat_id']) { echo "selected";} ?>><?php echo $cat['Category']; ?></option>
									   <?php
									   }
									   ?>
									   </select>
                                    </div>
									
                                    
                                </div>
                                <div class="col-md-6">
                                 <div class="form-group">
                                        <label for="fname">Sub Category Name</label>
                                        <input type="text" class="form-control " value="<?php echo $subcatdata->Category; ?>" id="categoryname" name="categoryname" maxlength="128"  required>
                                    </div>
									<input type="hidden" name="catid" id='catid' value="<?php echo ($cat_id); ?>">
									<input type="hidden" name="updateid" value="<?php echo ($subcatdata->cat_id); ?>">
                                </div>
                            </div>
                            
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" name="update" id="update" class="btn btn-primary" value="update" />
                            
                        </div>
                    </form>
                </div>




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
