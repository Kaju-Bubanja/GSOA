<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		echo $this->Html->charset();
		echo $this->Html->css('test');
		echo $this->Html->css('/bootstrap/css/bootstrap.min');
		?>
		<link rel='stylesheet' id='font-1-css'  href='http://fonts.googleapis.com/css?family=Roboto%3A500%2C900%2C100%2C300%2C700%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		<link rel='stylesheet' id='font-2-css'  href='http://fonts.googleapis.com/css?family=Roboto+Condensed%3A700%2C300%2C400&#038;ver=4.3.1' type='text/css' media='all' />
		<title>Schweizer Waffenexporte</title>
	</head>

	<body>
		<div id="container" style="height: 100%">
			<div class="row" style='font-family:"Roboto Condensed"; font-size: 52px; font-weight: 700; text-transform: uppercase; padding: 20px; background-color: #fcfcfc'>
				<div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
				    <img alt="" src="http://i0.wp.com/kriegsmaterial.ch.augustus.sui-inter.net/kriegsmaterial/wp-content/uploads/2015/08/icon_1_100_b.png" />
					Schweizer Waffenexporte
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
							array_push($outSystem, h($system->System));
						}
						foreach($kategorie as $kategorie){
							array_push($outKategorie, h($kategorie->Kategorie));
						}
						 ?>
						<fieldset>
							<div class="form-group">
								<select id="pickSearchExport" class="pickSearch form-control">
									<option value="export">Exportzahlen anzeigen</option>
									<option value="skandal">Skandale anzeigen</option>
								</select>
							</div>
							<div class="form-group">
    							<label for="lander">Wohin?</label>
								<?php echo $this->Form->select('laender', $outLaender, ['empty' => 'Alle Staaten', 'label' => 'sfs', 'id' => 'laender', 'class' => 'dropdownExport form-control']); ?>
							</div>
							<div class="form-group">
    							<label for="art">Was?</label>						
								<?php echo $this->Form->select('art', $outArt, ['empty' => 'Alle Arten', 'id' => 'art', 'class' => 'dropdownExport form-control']);
								echo $this->Form->select('system', $outSystem, ['empty' => 'Alle Systeme', 'id' => 'system', 'class' => 'dropdownExport form-control']);
								echo $this->Form->select('kategorie', $outKategorie, ['empty' => 'Alle Kategorien', 'id' => 'kategorie', 'class' => 'dropdownExport form-control']); ?>
							</div>
							<div class="form-group">
    							<label for=yearBegin>Wann?</label><?php  
								echo $this->Form->year('yearBegin', ['maxYear' => 2014,
				    				'minYear' => 2006,
				    				'empty' => 'Von',
				    				'id' => 'yearBegin',
									'class' => 'dropdownExport form-control']);
								echo $this->Form->year('yearEnd', ['minYear' => 2006,
				    				'maxYear' => 2014,
				    				'empty' => 'Bis',
				    				'id' => 'yearEnd',
									'class' => 'dropdownExport form-control']);
				    		?>
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
							<div class="form-group">
								<select id="pickSearchSkandal" class="pickSearch form-control" style="margin-left: 20px;">
									<option value="export">Exportzahlen anzeigen</option>
									<option value="skandal">Skandale anzeigen</option>
								</select>
							</div>
							<div class="form-group">
    							<label for="laenderSkandal">Wohin?</label>
								<?php echo $this->Form->select('laenderSkandal', $outLaender, ['empty' => 'Alle Staaten', 'id' => 'laenderSkandale', 'class' => 'dropdownSkandal form-control']); ?>
							</div>
							<div class="form-group">
    							<label for="firma">Firma</label>
								<?php echo $this->Form->select('firma', $outFirma, ['empty' => 'Firma', 'id' => 'firma', 'class' => 'dropdownSkandal form-control']); ?>
							</div>
							<div class="form-group">
    							<label for="yearBeginSkandal">Wann?</label>
								<?php echo $this->Form->year('yearBeginSkandal', ['maxYear' => 2014,
				    				'minYear' => 1939,
				    				'empty' => 'Von',
				    				'id' => 'yearBeginSkandale', 
									'class' => 'dropdownSkandal form-control']);
								echo $this->Form->year('yearEndSkandal', ['minYear' => 1939,
				    				'maxYear' => 2014,
				    				'empty' => 'Bis',
				    				'id' => 'yearEndSkandale', 'class' => 'dropdownSkandal form-control']);
				    		?>
				    		</div>
						</fieldset>
						<?php echo $this->Form->end() ?>
						<p id="Betrag" style="margin-top: 20px">Diese Auswahl umfasst Rüstungsexporte im Wert von <?php 
							foreach($sumData as $sumData){
								echo $this->Number->format($sumData->Betrag); 
							}
						?> Franken. </p>
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
	var allData = <?php echo json_encode($allData); ?>;
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
	</script>

 <?php
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
		echo $this->Html->script('pulse');
	?>
	
</html>
