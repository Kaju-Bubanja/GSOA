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
for(oneExport in allData){
  var city = new google.maps.LatLng(oneExport.Latitude, oneExport.Longitude);
  cities.push(city);
}

var trips = [];
for(city in cities){
  var trip = [schweiz, city];
}

for(trip in trips){
  var flightPath=new google.maps.Polyline({
  path:trip,
  icons: [{
    icon: arrow
  }],
  strokeColor:"#FF0000",
  strokeOpacity:1,
  strokeWeight:4,
  geodesic:true
  });
  flightPath.setMap(map);
}

}

google.maps.event.addDomListener(window, 'load', initialize);
