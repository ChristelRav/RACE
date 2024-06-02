psql -U raceu -d race

---SELECT TABLE

SELECT * FROM coureur_rang;
SELECT * FROM point_etape;
SELECT * FROM coureur_etape;
SELECT * FROM coureur_categorie;
SELECT * FROM etape;
SELECT * FROM coureur;
SELECT * FROM categorie;
SELECT * FROM equipe;
SELECT * FROM admin;

---DELETE TABLE

DELETE FROM coureur_rang;
DELETE FROM point_etape;
DELETE FROM coureur_etape;
DELETE FROM coureur_categorie;
DELETE FROM etape;
DELETE FROM coureur;
DELETE FROM categorie;
DELETE FROM equipe;
DELETE FROM admin;

---DROP TABLE

DROP VIEW v_classement_equipe;
DROP VIEW v_classement_coureur;
DROP VIEW v_classement;

DROP TABLE coureur_rang CASCADE;
DROP TABLE point_etape CASCADE;
DROP TABLE coureur_etape CASCADE;
DROP TABLE coureur_categorie CASCADE;
DROP TABLE etape CASCADE;
DROP TABLE coureur CASCADE;
DROP TABLE categorie CASCADE;
DROP TABLE equipe CASCADE;
DROP TABLE admin CASCADE;

--- TRUNCATE

TRUNCATE  TABLE point_etape RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE coureur_etape RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE coureur_categorie RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE etape RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE coureur RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE categorie RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE equipe RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE admin RESTART  IDENTITY CASCADE;

--- REQUEST

SELECT ce.*,c.nom,c.num_dossard,c.genre,c.date_naissance,e.id_equipe,e.nom,
(heure_arrive - heure_depart) as duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 2;


select * from coureur_etape where id_etape=1;

SELECT ce.*,c.num_dossard,e.id_equipe,e.nom,
(heure_arrive - heure_depart) as duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 1
ORDER BY (heure_arrive - heure_depart) ASC;


SELECT ce.*, c.num_dossard, e.id_equipe, e.nom,(ce.heure_arrive - ce.heure_depart) AS duree,
ROW_NUMBER() OVER (ORDER BY (ce.heure_arrive - ce.heure_depart)) AS rang
FROM  coureur_etape ce
JOIN  coureur c ON c.id_coureur = ce.id_coureur
JOIN  equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 1
ORDER BY duree ASC;


SELECT ce.*, COALESCE(pe.point, 0) AS point
FROM v_coureur_rang ce
LEFT JOIN point_etape pe ON ce.rang = pe.rang
WHERE ce.id_etape = 2
ORDER BY ce.duree ASC;


  SELECT ce.*, c.num_dossard, e.id_equipe, e.nom,(ce.heure_arrive - ce.heure_depart) AS duree,
    RANK() OVER (ORDER BY (ce.heure_arrive - ce.heure_depart)) AS rang
    FROM coureur_etape ce
    JOIN coureur c ON c.id_coureur = ce.id_coureur
    JOIN equipe e ON e.id_equipe = c.id_equipe

CREATE VIEW v_coureur_rang AS (
    SELECT ce.*, c.num_dossard, e.id_equipe, e.nom,(ce.heure_arrive - ce.heure_depart) AS duree,
    ROW_NUMBER() OVER (ORDER BY (ce.heure_arrive - ce.heure_depart)) AS rang
    FROM coureur_etape ce
    JOIN coureur c ON c.id_coureur = ce.id_coureur
    JOIN equipe e ON e.id_equipe = c.id_equipe
);

SELECT ce.id_equipe,ce.nom,
 SUM(COALESCE(pe.point, 0)) AS point ,
 RANK() OVER (ORDER BY (SUM(COALESCE(pe.point, 0))) DESC) AS rang
FROM v_coureur_rang ce
LEFT JOIN point_etape pe ON ce.rang = pe.rang
GROUP BY ce.id_equipe,ce.nom
ORDER BY point DESC;


SELECT id_etape, nom, longueur, nbr_coureur, rang, heure_depart, duree_limite,
(heure_depart::interval + duree_limite::interval) AS heure_limite
FROM etape;

--GET_HEURE
SELECT id_etape, nom, longueur, nbr_coureur, rang, heure_depart, duree_limite,
(heure_depart::time + duree_limite::interval) AS heure_limite
FROM etape;


--GET Equipe 


SELECT ce.id_coureur, ce.id_etape, c.num_dossard, e.id_equipe, e.nom,
       SUM(heure_arrive - heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
GROUP BY ce.id_coureur, ce.id_etape, c.num_dossard, e.id_equipe, e.nom
ORDER BY duree ASC;


SELECT ce.*,c.num_dossard,e.id_equipe,e.nom,
(heure_arrive - heure_depart) as duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
ORDER BY (heure_arrive - heure_depart) ASC;




SELECT ce.*,c.num_dossard,c.nom,e.id_equipe,e.nom,
(heure_arrive - heure_depart) as duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 1
ORDER BY (heure_arrive - heure_depart) ASC;



SELECT ce.id_coureur, c.num_dossard, e.id_equipe, e.nom,
       SUM(heure_arrive - heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 1
GROUP BY ce.id_coureur, c.num_dossard, e.id_equipe, e.nom
ORDER BY duree ASC;


SELECT ce.id_coureur, ce.id_etape, c.num_dossard, e.id_equipe, e.nom,
       SUM(heure_arrive - heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
GROUP BY ce.id_coureur, ce.id_etape, c.num_dossard, e.id_equipe, e.nom
ORDER BY duree ASC;


SELECT ce.id_coureur,c.nom as coureur, ce.id_etape, c.num_dossard, e.id_equipe, e.nom,
       SUM(heure_arrive - heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
WHERE ce.id_etape = 1
GROUP BY ce.id_coureur,c.nom , ce.id_etape, c.num_dossard, e.id_equipe, e.nom
ORDER BY duree ASC;

SELECT *,
    CASE
        WHEN duree IS NOT NULL THEN DENSE_RANK() OVER (ORDER BY duree ASC)
        ELSE 0
    END AS rang_coureur_calculated,
    COALESCE(pe.point, 0) AS point
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
WHERE vc.id_etape = 2
ORDER BY vc.id_etape, rang_coureur_calculated; -- Utilisation de l'alias distinct rang_coureur_calculated
