<?php
// The MySQL service named in the docker-compose.yml.
$host = 'datadb';

// Database use name
$username = getenv("MYSQL_USER");

//database user password
$pass = getenv("MYSQL_PASSWORD");

$DB = getenv("MYSQL_DATABASE");

$user = $_POST['user'];
$password = $_POST['password'];
// Create connection
$con = new mysqli("$host", "$username","$pass","$DB");
if($con->connect_error){
	die("failed to connect : " .$con->connect_error);
} else {
$stmt = $con->prepare("select * from logintable where user = ?");
	$stmt->bind_param("s",$user);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	if($stmt_result->num_rows > 0) {
	  $data = $stmt_result->fetch_assoc();
		if($data['password'] ==$password) {
		include("welcompage.html");
		} else {
     			echo "<h2>Invalid password</h2>";

		}
	} else {
	 echo "<h2>kuch bhi name mt dalo</h2>";
	}
}

?>
