<div class=	"sidebar">
<h1>Derniers Articles</h1>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
$select = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,2");
$select->execute();

	while($s=$select->fetch(PDO::FETCH_OBJ)){
		?>
		
		<h2><?php echo $s->titre;?></h2>
		<h5><?php echo $s->description;?></h5>
		<h4><?php echo $s->prix;?> Euros</h4>
		<br>
		
		<?php
	}
	
	
	?>
	</div>