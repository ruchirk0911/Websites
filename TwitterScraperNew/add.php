<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "tweets";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['twitter_handle'])){
	

	$twitter_handle = $_POST['twitter_handle'];
	$sql = "INSERT INTO user values('','$twitter_handle')";
	if ($conn->query($sql) === TRUE) {
		header('Location: admin.php');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>