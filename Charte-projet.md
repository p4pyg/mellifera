# Lettre de cadrage

## Rappel du contexte
L'objectif général du projet est de proposer une solution d'infogérance apicole.
La demande principale est le suivi et l'historique de la vie d'une ruche pour une meilleure gestion des transhumances. 
Les transhumances sont organisées autour de la floraison et du rythme des saisons.
La partie "Back-office", s'incrit donc dans un projet de plus grande envergure où chaque partie doit se rendre interopérable avec les autres.

## Enjeux et spécificités

À partir du "Back-office", l'utilisateur doit pouvoir :

*  S'authentifier et modifier les paramètres de son compte.
*  Gérer les paramètres :
    -  Paramètres de l'application mobile ???
    -  Paramètres de l'application back    -office

*  Préparer ses interventions sur un rucher
    -  Un document au format PDF à imprimer contenant une check    -list des actions à réaliser
*  Générer des étiquettes
    -  Un document PDF à imprimer contenant les identifiant de chaque ruche et son QRcode/BarCode? 
*  Administer les colonies
    -  Gérer les reines
    -  Gérer les essaims
        +  Création/Modification/Suppression d'essaim
        +  Fiche d'identité (souche, couleur de la reine, origine, age, douceur, ...)
        +  Voir les nourrissements (date et caractéristiques du nourrissement)
        +  Affectation/Désaffectation à une ruche ou mise en vente
    -  Gérer les ruches
        +  Création/Modification/Suppression de ruche
        +  Fiche d'identité (identifiant unique, couvain...)
        +  Import export d'essaim
        +  Affectation/Désaffectation à un rucher
        +  Voir les nourrissements  (date et caractéristiques du nourrissement)
        +  Voir/Ajuster les évaluations (force, volume, tenue au cadre...)
*  Administration des ruchers
    -  Création/Modification/Suppression de rucher
    -  Fiche d'identité (identifiant, localisation, nom,...)
    -  Import export de ruche/essaim
    -  Gérer la transhumance
    -  Voir l'état des nourrissements
*  Visualiser l'historique des précédents lieux d'exploitation (ruchers)


Les discussions ont amené à distinguer 4 entités majeures pour ce point  : _Reines_, _Essaims_, _Ruches_, _Ruchers_. 
Et ce en suivant le shéma : Un rucher possède des ruches, les ruches sont composées d'essaims, un essaim à une reine.
Il y avait débat sur l'entité Reine, qui a fini par justifier sa présence suite à la volonté de traçabilité des opérations pour l'aspect "Élevage".

## Rôles et responsabilités

L'équipe se compose de 3 membres :

*  Cyril
*  Yoann
*  Laurent

Yoann est présenti comme responsable du projet, il conduira le projet. 
Pendant la phase d'analyse Cyril est affecté à l'aspect documentation et rédaction des compte-rendus. Laurent sera en charge de la partie logistique en mettant à disposition des outils de travail, méthodologie et soutiens à l'utilisation.
Ces rôles peuvent bien entendu être revu en fonction de la charge de travail et des disponibilités de chacun.

Durant la phase de développement et pour que chaque membre travaille sur l'ensemble du projet, une rotation pourra être mise en place (revue de code comprise) entre les trois grands domaines impliqués :

*  Développement Back-end
*  Développement Front-end
*  Intégration

## Méthodologie
Le livrable final se compose du source du projet, de sa documentation et d'une plaquette de présentation.

L'idée ici est de pouvoir alimenter et gérer l'ensemble des données au travers d'une interface web simple et ergonomique.
Étant donné que le back-office doit pouvoir être exploité à partir d'appareils mobiles, un soin particulier sera apporté à l'interface afin que l'utilisateur considère l'action comme avantageuse (Responsive Design, Material design).

Afin d'optimiser l'avancement du projet, la méthode Agile appliquée au développement peut être envisagée. L'idée est ici de découper le projet par fonctionnalités autonomes et :

*  produire le source PHP (+ tests) et réaliser le template HTML5/JS( + test) en parallèle,
*  réaliser l'intégration et tester le fonctionnement.
*  réaliser la documentation et alimenter la plaquette de présentation



## Synthèse