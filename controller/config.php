<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'johang');
define('DB_PASSWORD', '4E3r+JZ43Q7Kgw==');
define('DB_NAME', 'johang_concierge');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

?>