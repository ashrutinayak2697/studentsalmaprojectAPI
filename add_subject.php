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

  
   define("sub_name",mysql_real_escape_string($input_params['sub_name']));
   define("semester",mysql_real_escape_string($input_params['semester']));
   
  
   

//			 JainSangh Tour Event			//

		
		$sub_name = sub_name;
		$semester = semester;
						
		if(empty($sub_name) || empty($semester))
		{
			header('Content-type: application/json'); 
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all require fields."));	
		}
		else
		{

				$arrEvent = array(
								"semester"=>$semester,
								"sub_name"=>$sub_name
							);
						
				$insertUser = $con->insert_record("subject",$arrEvent);
							
				header('Content-type: application/json');
			echo json_encode(array("Status"=>1,"Message"=>"Subject Added Successfully"));
			
		}

?>