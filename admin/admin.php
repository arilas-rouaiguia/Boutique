<?php
session_start();

if(isset($_SESSION['login'])){
if(isset($_GET['action'])){	
	if($_GET['action']=='add'){
		
		if(isset($_POST['submit'])){
		
		$titre = $_POST['titre'];
		$description = $_POST['description'];
		$prix = $_POST['prix'];
		
		
		if($titre&&$description&&$prix){
			echo $titre;
			echo $description;
			echo $prix;

			    $pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
				$stmt = $pdo->prepare("INSERT INTO products(titre, description, prix) VALUES ('$titre','$description','$prix')");
				$stmt->execute();
				echo 'test';
				
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
		<h3>Description du Produit :</h3><input type="text" name="description"/>
		<h3>Prix du Produit :</h3><input type="text" name="prix"/><br><br>
		<input type="submit" name="submit">
		</form>
		<?php
	
	}else if ($_GET['action']=='modify'){
		
	}else if($_GET['action']=='delet'){
	
	}else{
		
	Die("une erreur c'est produite.");
	}	
}
}else
	{header('location: .../index.php');
	}
?>

<h1>Bienvenue, <?php echo $_SESSION['login'];?></h1>
<br>
<a href="?action=add">Ajouter un Produit</a><br>
<a href="?action=add">Modifier un Produit</a><br>
<a href="?action=add">Supprimer un Produit</a><br> 
