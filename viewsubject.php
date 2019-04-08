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


 	
   	define("semester",mysql_real_escape_string($input_params['semester']));


//JainSanghViewcircular


    $semester=semester;
   if(empty($semester))
    {
        header('Content-type: application/json');
        echo json_encode(array("Status"=>0,"Message"=>"Please fill all required Fields"));  
    }
  else
  {
    $a=1;
    $DocumentQuery=mysql_query("SELECT * FROM subject where semester='".$semester."'");
      if ($con->total_records($DocumentQuery) > 0) 
      {
        $x=0;
         // $DirectoryList=array();
          while($row_doc = mysql_fetch_assoc($DocumentQuery))
          {
            
            $DirectoryList[$x]["Subject_id"]=intval($row_doc['subject_id']);
            $DirectoryList[$x]["Subject_name"]=$row_doc['sub_name'];
            $DirectoryList[$x]["Semester"]=intval($row_doc['semester']);
           
            $x++;
            }
            header('Content-type: application/json');
            echo json_encode(array("Status"=>1,"SubjectDetails"=>$DirectoryList,"Message"=>"Subject Details Listed Successfully"));
      }
      else
      {
          header('Content-type: application/json'); 
          echo json_encode(array("Status"=>0,"Message"=>"No  available"));
      }
    }
?>