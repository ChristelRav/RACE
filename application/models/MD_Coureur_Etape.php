<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Coureur_Etape extends CI_Model {
    public function getOne($where) {
        $this->db->where('id_coureur_etape', $where);
        $query = $this->db->get('coureur_etape'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col4,$col3) {
        $sql = "insert into coureur_etape (id_etape,id_coureur,date_parcours,heure_depart) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col4),$this->db->escape($col3));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function insert1($col1,$col2,$col4,$col5) {
        $sql = "insert into coureur_etape (id_etape,id_coureur,heure_depart,heure_arrive) values ( %s,  %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col4),$this->db->escape($col5));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function list_coureur_etape($where){
        $this->db->select("ce.*,c.nom as coureur,c.num_dossard,c.genre,c.date_naissance,e.id_equipe,e.nom");
        $this->db->from('coureur_etape ce');
        $this->db->join('coureur c', 'c.id_coureur = ce.id_coureur');
        $this->db->join('equipe e ', ' e.id_equipe = c.id_equipe');
        $this->db->where('ce.id_etape', $where);
        $query = $this->db->get();
        return $query->result();  
    }
    public function display_list($where){
        $tab = $this->MD_Coureur_Etape->list_coureur_etape($where);
        foreach ($tab as $t) {
            if ($t->genre == 'M') {
                $t->genre = 'Homme';
            } elseif ($t->genre == 'F') {
                $t->genre == 'Femme';
            }
        }
        return $tab;
    }
    public function update($id,$col1,$col2) {
        $sql = "update coureur_etape set heure_depart =%s  , heure_arrive =%s where id_coureur_etape =%s";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($id));
        $this->db->query($sql);
    }
    public function rang_etape(){
        $this->db->select("ce.*,c.nom,c.num_dossard,c.genre,c.date_naissance,e.id_equipe,e.nom,
        (heure_arrive - heure_depart) as duree");
        $this->db->from('coureur_etape ce');
        $this->db->join('coureur c', 'c.id_coureur = ce.id_coureur');
        $this->db->join('equipe e ', ' e.id_equipe = c.id_equipe');
        $this->db->where('ce.id_etape', $where);
        $this->db->order_by('(heure_arrive - heure_depart)','ASC');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>