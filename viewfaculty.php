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

	include("include/config.php");
	include("include/function.php");
	
	include("include/postNotification.php");

		$CountryDetailsQuery = $con->select_query("reg_faculty","*","","");
		if($con->total_records($CountryDetailsQuery) > 0)
			{
				$x=0;
				$CountryList=array();
				while($row = mysql_fetch_assoc($CountryDetailsQuery))
				{
					$CountryList[$x]["Faculty_id"]=intval($row['fac_id']);
					$CountryList[$x]["Faculty_name"]=$row['fac_name'];
					$CountryList[$x]["Faculty_email"]=$row['fac_email'];
					$CountryList[$x]["Faculty_mobile"]=$row['fac_mobile'];
					$CountryList[$x]["Faculty_dob"]=$row['fac_dob'];
					$CountryList[$x]["Faculty_dojoin"]=$row['fac_doj'];
					$CountryList[$x]["Faculty_address"]=$row['fac_address'];
				
					$x++;
				}
				header('Content-type: application/json');
				echo json_encode(array("Status"=>1,"FacultyDetails"=>$CountryList,"Message"=>"Faculty Details Listed Successfully"));			
			}
			else
			{
				header('Content-type: application/json'); 
				echo json_encode(array("Status"=>0,"Message"=>"No  available"));  
			}			
?>