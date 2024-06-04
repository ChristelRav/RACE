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


CREATE VIEW v_classement_coureur AS (
SELECT *,DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY duree ASC) AS rang_coureur
FROM v_classement
ORDER BY id_etape ASC
);


CREATE VIEW v_classement_equipe AS ( SELECT vc.id_equipe,vc.nom,SUM(COALESCE(pe.point, 0)) AS point 
FROM v_classement_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
GROUP BY vc.id_equipe,vc.nom
);

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



