-- Base de données Supermarché
CREATE DATABASE IF NOT EXISTS supermarche CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE supermarche;

-- Table Utilisateurs
CREATE TABLE IF NOT EXISTS utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table Caisse
CREATE TABLE IF NOT EXISTS caisse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL UNIQUE,
    libelle VARCHAR(100) NOT NULL,
    active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

-- Table Produit
CREATE TABLE IF NOT EXISTS produit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(150) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    quantite_stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table Achat (en-tête)
CREATE TABLE IF NOT EXISTS achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    caisse_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(12,2) DEFAULT 0,
    cloture TINYINT(1) DEFAULT 0,
    FOREIGN KEY (caisse_id) REFERENCES caisse(id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
) ENGINE=InnoDB;

-- Table Ligne Achat (détail)
CREATE TABLE IF NOT EXISTS ligne_achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    achat_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    montant DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (achat_id) REFERENCES achat(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produit(id)
) ENGINE=InnoDB;

-- Insertion des utilisateurs (mot de passe: 'password' hashé)
INSERT INTO utilisateur (login, mot_de_passe, nom) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrateur'),
('caissier1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jean Dupont');

-- Insertion de 2 caisses
INSERT INTO caisse (numero, libelle) VALUES
(1, 'Caisse Principale'),
(2, 'Caisse Express');

-- Insertion de 5 produits
INSERT INTO produit (designation, prix, quantite_stock) VALUES
('Biscuit', 1000, 100),
('Pain', 400, 200),
('Lait', 800, 150),
('Riz 5kg', 3500, 80),
('Huile 1L', 2500, 60);

UPDATE utilisateur
SET mot_de_passe = '123'
WHERE login = 'admin';


UPDATE utilisateur
SET mot_de_passe = '123'
WHERE login = 'caissier1';