<?php
// session_start();
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
       <h2>Espace administrateur</h2>
       <br/><br/>
       <a href="liste_users.php">Liste des utilisateurs</a>
       <a href="liste_articles.php">Liste des articles</a>
       <a href="liste_commentaires.php">Liste des commentaires</a>
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