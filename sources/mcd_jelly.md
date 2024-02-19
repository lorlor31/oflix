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
appears in, 1N SHOW, 1N PERSON: role
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
