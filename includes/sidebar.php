<div class=	"sidebar">
<h1>Derniers Articles</h1>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
$select = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,2");
$select->execute();

	while($s=$select->fetch(PDO::FETCH_OBJ)){
		
		$lenght= 15;
		
		$description = $s->description;
		
		$new_description=substr($description,0,$lenght)."...";
		
		$description_finale=wordwrap($new_description,25,'<br><br>', true);
		?>
		<img height="80" width="100" src="admin/imgs/<?php echo $s->titre; ?>.jpg"/>
		<h2><?php echo $s->titre;?></h2>
		<h5><?php echo $description_finale;?></h5>
		<h4><?php echo $s->prix;?> Euros</h4>
		<br>
		
		<?php
	}
	
	
	?>
	</div>