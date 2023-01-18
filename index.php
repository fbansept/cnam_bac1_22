<?php include 'header.php'; ?>

<?php include 'navbar.php'; ?>

<div class="container">

    <div class="row">

        <?php
        //connexion base de donnée
        include 'connexion-bdd.php';

        //préparation de  la requête
        $requete = $connexion->prepare('SELECT * FROM produits');
        //execution de la requête
        $requete->execute();
        //affectation du résulat dans la vaiable $listeArticle
        $listeArticles = $requete->fetchAll();

        //on trouve la colonne description à afficher selon la langue selectionnée
        //("description" ou "description_en" , voir + si on ajoute des langues)
        $colonneDescription = 'description';

        if (isset($_SESSION['langue']) && $_SESSION['langue'] != 'fr') {
            $colonneDescription = 'description_' . $_SESSION['langue'];
        }

        foreach ($listeArticles as $article) { ?>

            <div class="col-6 produit">
                <div class="card m-1">
                    <h3 class="card-header"><?= $article['nom'] ?></h3>
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['prix'] ?>€</h5>
                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                    </div>
                    <img src="<?= $article['url_image'] ?>">
                    <div class="card-body">
                        <p class="card-text"><?= $article[$colonneDescription] ?></p>

                        <?php if (
                            isset($_SESSION['id']) &&
                            $_SESSION['administrateur'] == 1
                        ) { ?>

                            <a href="supprimer-produit.php?id=<?= $article['id'] ?>" class="btn btn-danger">Supprimer</a>
                            <a href="modifier-produit.php?id=<?= $article['id'] ?>" class="btn btn-primary">
                                Modifier
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php }
        ?>
    </div>
</div>

<?php
if (!isset($_SESSION['accepte-cookie']) || !$_SESSION['accepte-cookie']) {
?>

    <div class="cookie-alert-overlay">
        <div class="cookie-alert">
            En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies<a href="accepte-cookie.php">OK</a>
        </div>
    </div>
<?php
}

?>

</body>

</html>