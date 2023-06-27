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
$query = "SELECT validation_token FROM users WHERE id_user = :getid";
$statement = $bdd->prepare($query);
$statement->bindValue(':getid', $last_id);
$statement->execute();
$token_exist = $statement->fetch();


// $token_exist['token'] = $token_exist->token c un tablo en oriente objet

if($token_exist && $token_exist->validation_token == $token)
{
    echo 'compte validé.';
}
else
{
    echo 'compte non validé.';
}
?>