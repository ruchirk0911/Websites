<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tweets";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$len = "SELECT COUNT(*) from tweet_data";
$result1 = mysqli_query($conn,$len);
$row1 = mysqli_fetch_array($result1);
$count = $row1[0];
$res= "";
for($i=1; $i<= $count; $i++){
$sql = "SELECT text,url,name,img_url from tweet_data WHERE id = '$i'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){

echo "<a href=".$row[1]." style='color:#000;text-decoration:none' target ='_blank'><div class= 'row'>
		<div class= 'col-md-2 urlimg'>
			<img src='".$row[3]."' alt='No image'/>
		</div>
		<div class= 'col-md-10'>
			<p>".$row[0]."</p><p>By <strong>".$row[2]."</strong></p>
		</div>
	</div></a><hr>";
}
}

?>