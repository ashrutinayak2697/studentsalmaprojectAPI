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

$document="http://192.168.1.128/staffleave/images/";
 	
    // $a=1;
    $DocumentQuery=mysql_query("SELECT * FROM leavealternate inner join reg_faculty on reg_faculty.fac_id=leavealternate.faculty_id where leavealternate.status=0");
      if ($con->total_records($DocumentQuery) > 0) 
      {
        $x=0;
         // $DirectoryList=array();
          while($row_doc = mysql_fetch_assoc($DocumentQuery))
          {
            
            $DirectoryList[$x]["leave_id"]=intval($row_doc['leave_id']);
            $DirectoryList[$x]["leave_day_type"]=$row_doc['leave_day_type'];
            $DirectoryList[$x]["leave_type"]=$row_doc['leave_type'];
            $DirectoryList[$x]["leave_day"]=$row_doc['leave_day'];
            $DirectoryList[$x]["day_peroid"]=$row_doc['day_peroid'];
            $DirectoryList[$x]["leave_start_date"]=$row_doc['leave_start_date'];
            $DirectoryList[$x]["leave_end_date"]=$row_doc['leave_end_date'];
            if($row_doc['document']!='')
            {
              $DirectoryList[$x]["document"]=$document.$row_doc['document'];
            }
            else
            {
              $DirectoryList[$x]["document"]='';
            }
            $DirectoryList[$x]["message"]=$row_doc['message'];
            $DirectoryList[$x]["fac_name"]=$row_doc['fac_name'];
            $DirectoryList[$x]["faculty_id"]=intval($row_doc['faculty_id']);
           
            $x++;
            }
            header('Content-type: application/json');
            echo json_encode(array("Status"=>1,"LeaveDetails"=>$DirectoryList,"Message"=>"Leave and alternate Details Listed Successfully"));
      }
      else
      {
          header('Content-type: application/json'); 
          echo json_encode(array("Status"=>0,"Message"=>"No  available"));
      }
?>