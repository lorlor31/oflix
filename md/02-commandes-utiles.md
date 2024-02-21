# Les commandes utiles

## Debug

| commandes | Description |
| --- | ------------ | 
| `bin/console debug:router` | pour afficher les routes |

## Maker

| commandes | Description |
| --- | ------------ |
| `bin/console make:controller` | pour générer un controller |
| `bin/console make:entity` | pour générer une entité |
| `bin/console make:migration` | pour générer les fichiers de migration |

## Doctrine

| commandes | Description |
| --- | ------------ |
| `bin/console doctrine:database:create` | pour créer la BDD |
| `bin/console make:migration` | pour générer les fichiers de migration |
| `bin/console doctrine:migration:migrate` | pour appliquer les migrations dans la BDD |
| `bin/console doctrine:database:drop` | pour supprimer la BDD |
| `bin/console doctrine:schema:validate` | pour valider une modification faite à la main |

### En cas de migration qui échoue

! PAS DE PANIQUE !

1. Repérer la requête qui a échoué
    - vérifier requête par requête si elle a été appliquée
2. Comprendre pourquoi la requête a échoué
    - par exemple une clef étrangère ne s'applique pas
3. Créer des requêtes pour corriger le problème et les ajouter dans la migration
4. Une fois le problème corrigé, terminer d'appliquer la migration "à la main" ( = jouer les requêtes suivantes dans la BDD )
5. Vérifier que les requêtes que l'on a ajouté vont bien être annulé si la fonction down est appliquée
6. Enregistrer la migration dans la table `doctrine_migration_versions`
