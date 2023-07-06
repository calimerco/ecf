<?php
session_start();
require 'functions.php';
require 'bdd.php';
?>
<?php
if(!empty($_POST))
{
    var_dump($_POST);
    var_dump($_GET);
    // créer les variables post
    $id_usercom = $_GET['id_usercom'];
    $id_souhait = $_GET['id_souhait'];
    var_dump($id_usercom);
    var_dump($id_souhait);
    $contenu_com = htmlspecialchars ($_POST['contenu_coment']);
    var_dump($contenu_com);
    $is_active = 0;
    // inserer les var dans tablo commentaires
    $sql = "INSERT INTO commentaires (id_usercom, id_souhait, contenu_com, is_active) VALUES (:id_usercom, :id_souhait, :contenu_com, :is_active) ";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_usercom', $id_usercom);
    $stmt->bindParam(':id_souhait', $id_souhait);
    $stmt->bindParam(':contenu_com', $contenu_com);
    $stmt->bindParam(':is_active', $is_active);
    $stmt->execute();


    $erreur = 'Commentaire inséré dans la Bdd';


}
   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecrire un commentaire</title>
</head>
<body>
<?php require 'header.php';?>
<main>
   <div align="center" class="column">
       <h2>Ecrire un commentaire</h2>
       <br/><br/>
       <?php
        if(!isset($contenu_com))
        {echo
        '<form method="post" action="" class="flex">
            <textarea placeholder="Votre commentaire" autocomplete="off" name="contenu_coment"></textarea>
            <input type="submit" name="envoyer_comment" value="Envoyer" />         
        </form>
        <a href="mdp_oublie.php">mot de passe oublié</a>';
        }
       ?>

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