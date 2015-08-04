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
	
	<?php
	echo $this->Form->create($laender, ['action' => 'search']);
	$outLaender = [];
	foreach($laender as $land){
		array_push($outLaender, h($land->Land));
	}
	echo $this->Form->select('laender', $outLaender, ['multiple' => true,
		'empty' => true,]);
	?>

	<div id="Selector">
		<select id="laender">
			<?php foreach ($laender as $land): ?>
    	   		<option>
    	   			<?= h($land->Land) ?>
    	   		</option>
			<?php endforeach; ?>
		</select>
	
		<select id="art">
			<?php foreach ($art as $art): ?>
    	   		<option>
    	   			<?= h($art->Art) ?>
    	   		</option>
			<?php endforeach; ?>
		</select>
	
		<select id="system">
			<?php foreach ($system as $system): ?>
    	   		<option>
    	   			<?= h($system->System) ?>
    	   		</option>
			<?php endforeach; ?>
		</select>
	
		<select id="kategorie">
			<?php foreach ($kategorie as $kategorie): ?>
    	   		<option>
    	   			<?= h($kategorie->Kategorie) ?>
    	   		</option>
			<?php endforeach; ?>
		</select>
	
		<select id="years">
				<option>
    	   			2006
    	   		</option>
    	   		<option>
    	   			2007
    	   		</option>
    	   		<option>
    	   			2008
    	   		</option>
    	   		<option>
    	   			2009
    	   		</option>
    	   		<option>
    	   			2010
    	   		</option>
    	   		<option>
    	   			2011
    	   		</option>
    	   		<option>
    	   			2012
    	   		</option>
    	   		<option>
    	   			2013
    	   		</option>
    	   		<option>
    	   			2014
    	   		</option>
		</select>

	</div>

	<div class="table">
		<table>
    	<thead>
        	<tr>
          		<th><?= $this->Paginator->sort('Code') ?></th>
           		<th><?= $this->Paginator->sort('Art') ?></th>
        	    <th><?= $this->Paginator->sort('System') ?></th>
            	<th><?= $this->Paginator->sort('Kategorie') ?></th>
            	<th><?= $this->Paginator->sort('Betrag') ?></th>
        	</tr>
    	</thead>
    <tbody>
   <?php foreach ($export as $export): ?>
        <tr>
            <td><?= h($export->Code) ?></td>
            <td><?= h($export->Art) ?></td>
            <td><?= h($export->System) ?></td>
            <td><?= h($export->Kategorie) ?></td>
            <td><?= $this->Number->format($export->Betrag) ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

    </div>
	</body>

	<script type="text/javascript">
	var data = <?php echo json_encode($export); ?>;
	var allData = <?php echo json_encode($allData); ?>;
	var schweizKordinaten = <?php echo json_encode($schweizKordinaten); ?>;
	</script>

    <?php
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
	?>
</html>
