<?php

require_once('includes/header.php');
require_once('includes/sidebar.php');

if(isset($_GET['show'])){
$products = $_GET['show'];

$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
$select = $pdo->prepare("SELECT * FROM products WHERE titre='$products'");
$select->execute();

$s = $select->fetch(PDO::FETCH_OBJ);

$description = $s->description;

$description_finale = wordwrap($description,25,'<br><br>', true);
	
	
	?><br>
	<div style="text-align: center;">
	<img src="admin/imgs/<?php echo $s->titre; ?>.jpg"/>
	<h1><?php echo $s->titre;?></h1>
	<h5><?php echo $description_finale;?></h5>
	<h4><?php echo $s->prix;?> Euros</h4>
<a href="">Ajouter au Panier</a>
<br><br><br><br><br><br><br><br><br><br><br><br>
</div><br>

<?php
}else{
	

if(isset($_GET['categorie'])){
	
	$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
$categorie = $_GET['categorie'];
$select = $pdo->prepare("SELECT * FROM products WHERE categorie='$categorie'");
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){
		
		$lenght = 70;
		
		$description = $s->description;
		
		$new_description=substr($description,0,$lenght)."...";
		
		$description_finale=wordwrap($new_description,25,'<br><br>', true);
		
		?>
		<br><br><br>
		<a href="?show=<?php echo $s->titre; ?>"><img src="admin/imgs/<?php echo $s->titre; ?>.jpg"/></a>
		<a href="?show=<?php echo $s->titre; ?>"><h2><?php echo $s->titre;?></h2></a>
		<h5><?php echo $description_finale;?></h5>
		<h4><?php echo $s->prix;?> Euros</h4>
		<a href="">Ajouter au Panier</a><br>
		<br><br><br>
		
		<?php
	}
}else{

	

	$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
	$cat = $pdo->query('SELECT * FROM categorie');	

while ($c= $cat->fetch(PDO::FETCH_OBJ)){

?>
<br><br><br>
<a href="?categorie=<?php echo $c->nom;?>"> <h3><?php echo $c->nom ?></h3> </a> <br>

<br><br><br><br><br><br><br><br><br>
<?php
}
require_once('includes/footer.php');
}
}
?>
<br><br><br><br>
<footer>
<?php
require_once('includes/footer.php');
?>
</footer>