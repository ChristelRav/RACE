INSERT INTO equipe (nom, pseudo, mot_passe) VALUES 
('A', 'A', 'a123'),
('B', 'B', 'b456'),
('C', 'C', 'c789'),
('D', 'D', 'd123');

INSERT INTO categorie (nom) VALUES 
('Homme'),
('Femme'),
('Junior');

INSERT INTO point_etape (rang, point) VALUES 
(1, 10),
(2, 6),
(3, 4),
(4, 2),
(5, 1);



INSERT INTO coureur (id_equipe, nom, num_dossard, genre, date_naissance) VALUES 
(1, 'Alain', 101, 'M', '2007-11-10'),
(1, 'Aurelie', 102, 'F','1985-08-05'),
(1, 'Adrien', 103, 'M', '1970-02-17'),
(1, 'Alexis', 104, 'M', '2009-09-24'),
(1, 'Armelle', 105, 'F','2008-01-01'),
(1, 'Alvin', 106, 'M', '1999-05-20'),
(1, 'Amelie', 107, 'F', '1979-07-19'),
(1, 'Allan', 108, 'M','2008-09-09'),

(2, 'Balita', 201, 'M', '2007-11-20'),
(2, 'Bakoly', 202, 'F','1985-08-05'),
(2, 'Beloha', 203, 'M', '1970-02-17'),
(2, 'Beza', 204, 'M', '2009-09-24'),
(2, 'Benja', 205, 'F','2008-01-01'),
(2, 'Batoto', 206, 'M', '1999-05-20'),
(2, 'Bako', 207, 'F', '1979-07-19'),
(2, 'Bainina', 208, 'M','2008-09-09'),

(3, 'Soavaly', 301, 'M', '2007-11-20'),
(3, 'Omby', 302, 'F','1985-08-05'),
(3, 'Saka', 303, 'M', '1970-02-17'),
(3, 'lalitra', 304, 'M', '2009-09-24'),
(3, 'Gidro', 305, 'F','2008-01-01'),
(3, 'Tantely', 306, 'M', '1999-05-20'),
(3, 'Fody', 307, 'F', '1979-07-19'),
(3, 'Osy', 308, 'M','2008-09-09'),

(4, 'John', 401, 'M', '2007-11-10'),
(4, 'Jenny', 402, 'F','1985-08-05'),
(4, 'Justin', 403, 'M', '1970-02-17'),
(4, 'Jackie', 404, 'M', '2009-09-24'),
(4, 'Josh', 405, 'F','2008-01-01'),
(4, 'Jasmine', 406, 'M', '1999-05-20'),
(4, 'Jill', 407, 'F', '1979-07-19'),
(4, 'Jade', 408, 'M','2008-09-09');



INSERT INTO etape (nom, longueur, nbr_coureur, rang, date_etape,heure_depart) VALUES 
('Betsizaraina', 4.0, 2, 1, '2023-6-02', '08:00:00'),
('Mahatsinjo', 2.0, 2, 2, '2023-06-02', '09:30:00'),
('Ampasimbe', 2.0, 1, 3, '2023-06-02', '14:00:00'),
('Dezaka', 8.0, 2, 4, '2023-06-03', '07:00:00'),
('Mahatozo', 1.5, 3, 5, '2023-06-03', '11:00:00');
