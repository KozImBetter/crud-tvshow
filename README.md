# Développement d'une application Web de consultation de séries télévisées

## Auteurs
Rysman Karim (rysm0002)
Deutsche Sacha (deut0005)

## Serveur Web Local

Entrer la commande pour lancer le serveur :
```shell
composer start:linux
```


## Style de Codage

Pour vérifier la validité d'un fichier, PHP CS Fixer est utilisé.

La commande suivante affiche les fichiers réparables :
```shell
composer run-script test:cs
```

Celle-ci permet de constater les différences entre l'original et la correction :
```shell
php vendor/bin/php-cs-fixer fix --dry-run
```

Enfin la modification se fait avec la commande :
```shell
composer run-script fix:cs
```

## Configuration de base de données

L'utilisation d'un fichier .mydo.ini permet de donner un accès à la base de données
pour tous les programmes sans entrer de ligne spécifique dans chaque fichier.