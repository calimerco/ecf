<?php
session_start();
require 'functions.php';
require 'bdd.php';
?>
<?php

// PANIER
   
//    var_dump($_GET);
//    var_dump($_GET['id_article']);
   var_dump($_SESSION);
   if(isset($_SESSION['liste'])){var_dump($_SESSION['liste']);}
   if(isset($_GET['id_article']))
   {
        $id_article = $_GET['id_article'];
        // récupérer l'article de la bdd
        $q = $bdd->prepare("SELECT * FROM articles WHERE id_article = :id_article");
        $q->bindvalue('id_article', $id_article);
        $q->execute();
        $article = $q->fetch();
        // $requete = $bdd->query($sql);
        // $article = $requete->fetchAll();
        var_dump($article);
        // var_dump($article->id_article);
        $id_articleSecu = $article->id_article;
        // var_dump($id_articleSecu);
        if(!empty($article))
        {
            if (isset($_SESSION['id_user']))
            {
                if(!isset($_SESSION['liste']))
                {
                    //  créer une liste vide
                    $_SESSION['liste'] = array();
                    $_SESSION['liste'][$id_articleSecu] = 1;
                    echo 'article ajouté à votre liste.Vous pouvez valider votre liste en cliquant sur valider ma liste ';
                }
                else{
                    $_SESSION['liste'][$id_articleSecu] += 1;
                    echo 'article ajouté à votre liste.Vous pouvez valider votre liste en cliquant sur valider ma liste ';
                }
                var_dump($_SESSION['liste']);

            }
            else 
            {
                    $erreur = "variable SESSION ['id_user'] non trouvée!";
            }

        }
        else
        {
            $erreur = "Ce produit n'existe pas dans la bdd.";
        }

       

   }
   else
   {
    $erreur = "variable GET 'id_article' non trouvée! veuilleez seléctionner un article.";
   }
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
</head>
<body>
<?php require 'header.php';?>
<main>
   <div align="center"  class="column">
       <h2>L'article id_article=<?php if(isset($_GET['id_article'])){ echo $id_article;} ?> a été ajouté à votre liste de souhait</h2>
       <br/><br/>
       <!-- <form method="post" action="" class="form_connect">
          <input type="email" name="mail" placeholder="Mail" autocomplete="off"/> -->
          <!-- <input type="text" name="pseudo" placeholder="Pseudo" autocomplete="off" /> -->
          <!-- <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off"/>
          <input type="submit" name="connexion" value="Se connecter" />         
       </form> -->
       <!-- <a href="mdp_oublie.php">mot de passe oublié</a> -->
       <a href="catalogue_article.php">Retour au catalogue des articles</a>
       <a href="valider_listesouhait.php">Visualiser votre liste de souhaits</a>
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