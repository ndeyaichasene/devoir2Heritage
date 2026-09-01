# Partie 0

------------------------------
## 1. Pourquoi le dossier /vendor ne doit-il pas être versionné ?
Le dossier /vendor contient les dépendances externes installées par Composer. Il doit être exclu de Git (via le fichier .gitignore) pour trois raisons principales :

* Poids inutile et pollution : Ce dossier contient des milliers de fichiers de bibliothèques tierces. Le versionner alourdit inutilement le dépôt Git, ralentit les commandes (git status, git clone) et pollue l'historique des modifications.
* Redondance du code : Les paquets que vous utilisez possèdent déjà leurs propres dépôts officiels. Il n'y a aucun intérêt à stocker une copie de leur code dans le vôtre.
* Le fichier composer.lock fait déjà le travail : Ce fichier enregistre les versions exactes de chaque dépendance installée. Vos collaborateurs ou vos serveurs de production n'ont qu'à exécuter la commande composer install pour recréer à l'identique le dossier /vendor.

------------------------------
## 2. Quelle différence existe entre un commit et un tag ?
Bien qu'ils soient tous deux liés à l'historique du code, ils ont des rôles très différents :

* Un commit est une photo de l'état du code à un instant T. C'est l'unité de base de Git. Il représente un changement précis (ajout d'une fonction, correction d'un bug) et possède un identifiant unique (un hash SHA-1 comme a1b2c3d). L'historique est une suite de commits.
* Un tag (étiquette) est un repère fixe nommé qui pointe vers un commit spécifique. On l'utilise généralement pour marquer une étape majeure, comme la sortie d'une version stable de l'application (ex: v1.0.0, v2.4.1). Contrairement aux branches, un tag ne bouge plus jamais une fois créé.

En résumé : On fait des dizaines de commits par jour pour travailler, et on pose un tag de temps en temps pour publier une version officielle.
------------------------------
## 3. Pourquoi la branche main doit-elle rester stable ?
La branche main est la colonne vertébrale de notre projet. Elle doit impérativement rester stable pour les raisons suivantes :

* Prête pour la production : Tout code présent sur main doit pouvoir être déployé en production à n'importe quel moment sans casser le site ou l'application pour les utilisateurs finaux.
* Référence absolue pour l'équipe : C'est à partir de main que les développeurs créent leurs nouvelles branches de travail (feature-xyz). Si main contient des bugs, chaque développeur va importer ces bugs dans son propre travail, ce qui paralyse l'équipe.
* Automatisation (CI/CD) : Les outils modernes de déploiement automatique déclenchent souvent la mise en ligne dès qu'un changement est validé sur main. Un code instable sur cette branche provoquerait immédiatement une panne en ligne.


# Partie 1


## 1.Pourquoi placer index.php dans un dossier public ?

Placer index.php dans un dossier /public (parfois nommé /web ou /html) est une mesure de sécurité fondamentale pour isoler le code source du web.

* Sécurité des fichiers : Le serveur web (Apache, Nginx) est configuré pour pointer directement dans ce dossier /public. Cela signifie que les internautes peuvent uniquement accéder aux fichiers situés dans ce dossier.

* Inaccessibilité du code source : Vos scripts PHP sensibles, vos fichiers de configuration (contenant les mots de passe de base de données), et vos dépendances (/vendor) se trouvent un niveau au-dessus (à la racine du projet). Ils sont techniquement invisibles et inaccessibles depuis un navigateur, éliminant le risque qu'un client lise votre code source.

## 2.Pourquoi toutes les requêtes devraient-elles passer par ce fichier (index.php) ?

C'est le design pattern du Front Controller (Contrôleur Unique). Au lieu d'avoir des dizaines de fichiers accessibles (comme contact.php, articles.php), le serveur redirige absolument toutes les URLs (grâce à un fichier .htaccess ou une règle Nginx) vers l'unique fichier index.php.Cela offre des avantages majeurs :

* Point d'entrée unique : Vous centralisez les tâches répétitives au même endroit : charger l'autoloader de Composer, démarrer la session, vérifier si l'utilisateur est connecté, et initialiser les paramètres de sécurité.

* Routage flexible : C'est un script PHP (le Routeur) qui analyse l'URL demandée (ex: /article/42) et décide dynamiquement quel contrôleur et quelle fonction exécuter. Vous obtenez ainsi des "URLs propres" (sans .php à la fin).

* Maintenance simplifiée : Si vous devez ajouter un système de maintenance ou un pare-feu sur tout le site, vous n'avez qu'un seul fichier à modifier.

## 3. Quels éléments ne devraient jamais se trouver dans le dossier public ?

Le dossier public ne doit contenir que des ressources destinées à être téléchargées ou lues directement par le navigateur de l'utilisateur.Ne doivent jamais s'y trouver :

* Le code source de l'application : Vos classes, vos routeurs, vos contrôleurs, vos modèles et vos scripts de logique métier.
* Les fichiers de configuration et d'environnement : Les fichiers .env, config.php ou parameters.yaml qui contiennent les clés d'API et les identifiants de connexion.
* Les dépendances : Le dossier /vendor de Composer.
* Les templates / vues de rendu : Les fichiers Twig, Blade ou fichiers HTML/PHP bruts qui servent de squelettes graphiques (ils doivent être compilés ou inclus par PHP en amont).
* Les sauvegardes et logs : Les fichiers de base de données (.sql) ou les journaux d'erreurs de l'application.

## 4. Comment répartir les responsabilités entre les dossiers ?

Dans une architecture PHP professionnelle (inspirée du MVC et de l'architecture propre), l'arborescence type sépare strictement les rôles :

├── config/             # Configuration de l'application (routes, base de données)
├── src/                # Le cœur de votre application (Code Source unique)
│   ├── Controller/     # Reçoit la requête, demande les données, et retourne la réponse
│   ├── Model/ (ou Entity)# Représente la structure des données (ex: classe User)
│   └── Service/        # Contient la logique métier lourde (ex: envoi d'email, calculs)
├── templates/          # Les fichiers de rendu (HTML / Twig) injectés par les contrôleurs
├── vendor/             # Les bibliothèques tierces installées par Composer
└── public/             # Le SEUL dossier accessible depuis le web
    ├── css/            # Feuilles de style
    ├── js/             # Scripts JavaScript
    ├── images/         # Images du site (logos, icônes)
    └── index.php       # Le Front Controller (point d'entrée unique)
