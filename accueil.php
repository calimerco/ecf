<?php
require 'functions.php';
require 'bdd.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil du site</title>
</head>
<body>
<?php require 'header.php';?>
<main>
   <div align="center" class="column">
       <h2>Page d'accueil du site</h2>
       <br/><br/>
      
       <br/><br/><br/><br/>
       <?php
       if(isset($erreur))
       {
        echo '<font color="red">'.$erreur."</font>";
       }
       ?>

    </div>  
</main>
<script src="app.js"></script>
</body>
<?php
    require_once 'footer.php';
?>
</html>