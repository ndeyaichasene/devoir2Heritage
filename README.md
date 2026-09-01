# devoir2Heritage

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


