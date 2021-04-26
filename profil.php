<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>

<body>
<header> <?php include('includes/header.php');?> </header>

        <?php
        $bdd = mysqli_connect('localhost', 'root', '', 'boutique');  // je me connecte a ma bdd a voir si c"est utile -> mettre un require(config.php)
                                                            // ou y'a la connection au server
		$login = $_SESSION['login'];												
        if (isset($_POST['register'])){ 
			
            $n_identifiant = $_POST['identifiant'];
            $n_identifiant = mysqli_real_escape_string($bdd, htmlspecialchars(trim($n_identifiant)));
            $n_password = $_POST['password'];
            $n_password = mysqli_real_escape_string($bdd, htmlspecialchars(trim($n_password)));
            $confirmpassword = $_POST['confirmpassword'];
            $confirmpassword = mysqli_real_escape_string($bdd, htmlspecialchars(trim($confirmpassword)));
            $cryptedpass = password_hash($n_password, PASSWORD_BCRYPT); // valeur utilisé dans les requetes

            $utilisateur = $_SESSION['login'];

            $sql_select = "SELECT id FROM utilisateurs WHERE login = '$utilisateur'"; // on prend la clé du compte

            $query = mysqli_query($bdd, $sql_select);// $query prend le résultat de la requete id
            $all_result = mysqli_fetch_row($query); // on stock le résultat dans un tableau
            $compteur = count($all_result); //on compte le nbr de valeur 
            

            $verification = mysqli_query($bdd, "SELECT login FROM utilisateurs WHERE login = '$n_identifiant'"); // on recherche si l'identifiant existe déjà 

            if ($compteur == 1 && $confirmpassword == $n_password && !mysqli_num_rows($verification)) { // normalement y'a que id car on SELECT id dans la requete 
                $id = $all_result[0]; // id = la case 0 du tableau fetch 
                $sql_update = "UPDATE utilisateurs SET login='$n_identifiant',password='$cryptedpass' WHERE id=$id";
                // voir si ça update meme si on écrit rien

                $query = mysqli_query($bdd, $sql_update);
                echo 'Changement accepté, veuillez vous reconnecter';
                $_SESSION['login'] = $n_identifiant;
                
            }
            else{
                echo '<p style="text-align:center">confirmation du mot de passe incorrect ou identifiant déjà utilisé</p>';
            }
        }
      

?>
        </ul>
    <main>
        <section class="section_profil">
        <div id="container">
            <form method="post" action="" class="container">
					        <H1>Modifie tes identifiants</H1><br> 
							<p>Identifiant actuel:<?php echo (' '.$login); ?></p>
                    <label for="login">Nouvel identifiant :</label>
                    <input type="text" id="identifiant" name="identifiant" placeholder="Login" required>
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" name="password" placeholder="*******" required>
                    <label for="password_confirm">Confirmation du nouveau mot de passe : </label>
                    <input type="password" name="confirmpassword" placeholder="*******" required>
                <input type="submit" name="register">
            </form>
        </section>
		</div>
		  <footer><?php require_once('includes/footer.php');?> </footer>
</body>

</html>