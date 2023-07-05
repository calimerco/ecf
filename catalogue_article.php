<?php
session_start();
require 'header.php';
require 'functions.php';
require 'bdd.php';
var_dump($_SESSION);
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
            //    $recupUser->execute();ù
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
    <title>Catalogue des articles</title>
    
</head>
<main>
   <div class="container column grey" align="center">
       <h2>Catalogue des articles</h2>
       <!-- <br/><br/> -->
       <section class="grid pink">
            <?php foreach($articles as $article): ?>
                <?php 
                $nom_article = $article->nom_art;
                $date_ajout = $article->date_ajout;
                $id_article = $article->id_article;
                $photo = $article->photo;
                ?>
                <article class="grid-item">
                    <h1><?= $nom_article ?></h1>
                    <p>inscrit le <?= $date_ajout ?></p>   
                    <p>id_article = <?= $id_article ?></p>                
                    <img src="<?= $photo ?>" alt="image article" width="300px">
                    
                    <!-- <div>
                    <a href="ajouter_article.php?id_article=<?= $id_article ?>&id_user=<?= $_SESSION['id_user'] ?>">Ajouter</a>
                    <a>Désactiver</a>
                    <a>Supprimer</a>
                    </div> -->

                    <?php
                            if (isset($_SESSION['id_user'])) 
                            {
                                $id_user = $_SESSION['id_user'];
                                $id_article = $id_article; // Assurez-vous que la variable $id_article est définie

                                echo '<div>
                                    <!-- Insérer id_user et id-usercom dans l\'URL afin de les récupérer dans les pages de destination -->
                                    <a href="ajouter_article.php?id_article=' . $id_article . '&id_user=' . $id_user . '">Ajouter</a>
                                      </div>';
                            } 
                            if (isset($_SESSION['id_user']) AND $_SESSION['id_user'] == 7)
                            {
                                echo '<div>
                                    <!-- Insérer id_user et id-usercom dans l\'URL afin de les récupérer dans les pages de destination -->
                                    
                                
                                    <a>Désactiver</a>
                                    <a>Supprimer</a>
                                    
                                      </div>';

                            }
                            else 
                            {
                                echo 'CONNECTEZ-VOUS!';
                            }
                    ?>

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
