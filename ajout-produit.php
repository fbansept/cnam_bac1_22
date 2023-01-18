<?php include 'header.php'; ?> 

<?php include 'navbar.php'; ?>

<!-- <script defer src="assets/js/ajout-produit.js"></script> -->

<h1>Ajouter un nouvel article</h1>


<?php
//si l'utilisateur n'est pas connecté
//ou qu'il n'est pas administrateur
//on le redirige vers la page de connexion
if (!isset($_SESSION['administrateur']) || $_SESSION['administrateur'] != 1) {
    header('Location: connexion.php');
}

if (isset($_POST['nom'])) {
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
        include 'connexion-bdd.php';

        $urlImage = $_POST['url_image'];

        //si l'utilisateur à uploadé un fichier
        if (isset($_FILES['fichier'])) {

            var_dump($_FILES);

            $nomFichierTemporaire = $_FILES['fichier']['tmp_name'];

            $date = new DateTime();
            $dateFormat = $date->format('Y-m-d-H-i-s');

            $nomFichierFinal =
                'uploads/' . $dateFormat . '-' . $_FILES['fichier']['name'];

            $urlImage = 'http://localhost/cnam_bac1_22/' . $nomFichierFinal;

            move_uploaded_file($nomFichierTemporaire, $nomFichierFinal);
        }

        //préparation de  la requête
        $requete = $connexion->prepare(
            'INSERT INTO produits ( nom, description,description_en, prix, url_image) 
             VALUES (?, ?, ?, ?, ?)'
        );

        //execution de la requête
        $requete->execute([
            $_POST['nom'],
            $_POST['description'],
            $_POST['descriptionEn'],
            $_POST['prix'],
            $urlImage,
        ]);
    }
}
?>

    <form method="POST" enctype='multipart/form-data' onsubmit="return validerFormulaire();" class="container mb-4">
        <div class="form-group <?php if ($erreurNom) {
            echo 'has-danger';
        } ?>">
            <label class="col-form-label mt-4" for="inputNom">Nom</label>

            <?php
/*
            
            la ligne : <?= $_POST['nom'] ?? '' ?>
            est un racourci pour écrire :
            <?php 
            if(isset($_POST['nom'])) {
                echo $_POST['nom'];
            } else {
                echo ""
            } ?>

            C'est à dire : si il y a un index "nom" dans le tableau $_POST alors on l'écrit, sinon on ecrit rien

            Autrement dit : si il y a eu une erreur dans le nom (ex > à 10 caractères) alors on laisse le texte dans le champs
*/
?>
            
            <input value="<?= $_POST['nom'] ??
                '' ?>" name="nom" type="text" class="form-control <?php if (
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
            <label for="inputDescriptionEn" class="form-label mt-4">Description anglais</label>
            <textarea name="descriptionEn" class="form-control" id="inputDescriptionEn" rows="3"></textarea>
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
        </div><div class="form-group">
            <label class="col-form-label mt-4" for="inputUrlImage">URL image</label>
            <input name="url_image" type="text" class="form-control" placeholder="URL de l'image (ex: http://mon-site.com/image.jpg)" id="inputUrlImage">
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="col-form-label mt-4" for="inputFile">Fichier</label>
            <input 
                name="fichier" 
                type="file"
                class="form-control"
                id="inputFile">
        </div>


        <input type="submit" value="Ajouter l'article" class="btn btn-primary mt-4">

    </form>
</body>
</html>


