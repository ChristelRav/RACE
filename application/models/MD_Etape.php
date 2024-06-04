<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Etape extends CI_Model {
    public function getOne($where) {
        $this->db->where('id_etape', $where);
        $query = $this->db->get('etape'); 
        return $query->row(); 
    }
    public function list(){
        $this->db->select("*");
        $this->db->from('etape');
        $this->db->order_by('rang', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }
    public function insert($col1,$col2,$col3,$col4,$col5,$col6) {
        $sql = "insert into etape (nom, longueur, nbr_coureur, rang,date_etape, heure_depart) values ( %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3)
                           ,$this->db->escape($col4),$this->db->escape($col5),$this->db->escape($col6));
        $this->db->query($sql);
        echo $sql;
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function detail_equipe($where){
        $sql = "SELECT
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
            AND vc.id_equipe = %s
        ORDER BY
            e.date_etape, e.heure_depart;
        ";
        $sql = sprintf($sql,$this->db->escape($where),$this->db->escape($where));
        $query = $this->db->query($sql);
        //  echo $sql;
        return $query->result();
    }
    public function detail_etape_equipe($where){
        $result = array();
        $tab = $this->detail_equipe($where);
        foreach ($tab as $row) {
            $duree = ($row->duree !== null) ? ($row->duree > '00:00:00' ? $row->duree : '') : null;
            $result[$row->id_etape]['id_etape'] = $row->id_etape;
            $result[$row->id_etape]['rang_etape'] = $row->rang_etape;
            $result[$row->id_etape]['nom'] = $row->etape;
            $result[$row->id_etape]['longueur'] = $row->longueur;
            $result[$row->id_etape]['nbr_coureur'] = $row->nbr_coureur;
            $result[$row->id_etape]['date_etape'] = $row->date_etape;
            $result[$row->id_etape]['hd'] = $row-> heured;
            $result[$row->id_etape]['etape'][] = array(
                'id_coureur' => $row->id_coureur,
                'coureur' => $row->coureur,
                'num_dossard' => $row->num_dossard,
                'id_equipe' => $row->id_equipe,
                'equipe' => $row->nom,
                'rang_coureur' => $row->rang_coureur,
                'point' => $row->point_etape,
                'duree' => $duree
            );
        }
        return $result;
    }    
    public function exception_affectation_coureur($where1,$where2){
        $this->db->select(" count(*) as nbr");
        $this->db->from('coureur_etape ce');
        $this->db->join('coureur c', 'c.id_coureur = ce.id_coureur');
        $this->db->where('ce.id_etape', $where1);
        $this->db->where('c.id_equipe', $where2);
        $query = $this->db->get();
        return $query->row();  
    }
}
?>