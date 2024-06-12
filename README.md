# Développement d'une application Web de consultation de séries télévisées

## Auteurs
Rysman Karim (rysm0002)
Deutsche Sacha (deut0005)

## Serveur Web Local

Entrer la commande pour lancer le serveur :
```shell
composer start:linux
```
ou pour le lancer sur windows :
```shell
composer start:windows
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

## Fonctionnement du site
- ### Les filtres
  Vous ne pouvez sélectionner qu'un filtre à la fois et dès que vous cliquez sur un filtre vous avez directement
  la sélection des films via le filtre.
- ### Les séries
    - Quand vous cliquez sur une série vous avez la description du film avec son affiche à gauche et son nom en haut de la page
      ainsi qu'à droite au dessus de la description avec son titre original.
    - En dessous de la description vous avez les différentes saisons de la série
- ### Les saisons
  Les saisons vous amènent aux épisodes qui sont donnés par la numérotation et le titre de l'épisode sur la même
  ligne et leur description en dessous. Vous pouvez revenir sur la page de la série en cliquant sur le nom de la 
  série en haut à droite.