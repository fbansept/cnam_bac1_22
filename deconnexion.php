<?php
//on utilise le système de session
session_start();

//on supprime la session de l'utilisateur
session_destroy();

//on redirige vers la page d'accueil
header('Location: index.php');

?>
