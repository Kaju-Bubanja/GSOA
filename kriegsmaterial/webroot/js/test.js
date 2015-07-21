var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
var stavanger=new google.maps.LatLng(50.983991,-100.734863);
var amsterdam=new google.maps.LatLng(52.395715,4.888916);
var london=new google.maps.LatLng(51.508742,-0.120850);

function initialize()
{
var mapProp = {
  center:schweiz,
  zoom:3,
  mapTypeId:google.maps.MapTypeId.HYBRID
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var arrow = {
    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
  };

var cities = [];
var values = [];
for(var i = 0; i < allData.length; i++){
  var city = new google.maps.LatLng(allData[i].laender.Latitude, allData[i].laender.Longitude);
  cities.push(city);
  values.push(allData[i].Betrag);
}

var trips = [];
for(var i = 0; i < cities.length; i++){
  var trip = [schweiz, cities[i]];
  trips.push(trip);
}

for(var i = 0; i < trips.length; i++){
  var flightPath=new google.maps.Polyline({
  path:trips[i],
  icons: [{
    icon: arrow
  }],
  strokeColor:"#FF0000",
  strokeOpacity:0.9,
  strokeWeight:values[i]/1000000,
  geodesic:true
  });
  flightPath.setMap(map);
}

}

google.maps.event.addDomListener(window, 'load', initialize);
