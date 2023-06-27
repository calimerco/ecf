<?php
require 'header.php';
require 'functions.php';
require 'bdd.php';
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
       <h2>Connexion</h2>
       <br/><br/>
       <form method="post" action="" class="form_connect">
          <input type="text" name="pseudo" placeholder="Pseudo" autocomplete="off" />
          <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off"/>
          <input type="submit" name="valider" value="Se connecter" />
         
       </form>
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