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
		$img = $_FILES['img']['name'];
		
		$img_tmp = $_FILES['img']['tmp_name'];
		
		if(!empty($img_tmp)){
			$image = explode('.',$img);
			
			$image_ext = end($image);
			
			if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))==false){
				echo'Format Invalide (PNG, JPG ou JPEG)';
			}else{
				$image_size = getimagesize($img_tmp);
				
				if($image_size['mime']=='image/jpeg'){
					
					$image_src = imagecreatefromjpeg($img_tmp);
				}else if($image_size['mime']=='image/png'){
					
					$image_src = imagecreatefrompng($img_tmp);
				}else{
					$image_src = false;
					echo 'Veuillez rentrer une image Valide.';	
				}
				if($image_src!==false){
				 $image_width=200;
				 
				 if($image_size[0]==$image_width){
					 $image_finale = $image_src;
				 }else{
					 $new_width[0]=$image_width;
					 
					 $new_height[1] = 200;
					 
					 $image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);
					 
					 imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);
				 }
				 imagejpeg($image_finale,'imgs/'.$titre.'.jpg');				
				}
		}
		}
		else{
			echo'Veuillez rentrer une image';
		}
		
		
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
		<form action="" method="post" enctype="multipart/form-data">
		<h3>Titre du Produit :</h3><input type="text" name="titre"/>
		<h3>Description du Produit :</h3><textarea name="description"></textarea>
		<h3>Prix du Produit :</h3><input type="number" name="prix"/>Euros<br><br>
		<input type="file" name="img"/><br><br>
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
		$id=$_GET['id'];
		
		$pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
		$update = $pdo->prepare("UPDATE products SET titre= '$titre' ,description= '$description' ,prix= '$prix' WHERE id=$id");
		$update->execute();
		}
	
	
	
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
?>

		
<br>
<a href="?action=add">Ajouter un Produit</a><br>
<a href="?action=modifyanddelet">Modifier ou Supprimer un Produit</a><br> 

