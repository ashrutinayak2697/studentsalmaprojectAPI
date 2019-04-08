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
	include("include/classes/SMTPClass.php");
	include("include/classes/PHPMailer.class.php");
	include("include/classes/SMTP.class.php");
	include("include/postNotification.php");

   define("mode",mysql_real_escape_string($input_params['mode']));
   define("fac_id",mysql_real_escape_string($input_params['fac_id']));
   define("fac_name",mysql_real_escape_string($input_params['fac_name']));
   define("fac_dob",mysql_real_escape_string($input_params['fac_dob']));
   define("fac_doj",mysql_real_escape_string($input_params['fac_doj']));
   define("fac_address",mysql_real_escape_string($input_params['fac_address']));
   define("fac_password",mysql_real_escape_string($input_params['fac_password']));
   define("fac_email",mysql_real_escape_string($input_params['fac_email']));
   define("fac_mobile",mysql_real_escape_string($input_params['fac_mobile']));
   define("hod_name",mysql_real_escape_string($input_params['hod_name']));
   define("hod_email",mysql_real_escape_string($input_params['hod_email']));
   define("hod_password",mysql_real_escape_string($input_params['hod_password']));
   define("hod_address",mysql_real_escape_string($input_params['hod_address']));
   define("hod_mobile",mysql_real_escape_string($input_params['hod_mobile']));
   define("hod_dob",mysql_real_escape_string($input_params['hod_dob']));
   define("hod_doj",mysql_real_escape_string($input_params['hod_doj']));
   define("email",mysql_real_escape_string($input_params['email']));
   define("password",mysql_real_escape_string($input_params['password']));
   define("designation",mysql_real_escape_string($input_params['designation']));
  
 


	if(mode=="register")
	{
		$fac_name=fac_name;
		$fac_dob=fac_dob;
		$fac_doj=fac_doj;
		$fac_address=fac_address;
		$fac_password=fac_password;
		$fac_email=fac_email;
		$fac_mobile=fac_mobile;
		$designation=designation;
		if(empty($fac_name)||empty($fac_dob)||empty($fac_password)||empty($fac_email)||empty($fac_mobile)||empty($fac_doj)||empty($designation))
		{
			header('Content-type: application/json');
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all required fields"));	
		}
		else
		{
			if($designation=='Faculty')
			{
				$check_email_query = $con->select_query("reg_faculty","*","where fac_mobile='".$fac_mobile."' OR fac_email='".$fac_email."'","","");
				$rowFetch = mysql_fetch_assoc($check_email_query);
				
				if(mysql_num_rows($check_email_query)>0)
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"Mobile OR Email is already exists"));
				}
				else
				{

					$arrUser = array(
									"fac_name"=>$fac_name,
									"fac_dob"=>$fac_dob,
									"fac_doj"=>$fac_doj,
									"fac_address"=>$fac_address,
									"fac_mobile"=>$fac_mobile,
									"fac_password"=>$fac_password,
									"fac_email"=>$fac_email
								);
							
					$insertUser = $con->insert_record("reg_faculty",$arrUser);
								
					header('Content-type: application/json');
					echo json_encode(array("Status"=>1,"Message"=>"Faculty registered Successfully."));			
				}
			}
			elseif ($designation=='HOD')
			{
				$check_email_query = $con->select_query("reg_hod","*","where hod_mobile='".$hod_mobile."' OR hod_email='".$hod_email."'","","");
				$rowFetch = mysql_fetch_assoc($check_email_query);
				
				if(mysql_num_rows($check_email_query)>0)
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"Mobile OR Email is already exists"));
				}
				else
				{

					$arrUser = array(
									"hod_name"=>$fac_name,
									"hod_dob"=>$fac_dob,
									"hod_doj"=>$fac_doj,
									"hod_address"=>$fac_address,
									"hod_mobile"=>$fac_mobile,
									"hod_password"=>$fac_password,
									"hod_email"=>$fac_email
								);
							
					$insertUser = $con->insert_record("reg_hod",$arrUser);
								
					header('Content-type: application/json');
					echo json_encode(array("Status"=>1,"Message"=>"HOD Registered Successfully."));			
				}				
			}
		}
		
	}
	elseif (mode=='login') 
	{
		$email=email;
		$password=password;
		$designation=designation;
		if(empty($password)||empty($email))
		{
			header('Content-type: application/json');
			echo json_encode(array("Status"=>0,"Message"=>"Please fill all required fields"));	
		}
		else
		{
			if($designation=='Faculty')
			{
				$check_login_query = $con->select_query("reg_faculty","*","where fac_email='".$email."'","","");
				$rowFetch = mysql_fetch_assoc($check_login_query);
				
				if(mysql_num_rows($check_login_query)>0)
				{
					if ($rowFetch['fac_password']==$password) 
					{
						$Faculty['faculty_id']=$rowFetch['fac_id'];
						$Faculty['faculty_name']=$rowFetch['fac_name'];
						$Faculty['faculty_email']=$rowFetch['fac_email'];
						$Faculty['faculty_mobile']=$rowFetch['fac_mobile'];
						$Faculty['faculty_address']=$rowFetch['fac_address'];
						$Faculty['faculty_DOB']=$rowFetch['fac_dob'];			
						$Faculty['faculty_DOJoin']=$rowFetch['fac_doj'];			
					header('Content-type: application/json');
					echo json_encode(array("Status"=>1,"FacultyDetails"=>$Faculty,"Message"=>"Faculty Login Successfully."));
					}
					else
					{
						header('Content-type: application/json');
						echo json_encode(array("Status"=>0,"Message"=>"Email id or password not vaild."));
					}			
				}
				else
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"You are not registered."));
				}
		}
		if($designation=='HOD')
		{
			$check_login_query = $con->select_query("reg_hod","*","where hod_email='".$email."'","","");
				$rowFetch = mysql_fetch_assoc($check_login_query);
				
		if(mysql_num_rows($check_login_query)>0)
				{
					if ($rowFetch['hod_password']==$password) 
					{
						$Faculty['HOD_id']=$rowFetch['hod_id'];
						$Faculty['HOD_name']=$rowFetch['hod_name'];
						$Faculty['HOD_email']=$rowFetch['hod_email'];
						$Faculty['HOD_mobile']=$rowFetch['hod_mobile'];
						$Faculty['HOD_address']=$rowFetch['hod_address'];
						$Faculty['HOD_DOB']=$rowFetch['hod_dob'];			
						$Faculty['HOD_DOJoin']=$rowFetch['hod_doj'];			
					header('Content-type: application/json');
					echo json_encode(array("Status"=>1,"HOD_Details"=>$Faculty,"Message"=>"HOD Login Successfully."));
					}
					else
					{
						header('Content-type: application/json');
						echo json_encode(array("Status"=>0,"Message"=>"Email id or password not vaild."));
					}			
				}
				else
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"You are not registered."));
				}
		}
		if ($designation=='Admin') 
		{
			$check_login_query = $con->select_query("login","*","where email='".$email."'","","");
				$rowFetch = mysql_fetch_assoc($check_login_query);
				
				if(mysql_num_rows($check_login_query)>0)
				{
					if ($rowFetch['password']==$password) 
					{
						header('Content-type: application/json');
						echo json_encode(array("Status"=>1,"Message"=>"Admin Login Successfully."));
					}
					else
					{

					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"Password or email id not correct."));
					}
											
				}
				else
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"You are not register."));
				}	
		}
	}
}
?>