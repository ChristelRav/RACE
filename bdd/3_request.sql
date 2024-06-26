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
DROP VIEW v_classement_categorie;
DROP VIEW v_classement_etape;
DROP VIEW v_classement_equipe;
DROP VIEW v_classement_coureur;
DROP VIEW v_classement;

DROP VIEW  v_classement_gnrl_etape;
DROP VIEW  v_classement_gnrl_equipe_categorie     ;            
DROP VIEW  v_classement_gnrl_equipe   ;       
DROP VIEW  v_classement_gnrl_coureur_etape  ;                                    
DROP VIEW  v_classement_gnrl_categorie;  
DROP VIEW  v_classement_gnrl_etape;  
DROP VIEW  v_classement_gnrl_coureur ; 
DROP VIEW  v_classement_gnrl;          



DROP TABLE temp2;
DROP TABLE temp3;
DROP TABLE temp1;
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


TRUNCATE  TABLE temp3 RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE temp2 RESTART  IDENTITY CASCADE;
TRUNCATE  TABLE temp1 RESTART  IDENTITY CASCADE;
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


SELECT *, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
WHERE id_equipe =1
ORDER BY vc.id_etape, vc.rang_coureur;



SELECT  et.id_etape, et.nom AS etape, et.longueur , et.nbr_coureur , et.rang AS rang_etape, vc.id_coureur, vc.coureur, vc.num_dossard, vc.id_equipe, vc.nom AS equipe, vc.heure_depart, vc.heure_arrive, vc.duree, vc.rang_coureur,
        COALESCE(pe.point, 0) AS point
FROM  etape et
LEFT JOIN  v_classement_coureur vc ON et.id_etape = vc.id_etape AND vc.id_equipe = 2
LEFT JOIN  point_etape pe ON vc.rang_coureur = pe.rang
WHERE 
    vc.id_equipe = 2 OR vc.id_equipe IS NULL
ORDER BY  et.rang, vc.rang_coureur;


SELECT et.id_etape, et.nom AS etape,vc.coureur, vc.num_dossard, vc.nom AS equipe, vc.heure_depart, vc.heure_arrive, vc.duree, vc.rang_coureur, COALESCE(pe.point, 0) AS point 
FROM etape et 
LEFT JOIN v_classement_coureur vc ON et.id_etape = vc.id_etape AND vc.id_equipe = '1' 
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang 
WHERE vc.id_equipe = '1' OR vc.id_equipe IS NULL ORDER BY et.rang, vc.rang_coureur;



SELECT c.id_coureur, c.id_equipe, c.nom AS nom_coureur, c.num_dossard, c.genre, c.date_naissance,e.nom AS nom_equipe,cc.id_categorie, ca.nom AS nom_categorie
FROM coureur c
JOIN equipe e ON e.id_equipe = c.id_equipe
LEFT JOIN coureur_categorie cc ON cc.id_coureur = c.id_coureur
LEFT JOIN categorie ca ON ca.id_categorie = cc.id_categorie;


SELECT c.id_coureur, c.id_equipe, c.nom AS nom_coureur, c.num_dossard, c.genre, c.date_naissance,e.nom AS nom_equipe,cc.id_categorie, ca.nom AS nom_categorie
FROM coureur c
JOIN equipe e ON e.id_equipe = c.id_equipe
 JOIN coureur_categorie cc ON cc.id_coureur = c.id_coureur
 JOIN categorie ca ON ca.id_categorie = cc.id_categorie;

 
SELECT *, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
ORDER BY vc.id_etape, vc.rang_coureur;


SELECT vc.id_coureur,vc.coureur,vc.duree,vc.id_etape,vc.id_equipe,cc.id_categorie, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
ORDER BY vc.id_etape, vc.rang_coureur;

SELECT vc.id_equipe,vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
FROM equipe e
LEFT JOIN v_classement_coureur vc ON vc.id_equipe = e.id_equipe  
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
WHERE cc.id_categorie = 1 OR cc.id_categorie IS NULL
GROUP BY vc.id_equipe,vc.nom;


SELECT vc.id_equipe,vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
WHERE CC.id_categorie = 2
GROUP BY vc.id_equipe,vc.nom;



SELECT vc.id_equipe,vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
WHERE CC.id_categorie = 3
GROUP BY vc.id_equipe,vc.nom;


SELECT  id_equipe,  nom,  point, RANK() OVER (ORDER BY point DESC) AS classement
FROM ( SELECT  vc.id_equipe, vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
    FROM equipe e 
    LEFT JOIN v_classement_coureur vc ON vc.id_equipe = e.id_equipe 
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang 
    LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur 
    WHERE cc.id_categorie = 1 OR cc.id_categorie IS NULL GROUP BY vc.id_equipe, vc.nom
) AS subquery;


SELECT count(*)
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
WHERE ce.id_etape = 1 AND c.id_equipe = 1 ;


SELECT p.*,et.nom as etape, e.nom as equipe
FROM penalite p 
JOIN equipe e ON e.id_equipe = p.id_equipe
JOIN etape et ON et.id_etape = p.id_etape;


SELECT
e.id_etape,
e.nom AS etape,
e.longueur,
e.nbr_coureur,
e.date_etape,
COALESCE(vc.rang_etape, 0) AS rang_etape,
COALESCE(vc.id_coureur, NULL) AS id_coureur,
COALESCE(vc.id_equipe, NULL) AS id_equipe,
COALESCE(vc.coureur, '') AS coureur,
COALESCE(vc.hd, NULL) AS hd,
COALESCE(vc.nom, '') AS nom,
COALESCE(vc.num_dossard, 0) AS num_dossard,
COALESCE(vc.heure_depart, NULL) AS heure_depart,
COALESCE(vc.heure_arrive, NULL) AS heure_arrive,
COALESCE(vc.duree_simple, NULL) AS duree_simple,
COALESCE(vc.temps_penalite, NULL) AS temps_penalite,
COALESCE(vc.duree, NULL) AS duree,
COALESCE(vc.rang_coureur, 0) AS rang_coureur,
COALESCE(vc.point_etape, 0) AS point_etape
FROM
    etape e
LEFT JOIN
    v_classement_gnrl_coureur_etape vc
ON
    e.id_etape = vc.id_etape
    AND vc.id_equipe = 1
ORDER BY
    e.date_etape, e.heure_depart;




SELECT
        e.id_etape,
        e.nom AS etape,
        e.longueur,
        e.nbr_coureur,
        e.date_etape,
        e.rang AS rang_etape,
        e.heure_depart AS heureD,
        COALESCE(vc.id_coureur, NULL) AS id_coureur,
        COALESCE(vc.id_equipe, NULL) AS id_equipe,
        COALESCE(vc.coureur, '') AS coureur,
        COALESCE(vc.hd, NULL) AS hd,
        COALESCE(vc.nom, '') AS nom,
        COALESCE(vc.num_dossard, 0) AS num_dossard,
        COALESCE(vc.heure_depart, NULL) AS heure_depart,
        COALESCE(vc.heure_arrive, NULL) AS heure_arrive,
        COALESCE(vc.duree_simple, NULL) AS duree_simple,
        COALESCE(vc.temps_penalite, NULL) AS temps_penalite,
        COALESCE(vc.duree, NULL) AS duree,
        COALESCE(vc.rang_coureur, 0) AS rang_coureur,
        COALESCE(vc.point_etape, 0) AS point_etape
        FROM
            etape e
        LEFT JOIN
            v_classement_gnrl_coureur_etape vc
        ON
            e.id_etape = vc.id_etape
            AND vc.id_equipe = 1
        ORDER BY
            e.date_etape, e.heure_depart;
        





        SELECT
        e.id_etape,
        e.nom AS etape,
        e.longueur,
        e.nbr_coureur,
        e.date_etape,
        e.rang AS rang_etape,
        e.heure_depart AS heureD,
        COALESCE(vc.id_coureur, NULL) AS id_coureur,
        COALESCE(vc.id_equipe, NULL) AS id_equipe,
        COALESCE(vc.coureur, '') AS coureur,
        COALESCE(vc.hd, NULL) AS hd,
        COALESCE(vc.nom, '') AS nom,
        COALESCE(vc.num_dossard, 0) AS num_dossard,
        COALESCE(vc.heure_depart, NULL) AS heure_depart,
        COALESCE(vc.heure_arrive, NULL) AS heure_arrive,
        COALESCE(vc.duree_simple, NULL) AS duree_simple,
        COALESCE(vc.temps_penalite, NULL) AS temps_penalite,
        COALESCE(vc.duree, NULL) AS duree,
        COALESCE(vc.rang_coureur, 0) AS rang_coureur,
        COALESCE(vc.point_etape, 0) AS point_etape
        FROM
            etape e
        LEFT JOIN
            v_classement_gnrl_coureur_etape vc
        ON
            e.id_etape = vc.id_etape
            AND vc.id_equipe = 1
        ORDER BY
            e.date_etape, e.heure_depart;
        


        SELECT
        e.id_etape,
        e.nom AS etape,
        e.longueur,
        e.nbr_coureur,
        e.date_etape,
        e.rang AS rang_etape,
        e.heure_depart AS heureD,
        COALESCE(vc.id_coureur, NULL) AS id_coureur,
        COALESCE(vc.id_equipe, NULL) AS id_equipe,
        COALESCE(vc.coureur, '') AS coureur,
        COALESCE(vc.hd, NULL) AS hd,
        COALESCE(vc.nom, '') AS nom,
        COALESCE(vc.num_dossard, 0) AS num_dossard,
        COALESCE(vc.heure_depart, NULL) AS heure_depart,
        COALESCE(vc.heure_arrive, NULL) AS heure_arrive,
        COALESCE(vc.duree_simple, NULL) AS duree_simple,
        COALESCE(vc.temps_penalite, NULL) AS temps_penalite,
        COALESCE(vc.duree, NULL) AS duree,
        COALESCE(vc.rang_coureur, 0) AS rang_coureur,
        COALESCE(vc.point_etape, 0) AS point_etape
        FROM
            etape e
        LEFT JOIN
            v_classement_gnrl_coureur_etape vc
        ON
            e.id_etape = vc.id_etape
            AND vc.id_equipe = 1
        ORDER BY
            e.date_etape, e.heure_depart;
        