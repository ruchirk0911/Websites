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
if (isset($_POST['username']) && isset($_POST['pass'])){
	
$user_name = $_POST['username']; //filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
$pass = $_POST['pass']; //filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING);
$sql = "SELECT pass from admin where admin_name= '$user_name'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if($pass === $row[0]){
		$_SESSION['username'] = $user_name;
		header("Location: admin.php");
	}else {
    echo "Invalid Username- password combination";
}
$conn->close(); 	
}
?>
