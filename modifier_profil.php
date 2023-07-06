<?php
session_start();
require 'functions.php';
require 'bdd.php';
var_dump($_SESSION);

?>
              
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>modifier mon proofil</title>
    
</head>
<body>
<?php require 'header.php';?>
<main>
   <div class="container column grey" align="center">
       <h2>Modifier mon proofil</h2>
       <!-- <br/><br/> -->
       
       
       
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