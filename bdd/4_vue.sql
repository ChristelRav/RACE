--classement sans point
CREATE VIEW v_classement AS (
SELECT ce.id_coureur, ce.id_etape, et.nom as etape,et.rang as rang_etape , c.nom as coureur, c.num_dossard, e.id_equipe, e.nom,
       SUM(ce.heure_arrive - ce.heure_depart) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
JOIN etape et ON et.id_etape = ce.id_etape
GROUP BY ce.id_coureur, ce.id_etape, et.nom ,et.rang , c.nom , c.num_dossard, e.id_equipe, e.nom
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

