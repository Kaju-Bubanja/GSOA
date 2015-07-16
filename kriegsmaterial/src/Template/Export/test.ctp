<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		echo $this->Html->charset();
		echo $this->Html->css('test');
		?>
		<title>GSOA</title>
	</head>

<?php echo json_encode($export); ?>;

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

	<script type="text/javascript">
	var data = <?php echo json_encode($export); ?>;
	</script>

	

    <?php
		echo $this->Html->script('http://maps.googleapis.com/maps/api/js');
		echo $this->Html->script('test');
	?>

</html>
