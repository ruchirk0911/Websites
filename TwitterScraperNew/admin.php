<?php 
session_start();
if(isset($_SESSION['username']))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Healthweets</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class = "logo">
		<img src ="logo.png" align : "center" />
		<i class="fa fa-lock" id="logout" aria-hidden="true" style="cursor:pointer;font-size:24px;float:right;margin-right:50px;margin-top:50px;color:#fff"><a href="./removeSession.php" style="color:#fff;text-decoration:none">&nbsp Logout</a></i>
		<i id=myBtn class="fa fa-plus-square" style="cursor:pointer;font-size:24px;color:white;float:right;margin-right:50px;margin-top:50px"> Account</i>
		<!-- The Modal -->
		<div id="myModal" class="modal">

		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<a><span class="close"><i class="fa fa-times" aria-hidden="true"></i></span></a>
				<h2>Manage accounts</h2>
			</div>
			<div class="modal-body">
				<form action="add.php" method="post">
					<p>Twitter handle <input type="text" name="twitter_handle" id="twitter_handle" placeholder="Enter Twitter handle"></p>
					<p><input type="submit" value="Add"></p>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>

	</div>


	</div>
	
   <div class="container data">
        <?php
			require_once 'tweets_data.php';
		?>	
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
   
	<script>
	
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	$('#logout').onclick(function(){
		
	$.ajax({
		url : "./removeSession.php",
		type : "POST"
	});
	
		
	});
	
//var obj = JSON.parse(x);
//console.log(obj.text);
	</script>
   

</body>

</html>
<?php 
}
else{
	 
	header('location:index.php');
}

?>