<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Classement extends CI_Model {
    public function classement_coureur(){
        $sql = "
        SELECT *, COALESCE(pe.point, 0) AS point 
        FROM v_classement_coureur vc
        LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
        ORDER BY vc.id_etape, vc.rang_coureur";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function display_etape(){
        $result = array();
        $tab = $this->classement_coureur();
        foreach ($tab as $row) {
            if($row->duree >= 0){ 
               // echo  $row->coureur.'  -- DDD = '.$row->duree.'<br>';
                $result[$row->id_etape]['id_etape'] = $row->id_etape;
                $result[$row->id_etape]['rang_etape'] = $row->rang_etape;
                $result[$row->id_etape]['nom'] = $row->etape;
                $result[$row->id_etape]['etape'][] = array(
                    'id_coureur' => $row->id_coureur,
                    'coureur' => $row->coureur,
                    'num_dossard' => $row->num_dossard,
                    'id_equipe' => $row->id_equipe,
                    'nom' => $row->nom,
                    'rang_coureur' => $row->rang_coureur,
                    'point' => $row->point,
                    'duree' => $row->duree
                );
            }
        }
        return $result;
    }
    public function classement_equipe(){
        $sql = "
        SELECT id_equipe, nom, total_point,
        RANK() OVER (ORDER BY total_point DESC) AS rang
        FROM (
            SELECT vc.id_equipe, vc.nom, SUM(COALESCE(pe.point, 0)) AS total_point
            FROM v_classement_coureur vc
            LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
            WHERE vc.duree >= '00:00:00'::interval -- Filtrer les durées positives
            GROUP BY vc.id_equipe, vc.nom
        ) AS subquery";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function selection_equipe($where){
        $sql = "
        SELECT id_equipe, id_etape, nom, total_point,
            RANK() OVER (ORDER BY total_point DESC) AS rang
        FROM (
            SELECT vc.id_equipe, vc.id_etape, vc.nom, SUM(COALESCE(pe.point, 0)) AS total_point
            FROM v_classement_coureur vc
            LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang
            WHERE vc.duree >= '00:00:00'::interval
            AND vc.id_etape = %s
            GROUP BY vc.id_equipe, vc.nom, vc.id_etape
        ) AS subquery";
        $sql = sprintf($sql,$this->db->escape($where));
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function selection_categorie($where){
        $sql = "
        SELECT  id_equipe,  nom ,  point as total_point, RANK() OVER (ORDER BY point DESC) AS rang
        FROM ( SELECT  vc.id_equipe, vc.nom, SUM(COALESCE(pe.point, 0)) AS point 
            FROM equipe e 
            LEFT JOIN v_classement_coureur vc ON vc.id_equipe = e.id_equipe 
            LEFT JOIN point_etape pe ON vc.rang_coureur = pe.rang 
            LEFT JOIN coureur_categorie cc ON cc.id_coureur = vc.id_coureur 
            WHERE cc.id_categorie = %s OR cc.id_categorie IS NULL GROUP BY vc.id_equipe, vc.nom
        ) AS subquery";
        $sql = sprintf($sql,$this->db->escape($where));
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function classement_categorie(){
        $sql = "
        SELECT vcc.id_equipe,
        vcc.nom,
        vcc.id_categorie,
        vcc.categorie,
        SUM(COALESCE(pe.point, 0)) AS point_categorie,
        DENSE_RANK() OVER (PARTITION BY vcc.categorie ORDER BY SUM(COALESCE(pe.point, 0)) DESC) AS rang_dense
        FROM v_classement_categorie vcc
        JOIN point_etape pe ON vcc.rang_dense = pe.rang
        GROUP BY vcc.id_equipe, vcc.nom, vcc.id_categorie, vcc.categorie
        ORDER BY vcc.categorie, rang_dense";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function display_categorie(){
        $result = array();
        $tab = $this->classement_categorie();
        foreach ($tab as $row) {
                $result[$row->id_categorie]['id_categorie'] = $row->id_categorie;
                $result[$row->id_categorie]['categorie'] = $row->categorie;
                $result[$row->id_categorie]['detail'][] = array(
                    'id_equipe' => $row->id_equipe,
                    'nom' => $row->nom,
                    'rang' => $row->rang_dense,
                    'point_categorie' => $row->point_categorie
                );
        }
        return $result;
    }
}
?>