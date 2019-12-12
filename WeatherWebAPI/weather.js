var api_key = "YOUR API KEY";

function sendRequest () {
    var xhr = new XMLHttpRequest();
	//var method = "artist.getinfo";
    var city = encodeURI(document.getElementById("form-input").value);
	if(city === ""){
		alert("Please enter the city name.");
	}
	else{
		xhr.open("GET", "proxy.php?q="+city+"&appid="+api_key+"&format=json&units=imperial", true);
		xhr.setRequestHeader("Accept","application/json");
		xhr.onreadystatechange = function () {
			if (this.readyState == 4) {
				var json = JSON.parse(this.responseText);
				var str = JSON.stringify(json,undefined,2);
				document.getElementById("icon").style.display = 'block';
				document.getElementById("data").style.display = 'block';
				message(json.weather[0].id);
				document.getElementById("icon").innerHTML = "<img src='http://openweathermap.org/img/w/"+json.weather[0].icon+".png'></pre>";
				document.getElementById("name").innerHTML = "<p>"+json.name+", "+json.sys.country+"</p>";
				document.getElementById("lon").innerHTML = "<td><strong>Longitude:</strong></td><td>"+json.coord.lon+ "°</td>";
				document.getElementById("lat").innerHTML = "<td><strong>Latitude:</strong></td><td>"+json.coord.lat+"°</td>";
				document.getElementById("tosr").innerHTML = "<td><strong>Time of sunrise:</strong></td><td>"+timeConverter(json.sys.sunrise)+" (Local Time)</td>";
				document.getElementById("toss").innerHTML = "<td><strong>Time of sunset:</strong></td><td>"+timeConverter(json.sys.sunset)+" (Local Time)</td>";
				document.getElementById("pressure").innerHTML = "<td><strong>Pressure:</strong></td><td>"+json.main.pressure+" hPa</td>";
				document.getElementById("humidity").innerHTML = "<td><strong>Humidity:</strong></td><td>"+json.main.humidity+"%</td>";
				document.getElementById("temp").innerHTML = "<td><strong>Temperature:</strong></td><td>"+json.main.temp+" °F</td>";
				document.getElementById("temp_min").innerHTML = "<td><strong>Minimum Temperature:</strong></td><td>"+json.main.temp_min+" °F</td>";
				document.getElementById("temp_max").innerHTML = "<td><strong>Maximum Temperature:</strong></td><td>"+json.main.temp_max+" °F</td>";
				document.getElementById("clouds").innerHTML = "<td><strong>Clouds:</strong></td><td>"+json.clouds.all+"%</td>";
				console.log(str);
            
			}
        
		};
		xhr.send(null);
	}
}
function initialize(){
	document.getElementById("icon").style.display = 'none';
	document.getElementById("data").style.display = 'none';
}
	
function timeConverter(t){
  var a = new Date(t * 1000);
  var months = ['January','February','Marach','April','May','June','July','August','September','October','November','December'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = "0"+ a.getMinutes();
  var sec = a.getSeconds();
  var time = date + ' ' + month + ' ' + year + ', ' + hour + ':' + min.substr(-2);
  return time;
}

function message(weather_id){
	if(weather_id < 300){
		document.getElementById("output").innerHTML = "Go to a nearby strom shelter!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Poor</td>";
	}
	else if(weather_id >= 300 && weather_id < 400){
		document.getElementById("output").innerHTML = "Carry umbrella....It's drizzling!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Poor</td>";
	}
	else if(weather_id >= 500 && weather_id < 600){
		document.getElementById("output").innerHTML = "Carry umbrella....It's raining!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Very Poor</td>";
	}
	else if(weather_id >= 600 && weather_id < 700){
		document.getElementById("output").innerHTML = "Wear your coat....It's snowing!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Very Poor</td>";
	}
	else if(weather_id >= 700 && weather_id < 800){
		document.getElementById("output").innerHTML = "Bad atmosphere!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Very Poor</td>";
	}
	else if(weather_id === 800){
		document.getElementById("output").innerHTML = "It's a clear weather.....Enjoy!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Very Good</td>";
	}
	else if(weather_id > 800 && weather_id < 900){
		document.getElementById("output").innerHTML = "Cloudy Climate.... You might need an umbrella later!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Good</td>";
	}
	else if(weather_id >= 900 && weather_id < 910){
		document.getElementById("output").innerHTML = "Extreme weather...Take a shelter!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Poor</td>";
	}
	else if(weather_id >= 950 && weather_id < 970){
		document.getElementById("output").innerHTML = "Watch out for storm or hurricane!";
		document.getElementById("visibility").innerHTML = "<td><strong>Visibility:</strong></td><td>Good</td>";
	}
};
