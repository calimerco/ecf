<?php
require 'header.php';
require 'functions.php';
require 'bdd.php';

// ecrir la requete
$sql = "SELECT * FROM articles ORDER BY id_article ";

// executer la requete dans la bdd query=execute
$requete = $bdd->query($sql);

// recuperer les données
$articles = $requete->fetchAll();



var_dump($articles);

            //    // récuper données user du tablo users et le stocker dans la  $_SESSION['']
            //    $recupUser = $bdd->prepare('SELECT * FROM users WHERE mail = :mail AND mdp = :mdp');
            //    $recupUser->bindValue('mail', $mail_saisi);
            //    $recupUser->bindValue('mdp', $mdp_saisi);
            //    $recupUser->execute();
            //    $adminfo = $recupUser->fetch();

            //    var_dump($adminfo);

            //    // creer la varSESSION  pour retser connecté sur les autres pages

            //    $_SESSION['pseudo'] = $adminfo->pseudo;
            //    $_SESSION['mdp'] = $mdp_saisi;
            //    $_SESSION['id_user'] = $adminfo->id_user;

            //    var_dump($_SESSION);
?>
              
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>TUTO PHP</title>
    <style>
        article div{
            border: 4px solid rgb(19, 230, 29);
            /* justify-content: space-between; */
            justify-content: space-evenly;
        }
        div a {
            font-size: 14px;
        }
    </style>
</head>
<main>
   <div class="container column grey" align="center">
       <h2>Catalogue des articles</h2>
       <!-- <br/><br/> -->
       <section class="grid">
            <?php foreach($articles as $article): ?>
                <article>
                    <h1><?= $article->nom_art ?></h1>
                    <p>inscrit le <?= $article->date_ajout ?></p>                   
                    <img src="<?= $article->photo ?>" alt="image article" width="300px">
                    <div>
                    <a>Commenter</a><a>Ajouter</a><a>Désactiver</a><a>Supprimer</a>
                    </div>
                </article>
            <?php endforeach; ?>
       </section>
       
       
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