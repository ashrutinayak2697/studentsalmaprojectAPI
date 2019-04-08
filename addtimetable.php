<?php
$file = fopen("php://input","r");
$jsonInput ="";

while(!feof($file))
{
	$jsonInput .= fgets($file);	
}
fclose($file);

$input_params = json_decode($jsonInput,true);

    include("include/common_vars.php");
	include("include/common_class.php");
	include("include/session.php");
	include("include/config.php");
	include("include/function.php");
	
	include("include/postNotification.php");	

  
   define("lecture_type",mysql_real_escape_string($input_params['lecture_type']));
   define("semester",mysql_real_escape_string($input_params['semester']));
   define("day",mysql_real_escape_string($input_params['day']));
   define("class1",mysql_real_escape_string($input_params['class1']));
   define("time",mysql_real_escape_string($input_params['time']));
   define("faculty_id",mysql_real_escape_string($input_params['faculty_id']));
   define("subject_id",mysql_real_escape_string($input_params['subject_id']));
   define("roomnumber",mysql_real_escape_string($input_params['roomnumber']));
   define("batch",mysql_real_escape_string($input_params['batch']));
   
  
   

//			 JainSangh Tour Event			//

		
		$batch = batch;
		$roomnumber = roomnumber;
		$subject_id = subject_id;
		$faculty_id = faculty_id;
		$time = time;
		$class1 = class1;
		$day = day;
		$semester = semester;
		$lecture_type = lecture_type;
						
		if(empty($semester) ||empty($roomnumber)||empty($subject_id)||empty($faculty_id)||empty($time)||empty($class1)||empty($day)||empty($lecture_type))
		{
			header('Content-type: application/json'); 
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all require fields."));	
		}
		else
		{

				$arrEvent = array(
								"semester"=>$semester,
								"roomnumber"=>$roomnumber,
								"subject_id"=>$subject_id,
								"faculty_id"=>$faculty_id,
								"time"=>$time,
								"class1"=>$class1,
								"day"=>$day,
								"batch"=>$batch,
								"lecture_type"=>$lecture_type
							);
						
				$insertUser = $con->insert_record("timetable",$arrEvent);
							
				header('Content-type: application/json');
			echo json_encode(array("Status"=>1,"Message"=>"Timetable Added Successfully"));
			
		}

?>