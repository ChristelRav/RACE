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
        $sql = "
        SELECT  et.id_etape, et.nom AS etape, et.longueur , et.nbr_coureur , et.rang AS rang_etape,et.date_etape,et.heure_depart as hd, vc.id_coureur, vc.coureur, vc.num_dossard, vc.id_equipe, vc.nom AS equipe, vc.heure_depart, vc.heure_arrive, vc.duree, vc.rang_coureur,
        COALESCE(pe.point, 0) AS point
        FROM  etape et
        LEFT JOIN  v_classement_coureur vc ON et.id_etape = vc.id_etape AND vc.id_equipe = %s
        LEFT JOIN  point_etape pe ON vc.rang_coureur = pe.rang
        WHERE vc.id_equipe = %s OR vc.id_equipe IS NULL
        ORDER BY  et.rang, vc.rang_coureur";
        $sql = sprintf($sql,$this->db->escape($where),$this->db->escape($where));
        $query = $this->db->query($sql);
        //  echo $sql;
        return $query->result();
    }
    public function detail_etape_equipe($where){
        $result = array();
        $tab = $this->detail_equipe($where);
        foreach ($tab as $row) {
            $duree = ($row->duree !== null) ? ($row->duree > 0 ? $row->duree : '00:00:00') : null;
            $result[$row->id_etape]['id_etape'] = $row->id_etape;
            $result[$row->id_etape]['rang_etape'] = $row->rang_etape;
            $result[$row->id_etape]['nom'] = $row->etape;
            $result[$row->id_etape]['longueur'] = $row->longueur;
            $result[$row->id_etape]['nbr_coureur'] = $row->nbr_coureur;
            $result[$row->id_etape]['date_etape'] = $row->date_etape;
            $result[$row->id_etape]['hd'] = $row->hd;
            $result[$row->id_etape]['etape'][] = array(
                'id_coureur' => $row->id_coureur,
                'coureur' => $row->coureur,
                'num_dossard' => $row->num_dossard,
                'id_equipe' => $row->id_equipe,
                'equipe' => $row->equipe,
                'rang_coureur' => $row->rang_coureur,
                'point' => $row->point,
                'duree' => $duree
            );
        }
        return $result;
    }    
}
?>