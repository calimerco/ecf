<?php
// validation du mail envoyer à l'utilisateur

// recuperer le id et le token se trouvant dans l'url
$last_id = $_GET['id'];
$token = $_GET['token'];

// connexion bdd
require 'bdd.php';

// requete preparee
// $req = $bdd->prepare('SELECT validation_token FROM users WHERE id = ?');
// $req->execute(['$last_id']);
// $token_exist = $req->fetch();
$query = "SELECT * FROM users WHERE id_user = :getid";
$statement = $bdd->prepare($query);
$statement->bindValue(':getid', $last_id);
$statement->execute();
$data_user = $statement->fetch();


// $token_exist['token'] = $token_exist->token c un tablo en oriente objet

if($data_user && $data_user->validation_token == $token)
{
    // la validation mail est reussie
    // on crée une $session pour stocker les données user
    session_start();
    $_SESSION ['auth']= $data_user;
    $erreur = 'compte validé.';
    // Se connecter à la base de données afin de supprimer le token (pour empecher d'autres validations de mail si l'utilisateur reclique sur le lien de validatiion dans sa boite mail) et ajouter une date de validation
    $statement = $bdd->prepare("UPDATE users SET validation_token = :nouveauToken, date_valid = now() where id_user = :last_id");

    $statement->execute(
        [
            "nouveauToken" => "null",
            // "noow" => "now()",
            "last_id" => "$last_id",
        ]
        );
    // direger l'utilisateur vers la page mon_compte.php grace au lien accedez à votre espacee membre 
    header('Location: mon_compte.php');

}
else
{
    $erreur = 'compte non validé.';
}
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
       <h2>Inscription</h2>
       <!-- <br/><br/> -->
       
       
       <?php
       if(isset($erreur))
       {
        echo '<font color="red">'.$erreur."</font>";
       }

    //    if(isset($_SESSION ['auth']))
    //    {
    //     echo "<a href="">Accédez à votre espace membre</a>";
    //    }
       ?>
    </div>

</main>
    <?php
    require_once 'footer.php';
    ?>
</html>