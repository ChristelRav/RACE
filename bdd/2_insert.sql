-- Insérer des données dans la table admin
INSERT INTO admin (email, mot_passe) VALUES 
('admin@example.com', '123');

-- Insérer des données dans la table equipe
INSERT INTO equipe (nom, pseudo, mot_passe) VALUES 
('Equipe A', 'TeamA', 'a123'),
('Equipe B', 'TeamB', 'b456'),
('Equipe C', 'TeamC', 'c789');

-- Insérer des données dans la table categorie
INSERT INTO categorie (nom) VALUES 
('Homme'),
('Femme'),
('Junior'),
('Senior');

-- Insérer des données dans la table coureur
INSERT INTO coureur (id_equipe, nom, num_dossard, genre, date_naissance) VALUES 
(1, 'Alain', 101, 1, '1990-01-01'),
(1, 'Alice', 102, 5, '1992-02-02'),
(1, 'Anais', 103, 5, '1992-02-02'),
(2, 'Bob', 201, 1, '1988-03-03'),
(2, 'Bella', 202, 5, '1994-04-04'),
(2, 'Bistro', 201, 1, '1988-03-03'),
(3, 'Col', 301, 1, '1991-05-05'),
(3, 'Celia', 302, 5, '1993-06-06'),
(3, 'Chan', 303, 1, '1995-07-07');

-- Insérer des données dans la table etape
INSERT INTO etape (nom, longueur, nbr_coureur, rang, heure_depart, duree_limite) VALUES 
('Betsizaraina', 10.0, 3, 1, '08:00:00', '01:30:00'),
('Ampasimbe', 15.0, 1, 3, '09:00:00', '02:00:00');

-- Insérer des données dans la table coureur_categorie
INSERT INTO coureur_categorie (id_coureur, id_categorie) VALUES 
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(6, 2),
(7, 1);

-- Insérer des données dans la table coureur_etape
INSERT INTO coureur_etape (id_etape, id_coureur, date_parcours, heure_depart, heure_arrive) VALUES 
(1, 1, '2023-06-01', '08:00:00', '08:45:00'),
(1, 2, '2023-06-01', '08:00:00', '08:50:00'),
(1, 3, '2023-06-01', '08:00:00', '08:55:00'),
(1, 4, '2023-06-01', '08:00:00', '09:00:00'),
(1, 5, '2023-06-01', '08:00:00', '09:05:00'),
(1, 6, '2023-06-01', '08:00:00', '09:10:00'),
(2, 7, '2023-06-02', '09:00:00', '09:50:00'),
(2, 3, '2023-06-02', '09:00:00', '10:00:00'),
(2, 1, '2023-06-02', '09:00:00', '10:10:00');

-- Insérer des données dans la table point_etape
INSERT INTO point_etape (rang, point) VALUES 
(1, 10),
(2, 6),
(3, 4),
(4, 2),
(5, 1);
