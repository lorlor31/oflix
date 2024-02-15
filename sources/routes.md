# Routes de l'application

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Bienvenue sur O'flix | Page d'accueil |
| `/movie` | `GET`        | `MovieController` | `list`  | Liste des films disponibles | liste de tous le films |
| `/movie/{id}` | `GET`        | `MovieController` | `show`  | Détail du movie | détail du film dont l'id est fourni en url |
| `/favorites/{id}` | `GET`        | `MovieController` | `favoritesAdd`  | - | ajoute le film en session et redirige vers la page /favorites |
| `/favorites/remove/{id}` | `GET`        | `MovieController` | `favoritesRemove`  | - | supprime le film en session et redirige vers la page /favorites |
| `/favorites` | `GET`        | `MovieController` | `favorites`  | Mes films favoris | Liste des films favoris sélectionnés par l'utilisateur |

