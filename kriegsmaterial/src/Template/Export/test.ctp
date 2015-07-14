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
			<select id="jahresdaten">
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
	
		<footer>
			<p></p>
		</footer>

	</body>

	<?php foreach ($export as $export): ?>
       <script type="text/javascript">
       var code = <?php echo h($export->Code); ?>; 
       var art = <?php echo h($export->Art); ?>;		
       var system = <?php echo h($export->System); ?>;
       var kategorie = <?php echo h($export->Kategorie); ?>;
       var betrag = <?php echo $this->Number->format($export->Betrag); ?>;
       </script>
    <?php endforeach; ?>

    <?php
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
	?>

</html>