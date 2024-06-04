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
('Junior');

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

INSERT INTO temp1 (etape_rang, numero_dossard, genre, date_naissance, equipe, arrivee) VALUES
(1, 101, 'Homme', '2004-11-10', 'Equipe A', '2023-06-02 07:00:00'),
(2, 102, 'Femme', '1985-08-05', 'Equipe A', '2023-06-02 07:10:00'),
(3, 103, 'Homme', '1970-02-17', 'Equipe B', '2023-06-02 07:20:00'),
(4, 104, 'Homme', '2000-09-24', 'Equipe B', '2023-06-02 07:30:00'),
(5, 105, 'Femme', '2008-01-01', 'Equipe C', '2023-06-02 07:40:00'),
(6, 106, 'Homme', '1999-05-20', 'Equipe C', '2023-06-02 07:50:00'),
(7, 107, 'Femme', '1979-07-19', 'Equipe D', '2023-06-02 08:00:00'),
(8, 108, 'Homme', '2008-09-09', 'Equipe D', '2023-06-02 08:10:00'),
(9, 109, 'Homme', '1995-12-25', 'Equipe E', '2023-06-02 08:20:00'),
(10, 110, 'Femme', '1990-03-15', 'Equipe E', '2023-06-02 08:30:00');

INSERT INTO temp3 (etape, longueur, nb_coureur, rang, date_départ, heure_départ) VALUES
('Etape 1', 120.5, 50, 1, '2023-06-01', '08:00:00'),
('Etape 2', 130.7, 48, 2, '2023-06-02', '08:15:00'),
('Etape 3', 110.3, 47, 3, '2023-06-03', '08:30:00'),
('Etape 4', 140.2, 49, 4, '2023-06-04', '08:45:00'),
('Etape 5', 125.6, 45, 5, '2023-06-05', '09:00:00'),
('Etape 6', 115.8, 50, 6, '2023-06-06', '09:15:00'),
('Etape 7', 150.4, 46, 7, '2023-06-07', '09:30:00'),
('Etape 8', 135.2, 48, 8, '2023-06-08', '09:45:00'),
('Etape 9', 145.1, 49, 9, '2023-06-09', '10:00:00'),
('Etape 10', 155.0, 50, 10, '2023-06-10', '10:15:00');



INSERT INTO  coureur (id_equipe, nom, num_dossard, genre, date_naissance)
SELECT  e.id_equipe,t1.nom,t1.numero_dossard,t1.genre,t1.date_naissance
FROM temp1 t1
JOIN equipe e ON e.nom = t1.equipe
GROUP BY  e.id_equipe,t1.nom,t1.numero_dossard,t1.genre,t1.date_naissance;


INSERT INTO coureur_etape (id_etape, id_coureur,  heure_depart, heure_arrive) 
SELECT e.id_etape,c.id_coureur,e.date_etape + e.heure_depart::time as heure_depart , t1.arrivee
FROM temp1 t1
JOIN etape e ON e.rang = t1.etape_rang
JOIN coureur c ON c.nom = t1.nom AND c.genre = t1.genre AND c.date_naissance = t1.date_naissance
AND c.num_dossard = t1.numero_dossard;


INSERT INTO point_etape (rang,point)
SELECT classement , points FROM temp2;


INSERT INTO etape (nom, longueur, nbr_coureur, rang,date_etape, heure_depart)
SELECT   etape,longueur,nb_coureur,rang,date_depart,heure_depart FROM temp3;


INSERT INTO penalite (id_etape, id_equipe, temps_penalite) VALUES
(1, 1, '01:30:00'),
(2, 2, '00:45:00'),
(1, 3, '00:20:00'),
(3, 1, '00:15:00'),
(2, 1, '00:10:00');

