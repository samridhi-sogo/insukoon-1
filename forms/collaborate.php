<?php
require 'mailer/PHPMailerAutoload.php'; 
$mail = new PHPMailer();
// configure an SMTP
$mail->isSMTP();
$mail->Host = 'mail.insukoon.com';
$mail->SMTPAuth = true;
$mail->Username = 'no-reply@insukoon.com';
$mail->Password = 'Pass@#123';
//$mail->SMTPSecure = 'ssl';
$mail->Port = 25;
$name=$_POST['person']; // Get Name value from HTML Form
$mobile=$_POST['phoneno'];  // Get Mobile No
$email=$_POST['emailid'];  // Get Email Value
$organization=$_POST['organization'];
$mail->setFrom('no-reply@insukoon.com');
$adminmail='no-reply@insukoon.com';
$mail->addAddress($adminmail);
$mail->Subject = "Request to Collaborate with ". $organization;
// Set HTML 
$mail->isHTML(TRUE);
 $mail->Body = "
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Name: </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$email</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Mobile No: </strong></td>
                            <td style='width:400px'>$mobile</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Organization: </strong></td>
                            <td style='width:400px'>$organization</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";
 $mail->send();
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
$mail1->Username = 'no-reply@insukoon.com';
$mail1->Password = 'Pass@#123';
//$mail1->SMTPSecure = 'ssl';
$mail1->Port = 25; 
$mail1->setFrom('no-reply@insukoon.com');
$mail1->addAddress($email);
$mail1->Subject = "Thanks $name for showing support for INSUKOON";
$mail1->Body = "<html>Thanks For contacting INSUKOON <br/> We will get back to your soon!</html>";
$mail1->isHTML(TRUE);
$mail1->send();
if(!$mail1->send()){
   echo "<script>alert('EMAIL 2 FAILED');</script>";    
} else {
    echo " ";
}
?>
