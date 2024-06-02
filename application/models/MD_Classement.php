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
}
?>