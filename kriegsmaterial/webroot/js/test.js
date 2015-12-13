var map;
var lines = [];
var searchData = "false";
var searchSkandalsBol = "false";
var infowindows = [];
var markers = [];

function initialize()
{
  var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
  var mapProp = {
    center:schweiz,
    zoom:3,
    mapTypeId:google.maps.MapTypeId.HYBRID
  };

  map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  google.maps.event.trigger(map, 'resize');

  $(document).ready(function (){
	  $(document).on('click', '#pagination-container th a, #paginator a', function () {
	    if(searchSkandalsBol.localeCompare("false") == 0){
	      var land = $('#laender').find(':selected').text();
	      var art = $('#art').find(':selected').text();
	      var system = $('#system').find(':selected').text();
	      var kategorie = $('#kategorie').find(':selected').val();
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
	    }
	    if(searchSkandalsBol.localeCompare("true") == 0){
	      var landSkandal = $('#laenderSkandale').find(':selected').text();
	      var firma = $('#firma').find(':selected').text();
	      var yearBeginSkandale = $('#yearBeginSkandale').find(':selected').text();
	      var yearEndSkandale = $('#yearEndSkandale').find(':selected').text();

	      var thisHref = $(this).attr('href');
	      if (!thisHref) {
	        return false;
	      }
	      $('#pagination-container').fadeTo(300, 0);
	      $('#pagination-container').load(thisHref, {searchSkandals: searchSkandalsBol,
	        landSkandal: landSkandal,
	        firma: firma,
	        yearBeginSkandale: yearBeginSkandale,
	        yearEndSkandale: yearEndSkandale,
	      }, function() {
	        $(this).fadeTo(200, 1);
	      });
	      return false;
	    }
	  });
	  
		$('#pagination-container').on('click', '.skandalLink', function(){
			$('#myModalLabel').html($(this).text());
			$('#myModalBody').text("");
			$.ajax({
		        type: 'GET',
		        url: $(this).attr('href'),
		        dataType: "html",
		        success: function (data) {
		            $('#myModalBody').html($(data).find('#mw-content-text').remove(".mw-editsection").html());
		            $(".mw-editsection").remove();
		        }
		    });
			$('#myModal').modal('show');
			return false;
		});
	  
	  if(window.location.href.indexOf("skandal") > -1){
		  $("#search").toggle();
		  $("#searchSkandals").toggle();
		  $("#pickSearchSkandal").val("skandal");
		  searchSkandals();
	  } else {
		  search();
	  }
	});
}

google.maps.event.addDomListener(window, 'load', initialize);

function clearOverlays() {
	  for (var i = 0; i < markers.length; i++ ) {
		  markers[i].setMap(null);
	  }
	  markers.length = 0;
	}

function searchSkandals(){
  var landSkandal = $('#laenderSkandale').find(':selected').text();
  var firma = $('#firma').find(':selected').text();
  var yearBeginSkandale = $('#yearBeginSkandale').find(':selected').text();
  var yearEndSkandale = $('#yearEndSkandale').find(':selected').text();
  clearOverlays();
  $.ajax({
    type:"POST",
    url: searchSkandalsUrl,
    dataType: 'json',
    data: {landSkandal: landSkandal,
      firma: firma,
      yearBeginSkandale: yearBeginSkandale,
      yearEndSkandale: yearEndSkandale,
      },
    success: function(tab){
      var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
      if(tab.response[0] == null){
        var searchContent = document.getElementById("searchContent");
        searchContent.innerHTML = "Keine Daten für diese Parameter.";
        searchContent.style.display = "initial";
        $("#pagination-container").hide();
        $("#searchContent").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
        return;
      }
      $("#Betrag").html("<p>&nbsp</p>");
      
      document.getElementById("searchContent").style.display = "none";

        for(var i = 0; i < lines.length; i++){
            lines[i].setMap(null);
          }
        for(var i = 0; i < tab.response.length; i++){
          var Longitude = staaten[tab.response[i].Code].Longitude;
          var Latitude = staaten[tab.response[i].Code].Latitude;
          var searchPlace = new google.maps.LatLng(Latitude, Longitude);
          var searchTrip = [schweiz, searchPlace];
          var Betrag = tab.response[i].Betrag;

          var flightPath=new google.maps.Polyline({
            path:searchTrip,
            strokeColor:"lightgrey",
            strokeOpacity:0.9,
            strokeWeight:7,
            geodesic:true
            });
          lines.push(flightPath);
          flightPath.setMap(map);
          
          var infowindow = new google.maps.InfoWindow({
      	    content: staaten[tab.response[i].Code].Name
      	  });
        
        infowindows[tab.response[i].Code] = infowindow;
        
        var marker = new google.maps.Marker({
    	    map: map,
    	    position: searchPlace,
    	    title: tab.response[i].Code,
    	    icon: {
    	      path: google.maps.SymbolPath.CIRCLE,
    	      scale: 4,
    	    strokeColor: "lightgrey"
    	    }
    	  });
      
	      marker.setMap(map);
	      markers.push(marker);
	      
	      marker.addListener('click', function() {
	          infowindows[this.getTitle()].open(map, this);
	        });
          
        }
      $.ajax({
        type:"POST",
        url: searchSkandalsHtml,
        dataType: 'html',
        data: {searchSkandals: "true",
          landSkandal: landSkandal,
          firma: firma,
          yearBeginSkandale: yearBeginSkandale,
          yearEndSkandale: yearEndSkandale,
        },
        success: function(tab2){
          searchSkandalsBol = "true";
          $('#pagination-container').fadeTo(300, 0);
          $('#pagination-container').html(tab2);
          $('#pagination-container').fadeTo(200, 1);
        },
        error: function (response) {
            console.log(response);
            alert('error2');
        }
      });
    },
    error: function (response) {
      console.log(response);
      alert('error');
    }
  });
}

$( document ).ready(function() {
	$("#pickSearchSkandal, #laender, #yearBegin, #yearEnd, #kategorie, #system").change(function() {
		search();
	});
	$("#pickSearchExport, #firma, #laenderSkandale, #yearBeginSkandale, #yearEndSkandale").change(function() {
		searchSkandals();
	});
	$("#searchSkandals").toggle();
	$(".pickSearch").change(function() {
		$("#searchSkandals").toggle();
		$("#search").toggle();
		$("#pickSearchExport").val("export");
		$("#pickSearchSkandal").val("skandal");
	});
	
	$('#system').hide();
	$('#kategorie').hide();
	
	$('#art').change(function(){
		if($(this).val() == 0){
			$('#system').show();
			$('#kategorie').hide();
			$('#kategorie').val(null);
			search();
		} else if ($(this).val() == 1){
			$('#kategorie').show();
			$('#system').hide();
			$('#system').val(null);
			search();
		} else {
			$('#system').hide();
			$('#system').val(null);
			$('#kategorie').hide();
			$('#kategorie').val(null);
		}
	});
});

function search(){
	
  var land = $('#laender').find(':selected').text();
  var art = $('#art').find(':selected').text();
  var system = $('#system').find(':selected').val();
  var kategorie = $('#kategorie').find(':selected').val();
  var yearBegin = $('#yearBegin').find(':selected').text();
  var yearEnd = $('#yearEnd').find(':selected').text();
  clearOverlays();
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
      if(tab.response[0] == null ){
        var searchContent = document.getElementById("searchContent");
        searchContent.innerHTML = "Keine Daten für diese Parameter.";
        searchContent.style.display = "initial";
        $("#pagination-container").hide();
        $("#searchContent").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
        return;
      }
      $("#Betrag").html("Diese Auswahl umfasst Rüstungsexporte im Wert von " + tab.sum[0].Betrag.toLocaleString() + " Franken.");
      document.getElementById("searchContent").style.display = "none";
        var maxBetrag = 0;
      	for(var i = 0; i < lines.length; i++){
            lines[i].setMap(null);
          }
      	
      	for(var i = 0; i < tab.response.length; i++){
            if (tab.response[i].Betrag > maxBetrag){
            	maxBetrag = tab.response[i].Betrag;
            }
          }
      	
        for(var i = 0; i < tab.response.length; i++){
          var Longitude = staaten[tab.response[i].Code].Longitude;
          var Latitude = staaten[tab.response[i].Code].Latitude;
          var searchPlace = new google.maps.LatLng(Latitude, Longitude);
          var searchTrip = [schweiz, searchPlace];
          var Betrag = tab.response[i].Betrag;
          
          var weight = Betrag / maxBetrag * 12 + 2;
          
          var flightPath=new google.maps.Polyline({
            path:searchTrip,
            strokeColor:"lightgrey",
            strokeOpacity:0.9,
            strokeWeight: weight,
            geodesic:true
            });
          lines.push(flightPath);
          flightPath.setMap(map);
          
          var infowindow = new google.maps.InfoWindow({
        	    content: staaten[tab.response[i].Code].Name + "<br/>" + Betrag.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1\'') + " CHF"
        	  });
          
          infowindows[tab.response[i].Code] = infowindow;
          
          var marker = new google.maps.Marker({
      	    map: map,
      	    position: searchPlace,
      	    title: tab.response[i].Code,
      	    icon: {
      	      path: google.maps.SymbolPath.CIRCLE,
      	      scale: 4,
      	    strokeColor: "lightgrey"
      	    }
      	  });
          
        marker.setMap(map);
        markers.push(marker);
        
        marker.addListener('click', function() {
        	infowindows[this.getTitle()].open(map, this);
          });
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
          searchSkandalsBol = "false";
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
