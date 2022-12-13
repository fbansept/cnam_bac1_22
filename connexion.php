<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<?php if (isset($_POST['login'])) {
    //traitement du formulaire

    include 'connexion-bdd.php';

    //préparation de  la requête
    $requete = $connexion->prepare(
        'SELECT * 
         FROM utilisateur
         WHERE login = ?'
    );

    //execution de la requête
    $requete->execute([$_POST['login']]);

    //SI l'utilisateur existe, un tableau avec les colonnes
    //de la table utilisateur sera affecté,
    //SINON la variable $utilisateur contiendra false
    $utilisateur = $requete->fetch();

    //si l'utilisateur s'est trompé de login
    if ($utilisateur == false) {
        echo 'Login inexistant';
    } else {
        //on récupère le mot de passe de la base de donnée
        $motDePasseBcrypt = $utilisateur['password'];
        $motDePasseEnClair = $_POST['password'];

        //si les mot de passes sont compatibles
        //c'est à dire : si l'utilisateur ne
        //s'est pas trompé de mot de passe
        if (password_verify($motDePasseEnClair, $motDePasseBcrypt)) {
            $_SESSION['id'] = $utilisateur['id'];
            $_SESSION['login'] = $utilisateur['login'];
            $_SESSION['administrateur'] = $utilisateur['administrateur'];
            //ex : dans la table de session de l'utilisateur
            //on affecte à l'index id la valeur 42
            header('Location: index.php');
        } else {
            echo 'Mauvais mot de passe';
        }
    }
} ?>

<h1>Connexion</h1>

<form method="POST">

    <input name="login">
    <input name="password" type="password">
    <input type="submit" value="connexion">

</form>