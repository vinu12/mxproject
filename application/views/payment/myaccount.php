<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('<?php echo base_url(); ?>assets/images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Account</h2>
              
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="<?php echo base_url(); ?>">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Account</span>
      </div>
    </div>

 <div class="site-section">
	
	
	
	
        <div class="container">
		
		<div class="col-md-12">

	
	 <div class="">

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
	
       <div class="col-md-12 ">
           <table width="100%" class="table" style="font-size:12px;"  cellspacing="0" >
                                               

                                                    <tr style="background-color:#a22531;color:#fff;">
                                                        <th>Sr.</th>
														<th>Name</th>
														<th>email</th>
                                                        <th>Program</th>
                                                        
                                                       
                                                        <th>Transection Id</th>
                                                        <th>program Price</th>
                                                        
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                               
                                              
                                                    <?php
                                                    if (!empty($paymentlist)) {
                                                        $i = 1;
                                                        foreach ($paymentlist as $record) {
															
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><?php echo $record['name']; ?></td>
																<td><?php echo $record['email']; ?></td>
                                                                <td><?php echo $record['item_name']; ?></td>
                                                                
                                                               
                                                                <td><?php echo $record['item_number'] ?></td>
                                                                <td><?php echo $record['item_price'] ?></td>
                                                               
                                                             

                                                                <td><?php
                                                                    $dataval1 = explode(" ", $record['created']);
                                                                    $dataval = explode("-", $dataval1[0]);
                                                                    echo $data = $dataval[2] . "-" . $dataval[1] . "-" . $dataval[0] . " " . $dataval1[1];
                                                                    ?></td>
                                                                <td><?php
                                                                    if ($record['payment_status'] == 'succeeded') {
                                                                        ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 0 ?>')">succeeded				 </i>
                                                                           <?php
                                                                       } else {
                                                                           ?>
                                                                        <i data="480" class="status_checks btn btn-block btn-danger btn-xs
                                                                           btn-success" onclick="checkstatus('<?php echo $record['id']; ?>','<?php echo 1 ?>')">Failed				 </i>
                                                                        <?php
                                                                    }
                                                                    ?></td>

                                                                <td class="text-center">

              
                                               <a class="btn btn-sm btn-danger deleteUser" href="#" onclick="deleteuser('<?php echo base64_encode($record['id']); ?>'); "title="Delete">View</i></a>
                                                                </td>
                                                            </tr>



                                                            <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?> 
													

                                             
                                            </table>
																							<tr style="text-align:center;"><td colspan="12"><?php echo '<div class="pagination" style="text-align:center">'.$links.'</div>'; ?></td></tr>
											</div>
											
											
												
							
                            
                            
                               <div class="clearfix"> </div>
        </div>
		</div>
		</div>
		</div>
	<br>
	<br>
	<br>
	<br>




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

