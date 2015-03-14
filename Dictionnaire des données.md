
# DICTIONNAIRES DES DONNÉES

### REINES
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  souche         |  varchar  |  Race/Couleur/Souche              |
|  age            |  year     |  Année de naissance               |
|  origine        |  varchar  |  Éleveur/Origine                  |
|  clippage       |  enmum    |  Non, droite, gauche              |
|  photo          |  varchar  |  Photo                            |

### REINES_ESSAIMS
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  id_reine       |  int      |  Identifiant de la reine          |
|  id_essaim      |  int      |  Identifiant de l'essaim          |
|  date           |  date     |  Dates d'association              |

### REINES_EVALUATION
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  id_reine       |  int      |  Identifiant de la reine          |
|  id_essaim      |  int      |  Identifiant de l'essaim          |
|  note           |  int      |  Note / 10                        |
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
|  type           |  varchar  |  Type de ruche                    |
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
|  altitude       |  int      |  Altitude du rucher               |
|  lat            |  double   |  Latitude                         |
|  lng            |  double   |  Longitude                        |
|  vegetation     |  varchar  |  Type de végétation dominante     |

## RUCHERS_RUCHES
|  Colonne        |  Type     |  Description                      |
|  -------------  |:---------:|  --------------------------------:|
|  id             |  int      |  Identifiant                      |
|  id_rucher      |  int      |  Identifiant du rucher            |
|  id_ruche       |  int      |  Identifiant de la ruche          |
|  position       |  varchar  |  Indication position de la ruche  |
|  date           |  date     |  Date d'affectation de la ruche   |

