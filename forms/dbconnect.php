<?php
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

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

phpinfo();

?>