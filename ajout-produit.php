<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<!-- <script defer src="assets/js/ajout-produit.js"></script> -->

<h1>Ajouter un nouvel article</h1>


<?php if (isset($_POST['nom'])) {
    //est-ce-que l'index "nom" existe dans le tableau $_POST ?
    //(autrement dit : si on a validé le formulaire)

    //debuggage variable $_POST
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    //--------- validation coté PHP (obligatoire) ---------
    //javascript ne rajoutant que de l'ergonomie (expérience utilisateur UX)

    //TODO : faire la même chose en PHP que l'on a fait en javascript pour les 3 autres champs (prix, description, url)

    $erreurNom = false;
    $messageErreurNom = 'max 10 caractères';

    if (strlen($_POST['nom']) > 10) {
        $erreurNom = true;
        $nombreCaractereEnTrop = strlen($_POST['nom']) - 10;
        $messageErreurNom .= ' (' . $nombreCaractereEnTrop . ' en trop)';

        //afficher les erreurs en dessous du titre
        // echo '<b style="color:red">';
        // echo 'Le nom doit avoir 10 caractères maximum';
        // echo '</b>';

        //afficher une alerte en avascript
        // echo '<script>';
        // echo 'alert("Le nom doit avoir 10 caractères maximum")';
        // echo '</script>';
    }

    //SI il n'y a pas d'erreur dans le formulaire
    if (!$erreurNom) {
        //connexion base de donnée
        $connexion = new PDO(
            'mysql:host=localhost;dbname=cours_cnam_bac1_22;charset=utf8',
            'root',
            ''
        );

        //préparation de  la requête
        $requete = $connexion->prepare(
            "INSERT INTO produits ( nom, description, prix, url_image) VALUES ('un nom', 'une description', '55', 'toto.jpg')"
        );
        //execution de la requête
        $requete->execute();
    }
} ?>

    <form method="POST" onsubmit="return validerFormulaire();" class="container mb-4">
        <div class="form-group <?php if ($erreurNom) {
            echo 'has-danger';
        } ?>">
            <label class="col-form-label mt-4" for="inputNom">Nom</label>
            <input name="nom" type="text" class="form-control <?php if (
                $erreurNom
            ) {
                echo 'is-invalid';
            } ?>" placeholder="Nom du produit" id="inputNom">
            <div class="invalid-feedback"><?= $messageErreurNom ?></div>
        </div>

        <div class="form-group">
            <label for="inputDescription" class="form-label mt-4">Description</label>
            <textarea name="description" class="form-control" id="inputDescription" rows="3"></textarea>
            <div class="invalid-feedback">20 caractères minimum</div>
        </div>

        <div class="form-group">
            <label class="col-form-label mt-4" for="inputPrix">Prix</label>
            <input name="prix" type="number" class="form-control" placeholder="Prix du produit (ex : 5.99)" id="inputPrix">
            <div class="invalid-feedback">Le prix doit être positif</div>
       </div>

        <div class="form-group">
            <label class="col-form-label mt-4" for="inputUrlImage">URL image</label>
            <input name="url_image" type="text" class="form-control" placeholder="URL de l'image (ex: http://mon-site.com/image.jpg)" id="inputUrlImage">
            <div class="invalid-feedback"></div>
        </div>

        <input type="submit" value="Ajouter l'article" class="btn btn-primary mt-4">

    </form>
</body>
</html>


