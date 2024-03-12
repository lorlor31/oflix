# MCD des Jellys

à visualiser sur mocodo.net

```raw
:
SEASON: code season, number, episode_count
has season , 0N SHOW, 11 SEASON
:
:

GENRE : name
belongs_to, 1N SHOW, 0N GENRE
SHOW : code show, title, duration, poster, summary, synopsis, rating, type, release_year, country
appears in, 1N SHOW, 1N PERSON: role, credit_order
:

:
:
is_favorite, 0N SHOW, 0N USER
PERSON : code person, firstname, lastname
:

:
:
USER: pseudo, password, role, favorite_theme
:
:

```

## relation avec attribut

Avec Doctrine, on ne sait pas faire de relation avec attribut. Par contre une relation avec un attribut ressemble beaucoup à une entité.

Du coup la relation entre Show et Person devient une entité

```raw
SHOW : code show, title, duration, poster, summary, synopsis, rating, type, release_year, country
:
:

casts, 11 CASTING, 0N SHOW
CASTING: role, credit_order
:

:
plays, 11 CASTING, 0N PERSON
PERSON : code person, firstname, lastname
```
