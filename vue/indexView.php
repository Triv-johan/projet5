<?php

// On démarre une session
session_start();
require_once('controller/close.php');


 // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["username"])){
   header("Location: controller/login.php");
   exit(); 
 }

require_once('modele/function.php');

// On inclut la connexion à la base
require_once('controller/connect.php');

$sql = 'SELECT * FROM `concierge` ORDER BY fin DESC limit 10';



// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="controller/style.css">
    <title>Administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12"><center>
            <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="controller/logout.php">Déconnexion</a>
    </div>
                <h1>Administration<hr></h1>

            <?php displayboard();
            ?>
                <h2>Liste</h2>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Mission</th>
                        <th>Etage</th>
                        <th>Debut</th>
                        <th>Fin</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['mission'] ?></td>
                                <td><?= $produit['etage'] ?></td>
                                <td><?= $produit['debut'] ?></td>
                                <td><?= $produit['fin'] ?></td>
                                <td> <a href="controller/edit.php?id=<?= $produit['id'] ?>">Modifier</a> <a href="controller/delete.php?id=<?= $produit['id'] ?>">Supprimer</a></td>
                                <td></td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </tbody>
                </table></center>
                <a href="controller/add.php" class="btn btn-primary">Ajouter un produit </a><center>
                
                 <h2>Historique</h2>       
                <form method="POST" action=""> 
     <p>Rechercher une lettre un mot ou un chiffre</p> <input type="text" name="recherche"><button class="btn btn-primary" type="SUBMIT" value="Appliquer ou reset"><h6>Appliquer ou reset</h6></button>
     
     </form>
     
     <?php displayhistorical();
     ?>
     
     
                    </center></section>
        </div>
    </main>
</body>
</html>