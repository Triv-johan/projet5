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
    <title>Liste des produits</title>

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
                <h1>Liste des produits</h1>
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

            
                <form action="" method="post">
    <input type="text" name="motEntree">
    <input type="submit" name="form" value="Rechercher">
</form>

<?php
    //Si le formulaire est envoyé donc si on a appuyé sur le bouton qui a comme name : form
    if(isset($_POST['form']) {
        //Connexion a la base de donnée
         
        $PARAM_hote='localhost'; // le chemin vers le serveur
        $PARAM_port='3306';
        $PARAM_nom_bd='immeuble'; // le nom de votre base de donn?es
        $PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
        $PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
    }
        try
        {  
            $this->pdo =  new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
         
        catch(Exception $e)
        {
            echo 'Erreur Mysql, pas d acces a la base de donnée.  ';
             
        }
 
        //On récupère ce qu'a rentrer l'utilisateur dans le champ texte et on utilise la fonction htmlentities pour se protéger d'une faille web
        $motEntree = htmlentities($_POST['motEntree']);
 
        //On fait notre requete on va chercher toutes les entrées de "matable" ou les motclés correspondent a ce que vient de rentrer l'utilisateur
        $req = $pdo->prepare('SELECT * FROM concierge WHERE motclés = $motEntree');
        $req->execute();
        if(empty($pseudo)) {
            echo 'indiquer votre pseudo';
            }
        //On fait une boucle et on affiche tous les sujets par exemple ou motclés = motEntree
        while($donnees = $req->fetch(PDO::FETCH_OBJ)) {
            echo $donnees->sujet;
        }
    }
?>

     
     
            </section>
        </div>
    </main>
</body>
</html>