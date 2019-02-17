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
		<link rel='stylesheet' id='font-1-css'  href='http://fonts.googleapis.com/css?family=Roboto%3A500%2C900%2C100%2C300%2C700%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		<link rel='stylesheet' id='font-2-css'  href='http://fonts.googleapis.com/css?family=Roboto+Condensed%3A700%2C300%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		
		<!-- for Google -->
		<meta name="description" content="Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta name="keywords" content="Schweiz Waffenexport Rüstungsexport Kriegsmaterialexport Kriegsmaterial" />
		
		<meta name="author" content="Gruppe für eine Schweiz ohne Armee (GSoA)" />
		<meta name="copyright" content="" />
		<meta name="application-name" content="" />
		
		<!-- for Facebook -->          
		<meta property="og:title" content="Wer schiesst mit unseren Waffen?" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="http://www.kriegsmaterial.ch/map/img/small.png" />
		<meta property="og:image:width" content="200" />
		<meta property="og:image:height" content="200" />
		<meta property="og:description" content="Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta property="og:url" content="http://kriegsmaterial.ch/map/" />
		<meta property="fb:app_id" content="1698504157063558"/>
		
		<!-- for Twitter -->          
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="Schweizer Waffenexporte" />
		<meta name="twitter:description" content="Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien" />
		<meta name="twitter:image" content="http://www.kriegsmaterial.ch/map/img/preview.png" />
		
		<title>Schweizer Waffenexporte: Die Kriegsmaterial-Statistik. Platz 1: Saudi-Arabien</title>
	</head>

	<body>
		<div id="container" style="height: 100%">
			<div class="row" style='font-family:"Roboto Condensed"; font-size: 52px; font-weight: 700; text-transform: uppercase; padding: 20px; background-color: #fcfcfc'>
				<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
				    <img alt="" src="http://i0.wp.com/kriegsmaterial.ch.augustus.sui-inter.net/kriegsmaterial/wp-content/uploads/2015/08/icon_1_100_b.png" />
					Schweizer Waffenexporte
					<span class="pull-right"><a href="http://www.gsoa.ch"><img alt="" src="http://www.kriegsmaterial.ch/map/img/GSoA-Logo.png" /></a><a href="http://www.kriegsmaterial.ch"><img alt="" src="http://www.kriegsmaterial.ch/map/img/LOGO_ausgeschossen_de.png" /></a></span>
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
						<script src="http://connect.facebook.net/de_DE/all.js#xfbml=1"></script><fb:like href="http://kriegsmaterial.ch/map" layout="button_count" show_faces="false" width="160" action="recommend" font="arial" colorscheme="dark"></fb:like>
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

	var staaten = [];
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
	</script>

 <?php
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
		echo $this->Html->script('pulse');
	?>
	
</html>
