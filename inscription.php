<?php
require 'header.php';
require 'functions.php';
require 'bdd.php';
?>
<?php
if(isset($_POST['forminscription']))
{
    if(!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
    {
        echo 'case rempli';
        //  creation des $ securisées   
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $tel = htmlspecialchars($_POST['tel']);
    $date = date('d m Y h:i:s');

    // var_dump($pseudo);
    // var_dump($mail);
    // var_dump($nom);
    // var_dump($prenom);
    // var_dump($adresse);
    // var_dump($tel);
    // var_dump($date);

    // récuperer les 2 mdp 
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];
    // var_dump($mdp);
        
// CONTROLER LES $ RECUES DANS $_POST
        
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255)
        {
            // preg_match: demarre par /^ finit $/ et contient [] [dea-z deA-Z de0-9 et _ ] le tous plusieurs fois (+)
            if(preg_match('/^[a-zA-Z0-9_]$/', $pseudo))
            {
                $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
                $req->bindValue(':pseudo', $pseudo);
                // // execute est 1 tablo qui contient les valeurs des ?
                $rep->execute();
                // // récupérer le 1er enregistrement avec fetch
                $pseudo_exist = $req->fetch();
               
                var_dump($pseudo_exist);
               
                if($pseudo_exist)
                {
                    $erreur = "Ce pseudo existe déja.";
                }

            }
            else
            {
                $erreur = "Vous n'avez pas renseigner de Pseudo valide.";
            }
        }
        else
        {
            $erreur = "votre pseudo ne doit pas depasser 255 carcteres!";
        }
        if($mail == $mail2)
        { 
              if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
              {
                 $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                 $reqmail->execute(array($mail));
                 $mailexist = $reqmail->rowCount();
                 if($mailexist == 0)
                 { 
                     if ($mdp = $mdp2) 
                     {
                        $mdpS = password_hash($mdp, PASSWORD_DEFAULT);
                        // var_dump($mdpS);
                        $role = 2;
                        $isactive = 0;
                        $token = str_random(60);
                        var_dump($token);
                     echo 'tout est bon';
                     //    inserer une ligne membre dans la bdd ($bdd)
                     $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, mdp, date_inscri, nom, prenom, adresse, tel, role, isactive, mdpNs, validation_token) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdpS, $date, $nom, $prenom, $adresse, $tel, $role,$isactive, $mdp, $token));
                     //    message de creation d'espace membre
                     $erreur = "votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</>";

                    //  récupérer le dernier id créé 
                    $last_id = $bdd->lastinsertId();

                    //  envoi de mail de validation de compte
                    // utiliser phpmailer avec composer
                    // mail($mail, 'Confirmation de votre compte', "Afin de valider votre compte veuillez cliquer sur ce lien\n\nhttp://localhost/ECF_graficart/confirmation_compte.php?id=$last_id&token=$token");


                    //  header('location: connexion.php');
                     }
                     else
                     {
                     $erreur = "Vos mots de passe ne correspondent pas!";
                     }
                 }
                 else
                 {
                 $erreur = "Adresse mail déja utilisée!";  
                 }

               }
               else
               {
               $erreur = "Votre adresse mail n'est pas valide!";
               }
         }
         else
         {
         $erreur = "Vos adresses mail ne se correspondent pas.";
         }

    }
    else
    {
        echo 'case vide';
        $erreur = 'Tous les champs doivent étre complétés !';
    }

    
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