
# Synthèse de l'interview
https://lite6.framapad.org/p/mellifera-transcription

## Les colonies
### Les essaims
Un essaim doit etre identifié de façon unique et avoir une fiche d'identité :

*  Souche, la race de la reine, sa couleur son age
*  L'éleveur d'origine , la provenance de la reine ou de l'essaim
*  La date de création de l'essaim, sa douceur
*  La date de vente ou d'export dans une ruche

On doit également pouvoir consulter ses dates de nourrissement.

### Les ruches
Une ruche possède une identification unique ainsi qu'une date de création. 
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

### REINES
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  souche         |  varchar  |  Race/Couleur/Souche de la reine  |
|  reine          |  year     |  Âge de la reine                  |
|  origine        |  varchar  |  Éleveur/Origine                  |
|  photo          |  varchar  |  Photo de la reine                |

### REINES_ESSAIMS
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  id_reine       |  int      |  Identifiant de la reine          |
|  id_essaim      |  int      |  Identifiant de l'essaim          |
|  date           |  date     |  Dates d'association              |

### ESSAIMS
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  creation       |  date     |  Date de création de l'essaim     |
|  douceur        |  boolean  |  Douceur, agressive ou pas        |
|  export         |  date     |  Date de vente/export             |

### RUCHES
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  creation       |  date     |  Date de création de la ruche     |
|  observation    |  varchar  |  Raison division/extension        |
|  transhumance   |  date     |  Date de transhumance             |
|  date           |  date     |  Dates de nourrisement            |
|  statut         |  enum     |  Hivernage/Stimulation/Prod.      |

### RUCHES_EVALUATION
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  nombre_couvain |  int      |  Division/Extension               |
|  fecondite      |  int      |  Note /10                         |
|  dynamisme      |  int      |  Note /10                         |
|  douceur        |  int      |  Note /10                         |
|  tenu_cadre     |  int      |  Note /10                         |
|  hygiène        |  int      |  Note /10                         |
|  recolte_prt    |  int      |  Note /10                         |
|  recolte_ete    |  int      |  Note /10                         |
|  hivernage      |  int      |  Note /10                         |
|  date           |  date     |  Date de l'évaluation             |
|  id_ruche       |  int      |  Identifiant de la ruche          |
*Évaluation de la ruche (étoiles, note, ...)*

### RUCHES_NOURRISEMENT
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  quantite       |  float    |  Volume du nourrissement          |
|  date           |  date     |  Date du nourrissement            |
|  observ.        |  text     |  Observation nourrissement        |
|  id_ruche       |  int      |  Identifiant de la ruche          |

### RUCHES_RECOLTE
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  quantite       |  float    |  Volume de la récolte             |
|  observ.        |  text     |  Observation récolte              |
|  date           |  date     |  Date de la récolte               |
|  id_ruche       |  int      |  Identifiant de la ruche          |


## RUCHERS
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  nom            |  varcher  |  Nom du rucher                    |
|  lieu           |  varchar  |  Nom du lieu                      |
|  lat            |  double   |  Latitude                         |
|  lng            |  double   |  Longitude                        |

## RUCHERS_RUCHES
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  id_rucher      |  int      |  Identifiant du rucher            |
|  id_ruche       |  int      |  Identifiant de la ruche          |
|  position       |  varchar  |  Indication position de la ruche  |
|  date           |  date     |  Date d'affectation de la ruche   |

