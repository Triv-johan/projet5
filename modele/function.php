<?php

function displayboard(){
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
                }
                


function displayhistorical(){
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
    ORDER BY etage
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


}

function displayadd(){
    if($_POST){
        if(isset($_POST['mission']) && !empty($_POST['mission'])
        && isset($_POST['etage']) && !empty($_POST['etage'])
        && isset($_POST['debut']) && !empty($_POST['debut'])
        && isset($_POST['fin']) && !empty($_POST['fin'])){
            // On inclut la connexion à la base
            require_once('../controller/connect.php');
    
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
            require_once('../controller/close.php');
    
            header('Location: ../index.php');
        }else{
            $_SESSION['erreur'] = "Le formulaire est incomplet";
        }
    }
}

function displaydelete(){
// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('../controller/connect.php');

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
        header('Location: ../index.php');
        die();
    }

    $sql = 'DELETE FROM `concierge` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Produit supprimé";
    header('Location: ../index.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../index.php');
}
}

    
?>