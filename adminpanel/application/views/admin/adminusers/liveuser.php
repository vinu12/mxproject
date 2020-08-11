
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Live User Management
            <small>View User</small>
        </h1>
    </section>
    <section class="content">



        <div class="col-md-12">
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
            <?php } ?>
            <?php
            $success = $this->session->flashdata('success');
            if ($success) {
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
                                                        <th>Sr.</th>
														<th>Login Type</th>
														<th>Photo</th>
                                                        <th>Name</th>
                                                        
                                                       
                                                        <th>Email</th>
                                                        <th>Mobile</th>
                                                        
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($user_result)) {
                                                        $i = 1;
                                                        foreach ($user_result as $record) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><?php echo $record['oauth_provider']; ?></td>
																<td><img src="<?php 
																$basepath=base_url();
																$maining=$record['photo'];
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
																?>" style="width:100px; width:80px;"></td>
                                                                <td><?php echo substr($record['user_name'], 0, 10); ?></td>
                                                                
                                                               
                                                                <td><?php echo $record['user_email'] ?></td>
                                                                <td><?php echo $record['user_mobile'] ?></td>
                                                               
                                                             

                                                                <td><?php
                                                                    $dataval1 = explode(" ", $record['created']);
                                                                    $dataval = explode("-", $dataval1[0]);
                                                                    echo $data = $dataval[2] . "-" . $dataval[1] . "-" . $dataval[0] . " " . $dataval1[1];
                                                                    ?></td>
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

              
                                               <a class="btn btn-sm btn-danger deleteUser" href="#" onclick="deleteuser('<?php echo base64_encode($record['id']); ?>'); "title="Delete"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>



                                                            <?php
                                                            $i++;
                                                        }
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
<?php //echo $this->pagination->create_links();   ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
       


        $('#example').DataTable({
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                }, {
                    targets: [1],
                    orderData: [1, 0]
                }, {
                    targets: [5],
                    orderData: [5, 0]
                },
            ]
        });
    });




</script>

<script type="text/javascript">
    
    
    
    function checkstatus(userid,status)
    {
        
        var msg = (status == '0') ? 'Deactivate' : 'Activate';
       
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
           
            url = "<?php echo base_url(); ?>admin_adminusers/deleteliveuser";
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
