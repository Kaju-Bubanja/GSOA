<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		echo $this->Html->charset();
		echo $this->Html->css('test');
		echo $this->Html->css('/bootstrap/css/bootstrap.min');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
		echo $this->Html->script('/bootstrap/js/bootstrap.js');
		?>
		<link rel='stylesheet' id='font-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A500%2C900%2C100%2C300%2C700%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		<link rel='stylesheet' id='font-2-css'  href='https://fonts.googleapis.com/css?family=Roboto+Condensed%3A700%2C300%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		
		<!-- for Google -->
		<meta name="description" content="Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta name="keywords" content="Schweiz Waffenexport Rüstungsexport Kriegsmaterialexport Kriegsmaterial" />
		
		<meta name="author" content="Gruppe für eine Schweiz ohne Armee (GSoA)" />
		<meta name="copyright" content="" />
		<meta name="application-name" content="" />
		
		<!-- for Facebook -->          
		<meta property="og:title" content="Wer schiesst mit unseren Waffen?" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="https://www.kriegsmaterial.ch/map/img/small.png" />
		<meta property="og:image:width" content="200" />
		<meta property="og:image:height" content="200" />
		<meta property="og:description" content="Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta property="og:url" content="https://kriegsmaterial.ch/map/" />
		<meta property="fb:app_id" content="1698504157063558"/>
		
		<!-- for Twitter -->          
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="Schweizer Waffenexporte" />
		<meta name="twitter:description" content="Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta name="twitter:image" content="https://www.kriegsmaterial.ch/map/img/preview.png" />
		
		<title>Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien</title>
	</head>

	<body>
		<div id="container" style="height: 100%">
			<div class="row" style='font-family:"Roboto Condensed"; font-size: 52px; font-weight: 700; text-transform: uppercase; padding: 20px; background-color: #fcfcfc'>
				<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
				    <img alt="" src="https://kriegsmaterial.ch/wp-content/uploads/2015/08/icon_1_100_b.png" />
					Schweizer Waffenexporte
					<span class="pull-right"><a href="https://www.gsoa.ch"><img alt="" src="https://www.kriegsmaterial.ch/map/img/GSoA-Logo.png" /></a><a href="https://www.kriegsmaterial.ch"><img alt="" src="https://www.kriegsmaterial.ch/map/img/LOGO_ausgeschossen_de.png" /></a></span>
				</div>
			</div>

			<div class="row" style="background-color: #cecece;">
        		<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
        		
        			<div id="Selector" style="margin-top: 20px">
						<?php
						echo $this->Form->create($laender, ['action' => 'search',
							'type' => 'get',
							'id' => 'search',
							'class' => 'form-inline']);
						
						$outLaender = [];
						$outArt = [];
						$outSystem = [];
						$outKategorie = [];
						foreach($laender as $land){
							array_push($outLaender, h($land->Land));
						}
						foreach($art as $art){
							array_push($outArt, h($art->Art));
						}
						foreach($system as $system){
							$outSystem[h($system->System)] = __($system->System);
						}
						foreach($kategorie as $kategorie){
							$outKategorie[h($kategorie->Kategorie)] = __($kategorie->Kategorie);
						}
						 ?>
						<fieldset>
							<div class="row" style="background-color: #cecece;">
							<div class="col-xs-12 col-md-6 col-lg-2">
								<strong>Modus?</strong><br/>
								<select id="pickSearchExport" class="pickSearch form-control">
									<option value="export">Exportzahlen anzeigen</option>
									<option value="skandal">Skandale anzeigen</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-6 col-lg-2">
    							<strong>Wohin?</strong><br/>
								<?php echo $this->Form->select('laender', $outLaender, ['empty' => 'Alle Staaten', 'label' => 'sfs', 'id' => 'laender', 'class' => 'dropdownExport form-control']); ?>
							</div>
							<div class="col-xs-12 col-md-6 col-lg-2">
    							<strong>Wann?</strong><br/><?php  
								echo $this->Form->year('yearBegin', ['maxYear' => 2015,
				    				'minYear' => 2006,
				    				'empty' => 'Von',
				    				'id' => 'yearBegin',
									'class' => 'dropdownExport form-control']);
								echo $this->Form->year('yearEnd', ['minYear' => 2006,
				    				'maxYear' => 2015,
				    				'empty' => 'Bis',
				    				'id' => 'yearEnd',
									'class' => 'dropdownExport form-control']);
				    		?>
				    		</div>
							<div class="col-xs-12 col-md-6 col-lg-4">
    							<strong>Was?</strong><br/>						
								<?php echo $this->Form->select('art', $outArt, ['empty' => 'Alle Arten', 'id' => 'art', 'class' => 'dropdownExport form-control']);
								echo $this->Form->select('system', $outSystem, ['empty' => 'Alle Systeme', 'id' => 'system', 'width' => '200px', 'class' => 'dropdownExport form-control']);
								echo $this->Form->select('kategorie', $outKategorie, ['empty' => 'Alle Kategorien', 'id' => 'kategorie', 'class' => 'dropdownExport form-control']); ?>
							</div>
				    		</div>
						</fieldset>
						<?php echo $this->Form->end() ?>
				
						<?php
						echo $this->Form->create($firmen, ['action' => 'searchskandals',
							'type' => 'get',
							'id' => 'searchSkandals',
							'class' => 'form-inline']);
						
						$outFirma = [];
						foreach($firmen as $firma){
							array_push($outFirma, h($firma->Firma));
						}
						array_push($outFirma, "None");
						?>
						<fieldset>
							<div class="row" style="background-color: #cecece;">
							<div class="col-xs-12 col-md-6 col-lg-2">
								<strong>Modus?</strong><br/>
								<select id="pickSearchSkandal" class="pickSearch form-control">
									<option value="export">Exportzahlen anzeigen</option>
									<option value="skandal">Skandale anzeigen</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-6 col-lg-2">
								<strong>Wohin?</strong><br/>
								<?php echo $this->Form->select('laenderSkandal', $outLaender, ['empty' => 'Alle Staaten', 'id' => 'laenderSkandale', 'class' => 'dropdownSkandal form-control']); ?>
							</div>
							<div class="col-xs-12 col-md-6 col-lg-2">
								<strong>Firma?</strong><br/>
								<?php echo $this->Form->select('firma', $outFirma, ['empty' => 'Firma', 'id' => 'firma', 'class' => 'dropdownSkandal form-control']); ?>
							</div>
							<div class="col-xs-12 col-md-6 col-lg-2">
								<strong>Wann?</strong><br/>
								<?php echo $this->Form->year('yearBeginSkandal', ['maxYear' => 2015,
				    				'minYear' => 1939,
				    				'empty' => 'Von',
				    				'id' => 'yearBeginSkandale', 
									'class' => 'dropdownSkandal form-control']);
								echo $this->Form->year('yearEndSkandal', ['minYear' => 1939,
				    				'maxYear' => 2015,
				    				'empty' => 'Bis',
				    				'id' => 'yearEndSkandale', 'class' => 'dropdownSkandal form-control']);
				    		?>
				    		</div>
				    		</div>
						</fieldset>
						</div>
						<?php echo $this->Form->end() ?>
						<p id="Betrag" style="margin-top: 20px"></p>
					</div>
			</div>
			<div class="row" style="background-color: #cecece;">
        		<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="padding-bottom: 20px;">
					<div id="facebook">
						<script src="https://connect.facebook.net/de_DE/all.js#xfbml=1"></script><fb:like href="http://kriegsmaterial.ch/map" layout="button_count" show_faces="false" width="160" action="recommend" font="arial" colorscheme="dark"></fb:like>
					</div>
        		</div>
			</div>

			<div class="row" style="height: 60%; background-color: #336666;">
        		<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="height: 100%;">
        			<div id="googleMap" style="height: 100%;"></div>
        		</div>
			</div>
			<div class="row" style="background-color: #cecece;">
        		<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="padding-top: 20px;">
        			<p style="font-size: 24px; color: white; font-weight: 700; font-family: 'Roboto Condensed', sans-serif">Die ausgewählten Exporte im Detail</p>
        		</div>
			</div>
			<div class="row" style="background-color: #cecece;">
        		<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="height: 100%;">		
					<div id="searchContent">
				
					</div>
				
					<div class="table table-striped">
				
					<div id="pagination-container">
					<?php 
					echo $this->element('../Export/ajax_table_part');
					
					?>
					</div>
					
					<div id="legende">
					<?php 
					echo $this->element('../Export/legende');
					?>
					</div>
					
					</div>
				</div>
			</div>
		</div>

	</body>

	<script type="text/javascript">
	function initMap(){
		initialize();
	}
	
	var map;
	var lines = [];
	var searchData = "false";
	var searchSkandalsBol = "false";
	var infowindows = {};
	var markers = [];
	var staaten = [];

	var schweizKordinaten = <?php echo json_encode($schweizKordinaten); ?>;
	var targetUrl = <?php echo json_encode($this->Url->build([
		'action' => 'search',
		'_ext' => 'json'])); ?>;
	var searchUrl = <?php echo json_encode($this->Url->build([
		'action' => 'search',
		'_ext' => 'html'])); ?>;
	var searchSkandalsUrl = <?php echo json_encode($this->Url->build([
		'action' => 'searchskandals',
		'_ext' => 'json'])); ?>;
	var searchSkandalsHtml = <?php echo json_encode($this->Url->build([
		'action' => 'searchskandals',
		'_ext' => 'html'])); ?>;

	function initialize()
	{



		<?php 
			foreach($laender as $land){
				echo "staaten['" . h($land->Code) . "'] = {};\n";
				echo "staaten['" . h($land->Code) . "'].Name = '" . h($land->Land) . "';\n";
				echo "staaten['" . h($land->Code) . "'].Longitude = '" . h($land->Longitude) . "';\n";
				echo "staaten['" . h($land->Code) . "'].Latitude = '" . h($land->Latitude) . "';\n";
				echo "staaten['" . h($land->Code) . "'].Skandale = [];\n";
			}
			
			foreach($skandale as $skandal){
				echo "staaten['" . h($skandal->Code) . "'].Skandale.push('" . $skandal->Link . "');\n";
			}
			?>
			
	  var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
	  var mapProp = {
	    center:new google.maps.LatLng(20, 10),
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
		      $('#pagination-container').load(thisHref.replace("search", "search.html"), {search: searchData,
		        land: land,
		        art: art,
		        system: system,
		        kategorie: kategorie,
		        search: "true",
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
		  
			$('#container').on('click', '.skandalLink', function(){
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
		  
		  if(window.location.href.indexOf("skandal") > -1 || window.location.href.indexOf("scandal") > -1 ){
			  $("#search").toggle();
			  $("#searchSkandals").toggle();
			  $("#pickSearchSkandal").val("skandal");
			  searchSkandals();
		  } else {
			  search(true);
		  }
		});
	}

	//google.maps.event.addDomListener(window, 'load', initialize);

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
	          
	          var txt = "<div class='km-marker'><strong>" + staaten[tab.response[i].Code].Name + "</strong><br>";
	          for(var k = 0; k < staaten[tab.response[i].Code].Skandale.length; k++){
	        	  txt = txt + "<a class='skandalLink' href='http://kriegsmaterial.ch/kriegsmaterialwiki/index.php/" + staaten[tab.response[i].Code].Skandale[k].replace(" ", "_") + "'>" + staaten[tab.response[i].Code].Skandale[k] + "</a><br/>";
	            }
	          txt = txt + "</div>";
	          
	          var infowindow = new google.maps.InfoWindow({
	      	    content: txt
	      	  });
	        
	        infowindows[tab.response[i].Code] = infowindow;
	        
	        var marker = new google.maps.Marker({
	    	    map: map,
	    	    position: searchPlace,
	    	    title: tab.response[i].Code,
	    	    zIndex: 999,
	    	    icon: {
	    	      path: google.maps.SymbolPath.CIRCLE,
	    	      scale: 4,
	    	    strokeColor: "black"
	    	    }
	    	  });
	      
		      marker.setMap(map);
		      markers.push(marker);
		      
		      marker.addListener('click', function() {
		        	for (var key in infowindows) {
		        		infowindows[key].close();
		        	}
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
	      alert('error hier');
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
				$('#system').hide();
				$('#system').val(null);
				$('#kategorie').hide();
				$('#kategorie').val(null);
				search();
			} else if ($(this).val() == 1){
				$('#kategorie').hide();
				$('#kategorie').val(null);
				$('#system').show();
				search();
			} else if ($(this).val() == 2){
				$('#kategorie').show();
				$('#system').hide();
				$('#system').val(null);
				search();
			} else {
				$('#system').hide();
				$('#system').val(null);
				$('#kategorie').hide();
				$('#kategorie').val(null);
				search();
			}
		});
	});

	function search(isInit){
		
	  var land = $('#laender').find(':selected').text();
	  var art = $('#art').find(':selected').text();
	  var system = $('#system').find(':selected').val();
	  var kategorie = $('#kategorie').find(':selected').val();
	  var yearBegin = $('#yearBegin').find(':selected').text();
	  var yearEnd = $('#yearEnd').find(':selected').text();
	  var targetUrl = <?php echo json_encode($this->Url->build([
			'action' => 'search',
			'_ext' => 'json'])); ?>;
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
	      searchSkandalsBol = "false";
	      var schweiz=new google.maps.LatLng(schweizKordinaten[0].Latitude, schweizKordinaten[0].Longitude);
	      console.log(tab);
	      if(tab.response[0] == null ){
	        var searchContent = document.getElementById("searchContent");
	        searchContent.innerHTML = "Keine Daten für diese Parameter.";
	        searchContent.style.display = "initial";
	        $("#pagination-container").hide();
	        $("#searchContent").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
	        $("#Betrag").html("Keine Daten für diese Parameter.");
	        $("#Betrag").pulse({opacity: 0.4}, {duration: 1000, pulses: 1});
	        return;
	      }
	      $("#Betrag").html("Diese Auswahl umfasst Exporte im Wert von " + tab.sum[0].Betrag.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1\'') + " Franken.");
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
	        	for (var key in infowindows) {
	        		infowindows[key].close();
	        	}
	        	infowindows[this.getTitle()].open(map, this);
	          });
	        }
	        $('#pagination-container').load(searchUrl, {search: searchData,
		        land: land,
		        art: art,
		        system: system,
		        kategorie: kategorie,
		        yearBegin: yearBegin,
		        search: "true",
		        yearEnd: yearEnd}, function() {
		        $(this).fadeTo(200, 1);
		      });
	    },
	    error: function (tab) {
	        console.log(tab);
	        alert('error hier2');
	    }
	  });
	}

	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJyuUcP2N1JAWJWUq5jtDwd-vE07zupjQ&callback=initMap"
  type="text/javascript"></script>
 <?php  
		//echo $this->Html->script('test');
		echo $this->Html->script('pulse');
	?>
	
</html>
