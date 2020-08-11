    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	
	<?php
/*  echo "<pre>";
 print_r($srchIndstryData);
die;  */
if($this->uri->segment(4)=="")
{
	$pageNumber = "1";
}
else
{
	$pageNumber = $this->uri->segment(4);
}
?> 

<section id="content_wrapper">

<header class="content-topbar">
<div class="topbar-left">
<ol id="breadcrumb" class="breadcrumb-styled">
<li class="crumb-icon">
<a href="dashboard.html">
<span class="glyphicon glyphicon-home"></span>
</a>
</li>
<li class="crumb-link">
 <a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a> 
</li>
<li class="crumb-trail active">
<a href="#"><?php echo ucfirst($this->uri->segment(2));?></a>
</li>
</ol>
   <!--<div class="page-header users-header">
       
	      
	   <?php
	   
		$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

		$date = getdate();
		$month = $date['mon'];
		$month_name = $mons[$month];
		$data=date('Y-m-d');
		$maindate=explode("-",$data);
		  //echo $maindatenew= $maindate[2]." ". $month_name." ". $maindate[0];
		  
		

	     ?>
      </div>-->
      
</div> 
</header>

<script>

function ajaxsearch()
{
	var empcode=$("#empcode").val();
	var startdate=$("#popupDatepicker").val();
	var enddate=$("#popupDatepicker1").val();
	if(empcode=="0")
	{
		alert("Please select Employee Name");
		return false;
	}
	
	
	if(startdate==enddate)
	{
		alert("End date should be greater then start date");
		return false;
	}
	
	
	
	else
	{
		
		//$("#searchemp").click(function() {
		$.ajax
		({
			type:'POST',
			url:'<?php echo base_url(); ?>admin_adminusers/dateajax',
			cache:false,
			data:{empcode: empcode,startdate:startdate,enddate:enddate},
			success:function(dataresponce)
			{
				var response =dataresponce;
				
				
				
				$("#example").html(dataresponce);
				
				$("#example_filter").hide();
				$("#example_paginate").hide();
				$("#example_info").hide();
				$("#example_length").hide();
				
						
			}
		});
		
	}
		
		
	
}

function checkdata()
{
	$("#example_filter").hide();
	$("#example_paginate").hide();
	$("#example_info").hide();
					
}

</script>

<section id="content" class="">

<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">



<table class="table" width="100%">
<tr>
<td>
<b>Late Coming  Employee<b> 
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Start Time  
</td>
<td>
<select name="latetimestart" id="latetimestart" class="form-control" onChange="latechecktime(this.value);">
<option value="0">Select start time</option>
<?php  foreach($starttimearray as $key=>$val)

{
?>
<option value="<?php echo $key; ?>"><?php  echo $val;?></option>

<?php
}
?>
</select>

<td>
End Time
</td>
<td>
<select name="latetimeend" id="latetimeend" class="form-control">
<option value="0">Select End time</option>
<?php foreach($endtimearray as $key=>$valdata)
{
	?>
<option value="<?php echo $key;?>"><?php echo $valdata; ?></option>

<?php
}
?>

</select>

<td>
</td>
<td>
<input type="button" name="filterdata" value="Late Filter" class="btn btn-info" id='filterdata' onclick="return ajaxfilterlateRecord();">
</td>
</tr>
</table>






<!--<table class="table" width="100%">
<tr>
<td>
<b>Month Bouns Employee<b> 
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Start Time  
</td>
<td>
<select name="timestart" id="timestart" class="form-control" onChange="checktime(this.value);">
<option value="0">Select start time</option>
<?php  foreach($starttimearray as $key=>$val)

{
?>
<option value="<?php echo $key; ?>"><?php  echo $val;?></option>

<?php
}
?>
</select>

<td>
End Time
</td>
<td>
<select name="timeend" id="timeend" class="form-control">
<option value="0">Select End time</option>
<?php foreach($endtimearray as $key=>$valdata)
{
	?>
<option value="<?php echo $key;?>"><?php echo $valdata; ?></option>

<?php
}
?>

</select>

<td>
</td>
<td>
<input type="button" name="filterdata" value="Bonus Filter" class="btn btn-info" id='filterdata' onclick="return ajaxfilterRecord();">
</td>
</tr>




<tr>
<td>
Late Coming
</td>
<td>
<select name="latecom" id="latecoming" class="form-control">
<option value="0">Select late</option>
<option value="first">First Half</option>
<option value="second">second Half</option>

</select>
</td>
<td>
<input type="button" name="filterdata" value="Filter" class="btn btn-info" id='filterdata' onclick="return ajaxsearchnew();">
</td>
</tr>
</table>-->
<table>
<tr>
<td colspan="3" style="border-color:#000 1px solid;">
</td>
</td>
</table>




<table class="table">
<tr>
<td>
Select Employee
</td>

<td>
<select name="empcode" id="empcode" class="form-control">
<option value="0">Select Employee</option>
<?php 
foreach($emprecord as $valemp)
{
?>
<option value="<?php echo $valemp['EmpCode'];?>"><?php echo $valemp['name'];?></option>

<?php
}
?>
</select>
</td>

<td>

Start date
</td>
<td>
<input type="text" name='startdate' id="popupDatepicker" class="form-control" style="width: 200px;">
</td>

<td>

End date
</td>
<td>
<input type="text" name='enddate' id="popupDatepicker1" class="form-control" style="width: 200px;">
</td>
<td>
<input type="button" name="searchemp" value="Search" class="btn btn-info" id='searchemp' onclick="return ajaxsearch();">
</td>
</tr>

</table>


<div class="panel">
<div style="text-align:center;">
<?php
  
  echo $this->session->flashdata('delmsg'); 
?>
</div>
<div class="panel-heading">

 <h2>
          <?php echo "Employee Attendance"?> 
         
        </h2>
<span class="">
<?php 
			echo '<center><h4 style="color:#099800 !important;">'.$this->session->flashdata('delmsg').'</h4><center>';
			?>
</div>
<div class="panel-body">
<div class="table-responsive">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>


<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
				
                <th>Emp Code</th>
                <th>CardNo</th>
                <th>Name</th>
                <th>DateTrn</th>
                <th>Day</th>
				<th>Shift</th>
				<th>ShiftTime</th>
				<th>ArrTim</th>
				<th>LateHrs</th>
				<th>DepTim</th>
				<th>EarlHrs</th>
				<th>WrkHrs</th>
				<th>OvTim</th>
				<th>PresAbs</th>
				<th>Remarks</th>
				
				<th>Edit</th>
				
				
				
				
				
				
				
            </tr>
        </thead>
        <tbody>
           <?php
		   $i = 1;
			if($totaldata>0)
			{
            foreach ($recordinfo as $valdata) {
				
				
                ?>   
                <tr id='datashow'>
				
				<!--<td>
                        <?php
                        //echo $valdata['id'];
                        ?>

                    </td>-->
                    
                    <td>
                        <?php
                        echo $valdata['EmpCode'];
                        ?>

                    </td>
                    <td>
                        <?php
                        echo $valdata['CardNo'];
                        ?>

                    </td>
                    <td>
                        <?php
                        echo $valdata['Name'];
                        ?>

                    </td>
                    
                     <td>
                        <?php
                      
						 $valdate= explode("-",$valdata['DateTrn']);
						 
						echo $maindate=$valdate[2]."-".$valdate[1]."-".$valdate[0];
                        ?>

                    </td>
                      <td>
                        <?php
                        echo $valdata['Day'];
                        ?>

                    </td>
                    
					</td>
					    <td>
                        <?php
                        echo $valdata['Shift'];
                        ?>

                    </td>
					</td>
					    <td>
                        <?php
                        echo $valdata['ShiftTime'];
                        ?>

                    </td>
					</td>
					    <td>
                        <?php
                        echo $valdata['ArrTim'];
                        ?>

                    </td>
					</td>
					    <td>
                        <?php
                        echo $valdata['LateHrs'];
                        ?>

                    </td>
					</td>
					    <td>
                        <?php
                        echo $valdata['DepTim'];
                        ?>

                    </td>
					
					</td>
					    <td>
                        <?php
                        echo $valdata['EarlHrs'];
                        ?>

                    </td>
					
					
					</td>
					    <td>
                        <?php
                        echo $valdata['WrkHrs'];
                        ?>

                    </td>
					
					
					</td>
					    <td>
                        <?php
                        echo $valdata['OvTim'];
                        ?>

                    </td>
					
					</td>
					    <td>
                        <?php
                        echo $valdata['PresAbs'];
                        ?>

                    </td>
					
					</td>
					    <td>
                        <?php
                        echo $valdata['Remarks'];
                        ?>

                    </td>
					
					
					
					
					
                    
					</td>
					    <td>
                        <?php
					//echo $totalhourspresent;
					     
					
                  
                        ?>
						
						 <a   href="<?php echo  base_url() ?>admin_adminusers/edit/<?php echo $valdata['id']?>" class="btn btn-info" >Edit</a></td>

                    </td>
                    

                </tr>
                


                <?php
                $i++;
            }
			}
			
            
            
            ?> 
            
        </tbody>
    </table>
	
	
	<script>
	$(document).ready(function() {
	 $('#example').DataTable( {
        columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 15 ],
            orderData: [ 15, 0 ]
        },
		
     
		]
    } );
	
	
		
} );



</script>

</div>
</div>
</div>


</div>
</div>


</div>

</section>

<script>

	function checktime(record) 
	{ 	
	
		$.ajax
		({
			type:'POST',
			url:'<?php echo base_url(); ?>admin_adminusers/checktimerecord',
			cache:false,
			data:{recordtime: record},
			success:function(dataresponce)
			{
				var response =dataresponce;
				var value = $('#timeend').html(response);
						
			}
		});
	}
	
	
	function ajaxfilterRecord()
	{
		
	var timestart=$("#timestart").val();
	var timeend=$("#timeend").val();
	
	if(timestart=="0")
	{
		alert("Please select Start time");
		return false;
	}
	
	
	if(timeend==0)
	{
		alert("Please select Start time");
		return false;
	}
	
	
	
	else
	{
		
		//$("#searchemp").click(function() {
		$.ajax
		({
			type:'POST',
			url:'<?php echo base_url(); ?>admin_adminusers/filterbonusData',
			cache:false,
			data:{timestart: timestart,timeend:timeend},
			success:function(dataresponce)
			{
				var response =dataresponce;
				
				
				
				$("#example").html(dataresponce);
				
				
				
						
			}
		});
		
	}
	}

	
	
/* new */

function latechecktime(record)
	{
		
		
		$.ajax
		({
			type:'POST',
			url:'<?php echo base_url(); ?>admin_adminusers/latechecktimerecord',
			cache:false,
			data:{recordtime: record},
			success:function(dataresponce)
			{
				var response =dataresponce;
				var value = $('#latetimeend').html(response);
						
			}
		});
		
	}
	
	
	
	
	function ajaxfilterlateRecord()
	{
		
		
	var timestart=$("#latetimestart").val();

	var timeend=$("#latetimeend").val();
	
	
	if(timestart=="0")
	{
		alert("Please select Start time");
		return false;
	}
	
	
	if(timeend==0)
	{
		alert("Please select Start time");
		return false;
	}
	
	
	
	else
	{
		
		//$("#searchemp").click(function() {
		$.ajax
		({
			type:'POST',
			url:'<?php echo base_url(); ?>admin_adminusers/latefilterData',
			cache:false,
			data:{latetimestart: timestart,latetimeend:timeend},
			success:function(dataresponce)
			{
				var response =dataresponce;
				
				
				
				$("#example").html(dataresponce);
				
				
				
						
			}
		});
		
	}
		
	}
	
	
	
	
</script>






<script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery.simple-dtpicker.js"></script>
<link href="<?php echo base_url(); ?>assets/css/admin/jquery.simple-dtpicker.css" rel="stylesheet" type="text/css">
    
    
	<script>
	$('#popupDatepicker').appendDtpicker({
	"dateOnly": true,
	"dateFormat": "DD-MM-YYYY",
	"closeOnSelected": true
	});


	$('#popupDatepicker1').appendDtpicker({
	"dateOnly": true,
	"dateFormat": "DD-MM-YYYY",
	"closeOnSelected": true
	});
	

	</script>







	