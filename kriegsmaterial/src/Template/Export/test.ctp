<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		echo $this->Html->charset();
		echo $this->Html->css('test');
		?>
		<title>GSOA</title>
	</head>

	<body>

	<main>
		<h1 id="title">Schweizer Waffenexporte</h1>
		<div id="googleMap"></div>
	</main>
	
	<div id="Selector">
		<p id="Betrag">Dies ergibt Waffen exportiert im Wert von <?php 
			foreach($sumData as $sumData){
				echo $this->Number->format($sumData->Betrag); 
			}
		?> Franken. </p>
		<?php
		echo $this->Form->create($laender, ['action' => 'search',
			'type' => 'get',
			'id' => 'search']);
		
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
			<?php
				echo $this->Form->select('laender', $outLaender, ['empty' => 'Land', 'id' => 'laender']);
				echo $this->Form->select('art', $outArt, ['empty' => 'Art', 'id' => 'art']);
				echo $this->Form->select('system', $outSystem, ['empty' => 'System', 'id' => 'system']);
				echo $this->Form->select('kategorie', $outKategorie, ['empty' => 'Kategorie', 'id' => 'kategorie']);
				echo $this->Form->year('yearBegin', ['maxYear' => 2014,
    				'minYear' => 2006,
    				'empty' => 'Von',
    				'id' => 'yearBegin']);
				echo $this->Form->year('yearEnd', ['minYear' => 2006,
    				'maxYear' => 2014,
    				'empty' => 'Bis',
    				'id' => 'yearEnd']);
				echo $this->Form->button('Suche Exporte', array('id' => 'submitButton', 'type' => 'button', 'onClick' => 'search()'));
    		?>
		</fieldset>
		<?php echo $this->Form->end() ?>

		<?php
		echo $this->Form->create($firmen, ['action' => 'searchskandals',
			'type' => 'get',
			'id' => 'searchSkandals']);
		
		$outFirma = [];
		foreach($firmen as $firma){
			array_push($outFirma, h($firma->Firma));
		}
		array_push($outFirma, "None");
		?>
		<fieldset>
			<?php
				echo $this->Form->select('laenderSkandal', $outLaender, ['empty' => 'Land', 'id' => 'laenderSkandale']);
				echo $this->Form->select('firma', $outFirma, ['empty' => 'Firma', 'id' => 'firma']);
				echo $this->Form->year('yearBeginSkandal', ['maxYear' => 2014,
    				'minYear' => 1939,
    				'empty' => 'Von',
    				'id' => 'yearBeginSkandale']);
				echo $this->Form->year('yearEndSkandal', ['minYear' => 1939,
    				'maxYear' => 2014,
    				'empty' => 'Bis',
    				'id' => 'yearEndSkandale']);
				echo $this->Form->button('Suche Skandale', array('id' => 'submitSkandals', 'type' => 'button', 'onClick' => 'searchSkandals()'));
    		?>
		</fieldset>
		<?php echo $this->Form->end() ?>

	</div>

	<div id="searchContent">

	</div>

	<div class="table">

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
