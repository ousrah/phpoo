# Projet de Base : Architecture PHP sans Framework

Ce document décrit la version la plus fondamentale du projet "Client Manager". L'objectif de cette version initiale est de mettre en place une **structure d'application PHP moderne et propre, sans l'aide d'un framework**, pour servir de fondation solide à l'apprentissage de concepts plus avancés.

L'application, dans cet état, permet uniquement d'afficher une liste de clients et d'en ajouter de nouveaux via un formulaire simple. Nous avons introduits une gestion de routes plus solide.

## 🎓 Concepts Fondamentaux Abordés

Cette version se concentre sur deux concepts architecturaux majeurs :

### 1. Séparation des Préoccupations (SoC)
Même sans être un framework MVC complet, le code est organisé pour que chaque fichier ait une responsabilité unique. C'est le principe le plus important pour écrire du code maintenable.
-   **Entité (`src/Entity/Client.php`)** : Représente la structure de nos données. C'est un simple objet qui contient les informations d'un client.
-   **Repository (`src/Repository/ClientRepository.php`)** : Sa seule responsabilité est de communiquer avec la base de données pour l'entité `Client`. Toute la logique SQL (SELECT, INSERT) est isolée ici.
-   **Contrôleur (`src/Controller/ClientController.php`)** : Il agit comme un chef d'orchestre. Il reçoit les requêtes HTTP, demande des données au Repository, et dit à la Vue de s'afficher.
-   **Vue (`public/list.php`)** : Son seul rôle est d'afficher le HTML et les données fournies par le contrôleur.
-   **Routeur (`routes/web.php`)** : Il mappe les URLs aux bonnes méthodes des contrôleurs.



## 🏗️ Architecture du Projet (Version de Base)

La structure des fichiers est volontairement simple et claire.

```
/
├── public/        # Racine web, seul dossier accessible depuis le navigateur
│   ├── .htaccess        # Règles de réécriture d'URL
│   ├── index.php        # Point d'entrée unique de l'application
│   └── list.php         # La Vue pour afficher les clients
├── Routes/ 
│   ├── web.php     #gestion centralisé des routes
├── src/                 # Cœur de l'application (code PHP)
│   ├── Controller/
│   │   └── ClientController.php
│   ├── Core/
│   │   └── Redirect.php   # systeme de redirection
│   ├── Entity/
│   │   └── Client.php
│   ├── Repository/
│   │   └── ClientRepository.php
│   ├── Database/
│   │   └── Connection.php
│   └── Exceptions/
│       └── DatabaseException.php
├── vendor/              # Dépendances gérées par Composer
├── .env                 # Fichier de configuration
├── composer.json        # Définition des dépendances du projet
└── database.sql 
```

## ✨ Fonctionnalités (Version de Base)

-   Affichage d'une liste de clients depuis une base de données MySQL.
-   Ajout d'un nouveau client via un formulaire HTML simple.
-   Redirection après l'ajout d'un client.
-   Utilisation de Composer pour l'autoloading (PSR-4) et la gestion des dépendances.
-   Configuration de l'application externalisée dans un fichier `.env`.

**Remarque** : Cette version n'inclut PAS d'héritage, de polymorphisme, de classes abstraites, de layout centralisé, ni de fonctionnalités AJAX. C'est un point de départ volontairement minimaliste.

## 🛠️ Installation

### Prérequis

-   PHP 8.1 ou supérieur
-   Serveur Web (Apache pour le `.htaccess` fourni)
-   Serveur de base de données MySQL ou MariaDB
-   Composer

### Étapes d'installation

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/ousrah/phpoo.git projet-base
    cd projet-base/clientManagerV2
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Configurer l'environnement**
    -   Créez un fichier `.env` à la racine.
    -   Copiez-y le contenu ci-dessous et adaptez les valeurs à votre configuration.

    ```dotenv
    # Fichier .env
    APP_BASEPATH=/projet-base/public # Adaptez ce chemin !

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_NAME=gestionClients
    DB_USER=root
    DB_PASS=
    ```

4.  **Créer la base de données**
    -   Créez une base de données MySQL avec le nom spécifié dans `.env` (par ex. `gestionClients`).

    
    -   Exécutez la commande SQL suivante pour créer la table `clients` :

    ```sql
    CREATE TABLE clients (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        telephone VARCHAR(20) NULL
    );
    ```
    ce code existe dans le fichiers ./database.sql
    
5.  **Configurer le serveur web (Apache)**
    -   Configurez votre serveur pour qu'il pointe vers le dossier `/public`.
    -   Assurez-vous que le module `mod_rewrite` est activé.
    -   Ouvrez le fichier `public/.htaccess` et adaptez la ligne `RewriteBase` pour qu'elle corresponde à votre `APP_BASEPATH`.

    ```apache
    # public/.htaccess
    RewriteBase /projet-base/public/
    ```

Une fois ces étapes terminées, vous devriez pouvoir accéder à votre application via l'URL configurée.