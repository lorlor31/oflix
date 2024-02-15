# installation

## installation avec composer

```bash
# installation de symfony skeleton
composer create-project symfony/skeleton
# facultatif déplacer les fichiers dans le repo actuel
mv skeleton/* ./
mv skeleton/.* ./
rmdir skeleton
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
