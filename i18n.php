<?php

function i18n($phrase)
{
    $langue = 'fr';
    //on récupère la langue dans la session de l'utilisateur
    if (isset($_SESSION['langue'])) {
        $langue = $_SESSION['langue'];
    }

    $traductions = [
        'en' => [
            'Accueil' => 'Home',
            'Ajout produit' => 'Add item',
            'Connexion' => 'Sign in',
            'Inscription' => 'Sign up',
            'Déconnexion' => 'Sign out',
            'Bienvenue' => 'Welcome',
            'Recherche' => 'Search',
        ]
    ];

    if ($langue == 'fr') {
        return $phrase;
    } else {
        return $traductions[$langue][$phrase];
    }
}

?>
