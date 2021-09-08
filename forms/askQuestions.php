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
$ques = $_POST['question'];
$age = $_POST['child1Age'];

// receive all data in an array
$questions = $_POST['questions'];
$children = $_POST['children'];


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	$sql = "INSERT INTO `ins_experts`(`parent_name`, `parent_email`, `phone_number` ) VALUES 
	( '$name' , '$email' , '$mobile' )";
	
	if($conn->query($sql)){
		$expertId = mysqli_insert_id($conn);
			$sql = "INSERT INTO `ins_questions`(`experts__id`, `question`, `age_child`) VALUES ('$expertId','$ques','$age')";
			if($conn->query($sql)){
				echo "";
			}
			else{
				error_log($sql);
				echo "ERROR";
			}
		foreach (array_combine($questions, $children) as $question => $child) {
			$sql = "INSERT INTO `ins_questions`(`experts__id`, `question`, `age_child`) VALUES ('$expertId','$question','$child')";
			if($conn->query($sql)){
				echo "";
			}
			else{
				error_log($sql);
				echo "ERROR";
			}
		}
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
