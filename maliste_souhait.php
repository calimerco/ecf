<?php
session_start();
require 'header.php';
require 'functions.php';
require 'bdd.php';
var_dump($_SESSION);
$liste = $_SESSION['liste'];
$id_user = $_SESSION['id_user'];
var_dump($id_user);
?>
<?php
$id_user = $_SESSION['id_user'];
// recupere les souhaits corresppondants à variablesession [id_user] 
$q = $bdd->prepare("SELECT * FROM souhaits WHERE id_user = :id_user");
$q->bindvalue('id_user', $id_user);
$q->execute();
$souhait = $q->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>Ma listes de souhaits</title>
</head>
<main>
   <div class="container column grey" align="center">
       <h2>Voici votre liste de souhaits</h2>
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