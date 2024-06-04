<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Classement extends CI_Model {
    public function classement_coureur(){
        $sql = "select * from v_classement_gnrl_coureur_etape";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function display_etape(){
        $result = array();
        $tab = $this->classement_coureur();
        foreach ($tab as $row) {
            if($row->duree >= 0){ 
                if ($row->genre == 'M') {
                    $row->genre = 'Homme';
                } elseif ($row->genre == 'F') {
                    $row->genre = 'Femme';
                }
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
                    'point' => $row->point_etape,
                    'genre' => $row->genre,
                    'duree' => $row->duree,
                    'temps_penalite' => $row->temps_penalite,
                    'duree_simple' => $row->duree_simple
                );
            }
        }
        return $result;
    }
    public function classement_equipe(){
        $sql = "SELECT * FROM v_classement_gnrl_equipe;";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function detail_classement_equipe() {
        $tab = $this->classement_equipe();
        foreach ($tab as $row) {
            if ($row->rang_equipe == 1) {
                $row->pdf = '<a href="' . base_url('CTE_Classement/pdf?nom=' . urlencode($row->nom) . '&points=' . urlencode($row->point)) . '" target="_blank" class="btn btn-danger"><i class="mdi mdi-download mx-0"></i></a>';
            } else {
                $row->pdf = '';
            }
        }
        return $tab;
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
        $sql = "SELECT * FROM v_classement_gnrl_equipe_categorie";
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