<?php

session_start();

$user='Admin';
$passwordadmin='12345';

if(isset($_POST['submit'])){
$login = $_POST['login'];
$password = $_POST['password'];

if($login&&$password){
	if($login==$user&&$password==$passwordadmin){
		
		$_SESSION['login']=$login;
		header('location: admin.php');
		
	}else
		{
		echo 'Veuillez verifier vos identifiants';
		}







}else
{
	echo'Veuillez remplir tout les champs';
}
}

?>

<link href="style/style.css" type="text/css" rel="stylesheet"/>
<h1>Connexion</h1>
<form action="" method="POST">
<h3>Login:</h3><input type="text" name="login"/><br><br>
<h3>Mot de passe:</h3><input type="text" name="password"/><br><br>
<input type="submit" name="submit"/><br><br>
</form>

