<?php
require 'tmhOAuth.php'; // Get it from: https://github.com/themattharris/tmhOAuth
$servername = "localhost";
$username = "root";
$password = "";
$database = "tweets";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)

$len = "SELECT COUNT(*) from user";
$result1 = mysqli_query($conn,$len);
$row1 = mysqli_fetch_array($result1);
$count = $row1[0];
mysqli_query($conn,"truncate table tweet_data");

for($j=1;$j<=$count ;$j++){
$connection = new tmhOAuth(array(
  'consumer_key' => 'mTqIHZBAAhvxL4ZTzNhoSRiHo',
	'consumer_secret' => 'zySk774l0jquP0qpl8Q47v40VlhQfHQZCw2jylC1XwdlEiLQdG',
	'user_token' => '245792598-ppUdMKFdIpnYSZAhSBVU2Y6GYIzdsdW87C2QojwL', //access token
	'user_secret' => 'xtktAHFUJPzXpfAivPoiVh0KY8ikHAs7oELDFEMdgn3jG' //access token secret
));

// set up parameters to pass
$parameters = array();

$parameters['count'] = '20' ;
$res = "";
$twitter_path = '1.1/statuses/user_timeline.json';
$result = mysqli_query($conn,"SELECT u_name FROM `user` where u_id= '$j'");
while($row = mysqli_fetch_array($result)){
$parameters['screen_name'] = $row[0];

$http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

if ($http_code === 200) { // if everything's good
	$response = strip_tags($connection->response['response']);


		$res = $res . $response;	

	
} else {
	echo "Error ID: ",$http_code, "<br>\n";
	echo "Error: ",$connection->response['error'], "<br>\n";
}
}
//echo $res;
$array = json_decode($res);
$i = 0;
$text = "";
$name = "";
$url = "";
$img = "";
while($i < count($array)){
	
	$text = $array[$i]->text;
	$name= $array[$i]->user->screen_name;
	$img= $array[$i]->user->profile_image_url;
	//if($array[$i]->entities->urls[0]->url != NULL){
    $url = $array[$i]->entities->urls[0]->url;
	//}
	//else{
		//$url =" ";
	//}
	$res = mysqli_query($conn,"insert into tweet_data values('','$name','$text','$url','$img')");
	$i++;
}

}

// You may have to download and copy http://curl.haxx.se/ca/cacert.pem 
?>