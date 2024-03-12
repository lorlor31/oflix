# Les voters

## STEP - 01 

`php bin/console make:voter "nom du voter"`

La convention veut que le voter porte le nom de l'entité liée au voter, s'il n'y a pas d'entité lié comme pour notre backOfficeVoter, donnez un nom implicite et pertinant

## STEP - 02

Pour que symfony appel les voters il va falloir dans le controller ou il y aura le controle d'accès utiliser l'attribut IsGranted :

```php
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('edit', 'post')]
```

Pour faire le lien entre le isGranted et notre voter il faut dans le voter en question définir des actions :

```php
const EDIT = 'edit';
 if (!in_array($attribute, [self::EDIT])) {
    return false;
}
```

On voit plus haut que edit et isGranted("edit") permet de faire le lien entre le voter et le controller

## STEP - 03

Si le voter est déclenché car il y a une concordance entre le isGranted du controller et le if !in_array la fonction `voteOnAttribute` va déterminer si l'utilisateur a le droit ou non d'accéder.

```php
// ... (check conditions and return true to grant permission) ...
switch ($attribute) {
    case self::EDIT:
        // return true;
        break;
}
```