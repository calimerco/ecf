<?php
session_start();
require 'functions.php';
require 'bdd.php';
?>
<?php
   
   if(isset($_POST['connexion']))
   {
       if(!empty($_POST['mail']) AND !empty($_POST['mdp']))
       {
           $mail_par_defaut = "admin@admin.fr";
           $mdp_par_defaut = "admin1234";
   
           $mail_saisi = htmlspecialchars($_POST['mail']);
           $mdp_saisi = htmlspecialchars($_POST['mdp']);
   
           if($mail_saisi == $mail_par_defaut AND $mdp_saisi == $mdp_par_defaut)
          
           {
               // récuper données user du tablo users et le stocker dans la  $_SESSION['']
               $recupUser = $bdd->prepare('SELECT * FROM users WHERE mail = :mail AND mdp = :mdp');
               $recupUser->bindValue('mail', $mail_saisi);
               $recupUser->bindValue('mdp', $mdp_saisi);
               $recupUser->execute();
               $adminfo = $recupUser->fetch();

               var_dump($adminfo);

               // creer la varSESSION  pour retser connecté sur les autres pages

               $_SESSION['pseudo'] = $adminfo->pseudo;
               $_SESSION['mdp'] = $mdp_saisi;
               $_SESSION['id_user'] = $adminfo->id_user;
               echo 'voici la SESSION';
               var_dump($_SESSION);
               // rediriger l'utilisateur vers l'espace administration
               header('Location: administration.php');
           }
           else
           {
            if(isset($_POST['connexion']))
            {
                $mailconnect = htmlspecialchars($_POST['mail']);
                $mdpconnect = htmlspecialchars($_POST['mdp']);
                if(!empty($mailconnect) AND !empty($mdpconnect))
                {
                    $requser = $bdd->prepare("SELECT * FROM users WHERE mail = :mail ");
                    $requser->bindValue('mail', $mailconnect);
                    // $requser->bindValue('mdp', $mdpconnect);
                    $requser->execute();
                    $userexist = $requser->rowCount();
                    $userinfo = $requser->fetch();
                    // var_dump($userinfo);
                    if($userexist == 1)
                    {
                        $passwordhash = $userinfo->mdp;
                        if(password_verify($mdpconnect, $passwordhash))
                        { 
                            $_SESSION['id_user'] = $userinfo->id_user;
                            $_SESSION['pseudo'] = $userinfo->pseudo;
                            $_SESSION['mail'] = $userinfo->mail;
                            var_dump($_SESSION);
                            header("Location: mon_compte.php");
                        }
                        else
                        {
                            $erreur = "Mauvais  mot de passe !";
                        }

                    }
                    else
                    {
                        $erreur = "Mauvais mail  !";
                    }

                }
                else
                {
                    $erreur = "Tous les champs doivent etre complétés !";
                }





            }
           }
   
       }
       else
       {
           $erreur = "Veuillez completer tous les champs!";
       }
   }
   else
   {
       
   }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace connexion administrateur</title>
    <link href="STYLE.CSS" rel="stylesheet">
</head>
<body>
<?php require 'header.php';?>
<main>
   <div align="center" class="column">
       <h2>Connexion</h2>
       <br/><br/>
       <form method="post" action="" class="flex">
          <input type="email" name="mail" placeholder="Mail" autocomplete="off"/>
          <!-- <input type="text" name="pseudo" placeholder="Pseudo" autocomplete="off" /> -->
          <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off"/>
          <input type="submit" name="connexion" value="Se connecter" />         
       </form>
       <a href="mdp_oublie.php">mot de passe oublié</a>
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