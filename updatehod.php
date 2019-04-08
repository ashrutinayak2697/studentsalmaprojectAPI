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

  
   define("accept_hod_id",mysql_real_escape_string($input_params['accept_hod_id']));
   define("leave_id",mysql_real_escape_string($input_params['leave_id']));
   
  
   


		
		$leave_id = leave_id;
		$accept_hod_id = accept_hod_id;
						
		if(empty($leave_id) || empty($accept_hod_id))
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
								"accept_hod_id"=>$accept_hod_id,
								"status"=>1
							);
						
			 $update_details = $con->update("leavealternate",$arrEvent,"where leave_id='".$leave_id."' ");			
				header('Content-type: application/json');
				echo json_encode(array("Status"=>1,"Message"=>"HOD accept leave Successfully"));
			 
        }
        else
        {
				header('Content-type: application/json'); 
				echo json_encode(array("Status"=>0,"Message"=>"No  available"));  
        }
				
		}

?>