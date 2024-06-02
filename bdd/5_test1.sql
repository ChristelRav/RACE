INSERT INTO equipe (nom, pseudo, mot_passe) VALUES 
('A', 'TeamA', 'a123'),
('B', 'TeamB', 'b456'),
('C', 'TeamC', 'c789'),
('D', 'TeamD', 'd123');

INSERT INTO categorie (nom) VALUES 
('Homme'),
('Femme'),
('Junior'),
('Senior');

INSERT INTO point_etape (rang, point) VALUES 
(1, 10),
(2, 6),
(3, 4),
(4, 2),
(5, 1);



INSERT INTO coureur (id_equipe, nom, num_dossard, genre, date_naissance) VALUES 
(1, 'Alain', 101, 1, '2004-11-10'),
(1, 'Aurelie', 102, 5,'1985-08-05'),
(1, 'Adrien', 103, 1, '1970-02-17'),
(1, 'Alexis', 104, 1, '2000-09-24'),
(1, 'Armelle', 105, 5,'2008-01-01'),
(1, 'Alvin', 106, 1, '1999-05-20'),
(1, 'Amelie', 107, 5, '1979-07-19'),
(1, 'Allan', 108, 1,'2008-09-09'),

(2, 'Balita', 201, 1, '2004-11-20'),
(2, 'Bakoly', 202, 5,'1985-08-05'),
(2, 'Beloha', 203, 1, '1970-02-17'),
(2, 'Beza', 204, 1, '2000-09-24'),
(2, 'Benja', 205, 5,'2008-01-01'),
(2, 'Batoto', 206, 1, '1999-05-20'),
(2, 'Bako', 207, 5, '1979-07-19'),
(2, 'Bainina', 208, 1,'2008-09-09'),

(3, 'Soavaly', 301, 1, '2004-11-20'),
(3, 'Omby', 302, 5,'1985-08-05'),
(3, 'Saka', 303, 1, '1970-02-17'),
(3, 'lalitra', 304, 1, '2000-09-24'),
(3, 'Gidro', 305, 5,'2008-01-01'),
(3, 'Tantely', 306, 1, '1999-05-20'),
(3, 'Fody', 307, 5, '1979-07-19'),
(3, 'Osy', 308, 1,'2008-09-09'),

(4, 'John', 401, 1, '2004-11-10'),
(4, 'Jenny', 402, 5,'1985-08-05'),
(4, 'Justin', 403, 1, '1970-02-17'),
(4, 'Jackie', 404, 1, '2000-09-24'),
(4, 'Josh', 405, 5,'2008-01-01'),
(4, 'Jasmine', 406, 1, '1999-05-20'),
(4, 'Jill', 407, 5, '1979-07-19'),
(4, 'Jade', 408, 1,'2008-09-09');



INSERT INTO etape (nom, longueur, nbr_coureur, rang, date_etape,heure_depart) VALUES 
('Betsizaraina', 4.0, 2, 1, '2023-05-31', '08:00:00'),
('Mahatsinjo', 2.0, 2, 2, '2023-05-31', '09:30:00'),
('Ampasimbe', 2.0, 1, 3, '2023-05-31', '14:00:00'),
('Dezaka', 8.0, 2, 4, '2023-06-01', '07:00:00'),
('Mahatozo', 1.5, 3, 5, '2023-06-01', '11:00:00');