<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['mission']) && !empty($_POST['mission'])
    && isset($_POST['etage']) && !empty($_POST['etage'])
    && isset($_POST['debut']) && !empty($_POST['debut'])
    && isset($_POST['fin']) && !empty($_POST['fin'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $mission = strip_tags($_POST['mission']);
        $etage = strip_tags($_POST['etage']);
        $debut = strip_tags($_POST['debut']);
        $fin = strip_tags($_POST['fin']);

        $sql = 'INSERT INTO `concierge` (`mission`, `etage`, `debut`, `fin`) VALUES (:mission, :etage, :debut, :fin);';

        $query = $db->prepare($sql);

        $query->bindValue(':mission', $mission, PDO::PARAM_STR);
        $query->bindValue(':etage', $etage, PDO::PARAM_STR);
        $query->bindValue(':debut', $debut, PDO::PARAM_STR);
        $query->bindValue(':fin', $fin, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Produit ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>

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
                <h1>Ajouter un produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="mission">mission</label>
                        <input type="text" id="mission" name="mission" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="etage">etage</label>
                        <input type="text" id="etage" name="etage" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="debut">debut</label>
                        <input type="date" id="debut" name="debut" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fin">fin</label>
                        <input type="date" id="fin" name="fin" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                    <a href="index.php"><button class="btn btn-primary">Retour</button></a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>