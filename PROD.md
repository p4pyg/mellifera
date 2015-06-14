# MISE EN PRODUCTION

## Pré-requis

*  Installation de Robo 
*  Télécommandes Git configurées pour :
    -  GitLab
    -  Serveur production
    -  GitHub

_Merci de me contacter avant d'effectuer les procédures suivantes:_

*  _Le dépot GitHub permet d'automatiser un audit qualité sur le code produit, un hook et configuré pour déclencher un scan par SensioLabsInsight et produire un rapport. L'icône SensioLabsInsight du README.md est mise à jour au terme de l'audit. Il est bien évidemment nécessaire de créer un compte GitHub et de faire une demande de rattachement au compte principal_

*  _Concernant la télécommande du serveur "Production", il est obligatoire d'enregistrer vos clés SSH publiques dans le fichier ./ssh/authorized\_keys du VPS._

### Mode d'installation recommandée

    # cd /opt
    # wget http://robo.li/robo.phar
    # chmod +x robo.phar && mv robo.phar /usr/bin/robo

## Éxécution

La mise en production peut être automatisée en utilisant l'éxécuteur de tâches Robo.
À la racine du projet se trouve un fichier PHP RoboFile.php contenant quelques tâches.

Pour connaitre la liste des tâches implémentées, ouvrez un terminal et placez pour à la racine du projet.

Saisissez la commande :

`robo --list`
