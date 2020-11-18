<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `concierge`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste</h1>
                <table class="table">
                    <thead>
                        <th>id</th>
                        <th>mission</th>
                        <th>etage</th>
                        <th>debut</th>
                        <th>fin</th>
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
                                <td> <a href="edit.php?id=<?= $produit['id'] ?>">Modifier</a> <a href="delete.php?id=<?= $produit['id'] ?>">Supprimer</a></td>
                                <td></td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>

                <form method="POST" action=""> 
     Rechercher une lettre un mot ou un chiffre <input type="text" name="recherche">
     <button class="btn btn-primary" type="SUBMIT" value="Appliquer ou reset">Appliquer ou reset</button> 
     </form>
     <?php


$db_server = 'localhost'; // Adresse du serveur MySQL
$db_name = 'immeuble';            // Nom de la base de données
$db_user_login = 'root';  // Nom de l'utilisateur
$db_user_pass = '';       // Mot de passe de l'utilisateur

// Ouvre une connexion au serveur MySQL
$conn = mysqli_connect($db_server,$db_user_login, $db_user_pass, $db_name);


 // Récupère la recherche
 $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

 // la requete mysql
    $q = $conn->query(
   "SELECT * FROM concierge
    WHERE etage LIKE '%$recherche%'
    OR mission LIKE '%$recherche%'
    OR debut LIKE '%$recherche%'
    OR fin LIKE '%$recherche%'
    LIMIT 10 ");

 // affichage du résultat
 if (empty ($_POST['recherche']))
 { 
     echo ""; 
 } 
 else 
 { 

 while($r = mysqli_fetch_array($q)){
 echo '<br/><span> (étage)=</span> '.$r['etage'].'<span> (mission)=</span> '.$r['mission'].'<span> (Date de début)= </span>'.$r['debut'].' <span>(Date de fin)=</span> '.$r['fin'].'<br />';
}
 }



?>
     
     
            </section>
        </div>
    </main>
</body>
</html>