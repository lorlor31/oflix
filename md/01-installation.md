# Installation

## TLDR

```bash
# installation de symfony
composer create-project symfony/skeleton

# Eventuellement déplacer les fichiers
mv skeleton/* ./
mv skeleton/.* ./
rmdir skeleton

# création du fichier de configuration
touch .env.local

# installation des composants de base pour une app web
# a terme on utilisera `composer require webapp`
composer require symfony/apache-pack twig symfony/asset symfony/orm-pack symfony/form symfony/validator

# les composants à installer en dev
composer require symfony/profiler-pack
composer require --dev symfony/debug-bundle symfony/maker-bundle

# ajout de la configuration de BDD dans le .env.local, 
# MODIFIER le nom de la bdd et la version de mariadb
echo "DATABASE_URL=\"mysql://explorateur:6q595XmCKm@127.0.0.1:3306/LE_NOM_DE_MA_BDD?serverVersion=10.3.39-MariaDB&charset=utf8mb4\"" > .env.local
bin/console doctrine:database:create
```

## Installation avec composer

```bash
# installation de symfony skeleton
composer create-project symfony/skeleton
# facultatif déplacer les fichiers dans le repo actuel
mv skeleton/* ./
mv skeleton/.* ./
rmdir skeleton
# création du fichier de configuration en local
touch .env.local
```

## Pour accéder avec apache

On installe le symfony/apache-pack

```bash
composer require symfony/apache-pack
```

## Installation de Twig

```bash
composer require twig
composer require symfony/asset
```

## WDT (Web Debug Toolbar)

Installation de la WDT ( visible dans une page contenant une balise `body` )

```bash
composer require symfony/profiler-pack
# pour integrer le var_dumper à twig
composer require --dev symfony/debug-bundle
```

## Maker

Le maker génère une base de code prête à l'emploi

```bash
composer require --dev symfony/maker-bundle
```

## Installation de Doctrine

```bash
composer require symfony/orm-pack
# créer la BDD
bin/console doctrine:database:create
```

Habituellement on va :

- modifier nos entités `bin/console make:entity`
- générer une migration `bin/console make:migration`
- appliquer la migration `bin/console doctrine:migration:migrate`

## Symfony/form

### Installation de Symfony/form

```bash
composer require symfony/form
```

### Création de la classe de formulaire

```bash
bin/console make:form
```

N'hésitez pas à ajouter / supprimer / modifier la configuration générée par le maker.

La liste de [tous les types est disponible ici](https://symfony.com/doc/current/reference/forms/types.html)

### Affichage d'un formulaire

- Dans le controller :
  1. instancier un objet de la classe FormType créé précédemment
  2. fournir cet objet à la vue
- Dans la vue :
  - Utiliser [les fonctions helper de Twig](https://symfony.com/doc/current/form/form_customization.html#form-functions-and-variables-reference) pour afficher le formulaire.
    - on utilisera principalement `form_start`, `form_end` et `form_row`

Pour demander au composant form de générer du HTML compatible avec boostrap.
Ajouter dans la configuration

```yml
# config/packages/twig.yaml
twig:
    form_themes: ['bootstrap_5_layout.html.twig']
```

### Validation des données

La liste des [contraintes existantes](https://symfony.com/doc/current/validation.html#constraints)

- Installer le composant symfony/validator `composer require symfony/validator`
- Ajouter les contraintes
  - sur l'entité directement
  - ou dans le FormType
