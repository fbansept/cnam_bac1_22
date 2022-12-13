<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<?php
$erreur = '';

if (isset($_POST['login'])) {
    include 'connexion-bdd.php';

    //préparation de  la requête
    $requete = $connexion->prepare(
        'INSERT INTO utilisateur ( login , password ) VALUES (?, ?)'
    );

    $motDePasseBcrypt = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        //execution de la requête
        $requete->execute([$_POST['login'], $motDePasseBcrypt]);

        header('Location: connexion.php');
    } catch (PDOException $erreur) {
        $erreur = 'Login déjà existant';
    }
}
?>

<h1>Inscription</h1>

<form method="POST">

    <input name="login">
    <?= $erreur ?>
    <input name="password" type="password">
    <input type="submit" value="inscription">

</form>