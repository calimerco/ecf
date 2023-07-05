<?php
session_start();
require 'header.php';
require 'functions.php';
require 'bdd.php';
?>
<?php
   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace connexion administrateur</title>
</head>
<main>
   <div align="center" class="column">
       <h2>Ecrire un commentaire</h2>
       <br/><br/>
       <form method="post" action="" class="form_connect">
          <!-- <input type="email" name="mail" placeholder="Mail" autocomplete="off"/> -->
          <input type="text" name="comment" placeholder="Votre commentaire" autocomplete="off" />
          <!-- <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off"/> -->
          <input type="submit" name="envoyer_comment" value="Envoyer" />         
       </form>
       <a href="mdp_oublie.php">mot de passe oublié</a>
       <br/><br/><br/><br/>
       <?php
       if(isset($erreur))
       {
        echo '<font color="red">'.$erreur."</font>";
       }
       ?>

    </div>  
</main>
<?php
    require_once 'footer.php';
?>
</html>