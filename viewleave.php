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


 	
   	define("faculty_id",mysql_real_escape_string($input_params['faculty_id']));


//JainSanghViewcircular


    $faculty_id=faculty_id;
   if(empty($faculty_id))
    {
        header('Content-type: application/json');
        echo json_encode(array("Status"=>0,"Message"=>"Please fill all required Fields"));  
    }
  else
  {
    $a=1;
    $DocumentQuery=mysql_query("SELECT * FROM leavealternate l inner join reg_faculty rf on rf.fac_id=l.faculty_id inner join reg_hod h on h.hod_id=l.accept_hod_id inner join reg_faculty rfa on rfa.fac_id=l.accept_faculty_id where l.status=1 and l.faculty_id='".$faculty_id."'");
      if ($con->total_records($DocumentQuery) > 0) 
      {
        $x=0;
         // $DirectoryList=array();
          while($row_doc = mysql_fetch_array($DocumentQuery))
          {
            
            $DirectoryList[$x]["leave_id"]=intval($row_doc[0]);
            $DirectoryList[$x]["leave_type"]=$row_doc[2];
            $DirectoryList[$x]["leave_day_type"]=$row_doc[4];
            $DirectoryList[$x]["leave_day"]=$row_doc[3];
            $DirectoryList[$x]["day_peroid"]=$row_doc[5];
            $DirectoryList[$x]["leave_start_date"]=$row_doc[6];
            $DirectoryList[$x]["leave_end_date"]=$row_doc[7];
            if($row_doc[8]!='')
            {
              $DirectoryList[$x]["document"]=$document.$row_doc[8];
            }
            else
            {
              $DirectoryList[$x]["document"]='';
            }
            $DirectoryList[$x]["message"]=$row_doc[9];
            $DirectoryList[$x]["fac_name"]=$row_doc[14];
            $DirectoryList[$x]["faculty_id"]=intval($row_doc[1]); 
            $DirectoryList[$x]["accept_faculty_name"]=$row_doc[30];
            $DirectoryList[$x]["accept_faculty_id"]=intval($row_doc[10]);
           $DirectoryList[$x]["accept_hod_name"]=$row_doc[22];
            $DirectoryList[$x]["accept_hod_id"]=intval($row_doc[11]);
           
            $x++;
            }
            header('Content-type: application/json');
            echo json_encode(array("Status"=>1,"LeaveDetails"=>$DirectoryList,"Message"=>" Faculty Leave and alternate Details Listed Successfully"));
      }
      else
      {
          header('Content-type: application/json'); 
          echo json_encode(array("Status"=>0,"Message"=>"No  available"));
      }
    }
?>