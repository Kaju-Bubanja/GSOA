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
		<aside>
			<?php
			echo $this->Html->image('background.png', ['alt' => 'background']);
			?>
			<select id="skandale">
				<option value="Skandal1">
					Skandal1
				</option>
				<option value="Skandal2">
					Skandal2
				</option>
				<option value="Skandal3">
					Skandal3
				</option>
			</select>
			
		</aside>
	
		<main>
			<h1>Schweizer Waffenexporte</h1>
			<div id="googleMap"></div>
		</main>
	
	<div id="Selector">
		<?php
		echo $this->Form->create($laender, ['action' => 'search',
			'type' => 'get']);
		
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
		} ?>
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
				echo $this->Form->button('search', array('id' => 'submitButton', 'type' => 'button', 'onClick' => 'search()'));
    		?>
		</fieldset>
		<?php $this->Form->end() ?>
	</div>

	<div id="searchContent">

	</div>

	<div class="table">

	<div id="pagination-container">
	<?php 
	echo $this->element('../Export/ajax_table_part');
	
	?>
	</div>

	</div>

	</body>

	<script type="text/javascript">
	var data = <?php echo json_encode($export); ?>;
	var allData = <?php echo json_encode($allData); ?>;
	var schweizKordinaten = <?php echo json_encode($schweizKordinaten); ?>;
	var targetUrl = <?php echo json_encode($this->Url->build([
		'action' => 'search',
		'_ext' => 'json'])); ?>;
	var searchUrl = <?php echo json_encode($this->Url->build([
		'action' => 'search',
		'_ext' => 'html'])); ?>;
	</script>

 <?php
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
		echo $this->Html->script('pulse');
	?>
	
</html>
