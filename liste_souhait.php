<?php
session_start();
require 'functions.php';
require 'bdd.php';
var_dump($_SESSION);

if(isset($_SESSION['id_user']))
{
    $id_user = $_SESSION['id_user'];
    var_dump($id_user);
} 

?>
<?php

// recupere tous les souhaits  
$q = $bdd->prepare("SELECT * FROM souhaits");
// $q->bindvalue('id_user', $id_user);
$q->execute();
$all_souhait = $q->fetchAll();
var_dump($all_souhait);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="STYLE.CSS" rel="stylesheet">
    <title>toutes les listes de souhaits</title>
</head>
<body>
<?php require 'header.php';?>
<main>

   <div class="container column grey" align="center">
       <h2>Voici toutes les listes de souhaits</h2>
       <!-- <br/><br/> -->
       <section class="grid pink">
            <?php foreach($all_souhait as $souhait): ?>
                <?php 
                $id_souhait = $souhait->id_souhait;
                $id_user = $souhait->id_user;
                $contenu_souh = $souhait->contenu_souh;
                $created_at = $souhait->created_at;
                $is_active = $souhait->is_active;
                // var_dump($id_souhait);
                // var_dump($id_user);
                // var_dump($contenu_souh);
                // var_dump($created_at);
                // var_dump($is_active);
                $req = $bdd->prepare("SELECT * FROM souhait_article WHERE id_souhait = $id_souhait");
                $req->execute();
                $article_souhait = $req->fetchAll();
                
                ?>
                <article class="grid-item grey">
                    <h1>ID de la liste de souhaits :<?= $id_souhait ?></h1>
                    <p>formulée par : <?= $id_user ?></p>
                    <p>Contenu : <?= $contenu_souh ?></p>
                    <p>Créée le <?= $created_at ?></p>   
                    <p>Statut = <?= $is_active ?></p> 
                    <p>contient les articles suivants :
                      <!-- recuperer les id des articles contenus dans la liste     -->
                         <?php  
                        //  $req = $bdd->prepare("SELECT * FROM souhait_article WHERE id_souhait = $id_souhait");
                        //  $req->execute();
                        //  $article_souhait = $req->fetchAll();
                        //  var_dump($article_souhait);
                         ?>
                    </p>

                                  
                    <!-- <img src="" alt="image article" width="300px"> -->
                    
                    <!-- <div>
                    <a href="ajouter_article.php?id_article=<?= $id_article ?>&id_user=<?= $_SESSION['id_user'] ?>">Ajouter</a>
                    <a>Désactiver</a>
                    <a>Supprimer</a>
                    </div> -->

                    <?php
                            if (isset($_SESSION['id_user'])) 
                            {
                                $id_user = $_SESSION['id_user'];

                               
                                // Insérer id_usercom et id_souhait dans URL afin de les récupérer dans les pages de destination 
                                echo '<div>
                                      <a href="ecrire_commentaire.php?id_usercom=' . $id_user . '&id_souhait=' . $id_souhait . '">Commenter</a>
                                      </div>';
                            } else 
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
<script src="app.js"></script>
</body>
    <?php
    require_once 'footer.php';
    ?>
</html>