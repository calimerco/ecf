<?php
require 'header.php';
require 'footer.php';
require 'functions.php';
require 'bdd.php';
?>
<?php
// code grafikart
// Vérifier si des données ont été postée
if(!empty($_POST))
{
    // créer une variable tablo vide errors qui se remplira si ya d erreurs
    $errors = array();

    // erreur si $POST vide OU ne convient pas (ne correspond pas a preg_match)
    // preg_match: demarre par /^ finit $/ et contient [] [dea-z deA-Z de0-9 et _ ] le tous plusieurs fois (+)
    if(empty($_POST['pseudo']) AND !preg_match('/^[a-zA-Z0-9_]$/', $_POST['pseudo']))
    {
        // stocker une erreur dans le tablo $errors
        $errors['pseudo'] = "Vous n'avez pas renseigner de Pseudo valide.";
    }
    if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) || $_POST['mail'] != $_POST['mail2']) 
    {
        $errors['mail'] = "Votre mail n'est pas valide.";
    }
    
    if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp2'])
    {
        $errors['mdp'] = "Vous devez rentrer un mot de passe valide.";
    }
    // var_dump($errors);
    // au lieu d'utiliser var_dum(qui n'est pas beau) je crée 1 fct debug pour débuguer les variables
    debug($errors);

    


}
else
{
    echo '$POST vide';
}
// fin code grafic art

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
       
       <form method="post" action="">
          <table>
            <tr>
                <td align="right"><label for="pseudo">Pseudo :</label></td> 
                <td><input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;} ?>" ></td>
            </tr>
            <tr>
                <td align="right"><label for="mail">Mail :</label></td>
                <td><input type="mail" placeholder="votre mail" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail;} ?>" ></td>
            </tr>
            <tr>
                <td align="right"><label for="mail2">Confirmation du mail :</label></td>
                <td><input type="mail" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)){echo $mail2;} ?>" ></td>
            </tr>
            <tr>
                <td align="right"><label for="mdp">Mot de passe :</label></td>
                <td><input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" ></td>
            </tr>
            <tr>
                <td align="right"><label for="mdp2">Confirmez votre mot de passe :</label></td>
                <td><input type="password" placeholder="Votre mot de passe" id="mdp2" name="mdp2" ></td>
            </tr>
            <tr>
                <td></td>
            <tr>
                <td align="right"><label for="nom">Nom :</label></td>
                <td><input type="text" placeholder="Votre nom" id="nom" name="nom" ></td>
            </tr>
            <tr>
                <td align="right"><label for="prenom">Prénom :</label></td>
                <td><input type="text" placeholder="Votre prénom" id="prenom" name="prenom" ></td>
            </tr>
            <tr>
                <td align="right"><label for="adresse">Adresse :</label></td>
                <td><input type="text" placeholder="Votre adresse" id="adresse" name="adresse" ></td>
            </tr>
            <tr>
                <td align="right"><label for="tel">Téléphone :</label></td>
                <td><input type="tel" placeholder="Votre numéro de téléphone" id="tel" name="tel" ></td>
            </tr>
          </table>
          <input type="submit" name="forminscription" value="Je m'inscris">
          <input type="reset" name="effacer" value="Effacer">

         
       </form>
      
    </div>

    </main>
</html>