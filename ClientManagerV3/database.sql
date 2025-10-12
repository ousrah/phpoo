-- Crée la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS gestionClients CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utilise la base de données
USE gestionClients;

-- Table pour les clients
-- Note : Pas de colonne 'type' car la table est déjà spécifique aux clients.
-- L'information de type est gérée au niveau de la classe PHP.
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NULL,
    solde DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table pour les fournisseurs
CREATE TABLE IF NOT EXISTS fournisseurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NULL,
    societe VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insertion de données de test pour les clients
INSERT INTO clients (nom, email, telephone, solde) VALUES
('Said Hassani', 'said@email.com', '0612345678', 1500.75),
('Kahlid Saidi', 'khalid@email.com', '0687654321', -250.00),
('Mounir el youssfi', 'mounir@email.com', NULL, 5200.00);

-- Insertion de données de test pour les fournisseurs
INSERT INTO fournisseurs (nom, email, telephone, societe) VALUES
('Farida kamali', 'farida@fournisseur.com', '0145678901', 'Tech Solutions SARL'),
('Souad Benali', 'souad@fournisseur.com', '0198765432', 'Compta Pro'),
('Mahmoud Fennan', 'mahmoud@fournisseur.com', NULL, 'Logistique Express');