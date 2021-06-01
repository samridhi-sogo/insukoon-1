<?php header('Access-Control-Allow-Origin: *,false');
//insukoon_dbinsukoonweb
//user : dbowebuser
//password : dbowebuser

/*FOR DEVELOPMENT*/
// $servername = "localhost";
// $username = "app_user";
// $password = "pass123";

/*FOR PRODUCTION*/
$servername = "103.118.16.155:3306";
$username = "insukoon_dbowebuser";
$password = "5I&u8a@s$!O5";


$dbname = "insukoon_dbinsukoonweb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
$error_msg='';
$email = $_POST["email-list"];
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function test_input($str) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

// Function call 
if(!test_input($email)) { 
    echo "Invalid email address."; 
} 

if($error_msg==''){
	$stmt = $conn->prepare("INSERT IGNORE INTO ins_email_list(email) values(?)");
	$stmt->bind_param("s", $email);

	$stmt->execute();
	$stmt->store_result();

	if(mysqli_stmt_affected_rows($stmt)==0){
		$error_msg = "Email already exists!";
	}
	$stmt->close();
}

if($error_msg==''){
	echo "OK";
}
else
	echo $error_msg;


$conn->close();
?>
