<?php
try{
    // Connexion à la base
    $db = new PDO('mysql:host=localhost;dbname=johang_concierge', 'johang', '4E3r+JZ43Q7Kgw==');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}

?>