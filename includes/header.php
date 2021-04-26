<!DOCTYPE html>
<html>
<head>
	<link href="style/style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<h1>Site de Commerce</h1>
<header>
	<ul class="menu">
		<li><a href="index.php">Accueil</a></li>
		<li><a href="inscription.php">Inscription</a></li>
		<li><a href="connexion.php">Connexion</a></li>
		<li><a href="boutique.php">Boutique</a></li>
		<?php if(!empty($_SESSION)){ echo ('<li><a class="lien" href="profil.php">Profil</a></li> <li><a class="lien" href="deconnexion.php">Deconnexion</a></li>');} //Uniquement affiché si connecté ?>
</header>
</body>
</html>