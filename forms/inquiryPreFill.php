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
$state=$_POST['state'];
$states=[];
$cities=[];
$counter=0;
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if($state==""){
	$sql = "SELECT distinct city_state states FROM `ins_cities` order by city_state ASC";
	$result = $conn->query($sql);
	if($result == false){
		echo mysqli_error($conn);
	}
	else{
		//echo $result->fetchInto($states);
		if ( $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$states[$counter] = $row["states"];
				$counter=$counter+1;
			}
			echo json_encode($states);
		} else {
			echo "no results";
		}
	}
}
else{
	$sql= "SELECT distinct city_name cities FROM `ins_cities` WHERE city_state= '{$state}' ORDER BY CITY_NAME ASC";
	//$stmt = $conn->prepare($sql); 
	//$stmt->bind_param("1", $state);
	//$stmt->execute();
	$result = $conn->query($sql);
	if($result == false){
		echo mysqli_error($conn);
	}
	else{
		if ( $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$cities[$counter] = $row["cities"];
				$counter=$counter+1;
			}
			echo json_encode($cities);
		} else {
			echo "no results";
		}
	}
	
}

$conn->close();
?>
