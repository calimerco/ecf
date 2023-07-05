<?php
session_start();

require 'header.php';
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
    <title>TUTO PHP</title>
</head>
<main>
   <div class="container column grey" align="center">
       <h2>Votre compte</h2>
       <!-- <br/><br/> -->
       
       
       
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