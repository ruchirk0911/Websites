// Put your zillow.com API key here

var username = "rrk7805";
var request = new XMLHttpRequest();


//initMap() which initiates map to a location
function initMap() {
    //var myLatlng = ;

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: {lat: 32.75, lng: -97.13}
    });
	var geocoder = new google.maps.Geocoder;
	var infowindow = new google.maps.InfoWindow;
	var marker = new google.maps.Marker({
		map: map,
	});
	
	google.maps.event.addListener(map,'click',function(event){
		reversegeocode(geocoder, event.latLng, map, infowindow, marker);
	});
		//Initialize a mouse click event on map which then calls reversegeocode function
	marker.addListener('click', function(event){
    infowindow.open(map, marker);
  })
}

function initialize(){
	initMap();
}	

function clearDiv(){
  document.getElementById("output").innerHTML = " ";
}


// Reverse Geocoding 
function reversegeocode(geocoder, latlng, map, infowindow,marker) {
	
  //get the latitude and longitude from the mouse click and get the address.
	  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[0]) {
        map.setZoom(17);
        marker.setPosition(latlng);
		    //map.setCenter(latlng);
        var addr_data = results[0].formatted_address;

        //call geoname api asynchronously with latitude and longitude 
        var lat = latlng.lat();
        var lng = latlng.lng();
        console.log("lat:",lat);
        console.log("lng:",lng);
        sendRequest(lat,lng,addr_data,infowindow);
        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
  
  
}// end of geocodeLatLng()



function displayResult (infowindow,addr_data) {
  if (request.readyState == 4) {
    var xml = request.responseXML.documentElement;
    var temperature = xml.getElementsByTagName("temperature")[0].childNodes[0].nodeValue;
    var wind_speed = xml.getElementsByTagName("windSpeed")[0].childNodes[0].nodeValue;
    var clouds = xml.getElementsByTagName("clouds")[0].childNodes[0].nodeValue;
    value ="<p><strong>Address: </strong>"+ addr_data+"<br><strong>Temperature: </strong>"+ temperature +"°C<br><strong>Wind Speed: </strong>"+ wind_speed+" mph<br><strong>Clouds: </strong>"+clouds+"</p>";
    infowindow.setContent(value);
    document.getElementById("output").innerHTML += value;
  }
}

function sendRequest (lat, lng, addr_data, infowindow) {
    request.onreadystatechange = function(){ displayResult(infowindow,addr_data)};
    request.open("GET"," http://api.geonames.org/findNearByWeatherXML?lat="+lat+"&lng="+lng+"&username="+username);
    //request.withCredentials = "true";
    request.send(null);
}
