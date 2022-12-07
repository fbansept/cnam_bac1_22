
--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `url_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `url_image`) VALUES
(1, 'Télé HD', 'LG télévsieur professionnel 43 43UT662H 4K UHD SANS PIEDS| | | |Caratéristiques principales:| |Taille : 43 |Diagonale de l\'image (cm) : 109 |Résolution native : 3840x2160 |Luminosité (cd/m2) : 300 |Enceintes : 10W + 10W |Entrée(s) HDMI : OUI |Port USB : oui |Poids avec support (kg) : 11,2 |973 x 626 x 303 mm | |SANS PIEDS |', '2999.99', 'https://cdn.cnetcontent.com/21/08/2108964c-274f-488f-921f-3a0433e3af2c.jpg'),
(2, 'home cinéma', 'Cet ensemble Denon Bundle fait de votre salon un véritable cinéma, en vous proposant tout ce dont vous avez besoin pour une véritable expérience cinéma. En plus, vous pouvez à tout moment l’enrichir des haut-parleurs arrière Dolby Atmos REFLEKT. Faites des économies face à des achats séparés.', '500.00', 'https://res.cloudinary.com/lautsprecher-teufel/image/upload/c_fill,f_auto,q_auto,w_800/v1/products/Ultima_40_Surround_Mk3/Ultima-40-Surround-AVR-Denon-2700-black-Set.jpg'),
(3, 'Télécommande', 'CONTROL 2.1\r\n\r\nTélécommande universelle pour 1 TV + 1 décodeur TNT ou satellite.\r\n\r\nTélécommande à infrarouge préprogrammée\r\n\r\n100 % des fonctions de la télécommande d’origine', '21.99', 'https://cdn2.narbonneaccessoires.fr/media/cdn/cache/product/400/auto/01-PD00TCG7-T%C3%A9l%C3%A9commande%20pour%20t%C3%A9l%C3%A9viseur-pd00tcg7-pa.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `administrateur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `administrateur`) VALUES
(1, 'toto', 'tata', 0),
(2, 'franck', 'root', 1),
(3, 'titi', 'tutu', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);
