<?php
$conn=mysqli_connect("localhost","root","","art");
	// Check connection
	if (mysqli_connect_errno())
 	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
  	mysqli_set_charset($conn,"utf8");
  ?>
