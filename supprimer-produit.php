<?php

include 'header.php';

include 'navbar.php';
?>

<h1>Voulez-vous vraiment supprimer ce produit ? </h1>

<?php
//si l'utilisateur n'est pas connecté
//ou qu'il n'est pas administrateur
//on le redirige vers la page de connexion
if (!isset($_SESSION['administrateur']) || $_SESSION['administrateur'] != 1) {
    header('Location: connexion.php');
}

if (isset($_GET['confirme'])) {
    //connexion base de donnée
    include 'connexion-bdd.php';

    //préparation de  la requête
    $requete = $connexion->prepare('DELETE FROM produits WHERE id = ?');

    //execution de la requête
    $requete->execute([$_GET['id']]);

    //On redirige vers la page index.php
    header('Location: index.php');
}
?>


<a class="btn btn-danger"
    href="supprimer-produit.php?id=<?= $_GET['id'] ?>&confirme=1">
    Confirmer la suppression
</a>

<a class="btn btn-primary" href="index.php">Annuler</a>