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

  
   define("accept_faculty_id",mysql_real_escape_string($input_params['accept_faculty_id']));
   define("leave_id",mysql_real_escape_string($input_params['leave_id']));
   
  
   


		
		$leave_id = leave_id;
		$accept_faculty_id = accept_faculty_id;
						
		if(empty($leave_id) || empty($accept_faculty_id))
		{
			header('Content-type: application/json'); 
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all require fields."));	
		}
		else
		{
				$listshopstatus=$con->select_query("leavealternate","*","where leave_id='".$leave_id."'","","");
		if($con->total_records($listshopstatus) > 0)
      	{
        	$arrEvent = array(
								"accept_faculty_id"=>$accept_faculty_id
							);
						
			 $update_details = $con->update("leavealternate",$arrEvent,"where leave_id='".$leave_id."' ");			
				header('Content-type: application/json');
				echo json_encode(array("Status"=>1,"Message"=>"Faculty accept alternate Successfully"));
			 
        }
        else
        {
				header('Content-type: application/json'); 
				echo json_encode(array("Status"=>0,"Message"=>"No  available"));  
        }
				
		}

?>