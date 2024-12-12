-- Création de la base de données
CREATE DATABASE voyage;

-- Utilisation de la base de données
USE voyage;

-- Table des clients
CREATE TABLE client (
    id_client INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telephone VARCHAR(15),
    adresse TEXT,
    date_naissance DATE
);

-- Table des activités
CREATE TABLE activite (
    id_activite INT(11) AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description TEXT,
    destination VARCHAR(100),
    prix DECIMAL(10,2) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    places_disponibles INT NOT NULL
);

-- Table des réservations
CREATE TABLE reservation (
    id_reservation INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_client INT(11) NOT NULL,
    id_activite INT(11) NOT NULL,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('En attente', 'Confirmée', 'Annulée') DEFAULT 'En attente',
    FOREIGN KEY (id_client) REFERENCES client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_activite) REFERENCES activite(id_activite) ON DELETE CASCADE
);

--Insertion des tables
INSERT INTO client (nom, prenom, email, telephone, adresse, date_naissance) 
VALUES 
('jaifra', 'ichrak', 'ichrak.jaifra@example.com', '0624172347', '12 Rue exemple', '1871-12-15'),
('laajil', 'kaoutar', 'kaoutar.laajil@example.com', '0624172347', '15 Rue exemple', '1850-11-27'),
('bora', 'omar', 'bora.omar@example.com', '0624172347', '33 Rue exemple', '1999-12-15'),
('oubaha', 'hanane', 'hanane.oubaha@example.com', '0624172347', '12 exemple', '2002-12-15');

INSERT INTO activite (titre, description,destination, prix, date_debut, date_fin, places_disponibles) 
VALUES 
('Atelier de cuisine marocaine', 'Apprenez à cuisiner des plats marocains traditionnels', 'Fès', 150.00, '2024-12-05', '2024-12-06', 10),
('Plongée sous-marine', 'Explorez la beauté du monde sous-marin', 'Agadir', 300.00, '2024-12-18', '2024-12-20', 8);

INSERT INTO reservation (id_client, id_activite, date_reservation, status) 
VALUES 
(1, 1,'En_attente'),
(2, 2, 'Confirmée'),
(3, 2, 'Annulée');

--Update des tables
UPDATE client
SET prenom = 'lina', adresse = '99 Avenue Centrale'
WHERE id_client = 3;


UPDATE activite
SET date_debut = '2024-12-10', date_fin = '2024-12-12'
WHERE id_activite = 2;
   

UPDATE reservation
SET date_reservation = '2024-12-01 14:00:00', statut = 'Annulée'
WHERE id_reservation = 2;
   



--Modifier les détails d’une Activité.
UPDATE activite
SET prix = 200.00, places_disponibles = 12
WHERE id_activite = 1;

--Supprimer une réservation.
DELETE FROM reservation
WHERE id_reservation = 2;



--une requête de jointure entre les tables
SELECT client.nom AS nom_client,client.prenom AS prenom_client,client.email AS email_client,activite.titre AS titre_activite,activite.destination AS destination,
    activite.prix AS prix_activite,
    activite.date_debut AS debut_activite,
    activite.date_fin AS fin_activite,
    reservation.date_reservation AS date_reservation,
    reservation.statut AS statut_reservation
FROM reservation
INNER JOIN client ON reservation.id_client = client.id_client
INNER JOIN activite ON reservation.id_activite = activite.id_activite
WHERE client.id_client = 1; 

