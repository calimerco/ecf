<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="STYLE.CSS" rel="stylesheet">
</head>
 -->
    
    <header class="pink" >

<!-- LOGO -->
        <!-- <div class="logo"> -->
           <img class="logo1" src="" alt="imoji diablotin" title="logo svg">
           <img class="logo2" src="logo2.svg" alt="imoji diablotin" title="logo svg" >
        <!-- </div> -->
<!-- ACCESS PRO -->
        <!-- <div class="pro grey">
            <a class="pink" href="#">PRO ACCESS</a>
        </div> -->
<!-- NAVBAR -->
        <nav class="navlinks_cont grey">
            <!-- PROBLEME -->
            <?php if(!empty($_SESSION))
            { ?>
            <?php if(isset($_SESSION['id_user']) ) { echo '<a href="mon_compte.php">mon compte</a>';} ?>
            <?php if($_SESSION['id_user'] == 7) { echo '<a href="administration.php">administration</a>';}   ?> 
           
            <a href="moteur_recherche.php">Recherche</a>
            <?php if(!isset($_SESSION['id_user'])) { echo '<a href="inscription.php">Inscription</a>';} ?>
            <?php if(!isset($_SESSION['id_user'])) { echo '<a href="connexion.php">Connexion</a>';} ?>
            <a href="catalogue_article.php">Catalogue</a>
            <?php if(isset($_SESSION['id_user'])) { echo '<a href="liste_souhait.php" title="voire toutes les listes de souhait">liste de souhaits</a>';} ?>
            <?php if(isset($_SESSION['id_user'])) { echo '<a href="deconnexion.php">déconnexion</a>';} ?>
            <?php
            }
            else
            {
                echo '<a href="moteur_recherche.php">Recherche</a>';
                echo '<a href="inscription.php">Inscription</a>';
                echo '<a href="connexion.php">Connexion</a>';

            }
            ?>
            
            
            
            
        </nav>
             <!-- hamburger -->
        <div class="burger">
                <span></span>
        </div>
    </header>
  <!--   <script src="app.js"></script> -->