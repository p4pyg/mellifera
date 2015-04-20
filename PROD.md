# MISE EN PRODUCTION
La mise en production n'est pas automatique.
Même après avoir "merge" votre branche avec la branche master sur le dépot gitlab, le serveur de production ne prend pas en compte ces modifications, une manipulation supplémentaire est nécessaire.

## Configuration d'une télécommande de mise en production
Sur votre poste de travail, configurez une nouvelle télécommande :
`git remote add prod ssh://mellifera@ip.server.prod:port/home/mellifera/mellifera-pro.git`

Puis vous pouvez pousser la branche "master" sur le serveur de production :
`git push prod master`

Un mot de passe vous est demandé, c'est normal, le fonctionnement diffère du dépôt GitLab, ici pas de clé SSH pour l'authentification (restons simple)
Une fois authentifié, la procédure de mise en production s'effectue. La mise à jour du répertoire web est automatisée. Vous pouvez joindre http://backoffice.mellifera.cu.cc avec votre navigateur préféré.

> Les ip, port et mot de passe vous seront communiqués par e-mail.
> En cas d'oubli ou de problème, merci de me contacter : laurent@impermanenceweb.fr
