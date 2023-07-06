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
       <h2>Votre compte</h2>
       <!-- <br/><br/> -->
       <?php if(isset($_SESSION['id_user'])) { echo '<a href="valider_listesouhait.php" title="Enregistrer votre liste de souhait en cours">Visualiser ma liste de souhaits en cours de création</a>';} ?>
       <?php if(isset($_SESSION['id_user'])) { echo '<a href="liste_souhait_user.php" title="vos listes de souhait existantes">Visualiser mes listes de souhaits déja crées</a>';} ?>
       <?php if(isset($_SESSION['id_user'])) { echo '<a href="liste_coment_usercom.php" title="vos listes de souhait existantes">Visualiser mes commentaires</a>';} ?>
       <?php if(isset($_SESSION['id_user'])) { echo '<a href="modifier_profil.php">modifier profil</a>';} ?>
       
       
       
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