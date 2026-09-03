### PARTIE 0

------------------------------
# 1. Pourquoi le dossier /vendor ne doit-il pas être versionné ?
Le dossier /vendor contient les dépendances externes installées par Composer. Il doit être exclu de Git (via le fichier .gitignore) pour trois raisons principales :

* Poids inutile et pollution : Ce dossier contient des milliers de fichiers de bibliothèques tierces. Le versionner alourdit inutilement le dépôt Git, ralentit les commandes (git status, git clone) et pollue l'historique des modifications.
* Redondance du code : Les paquets que vous utilisez possèdent déjà leurs propres dépôts officiels. Il n'y a aucun intérêt à stocker une copie de leur code dans le vôtre.
* Le fichier composer.lock fait déjà le travail : Ce fichier enregistre les versions exactes de chaque dépendance installée. Vos collaborateurs ou vos serveurs de production n'ont qu'à exécuter la commande composer install pour recréer à l'identique le dossier /vendor.

------------------------------
# 2. Quelle différence existe entre un commit et un tag ?
Bien qu'ils soient tous deux liés à l'historique du code, ils ont des rôles très différents :

* Un commit est une photo de l'état du code à un instant T. C'est l'unité de base de Git. Il représente un changement précis (ajout d'une fonction, correction d'un bug) et possède un identifiant unique (un hash SHA-1 comme a1b2c3d). L'historique est une suite de commits.
* Un tag (étiquette) est un repère fixe nommé qui pointe vers un commit spécifique. On l'utilise généralement pour marquer une étape majeure, comme la sortie d'une version stable de l'application (ex: v1.0.0, v2.4.1). Contrairement aux branches, un tag ne bouge plus jamais une fois créé.

En résumé : On fait des dizaines de commits par jour pour travailler, et on pose un tag de temps en temps pour publier une version officielle.
------------------------------
# 3. Pourquoi la branche main doit-elle rester stable ?
La branche main est la colonne vertébrale de notre projet. Elle doit impérativement rester stable pour les raisons suivantes :

* Prête pour la production : Tout code présent sur main doit pouvoir être déployé en production à n'importe quel moment sans casser le site ou l'application pour les utilisateurs finaux.
* Référence absolue pour l'équipe : C'est à partir de main que les développeurs créent leurs nouvelles branches de travail (feature-xyz). Si main contient des bugs, chaque développeur va importer ces bugs dans son propre travail, ce qui paralyse l'équipe.
* Automatisation (CI/CD) : Les outils modernes de déploiement automatique déclenchent souvent la mise en ligne dès qu'un changement est validé sur main. Un code instable sur cette branche provoquerait immédiatement une panne en ligne.


### PARTIE 1


# 1.Pourquoi placer index.php dans un dossier public ?

Placer index.php dans un dossier /public (parfois nommé /web ou /html) est une mesure de sécurité fondamentale pour isoler le code source du web.

* Sécurité des fichiers : Le serveur web (Apache, Nginx) est configuré pour pointer directement dans ce dossier /public. Cela signifie que les internautes peuvent uniquement accéder aux fichiers situés dans ce dossier.

* Inaccessibilité du code source : Vos scripts PHP sensibles, vos fichiers de configuration (contenant les mots de passe de base de données), et vos dépendances (/vendor) se trouvent un niveau au-dessus (à la racine du projet). Ils sont techniquement invisibles et inaccessibles depuis un navigateur, éliminant le risque qu'un client lise votre code source.

# 2.Pourquoi toutes les requêtes devraient-elles passer par ce fichier (index.php) ?

C'est le design pattern du Front Controller (Contrôleur Unique). Au lieu d'avoir des dizaines de fichiers accessibles (comme contact.php, articles.php), le serveur redirige absolument toutes les URLs (grâce à un fichier .htaccess ou une règle Nginx) vers l'unique fichier index.php.Cela offre des avantages majeurs :

* Point d'entrée unique : Vous centralisez les tâches répétitives au même endroit : charger l'autoloader de Composer, démarrer la session, vérifier si l'utilisateur est connecté, et initialiser les paramètres de sécurité.

* Routage flexible : C'est un script PHP (le Routeur) qui analyse l'URL demandée (ex: /article/42) et décide dynamiquement quel contrôleur et quelle fonction exécuter. Vous obtenez ainsi des "URLs propres" (sans .php à la fin).

* Maintenance simplifiée : Si vous devez ajouter un système de maintenance ou un pare-feu sur tout le site, vous n'avez qu'un seul fichier à modifier.

# 3. Quels éléments ne devraient jamais se trouver dans le dossier public ?

Le dossier public ne doit contenir que des ressources destinées à être téléchargées ou lues directement par le navigateur de l'utilisateur.Ne doivent jamais s'y trouver :

* Le code source de l'application : Vos classes, vos routeurs, vos contrôleurs, vos modèles et vos scripts de logique métier.
* Les fichiers de configuration et d'environnement : Les fichiers .env, config.php ou parameters.yaml qui contiennent les clés d'API et les identifiants de connexion.
* Les dépendances : Le dossier /vendor de Composer.
* Les templates / vues de rendu : Les fichiers Twig, Blade ou fichiers HTML/PHP bruts qui servent de squelettes graphiques (ils doivent être compilés ou inclus par PHP en amont).
* Les sauvegardes et logs : Les fichiers de base de données (.sql) ou les journaux d'erreurs de l'application.

# 4. Comment répartir les responsabilités entre les dossiers ?

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

### PARTIE 2

# 1. Quelle relation avez-vous établie entre les deux classes ?

J’ai établi une relation d’héritage entre les deux classes.
CopieExamen hérite de AbstractDocument grâce au mot-clé extends.

Ainsi, CopieExamen récupère les caractéristiques communes d’un document, notamment id et dateDepot.

# 2. Pourquoi ne peut-on pas créer directement un AbstractDocument ?

Parce que AbstractDocument est une classe abstraite.
Elle sert de classe de base pour les différents types de documents et ne doit pas être instanciée directement.

On crée plutôt une classe concrète comme CopieExamen.

# 3. Pourquoi l’identifiant peut-il être absent avant la sauvegarde ?

L’identifiant peut être null avant la sauvegarde parce qu’il peut être généré automatiquement par la base de données lors de l'enregistrement du document.

`Exemple` : Avant la sauvegarde → id = null
            Après la sauvegarde  → id = 1, 2, 3...
            C’est pourquoi la propriété est déclarée : protected ?int $id = null;

# La protection des propriétés favorise le principe d’encapsulation.

L’encapsulation permet de protéger l’état interne de l’objet et d’empêcher des modifications directes et invalides.

Par exemple, la note ne peut pas être directement modifiée à 25, car elle passe par une méthode qui vérifie qu’elle est comprise entre 0 et 20.

### PARTIE 3
# 1. Quelle classe doit être responsable de la connexion ?

C'est la classe Database.
Elle est responsable de créer et gérer la connexion à PostgreSQL avec PDO.
ex : Repository → Database → PDO → PostgreSQL

# 2. Faut-il créer une nouvelle connexion pour chaque requête SQL ?

Non.
On crée une connexion une seule fois et on la réutilise pour les différentes requêtes SQL.
C'est justement ce que permet le Singleton avec :Database::getInstance();
Cela évite de recréer inutilement une connexion à chaque requête.

# 3. Où placer les identifiants de connexion ?

Les identifiants (DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, etc.) doivent être placés dans un fichier .env, qui ne doit pas être versionné.

Exemple :   DB_HOST=localhost
            DB_PORT=5432
            DB_NAME=heritage_devoir2
            DB_USER=pos
            DB_PASSWORD=pwd

et mettre .env dans .gitignore
Ainsi, les informations sensibles ne sont pas directement écrites dans Database.php.

# 4. Pourquoi utiliser PDO ?

PDO (PHP Data Objects) permet à PHP de communiquer avec une base de données.

On l'utilise notamment parce qu'il permet :

* de se connecter à PostgreSQL ;
* d'utiliser des requêtes préparées ;
* de protéger les requêtes contre les injections SQL ;
* de gérer les erreurs avec des exceptions ;
* d'avoir une interface orientée objet pour accéder à la base.

### PARTIE 4

# 1. Pourquoi créer un objet supplémentaire alors que $_POST contient déjà les données ?

Parce que $_POST contient des données brutes provenant du navigateur, principalement sous forme de chaînes.

Le DTO permet de :

* contrôler les données reçues ;
* convertir les types ;
* centraliser la validation ;
* éviter que $_POST entre directement dans le métier.

On obtient donc: 

$_POST
   ↓
SoumettreCopieDTO
   ↓
Service
   ↓
CopieExamen


# 2.Quelle différence entre SoumettreCopieDTO et CopieExamen ?

DTO : transporte les données entre les couches.

Entité CopieExamen : représente réellement une copie dans ton domaine métier.

Par exemple :SoumettreCopieDTO
            → données reçues du formulaire

            CopieExamen
            → objet métier représentant une copie d'examen
Le DTO n'a donc pas vocation à remplacer ton entité.

# 3. Le DTO doit-il posséder un identifiant de base de données ?

Non.

L'identifiant appartient à l'entité persistée, pas aux données nécessaires à la soumission.

Donc :SoumettreCopieDTO
        - noteBrute
        - dateDepot
        - dateLimite 
    pas besoin de id

# 4. Où convertir les chaînes de dates ?

La conversion des données du formulaire vers les types métier attendus est une responsabilité adaptée au DTO.

Par exemple :"2026-09-02"
                ↓
            DateTime

Ainsi, ton Service ne reçoit plus une chaîne venant de $_POST, mais une vraie date.

# 5. Flux complet de la Partie 4

Tu dois viser cette architecture :
Formulaire HTML
       │
       │ $_POST
       ▼
   Controller
       │
       │ création du DTO
       ▼
SoumettreCopieDTO
       │
       │ données typées et validées
       ▼
     Service
       │
       │ logique métier
       ▼
  CopieExamen
       │
       ▼
   Repository
       │
       ▼
   PostgreSQL