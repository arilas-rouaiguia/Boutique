<?php
session_start();?>

<h1>Bienvenue, <?php echo $_SESSION['login'];?></h1>

<?php

if(isset($_SESSION['login'])){
if(isset($_GET['action'])){	
	if($_GET['action']=='add'){
		
		if(isset($_POST['submit'])){
		
		$titre = $_POST['titre'];
		$description = $_POST['description'];
		$prix = $_POST['prix'];
		
		
		if($titre&&$description&&$prix){

			    $pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
				$stmt = $pdo->prepare("INSERT INTO products(titre, description, prix) VALUES ('$titre','$description','$prix')");
				$stmt->execute();
				
				if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
}
				
		}else{
			echo'Veuillez rentrer tout les champs.';
		}
				
		}
		?>
		<form action="" method="post">
		<h3>Titre du Produit :</h3><input type="text" name="titre"/>
		<h3>Description du Produit :</h3><textarea name="description"></textarea>
		<h3>Prix du Produit :</h3><input type="text" name="prix"/><br><br>
		<input type="submit" name="submit">
		</form>
		<?php
	}else if ($_GET['action']=='modifyanddelet'){
			$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
			$select = $pdo->prepare("SELECT * FROM products");
			$select->execute();
		
		while($s=$select->fetch(PDO::FETCH_OBJ)){
			echo $s->titre;
			?>
			<a href="?action=modify&amp;id=<?php echo $s->id; ?>"> Modifier</a>
			<a href="?action=delet&amp;id=<?php echo $s->id; ?>"> X</a><br><br>
			<?php
		}
	
	}else if ($_GET['action']=='modify'){
				
		$id=$_GET['id'];
		
		$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
		$select = $pdo->prepare("SELECT * FROM products WHERE id=$id");
		$select->execute();
		
		$data = $select->fetch(PDO::FETCH_OBJ);
		
		?>
				<form action="" method="post">
		<h3>Titre du Produit :</h3><input value="<?php echo $data->titre;?>" name="titre"/>
		<h3>Description du Produit :</h3><textarea name="description"><?php echo $data->description; ?></textarea>
		<h3>Prix du Produit :</h3><input value="<?php echo $data->prix;?>" name="prix"/><br><br>
		<input type="submit" name="submit" value="Modifier"/>
		</form>
		
		<?php
		
		if(isset($_POST['submit'])){
			
		$titre = $_POST['titre'];
		$description = $_POST['description'];
		$prix = $_POST['prix'];
		
		$update = $pdo->prepare('UPDATE products SET titre= "$titre" ,description= "$description" ,prix= "$prix" WHERE id="$id"');
		$update->execute();
	
	
	}else if($_GET['action']=='delet'){
		
		$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
		
		$id=$_GET['id'];
		$select = $pdo->prepare("DELETE FROM products WHERE id=$id");
		$select->execute();
	
	}else{
		
	Die("une erreur c'est produite.");
	}	
}
}else
	{header('location: .../index.php');
	}
}
?>

		
<br>
<a href="?action=add">Ajouter un Produit</a><br>
<a href="?action=modifyanddelet">Modifier ou Supprimer un Produit</a><br> 

