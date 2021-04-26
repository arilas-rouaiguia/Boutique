<?php
include("securite.php"); include("utilsateur.php");

if (isset($_POST['inscription'])) { //Lancement de l'inscription
  $login = trim(htmlspecialchars($_POST['login']));
  $pdo = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
  $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = '$login'");
  $stmt->execute();
  $count = $stmt->fetch(PDO::FETCH_ASSOC);
  
  
  if($count == 0){ 
    if (strlen(trim($_POST['login']))) {
      if (strlen($_POST['password'])) {
        if ($_POST['password'] === $_POST['vpassword']) {
          $login = trim(htmlspecialchars($_POST['login']));
          $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
          $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')");
          $stmt->execute();
		  header("location: connexion.php");
        } //Inscription réussite
        else {
          $msg = "Password / Confirm Password Incorrect";
        }
      }
    }
    else {
      $msg = "Login trop court";
    }
  }
  else {
    $msg = "Login déjà existant";
  }
}

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
	<link rel="stylesheet" href="style.css" media="screen" type="text/css"/>
  </head>
  <body>
	<header> <?php include('includes/header.php');?> </header>
	<br><br><br>
    <section>
          <form class="form-signin" action="inscription.php" method="post"style="width: 40%;border-left-width: 0px;margin-left: auto;margin-right: auto;">
		          <h1>Inscription</h1>
            <label for="login">Identifiant:</label><br/>
            <input type="text" name="login"><br/>
            <label for="password">Mot de Passe:</label><br/>
            <input type="password" name="password"><br/>
            <label for="vpassword">Confirmer Mot de Passe:</label><br/>
            <input type="password" name="vpassword"><br/>
            <?php if(isset($msg)){
              echo ($msg);} ?>
            <input type="submit" name="inscription" value="S'inscrire">
          </form>
    </section>
	<footer><?php require_once('includes/footer.php');?> </footer>
  </body>
</html>
