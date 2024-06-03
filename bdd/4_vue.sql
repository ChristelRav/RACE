--classement sans point
CREATE VIEW v_classement AS (
SELECT ce.id_coureur, ce.id_etape, et.nom as etape,et.rang as rang_etape , c.nom as coureur, c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,
       SUM(ce.heure_arrive - ce.heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
JOIN etape et ON et.id_etape = ce.id_etape
GROUP BY ce.id_coureur, ce.id_etape, et.nom ,et.rang , c.nom , c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive
ORDER BY duree ASC
);



SELECT *, DENSE_RANK() OVER (ORDER BY duree ASC) AS rang
FROM v_classement
WHERE id_etape = 2;

CREATE VIEW v_classement_coureur AS (
SELECT *,DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY duree ASC) AS rang_coureur
FROM v_classement
ORDER BY id_etape ASC
);


--classement avec point
SELECT *, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur;


SELECT *, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur;

SELECT vc.id_equipe,vc.nom,SUM(COALESCE(pe.point, 0)) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
GROUP BY vc.id_equipe,vc.nom;


--classement avec  point / EQUIPE
CREATE VIEW v_classement_equipe AS ( SELECT vc.id_equipe,vc.nom,SUM(COALESCE(pe.point, 0)) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
GROUP BY vc.id_equipe,vc.nom
);

SELECT *, RANK() OVER ( ORDER BY point DESC) AS rang
FROM v_classement_equipe

SELECT id_equipe, nom, total_point,
       RANK() OVER (ORDER BY total_point DESC) AS rang
FROM (
    SELECT vc.id_equipe, vc.nom, SUM(COALESCE(pe.point, 0)) AS total_point
    FROM v_classement_coureur vc
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
    WHERE vc.duree >= '00:00:00'::interval -- Filtrer les durées positives
    GROUP BY vc.id_equipe, vc.nom
) AS subquery;


SELECT id_equipe, id_etape, nom, total_point,
       RANK() OVER (ORDER BY total_point DESC) AS rang
FROM (
    SELECT vc.id_equipe, vc.id_etape, vc.nom, SUM(COALESCE(pe.point, 0)) AS total_point
    FROM v_classement_coureur vc
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
    WHERE vc.duree >= '00:00:00'::interval -- Filtrer les durées positives
    AND vc.id_etape = 2
    GROUP BY vc.id_equipe, vc.nom, vc.id_etape
) AS subquery;




DROP VIEW v_classement_equipe;
DROP VIEW v_classement_coureur;
DROP VIEW v_classement;


-- SELECT ce.id_coureur, ce.id_etape, et.nom AS etape, et.rang AS rang_etape, c.nom AS coureur, 
--        c.num_dossard, e.id_equipe, e.nom AS equipe,
--        SUM(ce.heure_arrive - ce.heure_depart) AS duree
-- FROM coureur_etape ce
-- JOIN coureur c ON c.id_coureur = ce.id_coureur
-- JOIN equipe e ON e.id_equipe = c.id_equipe
-- JOIN etape et ON et.id_etape = ce.id_etape
-- GROUP BY ce.id_coureur, ce.id_etape, et.nom, et.rang, c.nom, c.num_dossard, e.id_equipe, e.nom
-- ORDER BY 
--     CASE 
--         WHEN SUM(ce.heure_arrive - ce.heure_depart) >= '00:00:00'::interval THEN 0 
--         ELSE 1 
--     END,
--     SUM(ce.heure_arrive - ce.heure_depart) ASC;


-- SELECT *
-- FROM v_classement
-- WHERE id_etape = 2
-- ORDER BY 
--     CASE 
--         WHEN duree >= '00:00:00'::interval THEN 0 
--         ELSE 1 
--     END,
--     duree;




 SELECT  et.id_etape, et.nom AS etape, et.longueur , et.nbr_coureur , et.rang AS rang_etape,et.date_etape,et.heure_depart as hd, vc.id_coureur, vc.coureur, vc.num_dossard, vc.id_equipe, vc.nom AS equipe, vc.heure_depart, vc.heure_arrive, vc.duree, vc.rang_coureur,

COALESCE(pe.point, 0) AS point
        FROM  etape et
        LEFT JOIN  v_classement_coureur vc ON et.id_etape = vc.id_etape AND vc.id_equipe = 1
        LEFT JOIN  point_etape pe ON vc.rang_coureur = pe.rang
        WHERE vc.id_equipe = 1 OR vc.id_equipe IS NULL
        ORDER BY  et.rang, vc.rang_coureur;


SELECT  id_equipe,  nom,  point, RANK() OVER (ORDER BY point DESC) AS classement
FROM ( SELECT  vc.id_equipe, vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
    FROM equipe e 
    LEFT JOIN v_classement_coureur vc ON vc.id_equipe = e.id_equipe 
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang 
    LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur 
    WHERE cc.id_categorie = 1 OR cc.id_categorie IS NULL GROUP BY vc.id_equipe, vc.nom
) AS subquery;


--/////////////////////////////////



SELECT vc.id_coureur,vc.id_equipe,vc.id_etape,vc.duree, COALESCE(pe.point, 0) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
WHERE vc.id_etape = 1
ORDER BY vc.id_etape, vc.rang_coureur;



  SELECT vc.id_coureur,vc.id_equipe,vc.id_etape,vc.duree, COALESCE(pe.point, 0) AS point 
    FROM v_classement_coureur vc
    JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
    WHERE cc.id_categorie = 1 AND vc.id_etape = 1
    ORDER BY vc.id_etape, vc.rang_coureur;

SELECT vc.id_coureur,
       vc.id_equipe,
       vc.id_etape,
       vc.duree,
       COALESCE(pe.point, 0) AS point,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape ORDER BY vc.duree ASC) AS rang_dense
FROM v_classement_coureur vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur

CREATE VIEW  v_classement_etape  AS(
SELECT vc.*,
       COALESCE(pe.point, 0) AS point,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape ORDER BY vc.duree ASC) AS rang_dense
FROM v_classement_coureur vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur);




CREATE VIEW v_classement_categorie AS (


SELECT cat.nom as categorie, vc.id_coureur,vc.nom, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point, cc.id_categorie,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape, cc.id_categorie ORDER BY vc.duree) AS rang_dense
FROM v_classement_etape vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
JOIN categorie cat ON cc.id_categorie = cat.id_categorie
GROUP BY cat.nom , vc.rang_etape,vc.nom, vc.id_coureur, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point, cc.id_categorie
ORDER BY vc.rang_etape, cc.id_categorie
);





SELECT vcc.categorie,
       vcc.id_coureur,
       vcc.nom AS coureur_nom,
       vcc.coureur,
       vcc.id_equipe,
       vcc.id_etape,
       vcc.duree,
       vcc.point,
       vcc.id_categorie,
       vcc.rang_dense,
       COALESCE(pe.point, 0) AS point_categorie
FROM  v_classement_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang;





SELECT vcc.categorie,
       vcc.id_coureur,
       vcc.nom AS coureur_nom,
       vcc.coureur,
       vcc.id_equipe,
       vcc.id_etape,
       vcc.duree,
       vcc.id_categorie,
       vcc.rang_dense,
       COALESCE(pe.point, 0) AS point_categorie
FROM  v_classement_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang;


SELECT  vcc.id_equipe,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie
FROM  v_classement_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
GROUP BY vcc.id_equipe,vcc.nom,vcc.id_categorie,vcc.categorie
ORDER BY vcc.id_categorie;



SELECT  vcc.id_equipe,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie
FROM  v_classement_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
GROUP BY vcc.id_equipe,vcc.nom,vcc.id_categorie,vcc.categorie
ORDER BY vcc.categorie,point_categorie ;


SELECT vcc.id_equipe,
       vcc.nom,
       vcc.id_categorie,
       vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
GROUP BY vcc.id_equipe, vcc.nom, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;



