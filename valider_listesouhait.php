<?php
session_start();
require 'header.php';
require 'functions.php';
require 'bdd.php';
var_dump($_SESSION);
var_dump($_SESSION['liste']);
$liste = $_SESSION['liste'];
var_dump($liste);
foreach($liste as $key => $value):
    echo $key ;
  
endforeach;
?>
              
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>liste de souhait en cours de création</title>
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
       <h2>liste de souhait en cours de création</h2>
       <!-- <br/><br/> -->
       <section class="grid">
            <?php foreach($liste as $article): ?>
                <?php 
                    $sql = "SELECT * FROM articles WHERE id_article = $key ";
                    $requete = $bdd->query($sql);
                    $article = $requete->fetch();
                    // var_dump($article);
                    // creation des variables
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
                                    <!-- <a href="ecrire_commentaire.php?id_usercom=' . $id_user . '&id_article=' . $id_article . '">Commenter</a> -->
                                    <a href="ajouter_article.php?id_article=' . $id_article . '&id_user=' . $id_user . '">Ajouter</a>
                                    <a>Supprimer</a>
                                      </div>';
                            } else 
                            {
                                echo 'CONNECTEZ-VOUS!';
                            }
                    ?>

                </article>
               
            <?php endforeach; ?>
       </section>
       <form method="post" action="" class="form_connect">
          <textarea placeholder="votre commentaire" name="contenu_souh"></textarea>
          <input type="submit" name="inserer_liste" value="Insérer la liste" />         
       </form>
       <?php
       if($_POST)
       {
        $id_user = $_SESSION['id_user'];
        $contenu_souh = $_POST['contenu_souh'];
        $is_active = 1;
        var_dump($id_user);
        var_dump($contenu_souh);
        var_dump($is_active);

        // implementer le tablo souhaits
        $sql = "INSERT INTO souhaits (id_user, contenu_souh, is_active) VALUES (:id_user, :contenu_souh, :is_active) ";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':contenu_souh', $contenu_souh);
        $stmt->bindParam(':is_active', $is_active);
        $stmt->execute();


        $erreur = 'liste de souhaits insérée dans la Bdd';

        // récupérer le dernier id_souhait
        $id_souhait_insrt = $bdd->lastInsertId();;
        var_dump($id_souhait_insrt);
        $id_user = $_SESSION['id_user'];
        // insertion dans  le tablo souhait_article
        foreach($liste as $article):
            $sql = "INSERT INTO souhait_article (id_souhait, id_article, id_user) VALUES (:id_souhait, :id_article, :id_user) ";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':id_souhait', $id_souhait_insrt);
            $stmt->bindParam(':id_article', $article);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();
        endforeach;

        echo "TABLEAU 'souhait_article' REMPLI";


       }
       else
       {
        echo "La variable post 'inserer_liste' n'existe pas";
       }

       ?>
       
       
       <?php
    //    var_dump($nom_article);
    //    var_dump($date_ajout);
    //    var_dump($id_article);
    //    var_dump($photo);
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