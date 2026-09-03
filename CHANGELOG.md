# Journal des modifications (CHANGELOG)

Toutes les modifications notables de ce projet sont consignées dans ce fichier.

## [v0.10.0] - Routeur HTTP fonctionnel
### Ajouté
- Classe `Router` permettant l'enregistrement des routes HTTP (`GET`, `POST`).
- Résolution des requêtes et extraction des paramètres dynamiques (`/copies/{id}`).
- Gestion des routes inexistantes avec page d'erreur HTTP 404.
- Configuration du Front Controller dans `public/index.php` et fichier `.htaccess`.
- Script de test du routeur `tests/testRouter.php`.

## [v0.9.0] - Contrôleur MVC des copies
### Ajouté
- Classe `CopieExamenController` orchestrant les interactions utilisateur.
- Action `create` pour afficher le formulaire de soumission.
- Action `store` pour traiter la soumission, instancier le DTO et appeler le service.
- Actions `index` et `show` pour lister et afficher le détail d'une copie.
- Gestion des erreurs de validation et d'exécution avec codes HTTP adaptés (422, 500).

## [v0.8.0] - Vues MVC du système de notation
### Ajouté
- Vues HTML structurées avec échappement de sécurité (`htmlspecialchars`).
- Formulaire de soumission (`template/copies/create.php`).
- Liste des copies enregistrées (`template/copies/index.php`).
- Détail d'une copie d'examen (`template/copies/show.php`).
- Pages d'erreur générique et 404 (`template/error/404.php`, `template/error/error.php`).
- Layout commun réutilisable (`template/layout/header.php`, `template/layout/footer.php`).

## [v0.7.0] - Service de soumission des copies
### Ajouté
- Classe `SoumissionCopieService` orchestrant la validation, le calcul de la note et la persistance.
- Tests d'intégration du service applicatif (`tests/testService.php`).

## [v0.6.0] - Persistance des copies
### Ajouté
- Interface `CopieExamenRepositoryInterface` et implémentation `PdoCopieExamenRepository`.
- Méthodes `save()`, `findAll()` et `findById()` avec requêtes SQL préparées.

## [v0.5.0] - Stratégie de calcul des notes
### Ajouté
- Pattern Strategy avec `CalculNoteInterface` et `CalculNoteAvecRetardService`.
- Calcul des pénalités de retard (-2 points si dépôt après la date limite) avec plancher à 0.
- Tests unitaires de la stratégie de calcul (`tests/testCalculNote.php`).

## [v0.4.0] - Transport des données de soumission (DTO)
### Ajouté
- Objet `SoumettreCopieDTO` pour transporter et valider les données du formulaire.
- Validateurs `NoteValidator` et utilitaires de date `DateUtils`.

## [v0.3.0] - Configuration de la base de données
### Ajouté
- Schéma SQL de la table `copies` (`database/schema.sql`).
- Connexion singleton PDO sécurisée via variables d'environnement (`.env`).

## [v0.2.0] - Modélisation des documents universitaires
### Ajouté
- Classe abstraite `AbstractDocument` et entité concrète `CopieExamen`.
- Encapsulation des données et règles métier (notes entre 0 et 20).

## [v0.1.0] - Préparation de l'application
### Ajouté
- Organisation modulaire du projet (MVC / Architecture propre).
- Point d'entrée `public/index.php` et configuration de l'autoloader Composer.

## [v0.0.0] - Initialisation du dépôt
### Ajouté
- Initialisation de Git, branche `main`, `.gitignore` et premier README.
