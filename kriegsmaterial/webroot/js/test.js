var map;
var lines = [];
function initialize()
{
  var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
  var mapProp = {
    center:schweiz,
    zoom:3,
    mapTypeId:google.maps.MapTypeId.HYBRID
  };

  map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
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
    lines.push(flightPath);
  }  
}

google.maps.event.addDomListener(window, 'load', initialize);

function createTable(tab){
  var exportColumns = 6;
  var tbody = document.createElement('tbody');
  tbody.id = "exportTbody";
  var rows = tab.response.length;
  /*
  Anfang von JS Pagination selbst implementierung
  if(rows >= 25){
    rows = 25;
  }
  */
  for(var i = 0; i < rows; i++){
    var tr = tbody.insertRow();
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].Code));
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].Art));
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].System));
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].Kategorie));
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].Betrag));
    var td = tr.insertCell();
    td.appendChild(document.createTextNode(tab.response[i].Year));
  }
 
  var oldtbody = document.getElementById("exportTbody");
  oldtbody.parentNode.replaceChild(tbody, oldtbody);

}

function search(){
  var land = $('#laender').find(':selected').text();
  var art = $('#art').find(':selected').text();
  var system = $('#system').find(':selected').text();
  var kategorie = $('#kategorie').find(':selected').text();
  var yearBegin = $('#yearBegin').find(':selected').text();
  var yearEnd = $('#yearEnd').find(':selected').text();
  $.ajax({
    type:"POST",
    url: targetUrl,
    dataType: 'json',
    data: {land: land,
      art: art,
      system: system,
      kategorie: kategorie,
      yearBegin: yearBegin,
      yearEnd: yearEnd},
    success: function(tab){
       var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
       document.getElementById("paginator").style.display = "none";
       document.getElementById("table").style.paddingBottom = "20px";
       if(tab.response.length < 1){
          var searchContent = document.getElementById("searchContent");
          searchContent.innerHTML = "Keine Daten für diese Parameter.";
          searchContent.style.display = "initial";
          $("#searchContent").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
          return;
        }
        document.getElementById("searchContent").style.display = "none";
        var Longitude = tab.response[0].laender.Longitude;
        var Latitude = tab.response[0].laender.Latitude;
        for(var i = 0; i < lines.length; i++){
          lines[i].setMap(null);
        }
        var searchPlace = new google.maps.LatLng(Latitude, Longitude);
        var searchTrip = [schweiz, searchPlace];
        var flightPath=new google.maps.Polyline({
          path:searchTrip,
          strokeColor:"#FF0000",
          strokeOpacity:0.9,
          strokeWeight:3,
          geodesic:true
          });
        lines.push(flightPath);
        flightPath.setMap(map);
        // Meine Idee wie man Pagination machen könnte
        // phpTable(tab);
        createTable(tab);
    },
    error: function (tab) {
        console.log(tab);
        alert('error');
    }
  });
}

