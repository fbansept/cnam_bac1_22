<?php

include 'header.php';

include 'navbar.php';
?>

<h1>Voulez-vous vraiment supprimer ce produit ? </h1>

<?php if (isset($_GET['confirme'])) {
    //connexion base de donnée
    $connexion = new PDO(
        'mysql:host=localhost;dbname=cours_cnam_bac1_22;charset=utf8',
        'root',
        ''
    );

    //préparation de  la requête
    $requete = $connexion->prepare('DELETE FROM produits WHERE id = ?');

    //execution de la requête
    $requete->execute([$_GET['id']]);

    //On redirige vers la page index.php
    header('Location: index.php');
} ?>


<a class="btn btn-danger"
    href="supprimer-produit.php?id=<?= $_GET['id'] ?>&confirme=1">
    Confirmer la suppression
</a>

<a class="btn btn-primary" href="index.php">Annuler</a>