const PRODUCTS_DATA = {
    // Collection Hommes
    "H_TSHIRT_PERF": {
        name: "T-Shirt Performance",
        description_short: "T-shirt technique à séchage rapide",
        price: "15 000 CFA",
        image: "../../images/tshirt.jpeg",
        description_long: "Conçu pour l'entraînement intensif, ce T-shirt en tissu technique évacue rapidement la transpiration et assure un confort optimal.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Bleu Marine", "Noir"],
            materiel: "Polyester technique 100%",
            fabrication: "Juillet 2024"
        }
    },
    "H_SHORT_TRAINING": {
        name: "Short de Training",
        description_short: "Short léger avec poches zippées",
        price: "18 000 CFA",
        image: "../../images/total-shape-lABFMWhnh4U-unsplash.jpg",
        description_long: "Idéal pour la salle de sport ou le running, il est doté de poches sécurisées par fermeture éclair et d'une taille élastique ajustable.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Gris", "Kaki"],
            materiel: "Nylon et Élasthanne",
            fabrication: "Mai 2024"
        }
    },
    "H_BASKETS_RUN": {
        name: "Baskets Running Elite",
        description_short: "Chaussures haute performance pour coureurs",
        price: "52 000 CFA",
        image: "../../images/baskethomme.jpg",
        description_long: "Technologie d'amorti avancée pour minimiser l'impact. Parfaites pour les longues distances.",
        details: {
            tailles: ["40", "41", "42", "43", "44"],
            couleurs: ["Noir/Orange", "Gris/Vert"],
            materiel: "Maille 3D, Semelle en caoutchouc",
            fabrication: "Avril 2024"
        }
    },
    "H_PANT_JOGGING": {
        name: "Pantalon de Jogging",
        description_short: "Pantalon confortable avec bandes latérales",
        price: "30 000 CFA",
        image: "../../images/pantalonjogging.jpg",
        description_long: "Un classique du confort, parfait pour l'échauffement ou la détente après l'effort. Tissu doux et épais.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Gris Clair", "Noir"],
            materiel: "Molleton Coton/Polyester",
            fabrication: "Août 2023"
        }
    },
    "H_VESTE_VENT": {
        name: "Veste Coupe-Vent",
        description_short: "Veste légère protection contre le vent",
        price: "45 000 CFA",
        image: "../../images/vestecoupevent.jpeg",
        description_long: "Légère et compacte, elle vous protège des intempéries sans vous surchauffer. Idéale pour le running matinal.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Rouge Vif", "Bleu Ciel"],
            materiel: "Nylon Ripstop déperlant",
            fabrication: "Mars 2024"
        }
    },
    "H_POLO_SPORT": {
        name: "Polo Sport Classique",
        description_short: "Polo élégant pour sport et loisir",
        price: "20 000 CFA",
        image: "../../images/polosport.jpg",
        description_long: "Un polo à la coupe classique, en tissu piqué respirant, parfait pour le golf ou le tennis.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Blanc", "Vert Forêt"],
            materiel: "Coton Piqué",
            fabrication: "Avril 2024"
        }
    },
    "H_SWEAT_PERF": {
        name: "Sweat Performance",
        description_short: "Sweat confortable pour échauffement",
        price: "38 000 CFA",
        image: "../../images/hautdesport.jpg",
        description_long: "Sweat à capuche zippé avec intérieur brossé doux pour un maximum de chaleur et de confort.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Noir", "Gris Chiné"],
            materiel: "Coton/Polyester",
            fabrication: "Septembre 2023"
        }
    },
    "H_CRAMPONS": {
        name: "Chaussures de Football",
        description_short: "Crampons pour terrain synthétique",
        price: "55 000 CFA",
        image: "../../images/crampons.jpg",
        description_long: "Crampons multi-surfaces offrant une excellente traction et un toucher de balle précis.",
        details: {
            tailles: ["40", "41", "42", "43", "44", "45"],
            couleurs: ["Jaune Fluo", "Bleu Roi"],
            materiel: "Synthétique texturé, Crampons TPU",
            fabrication: "Juin 2024"
        }
    },
    "H_DEBARDEUR": {
        name: "Débardeur Training",
        description_short: "Débardeur respirant pour musculation",
        price: "12 000 CFA",
        image: "../../images/equipementhomme.jpg",
        description_long: "Coupe ample et aérée, idéale pour les séances de musculation intenses ou les journées chaudes.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Blanc", "Rouge"],
            materiel: "Mesh respirant",
            fabrication: "Mai 2024"
        }
    },
    "H_SHORT_COMP": {
        name: "Short de Compression",
        description_short: "Short moulant pour récupération",
        price: "22 000 CFA",
        image: "../../images/shortcompression.jpg",
        description_long: "Améliore la circulation sanguine et réduit les vibrations musculaires. À porter sous un short de sport.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Noir"],
            materiel: "Polyester et Spandex",
            fabrication: "Février 2024"
        }
    },

    // Collection Femmes
    "F_CHAUSS_RUN": {
        name: "Chaussures de Running Pro",
        description_short: "Chaussures de course légères et confortables pour performances optimales",
        price: "45 000 CFA",
        image: "../../images/chaussurerunning.jpg",
        description_long: "Design adapté au pied féminin, offrant un excellent équilibre entre amorti et légèreté. Parfaites pour la route.",
        details: {
            tailles: ["36", "37", "38", "39", "40", "41"],
            couleurs: ["Blanc/Bleu", "Noir/Rose"],
            materiel: "Textile respirant, semelle en caoutchouc",
            fabrication: "Mars 2024"
        }
    },
    "F_LEGGING": {
        name: "Legging Sport Élégant",
        description_short: "Legging haute performance pour yoga et fitness",
        price: "25 000 CFA",
        image: "../../images/leggingfemme.jpg",
        description_long: "Tissu opaque et extensible qui sculpte la silhouette. Idéal pour les postures complexes et le confort au quotidien.",
        details: {
            tailles: ["XS", "S", "M", "L"],
            couleurs: ["Gris Anthracite", "Bordeaux"],
            materiel: "80% Nylon, 20% Spandex",
            fabrication: "Avril 2024"
        }
    },
    "F_BRASSIERE": {
        name: "Brassière de Sport",
        description_short: "Soutien optimal pour activités sportives intenses",
        price: "18 000 CFA",
        image: "../../images/brassierefemme.jpg",
        description_long: "Offre un soutien maximal sans compresser. Bretelles ajustables et dos nageur pour une liberté de mouvement totale.",
        details: {
            tailles: ["S", "M", "L"],
            couleurs: ["Noir", "Blanc", "Rose Pâle"],
            materiel: "Tissu anti-transpiration",
            fabrication: "Janvier 2024"
        }
    },
    "F_VESTE_COURSE": {
        name: "Veste de Course",
        description_short: "Veste coupe-vent légère et respirante",
        price: "38 000 CFA",
        image: "../../images/swratacapuchemieux.jpg",
        description_long: "Protection légère contre la pluie fine et le vent, avec des éléments réfléchissants pour courir en toute sécurité.",
        details: {
            tailles: ["S", "M", "L"],
            couleurs: ["Menthe", "Gris Perle"],
            materiel: "Polyester déperlant",
            fabrication: "Février 2024"
        }
    },
    "F_SHORT_SPORT": {
        name: "Short de Sport",
        description_short: "Short confortable pour entraînements",
        price: "15 000 CFA",
        image: "../../images/shortfemme.jpg",
        description_long: "Coupe décontractée avec sous-short intégré pour plus de confort et de sécurité pendant l'exercice.",
        details: {
            tailles: ["XS", "S", "M", "L"],
            couleurs: ["Noir", "Corail"],
            materiel: "Textile léger et fluide",
            fabrication: "Juin 2024"
        }
    },
    "F_TSHIRT_TECH": {
        name: "T-Shirt Technique",
        description_short: "T-shirt respirant à séchage rapide",
        price: "12 000 CFA",
        image: "../../images/maillottechniquefemme.jpg",
        description_long: "Idéal pour toutes les activités, il sèche ultra-rapidement et maintient une sensation de fraîcheur.",
        details: {
            tailles: ["S", "M", "L", "XL"],
            couleurs: ["Jaune", "Bleu Ciel"],
            materiel: "Mesh technique 100% Polyester",
            fabrication: "Mai 2024"
        }
    },
    "F_PANT_JOGGING": {
        name: "Pantalon de Jogging",
        description_short: "Pantalon confortable pour détente et sport",
        price: "28 000 CFA",
        image: "../../images/pantalonjogging.jpg",
        description_long: "Coupe fuselée et taille ajustable pour un look moderne et décontracté. Tissu doux et épais.",
        details: {
            tailles: ["XS", "S", "M", "L"],
            couleurs: ["Gris", "Bordeaux"],
            materiel: "Coton/Polyester",
            fabrication: "Septembre 2023"
        }
    },
    "F_BASKETS_TRAINING": {
        name: "Baskets Training",
        description_short: "Chaussures polyvalentes pour salle de sport",
        price: "42 000 CFA",
        image: "../../images/chaussurerunning.jpg",
        description_long: "Stabilité et flexibilité pour les entraînements en salle, le cross-training ou l'haltérophilie.",
        details: {
            tailles: ["36", "37", "38", "39", "40", "41"],
            couleurs: ["Noir/Blanc", "Gris/Rose"],
            materiel: "Maille renforcée",
            fabrication: "Décembre 2023"
        }
    },
    "F_SWEAT_CAP": {
        name: "Sweat à Capuche",
        description_short: "Sweat confortable pour échauffement",
        price: "35 000 CFA",
        image: "../../images/sweetsportfemme.jpg",
        description_long: "Tissu polaire doux et coupe ample pour un confort maximal avant ou après l'effort. Capuche doublée.",
        details: {
            tailles: ["S", "M", "L"],
            couleurs: ["Bleu Canard", "Beige"],
            materiel: "Coton/Polyester",
            fabrication: "Octobre 2023"
        }
    },
    "F_DEBARDEUR_SPORT": {
        name: "Débardeur Sport",
        description_short: "Débardeur léger pour entraînements intenses",
        price: "10 000 CFA",
        image: "../../images/ensemblesportfemme.jpg",
        description_long: "Léger, aéré et à séchage rapide, ce débardeur est essentiel pour les activités cardio.",
        details: {
            tailles: ["XS", "S", "M", "L"],
            couleurs: ["Orange Vif", "Gris Clair"],
            materiel: "Mesh Aéré",
            fabrication: "Avril 2024"
        }
    },

    // Collection Matériel
    "M_TAPIS_YOGA": {
        name: "Tapis de Yoga Premium",
        description_short: "Tapis antidérapant haute densité",
        price: "20 000 CFA",
        image: "../../images/tapisyoga2.jpg",
        description_long: "Épaisseur confortable et surface antidérapante. Facile à rouler et à transporter.",
        details: {
            tailles: ["Unique (183 x 61 cm)"],
            couleurs: ["Bleu", "Violet"],
            materiel: "TPE écologique",
            fabrication: "Février 2024"
        }
    },
    "M_HALTERES": {
        name: "Set Haltères 2x5kg",
        description_short: "Paire d'haltères avec revêtement néoprène",
        price: "35 000 CFA",
        image: "../../images/altere.jpg",
        description_long: "Revêtement qui assure une prise en main confortable et antidérapante, idéal pour le renforcement musculaire.",
        details: {
            tailles: ["2x5kg"],
            couleurs: ["Bleu"],
            materiel: "Fonte, Néoprène",
            fabrication: "Novembre 2023"
        }
    },
    "M_BANDES_RES": {
        name: "Bandes de Résistance",
        description_short: "Set de 5 bandes élastiques différentes résistances",
        price: "15 000 CFA",
        image: "../../images/banderesistance.jpeg",
        description_long: "Un set polyvalent pour le fitness, le yoga, la rééducation ou l'entraînement à domicile. Résistances progressives.",
        details: {
            tailles: ["Unique (5 niveaux)"],
            couleurs: ["Multiples"],
            materiel: "Latex naturel",
            fabrication: "Mars 2024"
        }
    },
    "M_CORDE_PRO": {
        name: "Corde à Sauter Pro",
        description_short: "Corde réglable avec compteur",
        price: "8 000 CFA",
        image: "../../images/cordeasauter.jpeg",
        description_long: "Idéale pour le cardio. Longueur ajustable et poignées ergonomiques avec un compteur de sauts intégré.",
        details: {
            tailles: ["Taille unique (réglable)"],
            couleurs: ["Noir/Rouge"],
            materiel: "PVC, Mousse",
            fabrication: "Janvier 2024"
        }
    },
    "M_BALLON_BASKET": {
        name: "Ballon de Basket",
        description_short: "Ballon de basketbultra résistant aux chocs",
        price: "18 000 CFA",
        image: "../../images/ballondebasket.jpg",
        description_long: "Conçu pour une utilisation intérieure et extérieure, offrant une excellente adhérence et durabilité.",
        details: {
            tailles: ["Taille 7"],
            couleurs: ["Orange Classique"],
            materiel: "Caoutchouc composite",
            fabrication: "Mai 2024"
        }
    },
    "M_KETTLEBELL": {
        name: "Kettlebell 12kg",
        description_short: "Kettlebell avec poignée ergonomique",
        price: "28 000 CFA",
        image: "../../images/kettlebell.jpg",
        description_long: "Idéale pour l'entraînement fonctionnel, la force et le cardio. Poignée lisse pour une prise en main confortable.",
        details: {
            tailles: ["12 kg"],
            couleurs: ["Noir"],
            materiel: "Fonte",
            fabrication: "Février 2024"
        }
    },
    "M_ROULEAU_MASSAGE": {
        name: "Rouleau de Massage",
        description_short: "Foam roller pour récupération musculaire",
        price: "12 000 CFA",
        image: "../../images/rouleaumassage.jpeg",
        description_long: "Indispensable pour l'auto-massage, il permet de relâcher les tensions et d'améliorer la récupération après l'effort.",
        details: {
            tailles: ["Unique (33 x 14 cm)"],
            couleurs: ["Noir/Orange"],
            materiel: "Mousse EVA",
            fabrication: "Mars 2024"
        }
    },
    "M_GANTS_MUSCU": {
        name: "Gants de Musculation",
        description_short: "Gants renforcés avec support poignet",
        price: "10 000 CFA",
        image: "../../images/gantsmuscu.jpg",
        description_long: "Protègent vos mains des callosités et offrent un support pour les poignets lors des levées lourdes.",
        details: {
            tailles: ["M", "L", "XL"],
            couleurs: ["Noir"],
            materiel: "Cuir synthétique, Néoprène",
            fabrication: "Mars 2024"
        }
    },
    "M_GANTS_BOXE": {
        name: "Gants de boxe",
        description_short: "Confortable et ajustable",
        price: "25 000 CFA",
        image: "../../images/gantdeboxe.jpg",
        description_long: "Gants rembourrés pour un entraînement sécurisé et confortable. Fermeture velcro rapide et ajustable.",
        details: {
            tailles: ["10 oz", "12 oz"],
            couleurs: ["Rouge", "Bleu"],
            materiel: "Cuir PU",
            fabrication: "Mai 2024"
        }
    },
    "M_BOUTEILLE": {
        name: "Bouteille Sport 1L",
        description_short: "Gourde isotherme sans BPA",
        price: "5 000 CFA",
        image: "../../images/bouteille.jpeg",
        description_long: "Bouteille réutilisable, légère et résistante. Bouchon sport pour une hydratation facile.",
        details: {
            tailles: ["1 Litre"],
            couleurs: ["Transparente"],
            materiel: "Plastique Tritan sans BPA",
            fabrication: "Avril 2024"
        }
    }

};
