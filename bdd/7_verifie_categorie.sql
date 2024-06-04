SELECT vc.nom,vc.coureur,vc.point_etape,vc.duree FROM v_classement_gnrl_etape vc
WHERE vc.id_etape=1;

select duree,heure_depart, heure_arrive,id_etape,id_coureur from v_classement_gnrl_coureur_etape
WHERE id_equipe=4;

select duree,heure_depart, heure_arrive,id_etape,id_coureur,id_equipe from v_classement_gnrl_coureur_etape;


--//
SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =1 AND  vcc.id_categorie = 1
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;


SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =1 AND  vcc.id_categorie = 2
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;

SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =1 AND  vcc.id_categorie = 1
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;


SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =1 AND  vcc.id_categorie = 3
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;



--//
SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =2 AND  vcc.id_categorie = 1
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;


SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =2 AND  vcc.id_categorie = 2
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;

SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_etape =2 AND  vcc.id_categorie = 3
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;





SELECT vcc.id_equipe,vcc.id_etape,vcc.coureur,vcc.nom,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE   vcc.id_categorie = 3
GROUP BY vcc.id_equipe,vcc.coureur, vcc.nom,vcc.id_etape, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;

SELECT cat.nom as categorie, vc.id_coureur,vc.nom, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point_etape, cc.id_categorie,
       DENSE_RANK() OVER (PARTITION BY vc.id_etape, cc.id_categorie ORDER BY vc.duree) AS rang_dense
FROM v_classement_gnrl_etape vc
JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur
JOIN categorie cat ON cc.id_categorie = cat.id_categorie
WHERE vc.id_equipe=1
GROUP BY cat.nom , vc.rang_etape,vc.nom, vc.id_coureur, vc.coureur, vc.id_equipe, vc.id_etape, vc.duree, vc.point_etape, cc.id_categorie
ORDER BY vc.rang_etape, cc.id_categorie;


SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_etape,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_equipe=1 AND vcc.id_categorie=2
GROUP BY vcc.id_equipe,vcc.coureur,vcc.id_etape, vcc.nom, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;



SELECT vcc.id_equipe,vcc.duree,vcc.coureur,vcc.nom,vcc.id_etape,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
GROUP BY vcc.id_equipe,vcc.duree,vcc.coureur,vcc.id_etape, vcc.nom, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;



SELECT vcc.id_equipe,vcc.coureur,vcc.nom,vcc.id_etape,vcc.id_categorie,vcc.categorie,
       SUM(COALESCE(pe.point, 0)) AS point_categorie,
       DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
FROM v_classement_gnrl_categorie vcc
JOIN point_etape pe ON vcc.rang_dense = pe.rang
WHERE vcc.id_equipe=1
GROUP BY vcc.id_equipe,vcc.coureur,vcc.id_etape, vcc.nom, vcc.id_categorie, vcc.categorie
ORDER BY vcc.categorie, rang_dense;
