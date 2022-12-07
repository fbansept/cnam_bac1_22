<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<?php if (isset($_POST['login'])) {
    //traitement du formulaire

    //connexion base de donnée
    $connexion = new PDO(
        'mysql:host=localhost;dbname=cours_cnam_bac1_22;charset=utf8',
        'root',
        ''
    );

    //préparation de  la requête
    $requete = $connexion->prepare(
        'SELECT * 
         FROM utilisateur
         WHERE login = ?
         AND password = ?'
    );

    //execution de la requête
    $requete->execute([$_POST['login'], $_POST['password']]);

    //SI l'utilisateur existe, un tableau avec les colonnes
    //de la table utilisateur sera affecté,
    //SINON la variable $utilisateur contiendra false
    $utilisateur = $requete->fetch();

    //si l'utilisateur s'est trompé
    if ($utilisateur == false) {
        echo 'mauvais login / mot de passe';
    } else {
        $_SESSION['id'] = $utilisateur['id'];
        $_SESSION['login'] = $utilisateur['login'];
        $_SESSION['administrateur'] = $utilisateur['administrateur'];
        //ex : dans la table de session de l'utilisateur
        //on affecte à l'index id la valeur 42
        header('Location: index.php');
    }
} ?>

<form method="POST">

    <input name="login">
    <input name="password" type="password">
    <input type="submit" value="connexion">

</form>