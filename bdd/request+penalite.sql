

CREATE VIEW v_classement_gnrl AS
SELECT ce.id_coureur,c.genre, ce.id_etape, et.nom as etape,et.rang as rang_etape ,et.longueur,et.nbr_coureur,et.date_etape, c.nom as coureur,et.heure_depart as hd, c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,
       ce.heure_arrive - ce.heure_depart AS duree_simple,
       SUM(COALESCE(pt.temps_penalite,'00:00:00')) AS temps_penalite,
       (ce.heure_arrive - ce.heure_depart ) + SUM(COALESCE(pt.temps_penalite,'00:00:00')) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
JOIN etape et ON et.id_etape = ce.id_etape
LEFT JOIN penalite pt ON pt.id_etape = ce.id_etape AND pt.id_equipe = c.id_equipe
GROUP BY ce.id_coureur,c.genre, ce.id_etape, et.nom ,et.rang , c.nom , c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,et.longueur,et.nbr_coureur,et.date_etape,et.heure_depart
ORDER BY duree ASC;




SELECT ce.id_coureur, ce.id_etape, et.nom as etape,et.rang as rang_etape , c.nom as coureur,e.id_equipe, e.nom,
        ce.heure_arrive - ce.heure_depart AS duree_simple,
      SUM(COALESCE(pt.temps_penalite,'00:00:00')) AS temps_penalite,
       (ce.heure_arrive - ce.heure_depart ) + SUM(COALESCE(pt.temps_penalite,'00:00:00')) AS duree
FROM coureur_etape ce
JOIN coureur c ON c.id_coureur = ce.id_coureur
JOIN equipe e ON e.id_equipe = c.id_equipe
JOIN etape et ON et.id_etape = ce.id_etape
LEFT JOIN penalite pt ON pt.id_etape = ce.id_etape AND pt.id_equipe = c.id_equipe
GROUP BY ce.id_coureur ,c.genre, ce.id_etape, et.nom ,et.rang , c.nom , c.num_dossard, e.id_equipe, e.nom,ce.heure_depart,ce.heure_arrive,et.longueur,et.nbr_coureur,et.date_etape,et.heure_depart 
ORDER BY duree ASC;