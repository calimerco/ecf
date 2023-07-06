<?php
session_start();
require 'functions.php';
require 'bdd.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>Votre compte</title>
</head>
<body>
<?php require 'header.php';?>
<main>
   <div class="container column grey" align="center">
       <h2>MOTEUR DE RECHERCHE </h2>
       <!-- <br/><br/> -->
       <?php $erreur = "LE MOTEUR DE RECHERCHE EST EN COURS DE CONCEPTION." ?>
       
       
       
       
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