
# Synthèse de l'interview
## Les colonies
### Les essaims
Un essaim doit etre identifié de façon unique et avoir une fiche d'identité :

*  Souche, la race de la reine, sa couleur son age
*  L'éleveur d'origine , la prvenance de la reine ou de l'essaim
*  La date de création de l'essaim, sa douceur
*  La date de vente ou d'export dans une ruche

On doit également pouvoir consulter ses dates de nourrissement.

### Les ruches
Une ruche  possède une identification unique ainsi qu'une date de création. 
On doit pouvoir évaluer une ruche (étoile, note) en fonction de :

*  Sa force, pour une saison données (printemps/automne) 
*  Son volume (lecture des cadres du couvain), 
*  La tenue au cadre, 
*  La récole, l'hygiène, l'hivernage
Une photo du couvain peut etre associé.

Des actions peuvent etre effectuées sur les ruches :

*  Import/export d'essaim (suppression/extension) en indiquant la raison et la quantité de cadre
*  Historisation des transhumances (vers un rucher)

Pour plus de simplicité, un outil de duplication de ruche doit être disponible (par quantité ou à l'unité)

## Les ruchers
Un rucher est composé de ruches et d'essaims, il doit etre identifiable et localisable :

*  Identifiant , Nom
*  Adresse, Coords GPS

Les actions sur le rucher sont :

*  Le nourrissement, qui effectue un traitement par lot sur les ruches et les essaims (par sélection précise ou en globalité)
*  L'ajout et suppression de ruches/essaims, par scan (QRcode/RFiD) ou par saisie manuelle (Identifiant unique)
*  L'import/Export de ruches/essaims
*  La visualisation de son état, l'historique des différentes actions effectuées (Cartographie et/ou listing)

---

# DICTIONNAIRES DES DONNÉES

## COLONIES

### ESSAIMS
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|
|  id        |  int      |  Identification                  |
|  creation  |  date     |  Date de création de l'essaim    |
|  souche    |  varchar  |  Race/Couleur/Souche de la reine |
|  reine     |  year     |  Âge de la reine                 |
|  douceur   |  boolean  |  Douceur, agressive ou pas       |
|  origine   |  varchar  |  Éleveur/Origine                 |
|  export    |  date     |  Date de vente/export            |

### ESSAIMS_NOURRISSEMENT
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|
|  id        |  int      |                                  |
|  id_essaim |  int      |  Identifiant de l'essaim         |
|  date      |  date     |  Dates de nourrisement           |

### RUCHES
|  Colonne        |  Type     |  Description                    |
|  -------------  |:---------:|  ------------------------------:|
|  id             |  int      |  Identification de la ruche     |
|  creation       |  date     |  Date de création de la ruche   |
|  nombre_couvain |  int      |  Division/Extension             |
|  observation    |  varchar  |  Raison division/extension      |
|  id_rucher      |  int      |  Identifiant du rucher          |
|  transhumance   |  date     |  Date de transhumance           |

### RUCHES_COUVAIN
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|
|  id        |  int      |  Identification du couvain       |
|  id_essaim |  int      |  Identifiant du couvain          |
|  id_ruche  |  int      |  Identifiant de la ruche         |
|  date      |  date     |  Date Import/Export d'essaim     |

### RUCHES_EVALUATION
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|

*Évaluation de la ruche (étoiles, note, ...)*

*  Force de la ruche
    -  Quantité de cadre
        +  Saison 
            *  Printemps
            *  Automne
        +  Volume de la "ruche" par lecture des cadre du couvain
    -  Photo du couvain
    -  Tenue au cadre
    -  Récolte
    -  Hygiène
    -  Hivernage

### RUCHES_NOURRISEMENT
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|

## RUCHERS
|  Colonne   |  Type     |  Description                     |
|  --------  |:---------:|  -------------------------------:|

*Gestion des ruchers*

*  Identification du rucher
*  Nom du rucher
*  Lieu du rucher
    -  Adresse
    -  Coordonnées GPS
*  Nourrissement (affecte l'ensemble des ruches)
*  État du rucher
    -  Date des nourrissements
    -  Volume de nourrissement
    -  Nombre de ruches
    -  Liste des ruches
    -  Position des ruches dans le rucher
*  Date d'arrivée de chaque ruche dans le rucher concerné
*  Ajout/suppression de ruche
*  Import/Export vers un autre rucher
*  Cartographie
    -  Couche forestière/végétale
*  Scan du rucher
    -  Flashage de chaque ruche permettant l'import automatique d'une ruche dans un rucher
