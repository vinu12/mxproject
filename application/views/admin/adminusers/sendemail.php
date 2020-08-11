
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/skin/default_skin/css/theme.css">
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

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
<li class="crumb-link">
	<a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
</li>
<li class="crumb-trail active">
 <a href="#">Update</a>
</li>
</ol>
 <div class="page-header">
       
      </div>
</div>
</header>


<section id="content" class="">

<div class="admin-panels ui-sortable">
<div class="row mb5">
<div class="col-md-12">

<div class="panel">

<div class="panel-heading">
 <h2>
         Send Mail
        </h2>
 <?php

            echo validation_errors();
            ?>  
  <?php
  
  echo $this->session->flashdata('errmsg');

  
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class=" alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> manufacturer updated with success.';
          echo '</div>';       
        }else{
          echo '<div class=" alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
	  
	  
	  
 if(@$_REQUEST['erroe']!=''){ echo   '<font color="#c51515">!Sorry Please upload max 3 MB file size.</font>'; } ?>
</div>
<div class="panel-body">
<?php

echo form_open('admin_adminusers/sendemailemployee');

?>

	 <table class="table">
	 
	 <td>
	 Email Id 
	 </td>
	
	 <td>
	 <input type="text" class="form-control" style="width:300px;" name="useremail"  id="useremail" value="<?php  if($emailRecord!="0") { echo $emailRecord[0]['email'];}?>" readonly>
	 </td>
	 </tr>
	 <tr>
	 
	 <td>
	 Details
	 </td>
	 <td>
		<textarea class="control-label col-md-3 ckeditor" id="noticemessage" rows="20" style="height:500px !important" height="700px"  name="message"> 
		
		
		     Dear  <?php echo $getEmployeeName[0]['Name']; ?>,
			
			
			
			<table class="table" width="100%" style="border: 1px solid black;">
			<tr>
	 <td colspan="3" style="text-align:center !important;" >
	<b><?php echo $getEmployeeName[0]['Name']; ?>  Attendance Summary</b>
	 </td>
	 </tr>
	 <tr>
			<tr>
			<th style="text-align:left">
			Name
			</th>
			<th style="text-align:left">
			Late Date 
			</th>
			<th style="text-align:left">
			Late hours
			</th>
			
			</tr>
			
		
		
		<?php
		
		if(empty($recordinfoDataemp)){
		$countval= '0';
		}
		else
		{
		$countval=count($recordinfoDataemp);
		}
		
		
		if($recordinfoDataemp!="")
		{
			$d=1;
			$i=0;
		foreach($recordinfoDataemp as $valdataemp)
		{
			
				$yrdata= strtotime($valdataemp['DateTrn']);
				$monthlate= date('d-M-Y', $yrdata);
				$shifttime=  $shiftcheck;
				$latetimecheck=$valdataemp["ArrTim"]-$shifttime;
				?>
				<tr>
				<td><?php echo $valdataemp["Name"]; ?>
				<td><?php echo  $monthlate;//$valdataemp["ArrTim"].'&nbsp; &nbsp;'.$monthlate; ?></td>
				<td>
				<?php 
				
			$timvel=explode(".",$latetimecheck);
			$hoursdata=@$timvel[0];
			$minutedata=@$timvel[1];
			

			$hourscalculated = floor($minutedata / 60).'.'.($minutedata -   floor($minutedata / 60) * 60);
			$calculateddata=explode(".",$hourscalculated);
			$deivedhours=$calculateddata[0];
			$deivedminute=$calculateddata[1];
			
			$maindata=$hoursdata+$deivedhours;
				
				
				echo $maindata.'.'.$deivedminute; ?>
				</td>
				</tr>
				
				<?php
		
		}
		}
		
			
			
			?>
			<tr>
			<td><b>Total</b></td>
			<td colspan="2"><b><?php echo $countval; ?> Days</b></td>
			</tr>
			</table>
		
		
				<table class="table" width="100%" style="border: 1px solid black;">
				<tr>
				<th colspan="2" style="text-align:left">
				10 Minute late window
				</th>


				</tr>
			<?php
				
				if(empty($tecnminutecheck)){
				$countvaldata= '0';
				}
				else
				{
				$countvaldata=count($tecnminutecheck);
				}

				
				if($tecnminutecheck!="")
				{
				foreach($tecnminutecheck as $valdataempten)
				{

				$yrdata= strtotime($valdataempten['DateTrn']);
				$monthdaytenleave= date('d-M-Y', $yrdata);
				?>

				<tr>
				<td><?php echo $valdataempten["ArrTim"]; ?></td>
				<td > <?php echo $monthdaytenleave; ?></td>

				</tr>


				<?php
				}
				}
				else 
				{
				?>
				<tr>

				<td colspan="3">No Record Found</td>

				</tr>
				<?php
				}
				?>	
				<tr>
				<td>
				<b>
				Total
				</b>
				</td>
				<td>
				<b><?php  echo $countvaldata; ?>&nbsp;Days</b>
				</td>
				</tr>
				</table>
		
		
				<table class="table" width="100%" style="border: 1px solid black;">
				<tr>
				<th colspan="2" style="text-align:left">
				30 minute late Window
				</th>


				</tr>
				<?php 
				
				if(empty($checkthirtyminuteData)){
				$countvaldatathirty= '0';
				}
				else
				{
				$countvaldatathirty=count($checkthirtyminuteData);
				}
				
				
				if($checkthirtyminuteData!="")
				{
				foreach($checkthirtyminuteData as $valdatathirty)
				{
			
				$yrdata= strtotime($valdatathirty['DateTrn']);
				$monthdayleave= date('d-M-Y', $yrdata);
				?>
			
				<tr>

				<td><?php echo $valdatathirty["ArrTim"]; ?></td>
				<td>
				<?php echo $monthdayleave; ?>
				</td>

				</tr>
				<?php
				}
				}
				else
				{
				?>
				<tr>
				<td>
				No Record found
				</td>
				</tr>
				<?php
				}
				?>
				
				<tr>
				<td>
				<b>
				Total
				</b>
				</td>
				<td>
				<b><?php  echo $countvaldatathirty ?>&nbsp;Days</b>
				</td>
				</tr>
				
				
				</table>
				
				<table class="table" width="100%" style="border: 1px solid black;">
				<tr>
				<th colspan="3" style="text-align:left">
				Not Working 7:30 Hours
				</th>
				</tr>
				
				<?php
					if($totaldayfindworking!="")
					{


					foreach($totaldayfindworking as $val)
					{
						
						?>
						<tr>
						<?php
					
					$arrTime=$val['ArrTim'];
					if(strlen($arrTime)==2 || strlen($arrTime)==1)
					{
					 $arrTime=$arrTime.'.'.'00';
					}
					
					$DepTime=$val['DepTim'];
					if(strlen($DepTime)==2 || strlen($DepTime)==1)
					{
						
						$DepTime=$val['DepTim'].'.'.'00';
					}
					//echo "<pre>";
					//print_r($DepTime);
					$datearrival=$val['DateTrn'];

					$yrdata= strtotime($datearrival);
					$datarecord= date('d-M-Y', $yrdata);


					$firstarrtime=strtotime($arrTime);
					$secondarrtime=strtotime($DepTime);
					$hoursdata = (($secondarrtime - $firstarrtime)/3600); 
					$workingtimedata= floor($hoursdata) . '.' . ( ($hoursdata-floor($hoursdata)) * 60 ); 
					
					$val2="";
					if($workingtimedata > $shifttimediffnew)
					{
					$val= $workingtimedata;
					}
					else if($arrTime>12.59  &&  $DepTime==0)
					{
						$textdata='Missed Morning Authentication';
						$maintime=$arrTime;
						$calculatedtime=$maintime-$shifttimediffnew;
						$maintimecal=explode(".",$calculatedtime);
						$maintimecalhours=$maintimecal[0];
						$maintimecalminute=$maintimecal[1];
						
						$mintetimeval = floor($maintimecalminute / 60).'.'.($maintimecalminute -   floor($maintimecalminute / 60) * 60);
						
						$hourssecondcal=explode(".",$mintetimeval);
						$hourssecondcalhours=$hourssecondcal[0];
						$hourssecondcalhoursminte=$hourssecondcal[1];
						$orignalvalue=$maintimecalhours+$hourssecondcalhours+$hourssecondcalhoursminte;
						
						$totalhours=$maintimecalhours+$hourssecondcalhours;
						
						$val2=$totalhours.'.'.$hourssecondcalhoursminte.'&nbsp;&nbsp;'.$textdata;
						
						
						
					}
					
					
					else if($DepTime==0)
					{
						$textdata='Missed Evening Authentication';
						$date1 = explode(".",$shifttimediffnew);
						$dhours=@$date1[0];
						$dminute=@$date1[1];
						
						$date2 = explode(".",'7.30');
						$date2hours = @$date2[0];
						$date2minute = @$date2[1];
						
						$hourscalculated=$dhours+$date2hours;
						$timevalue=$dminute+$date2minute;
						$hoursminutecal = floor($timevalue / 60).'.'.($timevalue -   floor($timevalue / 60) * 60);
						
						$workedcalculated=$hourscalculated+$hoursminutecal;

						$val2=$workedcalculated.'&nbsp;&nbsp;&nbsp;'.$textdata;
					 
					}
					
					
					
					
					else
					{

					$val2=$workingtimedata;
					} 
					if($val2!="")
					{
					?>
					<td>
					<?php echo $datarecord; ?>
					</td>
					<td colspan="2">
					<?php 
					
					
					
					echo $val2;?>
					</td>
					
					<?php
					}
					else
					{
						
					}	
					?>
					</tr>
					
					<?php 
					
					}
					}
					
					?>
				
				</table>
		
				<table class="table" width="100%" style="border: 1px solid black;">
				<tr>
				<th colspan="2" style="text-align:left">
				 Leaves
				</th>
				</tr>
					<?php 
					
					
				if(empty($checkemployeeleave)){
				$leavesdata= '0';
				}
				else
				{
				$leavesdata=count($checkemployeeleave);
				}
					
					
					if($checkemployeeleave!="")
					{
					foreach($checkemployeeleave as $valleave)
					{

					$leaveday=explode("-",$valleave["DateTrn"]);
					$leavedayval=$leaveday[2]."-".$leaveday[1]."-".$leaveday[0];
					$yrdata= strtotime($valleave["DateTrn"]);
					$monthday= date('d-M-Y', $yrdata);
					?>

					<tr>

					<td colspan="3"><?php echo $monthday; ?></td>

					</tr>
					<?php
					}
					}
					else 
					{
					?>	
					<tr>

					<td>No Record found</td>

					</tr>
				<?php
				}
				?>
				
				<tr>
				<td>
				<b>
				Total
				</b>
				</td>
				<td>
				<b><?php  echo $leavesdata ?>&nbsp;Days</b>
				</td>
				</tr>
				
				</table>
				
				<table class="table" width="100%" style="border: 1px solid black;">
				<tr>
				<th colspan="2" style="text-align:left">
				Total Present Days
				</th>
				</tr>
				<?php
				if($totalpresentemployeeDay!="")
				{

				$maincurdate=explode("-",$totalpresentemployeeDay[0]['DateTrn']);
				$finaldatemonth=$maincurdate[1];
				$finaldateyear=$maincurdate[2];
				$monthnumber = cal_days_in_month(CAL_GREGORIAN,  $finaldatemonth, $finaldateyear); // 31
				?>
				<tr>
				<td>
				<?php echo $totalpresentemployeeDay[0]['presentday'].'/'.$monthnumber ?>
				</td>
				</tr>
				<?php 
				}
				?>
				</table>
				
				
				
		
		
		
		</textarea>
			
			</td>

			</tr>
			</table>	

<script>
	initSample();
</script>

<div class="form-group">
<label class="col-lg-3 control-label" for="textArea1">&nbsp;</label>
<div class="col-lg-3">

<button type="submit" class="btn btn-large btn-primary" onclick="return validateemail();">Send</button>

<?php


echo form_close();
?>

</div>
</div>

</div>
</div>

</div>
</div>


</div>

</section>


	<script>
		CKEDITOR.replace( 'noticemessage', {
			width: '100%',
			height: 600
		} );
		
		function validateemail()
		{
			
			var emailadd=$("#useremail").val();
			if(emailadd=="")
			{
			alert("Please add email id of employee.");
			return false;
			}
			else 
			{
				return true;
			}
			
		}
		
	</script>











