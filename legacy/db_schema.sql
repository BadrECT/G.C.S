-- Database Creation
CREATE DATABASE IF NOT EXISTS gcs_db;
USE gcs_db;

-- 1. Users Table (Authentication & Base Roles)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Membres Table (Profile details linked to users)
CREATE TABLE IF NOT EXISTS membres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    telephone VARCHAR(20),
    photo VARCHAR(255),
    categorie VARCHAR(50), -- e.g., Senior, Junior
    statut ENUM('actif', 'inactif') DEFAULT 'actif',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Entrainements Table (Training Sessions)
CREATE TABLE IF NOT EXISTS entrainements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_heure DATETIME NOT NULL,
    lieu VARCHAR(255) NOT NULL,
    coach_id INT, -- Link to a user with role 'admin'
    places_max INT DEFAULT 20,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (coach_id) REFERENCES users(id) ON DELETE SET NULL
);


-- 4. Paiements Table (Financials)
CREATE TABLE IF NOT EXISTS paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membre_id INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    motif VARCHAR(255) NOT NULL, -- e.g., 'Cotisation 2024', 'Tournoi X'
    date_paiement DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('payé', 'en_attente', 'annulé') DEFAULT 'en_attente',
    transaction_ref VARCHAR(255), -- For Stripe/PayPal ID
    FOREIGN KEY (membre_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Default Admin User (Password: 123456)
-- Hash generated using password_hash('123456', PASSWORD_DEFAULT)
INSERT INTO users (name, email, password, role) VALUES 
('Admin User', 'admin@gcs.com', '$2y$10$YourHashHere...', 'admin');
