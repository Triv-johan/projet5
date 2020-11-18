<?php
// On démarre une session
session_start();

require_once('../modele/function.php');

displayadd();

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
                        <br>
                        <button class="btn btn-primary">Envoyer</button>
                    </form> </div><a href="../index.php"><button class="btn btn-primary">Retour</button></a>
                   
                    
                    
                    
                
            </section>
        </div>
    </main>
</body>
</html>