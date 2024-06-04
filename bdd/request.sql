
CREATE VIEW v_classement_gnrl AS
SELECT ce.id_coureur,c.genre, ce.id_etape, et.nom as etape,et.rang as rang_etape ,et.longueur,et.nbr_coureur,et.date_etape, c.nom as coureur,et.heure_depart as hd, c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,
       ce.heure_arrive - ce.heure_depart AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
JOIN etape et ON et.id_etape = ce.id_etape
GROUP BY ce.id_coureur,c.genre, ce.id_etape, et.nom ,et.rang , c.nom , c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,et.longueur,et.nbr_coureur,et.date_etape,et.heure_depart 
ORDER BY duree ASC;


CREATE VIEW v_classement_gnrl_coureur AS (
SELECT *,DENSE_RANK() OVER (PARTITION BY id_etape ORDER BY duree ASC) AS rang_coureur
FROM v_classement_gnrl
ORDER BY id_etape ASC
);



CREATE VIEW v_classement_gnrl_coureur_etape  AS 
SELECT vc.*, COALESCE(pe.point, 0) AS point_etape 
FROM v_classement_gnrl_coureur vc
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur;




CREATE VIEW v_classement_gnrl_equipe AS 
SELECT id_equipe, nom, point, DENSE_RANK() OVER (ORDER BY point DESC) AS rang_equipe
FROM (
    SELECT vc.id_equipe,vc.nom,
           SUM(COALESCE(pe.point, 0)) AS point
    FROM v_classement_gnrl_coureur vc
    LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
    GROUP BY vc.id_equipe, vc.nom
) AS points_summary
ORDER BY rang_equipe;



CREATE VIEW  v_classement_gnrl_etape  AS 
SELECT vc.*,COALESCE(pe.point, 0) AS point_etape,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape ORDER BY vc.duree ASC) AS rang_etape_coureur
FROM v_classement_gnrl_coureur vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
ORDER BY vc.id_etape, vc.rang_coureur;


CREATE VIEW v_classement_gnrl_categorie AS 
SELECT cat.nom as categorie, vc.id_coureur,vc.nom, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point_etape, cc.id_categorie,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape, cc.id_categorie ORDER BY vc.duree) AS rang_dense
FROM v_classement_gnrl_etape vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
JOIN categorie cat ON cc.id_categorie = cat.id_categorie
GROUP BY cat.nom , vc.rang_etape,vc.nom, vc.id_coureur, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point_etape, cc.id_categorie
ORDER BY vc.rang_etape, cc.id_categorie;


CREATE VIEW v_classement_gnrl_equipe_categorie AS
SELECT vcc.id_equipe,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
GROUP BY vcc.id_equipe, vcc.nom, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;



