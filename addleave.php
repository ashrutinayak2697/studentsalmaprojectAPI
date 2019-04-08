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

  
   define("leave_id",mysql_real_escape_string($input_params['leave_id']));
   define("leave_type",mysql_real_escape_string($input_params['leave_type']));
   define("faculty_id",mysql_real_escape_string($input_params['faculty_id']));
   define("leave_day",mysql_real_escape_string($input_params['leave_day']));
   define("leave_day_type",mysql_real_escape_string($input_params['leave_day_type']));
   define("day_peroid",mysql_real_escape_string($input_params['day_peroid']));
   define("leave_start_date",mysql_real_escape_string($input_params['leave_start_date']));
   define("leave_end_date",mysql_real_escape_string($input_params['leave_end_date']));
   define("document",mysql_real_escape_string($input_params['document']));
   define("message",mysql_real_escape_string($input_params['message']));
   define("accept_faculty_id",mysql_real_escape_string($input_params['accept_faculty_id']));
   define("accept_hod_id",mysql_real_escape_string($input_params['accept_hod_id']));
   
  
   

		$accept_hod_id = accept_hod_id;
		$accept_faculty_id = accept_faculty_id;
		$message = message;
		$faculty_id = faculty_id;
		$document = document;
		$leave_end_date = leave_end_date;
		$leave_start_date = leave_start_date;
		$day_peroid = day_peroid;
		$leave_day_type = leave_day_type;
		$leave_day = leave_day;
		$leave_type = leave_type;
						
		if(empty($message) ||empty($leave_end_date)||empty($faculty_id)||empty($leave_start_date)||empty($day_peroid)||empty($leave_day)||empty($leave_type)||empty($leave_day_type))
		{
			header('Content-type: application/json'); 
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all require fields."));	
		}
		else
		{

				$arrEvent = array(
								"leave_day"=>$leave_day,
								"leave_day_type"=>$leave_day_type,
								"day_peroid"=>$day_peroid,
								"leave_start_date"=>$leave_start_date,
								"faculty_id"=>$faculty_id,
								"leave_end_date"=>$leave_end_date,
								"message"=>$message,
								"accept_faculty_id"=>$accept_faculty_id,
								"accept_hod_id"=>$accept_hod_id,
								"status"=>0,
								"leave_type"=>$leave_type
							);
						
				$insertUser = $con->insert_record("leavealternate",$arrEvent);
				
				$leave_id=mysql_insert_id();

				if ($document != "") {
					


			    $binarytoimage = binarytoimage_doctor($document,$lecture_type,$leave_id);

					

					$fields_image =array("document"=>$binarytoimage);

					$images_insert=$con->update("leavealternate",$fields_image,"where leave_id=".$leave_id);
				}
				 header('Content-type: application/json');
        		echo json_encode(array("Status"=>1,"Message"=>"Leave and alternate added successfully."));
		}

?>