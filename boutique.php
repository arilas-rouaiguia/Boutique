<?php

require_once('includes/header.php');

$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
$select = $pdo->prepare("SELECT * FROM products");
$select->execute();

	while($s=$select->fetch(PDO::FETCH_OBJ)){
		?>
		<img src="admin/imgs/<?php echo $s->titre; ?>.jpg"/>
		<h2><?php echo $s->titre;?></h2>
		<h5><?php echo $s->description;?></h5>
		<h4><?php echo $s->prix;?> Euros</h4>
		<br><br>
		
		<?php
	}
	
	require_once('includes/footer.php');
	
	?>