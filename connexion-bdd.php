<?php
//connexion base de donnée
$connexion = new PDO(
    'mysql:host=localhost;dbname=cours_cnam_bac1_22;charset=utf8',
    'root',
    ''
);

$connexion->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
?>
