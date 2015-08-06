var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);

function initialize()
{
var mapProp = {
  center:schweiz,
  zoom:3,
  mapTypeId:google.maps.MapTypeId.HYBRID
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
/*
var arrow = {
    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
  };
*/
var cities = [];
var values = [];
for(var i = 0; i < allData.length; i++){
  var city = new google.maps.LatLng(allData[i].laender.Latitude, allData[i].laender.Longitude);
  cities.push(city);
  var kat = 0;
  if(allData[i].Betrag > 200000000)
    kat = 5;
  else if(allData[i].Betrag > 150000000)
    kat = 4;
  else if(allData[i].Betrag > 100000000)
    kat = 3;
  else if(allData[i].Betrag > 50000000)
    kat = 2;
  else if(allData[i].Betrag > 0)
    kat = 1;
  values.push(kat);
}

var trips = [];
for(var i = 0; i < cities.length; i++){
  var trip = [schweiz, cities[i]];
  trips.push(trip);
}

for(var i = 0; i < trips.length; i++){
  var flightPath=new google.maps.Polyline({
  path:trips[i],
  strokeColor:"#FF0000",
  strokeOpacity:0.9,
  strokeWeight:values[i]*3,
  geodesic:true
  });
  flightPath.setMap(map);
}

}

google.maps.event.addDomListener(window, 'load', initialize);
