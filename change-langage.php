<?php
session_start();

if (isset($_GET['langue'])) {
    $languesDisponibles = ['fr', 'en'];

    $langue = $_GET['langue'];

    //on vérifie que le paramètre langue
    //dans l'URL est bien une langue prise en charge
    if (in_array($langue, $languesDisponibles)) {
        $_SESSION['langue'] = $langue;
    }
}

header('Location: index.php');

?>
