# Projet Pédagogique : Maîtriser la POO en PHP 8

Ce projet a été conçu comme un support de cours pour enseigner les concepts fondamentaux de la **Programmation Orientée Objet (POO)** avec **PHP 8**. Il s'agit d'une application web de gestion de clients et fournisseurs, développée "from scratch" (sans framework majeur comme Symfony ou Laravel) afin de se concentrer sur l'architecture et les principes de base.

L'application offre une interface dynamique et réactive grâce à l'utilisation d'AJAX pour toutes les opérations CRUD (Create, Read, Update, Delete), offrant une expérience utilisateur fluide sans rechargement de page.

![Aperçu de l'application](https://user-images.githubusercontent.com/1319277/159159932-3569e5d4-28c0-4824-811c-6d278b87d853.png)
<!-- Vous pouvez remplacer cette image par une capture d'écran de votre application -->

## ✨ Fonctionnalités

-   **Gestion CRUD complète** pour les Clients et les Fournisseurs.
-   **Interface réactive en AJAX** : Ajout, modification et suppression des données sans recharger la page.
-   **Recherche instantanée** pour filtrer les listes.
-   **Architecture MVC-inspirée** claire et facile à comprendre.
-   **Code propre et commenté** mettant en évidence les concepts de POO.
-   **Configuration simple** via un fichier `.env`.

## 🎓 Concepts de POO Abordés

Ce projet est une démonstration pratique des quatre piliers de la POO.

### 1. Encapsulation
L'encapsulation garantit que les données (attributs) d'un objet ne sont pas accessibles directement de l'extérieur. L'accès se fait via des méthodes publiques (getters et setters), ce qui permet de contrôler la manière dont les données sont modifiées et lues.
-   **Exemple** : Dans la classe `App\Entity\Personne`, les propriétés comme `$nom` et `$email` sont `private`. On y accède via des méthodes comme `getNom()` et `setNom()`.

### 2. Héritage
L'héritage permet à une classe (enfant) d'hériter des propriétés et méthodes d'une autre classe (parent). Cela favorise la réutilisation du code.
-   **Exemple 1** : Les classes `Client` et `Fournisseur` héritent de la classe `Personne`, partageant ainsi des attributs et méthodes communs (nom, email, `afficherIdentite()`).
-   **Exemple 2** : Tous les contrôleurs (`ClientController`, `FournisseurController`) héritent d'un `BaseController` qui contient la logique de rendu des vues, évitant ainsi la duplication de code.

### 3. Polymorphisme
Le polymorphisme permet à des objets de classes différentes de répondre au même message (appel de méthode) de manière spécifique.
-   **Exemple** : La classe `Personne` a une méthode `abstract public function getType(): string;`. Les classes `Client` et `Fournisseur` implémentent chacune cette méthode, mais retournent une chaîne de caractères différente ("Client" ou "Fournisseur"). Sur la page d'accueil, nous pouvons appeler `$personne->getType()` sur n'importe quel objet du tableau `$personnes`, et la méthode correcte sera exécutée.

### 4. Abstraction
L'abstraction consiste à masquer les détails complexes de l'implémentation pour ne montrer que les fonctionnalités essentielles. Les classes abstraites ne peuvent pas être instanciées et servent de modèle pour les classes enfants.
-   **Exemple** : La classe `Personne` est `abstract`. On ne peut pas créer une "Personne" générique, seulement des objets concrets comme `Client` ou `Fournisseur` qui sont des types de personnes.

## 🏗️ Architecture du Projet

Le projet suit une structure inspirée du pattern **Modèle-Vue-Contrôleur (MVC)**, adaptée pour être simple et didactique.

```
/
├── public/              # Racine web, seul dossier accessible depuis le navigateur
│   ├── js/              # Fichiers JavaScript
│   ├── .htaccess        # Règles de réécriture d'URL (pour Apache)
│   └── index.php        # Point d'entrée unique de l'application
├── src/                 # Cœur de l'application (code PHP)
│   ├── Controller/      # Gère la logique et les requêtes HTTP
│   ├── Entity/          # Classes représentant nos objets métier (Client, Personne...)
│   ├── Repository/      # Gère la communication avec la base de données
│   ├── Core/            # Classes utilitaires de base
│   ├── Database/        # Gestion de la connexion PDO
│   └── Exceptions/      # Exceptions personnalisées
├── views/               # Fichiers de template (HTML et PHP)
│   ├── partials/        # Morceaux de vues réutilisables (ex: formulaires)
│   └── layout.php       # Template principal de l'application
├── vendor/              # Dépendances gérées par Composer
├── .env                 # Fichier de configuration (local)
├── composer.json        # Définition des dépendances du projet
└── database.sql         # Script de création de la base de données
```

## 🛠️ Installation

### Prérequis

-   PHP 8.1 ou supérieur
-   Serveur Web (Apache ou Nginx)
-   Serveur de base de données MySQL ou MariaDB
-   Composer

### Étapes d'installation

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/ousrah/phpoo.git projet-poo
    cd projet-base/clientManagerV3
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Configurer l'environnement**
    -   Copiez le fichier `.env.example` (s'il existe) en `.env`. Sinon, créez-le.
    -   Ouvrez le fichier `.env` et mettez à jour les informations de connexion à la base de données (`DB_*`) et le chemin de base de l'application (`APP_BASEPATH`).

    ```dotenv
    # Fichier .env
    APP_NAME="Client Manager"
    APP_BASEPATH=/projet-poo/public # Adaptez ce chemin !

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_NAME=gestionClients
    DB_USER=root
    DB_PASS= # Votre mot de passe
    ```

4.  **Créer la base de données**
    -   Créez une base de données avec le nom que vous avez spécifié dans le fichier `.env` (par défaut `gestionClients`).
    -   Importez le fichier `database.sql` dans votre base de données pour créer les tables et insérer des données de test.

5.  **Configurer le serveur web (Apache)**
    Il est **fortement recommandé** de configurer un Hôte Virtuel (Virtual Host) qui pointe vers le dossier `/public`.

    Exemple de configuration pour Apache :
    ```apache
    <VirtualHost *:80>
        ServerName projet-poo.test
        DocumentRoot "C:/chemin/vers/votre/projet/projet-poo/public"
        <Directory "C:/chemin/vers/votre/projet/projet-poo/public">
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```
    N'oubliez pas d'ajouter `127.0.0.1 projet-poo.test` à votre fichier `hosts`.

### ⚠️ Point Crucial : La Synchronisation des Chemins

Pour que le routage et les requêtes AJAX fonctionnent correctement, le chemin de base doit être configuré de manière identique à **trois endroits** :

1.  **Fichier `.env`** (pour les redirections PHP et les liens dans les vues) :
    `APP_BASEPATH=/projet-poo/public`
2.  **Fichier `.htaccess`** (pour la réécriture d'URL Apache) :
    `RewriteBase /projet-poo/public/`
3.  **Dans les vues `list.php`** (pour la configuration du gestionnaire JavaScript) :
    `basePath: '/projet-poo/public'`

## 📜 Licence

Ce projet est distribué sous la licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---
Fait avec ❤️ pour l'apprentissage.
oussama rahmouni
ousrah@hotmail.com
+212612962466
(https://github.com/ousrah)