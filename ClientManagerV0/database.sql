-- Base de données : gestionClients
-- Crée la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS gestionClients CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utilise la base de données
USE gestionClients;

-- Table : clients

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NULL
);

INSERT INTO clients (nom, email, telephone) VALUES
('Client Test 1', 'client1@example.com', '+212600000001'),
('Client Test 2', 'client2@example.com', '+212600000002'),
('Client Test 3', 'client3@example.com', '+212600000003'),
('Client Test 4', 'client4@example.com', '+212600000004'),
('Client Test 5', 'client5@example.com', '+212600000005'),
('Client Test 6', 'client6@example.com', '+212600000006'),
('Client Test 7', 'client7@example.com', '+212600000007'),
('Client Test 8', 'client8@example.com', '+212600000008'),
('Client Test 9', 'client9@example.com', '+212600000009'),
('Client Test 10', 'client10@example.com', '+212600000010');
