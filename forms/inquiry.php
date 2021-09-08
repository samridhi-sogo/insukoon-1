<?php session_start(); 
require 'mailer/PHPMailerAutoload.php'; 

$mail = new PHPMailer();
// configure an SMTP
$mail->isSMTP();
$mail->Host = 'mail.insukoon.com';
$mail->SMTPAuth = true;
$mail->Username = 'hr@insukoon.com';
$mail->Password = 'Pass#123';
//$mail->SMTPSecure = 'ssl';
$mail->Port = 25;

$orgName=$_POST['field-org-name']; // Get Name value from HTML Form
$orgAddress=$_POST['field-address'];
$orgState=$_POST['field-state'];
$orgCity=$_POST['field-city'];
$orgPIN=$_POST['field-org-pin'];
$orgEmail=$_POST['field-org-email'];
$orgPhone=$_POST['field-org-phone'];
$orgWebsite=$_POST['field-org-website'];
$orgNature=$_POST['field-org-nature'];
$orgOthers=$_POST['field-org-others'];
$orgType=$_POST['field-org-type'];
$headCount=$_POST['field-head-count'];

$pocName=$_POST['field-poc-name'];
$pocDesignation=$_POST['field-designation'];
$pocEmail=$_POST['field-poc-email'];
$pocPhone=$_POST['field-poc-phone'];

$challenges=$_POST['field-challenges'];
$participants=$_POST['field-participants'];
$sessions=$_POST['field-sessions'];
$participantLevel=$_POST['field-level'];
$fresher = $_POST['freshers']; 
$junior = $_POST['junior'];
$middle = $_POST['middle'];
$senior = $_POST['senior'];
$top = $_POST['top'];
$session1Date=$_POST['field-from-date'];
$session1Time=$_POST['field-from-time'];
$session2Date=$_POST['field-to-date'];
$session2Time=$_POST['field-to-time'];
$language=$_POST['field-language'];

if($orgOthers != ''){
	$orgNature = $orgOthers;
}
if( $fresher == "on" ){
	$participantLevel = "$participantLevel, Freshers";
}
if( $junior == "on" ){
	$participantLevel = "$participantLevel, Junior Management";
}
if( $middle == "on" ){
	$participantLevel = "$participantLevel, Middle Management";
}
if( $senior == "on" ){
	$participantLevel = "$participantLevel, Senior Management";
}
if( $top == "on" ){
	$participantLevel = "$participantLevel, Top Management";
}

$mail->setFrom('hr@insukoon.com');
$adminmail="hr@insukoon.com";
$mail->addAddress($adminmail);
$mail->Subject = "New Enquiry Received!";
// Set HTML 
$mail->isHTML(TRUE);
 $mail->Body = "
        <html>
            <body>
                <table style='width:800px;'>
                    <tbody>
                        <tr>
                            <td style='width:400px'>Organization Name:</td>
							<td style='width:400px'>$orgName</td>
						</tr>
						<tr>
                            <td style='width:400px'>Address:</td>
							<td style='width:400px'>$orgAddress</td>
						</tr>
						<tr>
							<td style='width:400px'>City:</td>
							<td style='width:400px'>$orgCity</td>
						</tr>
						<tr>
							<td style='width:400px'>State:</td>
							<td style='width:400px'>$orgState</td>
						</tr>
						<tr>
							<td style='width:400px'>PIN Code:</td>
							<td style='width:400px'>$orgPIN</td>
						</tr>
						<tr>
							<td style='width:400px'>e-mail:</td>
							<td style='width:400px'>$orgEmail</td>
						</tr>
						<tr>
							<td style='width:400px'>Phone:</td>
							<td style='width:400px'>$orgPhone</td>
						</tr>
						<tr>
							<td style='width:400px'>Website:</td>
							<td style='width:400px'>$orgWebsite</td>
						</tr>
						<tr>
							<td style='width:400px'>Nature Of Business:</td>
							<td style='width:400px'>$orgNature</td>
						</tr>
						<tr>
							<td style='width:400px'>Organization Scale:</td>
							<td style='width:400px'>$orgType</td>
                        </tr>
                        <tr>
							<td style='width:400px'>Head Count:</td>
							<td style='width:400px'>$headCount</td>
                        </tr>
                    </tbody>
                </table>
				<table style='width:800px;'>
                    <tbody>
                        <tr>
                            <td style='width:400px'>POC Name:</td>
							<td style='width:400px'>$pocName</td>
						</tr>
						<tr>
                            <td style='width:400px'>Designation:</td>
							<td style='width:400px'>$pocDesignation</td>
						</tr>
						<tr>
							<td style='width:400px'>e-mail:</td>
							<td style='width:400px'>$pocEmail</td>
                        </tr>
                        <tr>
                            <td style='width:400px'>Phone:</td>
							<td style='width:400px'>$pocPhone</td>
                        </tr>
                    </tbody>
                </table>
				<table style='width:800px;'>
                    <tbody>
                        <tr>
                            <td style='width:400px'>Challenges:</td>
							<td style='width:400px'>$challenges</td>
						</tr>
						<tr>
                            <td style='width:400px'>Participants Per Session:</td>
							<td style='width:400px'>$participants</td>
						</tr>
						<tr>
							<td style='width:400px'>Sessions:</td>
							<td style='width:400px'>$sessions</td>
						</tr>
						<tr>
							<td style='width:400px'>Participant-Level:</td>
							<td style='width:400px'>$participantLevel</td>
						</tr>
						<tr>
							<td style='width:400px'>Session 1 Date:</td>
							<td style='width:400px'>$session1Date</td>
						</tr>
						<tr>
							<td style='width:400px'>Session 1 Time:</td>
							<td style='width:400px'>$session1Time</td>
						</tr>
						<tr>
							<td style='width:400px'>Session 2 Date:</td>
							<td style='width:400px'>$session2Date</td>
						</tr>
						<tr>
							<td style='width:400px'>Session 2 Time:</td>
							<td style='width:400px'>$session2Time</td>
						</tr>
						<tr>
							<td style='width:400px'>Preferred Language:</td>
							<td style='width:400px'>$language</td>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
				
            </body>
        </html>
        ";
 if(!$mail->send()){
   echo "<script>alert('EMAIL FAILED');</script>";    
} else {
	echo "OK";
}
 
 
 
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
$mail1->Subject = "INSUKOON - Training Request Submitted";
$mail1->Body = "<html>Dear $pocName, <br/> Thank you, we appreciate your time for filling the form to conduct the Corporate Training Program – Equilibrium in $orgName.<br/>
We will get back to you at the earliest.<br/>
Have a great day!<br/><br/>
Thank You<br/>
Team INSUKOON <br/><br/>
</html>";
$mail1->isHTML(TRUE);

$mail1->send();
?>
