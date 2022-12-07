<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<?php if (isset($_POST['login'])) {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=cours_cnam_bac1_22;charset=utf8',
        'root',
        ''
    );

    //préparation de  la requête
    $requete = $connexion->prepare(
        'INSERT INTO utilisateur ( login , password ) VALUES (?, ?)'
    );

    //execution de la requête
    $requete->execute([$_POST['login'], $_POST['password']]);

    header('Location: connexion.php');
} ?>

<form method="POST">

    <input name="login">
    <input name="password" type="password">
    <input type="submit" value="inscription">

</form>