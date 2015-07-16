var x=new google.maps.LatLng(46.94276, 7.44324);
var stavanger=new google.maps.LatLng(50.983991,-100.734863);
var amsterdam=new google.maps.LatLng(52.395715,4.888916);
var london=new google.maps.LatLng(51.508742,-0.120850);

function initialize()
{
var mapProp = {
  center:x,
  zoom:3,
  mapTypeId:google.maps.MapTypeId.HYBRID
  };
  


var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var arrow = {
    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
  };


var myTrip=[london, stavanger];
var flightPath=new google.maps.Polyline({
  path:myTrip,
  icons: [{
    icon: arrow
  }],
  strokeColor:"#0000FF",
  strokeOpacity:1,
  strokeWeight:4,
  geodesic:true
  });

flightPath.setMap(map);
}

var arr = Object.keys(data).map(function(k) { return data[k] });

var blub = data[0].Code;
console.log(blub);
window.alert(arr);
google.maps.event.addDomListener(window, 'load', initialize);
