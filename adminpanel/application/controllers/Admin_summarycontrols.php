<?php

/*
  @Author : Vinod K Maurya
  Description: Summary  user
  Dated :  02/02/2018
 */


 
//require_once  APPPATH.'/spout-2.7.3/src/Spout/Autoloader/autoload.php';
//use Box\Spout\Reader\ReaderFactory;
//use Box\Spout\Common\Type;
 
 
class Admin_summarycontrols extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    const VIEW_FOLDER = 'admin/summarycontrols';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'security'));
        $this->load->library(array('form_validation', 'session', 'user_agent'));
        $this->load->model(array('Information_model'));
        $this->load->model(array('Meta_page_model'));
        $this->load->model(array('Author_model'));
        $this->load->library('pagination');
		
    }

    

    public function viewsummary() {
			$this->load->model('Members_email_model');
			$this->load->model('Members_attendance_new_model');
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
			$resultdata['recordinfoData'] = $this->Members_attendance_new_model->calculatepresentemployee($page);
			
			if($resultdata['recordinfoData'])
			{
				$resultdata['totallWeekoff'] = $this->Members_attendance_new_model->totweekoff($resultdata['recordinfoData'][0]["EmpCode"]);
				$resultdata['totabsentdays'] = $this->Members_attendance_new_model->totalabsentday($resultdata['recordinfoData'][0]["EmpCode"]);
				$resultdata['totalmonthday'] = $this->Members_attendance_new_model->totalmonthday($resultdata['recordinfoData'][0]["EmpCode"]);
				$resultdata['member_total_days_present'] = $this->Members_attendance_new_model->member_total_days_present($resultdata['recordinfoData'][0]["EmpCode"]);
				$resultdata['totalmonthdaycount'] = $this->Members_attendance_new_model->totalmonthdaycount($resultdata['recordinfoData'][0]["EmpCode"]);
			}
			
       
        $resultdata['main_content'] = 'admin/summarycontrols/viewsummary';
        $this->load->view('includes/template', $resultdata);
    }
	
	
function downloadsummaryemp()
{		

		$this->load->library("excel");
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$this->load->model('Members_attendance_new_model');
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$resultdatanew=array();
		$resultdatanew = $this->Members_attendance_new_model->calculatepresentemployee($page);
		$object->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
		$object->getActiveSheet()->getStyle("B1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
								
		$object->getActiveSheet()->getStyle("C1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
		$object->getActiveSheet()->getStyle("D1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
								
		$object->getActiveSheet()->getStyle("E1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
		$object->getActiveSheet()->getStyle("F1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
		$object->getActiveSheet()->getStyle("G1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
								
		$object->getActiveSheet()->getStyle("H1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
		$object->getActiveSheet()->getStyle("I1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(10)
                                ->getColor()->setRGB('330000');
		$headerStyle = array(
					'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb'=>'CCE5FF'),
					),
					'font' => array(
							'bold' => true,
					)
			);
		
		$object->getActiveSheet()->getStyle('A1:'.'I1')->applyFromArray($headerStyle);
		$table_columns = array("Name", "EmpCode", "lateDate|Late Hours", "10 Minute late window", "30 Minute late window","Not working 7.30 Hours","leaves","Total Present days","Bonus");
		$column = 0;
		foreach($table_columns as $field)
		{
		$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		$column++;
		}
		$excel_row = 2;
		foreach($resultdatanew as $row)
		{
	
				$empcode=$row['EmpCode'];
				$resultdata['recordinfoDataemp'] = $this->Members_attendance_new_model->checklatecoimingEmployee($empcode);
				$resultdata['tecnminutecheck'] = $this->Members_attendance_new_model->checktenMinute($empcode);
				$resultdata['checkthirtyminuteData'] = $this->Members_attendance_new_model->checkthirtyminute($empcode);
				$resultdata['checkemployeeleave'] = $this->Members_attendance_new_model->checkemployeeleave($empcode);
				$resultdata['totalpresentemployeeDay'] = $this->Members_attendance_new_model->totalpresentemployeeDay($empcode);
				$resultdata['totaldayfindworking'] = $this->Members_attendance_new_model->totaldayfindworking($empcode);
				$shifttimediffnew 				= $this->Members_attendance_new_model->shiftedtimeData($empcode);
				$shiftcheck 					= $this->Members_attendance_new_model->checkmainshifttime($empcode);
				$resultdatabonusEmployee = $this->Members_attendance_new_model->bonusEmployeeSearching($empcode);
				
				
				
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['name']);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['EmpCode']);
				if(empty($resultdata['recordinfoDataemp'])){
				$countval= '0';
				}
				else
				{
				$countval=count($resultdata['recordinfoDataemp']);
				}


				if($resultdata['recordinfoDataemp']!="")
				{
				
				$workingmonth_late = array();
				$i=0;
				foreach($resultdata['recordinfoDataemp'] as $tk => $valdataemp)
				{
				$yrdata= strtotime($valdataemp['DateTrn']);
				$monthlate= date('d-M-Y', $yrdata);
				$shifttime=  $shiftcheck;
				$latetimecheck=$valdataemp["ArrTim"]-$shifttime;
				$timvel=explode(".",$latetimecheck);
				$hoursdata=@$timvel[0];
				$minutedata=@$timvel[1];
				$hourscalculated = floor($minutedata / 60).'.'.($minutedata -   floor($minutedata / 60) * 60);
				$calculateddata=explode(".",$hourscalculated);
				$deivedhours=$calculateddata[0];
				$deivedminute=$calculateddata[1];

				$maindata=$hoursdata+$deivedhours;
				
				$recordval=$maindata.'.'.$deivedminute;
				$datarecord=explode(",",$recordval);
				$dataval=implode(" ",$datarecord);
				
				$workingmonth_late[$i++] = ($monthlate.'--'.$recordval);
				$slatehours = rtrim(implode(',', $workingmonth_late), ',');

				
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,$slatehours);
				
				}
				
				
				$i++;
				}
				
				else
				{
					$slatehours="No Record found";
					$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,$slatehours);
				}
						
						
				/** 10 minute functionality **/
						if(empty($resultdata['tecnminutecheck'])){
						$countvalten= '0';
						}
						else
						{
						$countvalten=count($resultdata['tecnminutecheck']);
						}


						if($resultdata['tecnminutecheck']!="")
						{
						$j=0;
						$monthleavecheck=array();
						foreach($resultdata['tecnminutecheck'] as $valdataempten)
						{

							$yrdata= strtotime($valdataempten['DateTrn']);
							$monthdaytenleave= date('d-M-Y', $yrdata);	
							
							$leavemonth=$valdataempten["ArrTim"].' '.($monthdaytenleave);
							$monthleavecheck[$i++] = ($leavemonth);
							$leaverecord = rtrim(implode(',', $monthleavecheck), ',');
							
							
							$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $leaverecord);
						}
						}
						else
						{
							$leaverecord="No record found";
							$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $leaverecord);
						}
				
				/** 10 minute functionality **/
				
				
				/** 30 minute functionality **/
				
					if(empty($resultdata['checkthirtyminuteData'])){
					$countvalthirty= '0';
					}
					else
					{
					$countvalthirty=count($resultdata['checkthirtyminuteData']);
					}
					
					if($resultdata['checkthirtyminuteData']!="")
					{
					$thirtyminutearray=array();
					foreach($resultdata['checkthirtyminuteData'] as $valdatathirty)
					{
						
							$yrdata= strtotime($valdatathirty['DateTrn']);
							$monthdayleave= date('d-M-Y', $yrdata);
							
					$thirtyminuteData= $valdatathirty["ArrTim"].'---'.($monthdayleave);
					$thirtyminutearray[$i++] = ($thirtyminuteData);
					$thirtyminuteVal = rtrim(implode(',', $thirtyminutearray), ',');
					
					$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $thirtyminuteVal);
					}
					}
					else
					{	$thirtyminuteVal="No Record found";
						$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $thirtyminuteVal);
					}
				
				
				
				
				
				
				/** 30 minute functionality **/
				
				
						
						
				if(empty($resultdata['checkemployeeleave'])){
				$countvalleave= '0';
				}
				else
				{
				$countvalleave=count($resultdata['checkemployeeleave']);
				}


				if($resultdata['checkemployeeleave']!="")
				{
				$workingmonth_leave =array();
				$l=0;
				foreach($resultdata['checkemployeeleave'] as $valleave)
				{

				$leaveday=explode("-",$valleave["DateTrn"]);
				$leavedayval=$leaveday[2]."-".$leaveday[1]."-".$leaveday[0];
				$yrdata= strtotime($valleave["DateTrn"]);
				$monthday= date('d-M-Y', $yrdata);
				$workingmonth_leave[$l++] = ($monthday);
				$sleavedata = rtrim(implode(',', $workingmonth_leave), ',');
		
				$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $sleavedata);
				}
				}
				else
				{
				$sleavedata="No record found";
				$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $sleavedata);
				}
	
	
			/******* 7.30 HOURS NOT WORKED  ****/
			
			
					if($resultdata['totaldayfindworking']!="")
					{

					$ltck=0;
					foreach( $resultdata['totaldayfindworking'] as $val)
					{

					$arrTime=$val['ArrTim'];
					
					
					
					if(strlen($arrTime)==2 || strlen($arrTime)==1)
					{
					 $arrTime=$val['ArrTim'].'.'.'00';
					}
					
					$DepTime=$val['DepTim'];
					if(strlen($DepTime)==2 || strlen($DepTime)==1)
					{
						
						$DepTime=$val['DepTim'].'.'.'00';
					}
					
					
					$datearrival=$val['DateTrn'];
					
					$yrdata= strtotime($datearrival);
					$datarecord= date('d-M-Y', $yrdata);
					
					
					$firstarrtime=strtotime($arrTime);
					$secondarrtime=strtotime($DepTime);
					$hoursdata = (($secondarrtime - $firstarrtime)/3600); 
					$workingtimedata= floor($hoursdata) . '.' . ( ($hoursdata-floor($hoursdata)) * 60 ); 
					

					
					
					$val2="";
					
					if($workingtimedata > $shifttimediffnew){
					  $val= $workingtimedata;
					}
					
					else if($arrTime>12.59  && $DepTime==0)
					{
						$textdata='Missed Morning Authentication';
						$maintime=$arrTime;
						$shifttimediffnew;
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
						
						$val2=$datarecord.'--'.$totalhours.'.'.$hourssecondcalhoursminte.'--'.$textdata;
						
						$workingseventhirtyhours[$ltck++] = ($val2);
						$finalcheckhours = rtrim(implode(',', $workingseventhirtyhours), ',');
						
						
					}
					
					
					
					else if($DepTime==0)
					{ 
					    $textdata='Missed Evening Authentication';
					  //$calculateddata=$shifttimediffnew+7.30;
					  
						$date1 = explode(".",$shifttimediffnew);
						$dhours=@$date1[0];
						$dminute=$date1[1];
						
						$date2 = explode(".",'7.30');
						$date2hours = @$date2[0];
						$date2minute = $date2[1];
						
						$hourscalculated=$dhours+$date2hours;
						$timevalue=$dminute+$date2minute;
						$hoursminutecal = floor($timevalue / 60).'.'.($timevalue -   floor($timevalue / 60) * 60);
						
						$workedcalculated=$hourscalculated+$hoursminutecal;
						
						

						
					  
					  $val2=$datarecord.'--'.$workedcalculated.'--'.$textdata;
					  $workingseventhirtyhours[$ltck++] = ($val2);
					  $finalcheckhours = rtrim(implode(',', $workingseventhirtyhours), ',');
					  
					  
					}
					
					
					else{
					
					   $val2=$datarecord.'--'.$workingtimedata;
					   $workingseventhirtyhours[$ltck++] = ($val2);
					   $finalcheckhours = rtrim(implode(',', $workingseventhirtyhours), ',');
					   
					} 
					if($val2!="")
					{
						$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $finalcheckhours);
					}
					else
					{
						
					}
					
					
					 
					}
					}
			
			/******* 7.30 HOURS NOT WORKED  ****/
	
	
			
	
					/******* total present day ****/

					if($resultdata['totalpresentemployeeDay'])
					{

					$maincurdate=explode("-",$resultdata['totalpresentemployeeDay'][0]['DateTrn']);
					$finaldatemonth=$maincurdate[1];
					$finaldateyear=$maincurdate[2];
					$monthnumber = cal_days_in_month(CAL_GREGORIAN,  $finaldatemonth, $finaldateyear); // 31

					$presentrecord=$resultdata['totalpresentemployeeDay'][0]['presentday'].'/'.$monthnumber;

					}
					else
					{
					$presentrecord ="No Record Found";
					}
					$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $presentrecord);
					$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, strip_tags($resultdatabonusEmployee));
					$excel_row++;
	}
		
		
	$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Employee_Attendance_Data' . date('Y-m-d') . '.xls');
	$object_writer->save('php://output');
		


}
	

}

?>