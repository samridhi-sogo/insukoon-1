<?php session_start(); 
require 'mailer/PHPMailerAutoload.php'; 

/*FOR DEVELOPMENT*/
// $servername = "localhost";
// $username = "app_user";
// $password = "pass123";

/*FOR PRODUCTION*/
$servername = "103.118.16.155:3306";
$username = "insukoon_dbowebuser";
$password = "5I&u8a@s$!O5";


$dbname = "insukoon_dbinsukoonweb";

$name=$_POST['name']; // Get Name value from HTML Form
$mobile=$_POST['phone'];  // Get Mobile No
$email=$_POST['email'];  // Get Email Value
$message=$_POST['message'];
$childrenNo=$_POST['radio-group-1'];
$child1Age=$_POST['child-age-1'];
$child2Age=$_POST['child-age-2'];
$child3Age=$_POST['child-age-3'];
$recommendation=$_POST['radio-group-2'];
$q1=$_POST['q1'];
$q2=$_POST['q2'];
$q3=$_POST['q3'];
$q4=$_POST['q4'];
$q5=$_POST['q5'];
$q6=$_POST['q6'];
$q7=$_POST['q7'];
$q8=$_POST['q8'];
$q9=$_POST['q9'];
$q10=$_POST['q10'];
$q11=$_POST['q11'];
$q12=$_POST['q12'];
$q13=$_POST['q13'];
$q14=$_POST['q14'];
$q15=$_POST['q15'];


if($child2Age == '')
{
	$child2Age = 0;
}

if($child3Age == '')
{
	$child3Age = 0;
}


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	$sql = "INSERT INTO `ins_parents_survey`(`parent_name`, `parent_email`, `phone_number`, `comments`, `age_child_1`, `age_child_2`, `age_child_3`, `recommendation`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`) VALUES 
	( '$name' , '$email' , '$mobile' , '$message' , $child1Age, $child2Age, $child3Age, '$recommendation' , $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15 )";
	
	if($conn->query($sql)){
		echo "OK";
	}
	else{
		error_log($sql);
		echo "ERROR";
	}
$conn->close();	


// add attachment
//$mail->addAttachment('//confirmations/yourbooking.pdf', 'yourbooking.pdf');
// send the message

$mail1 = new PHPMailer();
// configure an SMTP
$mail1->isSMTP();
$mail1->Host = 'mail.insukoon.com';
$mail1->SMTPAuth = true;
$mail1->Username = 'hr@insukoon.com';
$mail1->Password = 'Pass#123';
//$mail1->SMTPSecure = 'ssl';
$mail1->Port = 25; 
$mail1->setFrom('hr@insukoon.com');
$mail1->addAddress($pocEmail);
$mail1->addAddress($orgEmail);
$mail1->Subject = "INSUKOON - Thank you for participating in Our Survey";
$mail1->Body = "<html>Dear $name, <br/> Thank you, we appreciate your time for filling the Survey form.<br/>
Filling Out Surveys help us in improving our services and cater to wider variety of people. Each and Every response is valuablr to us.<br/>
Have a great day!<br/><br/>
Thank You<br/>
Team INSUKOON <br/><br/>
</html>";
$mail1->isHTML(TRUE);

$mail1->send();

?>
