<?php
// On démarre une session
session_start();
require_once('../modele/function.php');

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['mission']) && !empty($_POST['mission'])
    && isset($_POST['etage']) && !empty($_POST['etage'])
    && isset($_POST['debut']) && !empty($_POST['debut'])
    && isset($_POST['fin']) && !empty($_POST['fin'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $mission = strip_tags($_POST['mission']);
        $etage = strip_tags($_POST['etage']);
        $debut = strip_tags($_POST['debut']);
        $fin = strip_tags($_POST['fin']);

        $sql = 'UPDATE `concierge` SET `mission`=:mission, `etage`=:etage, `debut`=:debut, `fin`=:fin WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':mission', $mission, PDO::PARAM_STR);
        $query->bindValue(':etage', $etage, PDO::PARAM_STR);
        $query->bindValue(':debut', $debut, PDO::PARAM_STR);
        $query->bindValue(':fin', $fin, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Produit modifié";
        require_once('close.php');

        header('Location: ../index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `concierge` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>

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
                <h1>Modifier un produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="mission">mission</label>
                        <input type="text" id="mission" name="mission" class="form-control" value="<?= $produit['mission']?>">
                    </div>
                    <div class="form-group">
                        <label for="etage">etage</label>
                        <input type="text" id="etage" name="etage" class="form-control" value="<?= $produit['etage']?>">

                    </div>
                    <div class="form-group">
                        <label for="debut">debut</label>
                        <input type="date" id="debut" name="debut" class="form-control" value="<?= $produit['debut']?>">
                    </div>
                    <div class="form-group">
                        <label for="fin">fin</label>
                        <input type="date" id="fin" name="fin" class="form-control" value="<?= $produit['fin']?>">
                    </div>
                    <input type="hidden" value="<?= $produit['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <a href="../index.php"><button class="btn btn-primary">Retour</button></a>
            </section>
        </div>
    </main>
</body>
</html>