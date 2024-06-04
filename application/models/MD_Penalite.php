<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Penalite extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_penalite', $where);
        $query = $this->db->get('penalite'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col3) {
        $sql = "insert into penalite (id_etape, id_equipe, temps_penalite) values ( %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function delete($id){
        $sql = "delete from penalite where id_penalite =%s";
        $sql = sprintf($sql,$this->db->escape($id));
        $this->db->query($sql);
    }
    public function list_equipe_penalite(){
        $this->db->select(" p.*,et.nom as etape, e.nom as equipe");
        $this->db->from('penalite p ');
        $this->db->join(' equipe e', ' e.id_equipe = p.id_equipe');
        $this->db->join('etape et', 'et.id_etape = p.id_etape');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>