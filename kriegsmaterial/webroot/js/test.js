var map;
var lines = [];
var searchData = "false";

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
      kat = 10;
    else if(allData[i].Betrag > 150000000)
      kat = 8;
    else if(allData[i].Betrag > 100000000)
      kat = 6;
    else if(allData[i].Betrag > 50000000)
      kat = 4;
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

$(document).ready(function (){
  $(document).on('click', '#pagination-container a', function () {
    var land = $('#laender').find(':selected').text();
  var art = $('#art').find(':selected').text();
  var system = $('#system').find(':selected').text();
  var kategorie = $('#kategorie').find(':selected').text();
  var yearBegin = $('#yearBegin').find(':selected').text();
  var yearEnd = $('#yearEnd').find(':selected').text();

    var thisHref = $(this).attr('href');
    if (!thisHref) {
      return false;
    }
    $('#pagination-container').fadeTo(300, 0);
    $('#pagination-container').load(thisHref, {search: searchData,
      land: land,
      art: art,
      system: system,
      kategorie: kategorie,
      yearBegin: yearBegin,
      yearEnd: yearEnd}, function() {
      $(this).fadeTo(200, 1);
    });
    return false;
  });
});

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
      if(tab.response.length < 1){
        var searchContent = document.getElementById("searchContent");
        searchContent.innerHTML = "Keine Daten für diese Parameter.";
        searchContent.style.display = "initial";
        $("#searchContent").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
        return;
      }
      document.getElementById("searchContent").style.display = "none";
      if(land.localeCompare("Land") == 0){
        for(var i = 0; i < lines.length; i++){
            lines[i].setMap(null);
          }
        for(var i = 0; i < tab.response.length; i++){
          var Longitude = tab.response[i].laender.Longitude;
          var Latitude = tab.response[i].laender.Latitude;
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
        }
      }
      else{
        
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
      }
      $.ajax({
        type:"POST",
        url: searchUrl,
        dataType: 'html',
        data: {search: "true",
          land: land,
          art: art,
          system: system,
          kategorie: kategorie,
          yearBegin: yearBegin,
          yearEnd: yearEnd},
        success: function(tab2){
          searchData = "true";
          $('#pagination-container').fadeTo(300, 0);
          $('#pagination-container').html(tab2);
          $('#pagination-container').fadeTo(200, 1);
        },
        error: function (response) {
            console.log(response);
            alert('error');
        }
      });
    },
    error: function (tab) {
        console.log(tab);
        alert('error');
    }
  });
}

