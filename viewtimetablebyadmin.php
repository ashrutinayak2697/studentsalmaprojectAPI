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
    define("class1",mysql_real_escape_string($input_params['class1']));
    define("day",mysql_real_escape_string($input_params['day']));




    $semester=semester;
    $class1=class1;
    $day=day;
   if(empty($semester)||empty($class1)||empty($day))
    {
        header('Content-type: application/json');
        echo json_encode(array("Status"=>0,"Message"=>"Please fill all required Fields"));  
    }
  else
  {
    $a=1;
    $DocumentQuery=mysql_query("SELECT * FROM timetable inner join reg_faculty on reg_faculty.fac_id=timetable.faculty_id inner join subject on subject.subject_id=timetable.subject_id where timetable.semester='".$semester."' and timetable.class1='".$class1."' and timetable.day='".$day."' order by reg_faculty.fac_name");
      if ($con->total_records($DocumentQuery) > 0) 
      {
        $x=0;
         // $DirectoryList=array();
          while($row_doc = mysql_fetch_assoc($DocumentQuery))
          {
            
            $DirectoryList[$x]["timetable_id"]=intval($row_doc['timetable_id']);
            $DirectoryList[$x]["lecture_type"]=$row_doc['lecture_type'];
            $DirectoryList[$x]["semester"]=intval($row_doc['semester']);
            $DirectoryList[$x]["class1"]=$row_doc['class1'];
            $DirectoryList[$x]["day"]=$row_doc['day'];
            $DirectoryList[$x]["time"]=$row_doc['time'];
            $DirectoryList[$x]["roomnumber"]=$row_doc['roomnumber'];
            $DirectoryList[$x]["batch"]=$row_doc['batch'];
            $DirectoryList[$x]["sub_name"]=$row_doc['sub_name'];
            $DirectoryList[$x]["fac_name"]=$row_doc['fac_name'];
           
            $x++;
            }
            header('Content-type: application/json');
            echo json_encode(array("Status"=>1,"TimetableDetails"=>$DirectoryList,"Message"=>"Timetable Details Listed Successfully"));
      }
      else
      {
          header('Content-type: application/json'); 
          echo json_encode(array("Status"=>0,"Message"=>"No  available"));
      }
    }
?>