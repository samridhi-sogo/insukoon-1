<?php header('Access-Control-Allow-Origin: *,false');
//insukoon_dbinsukoonweb
//user : dbowebuser
//password : dbowebuser

/*FOR DEVELOPMENT*/
$servername = "localhost";
$username = "app_user";
$password = "pass123";

/*FOR PRODUCTION*/
// $servername = "103.118.16.155:3306";
// $username = "insukoon_dbowebuser";
// $password = "5I&u8a@s$!O5";


$dbname = "insukoon_dbinsukoonweb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);
$visits=0;
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE ins_counter SET visits=visits+1 WHERE ID=1";
$conn->query($sql);

$sql = "SELECT visits FROM `ins_counter` WHERE ID=1";
$result = $conn->query($sql);
if($result == false){
	echo mysqli_error($conn);
}
else{
	if ( $result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$visits = $row["visits"];
			echo $visits;
		}
	} else {
		echo "no results";
	}
}
$conn->close();
?>
