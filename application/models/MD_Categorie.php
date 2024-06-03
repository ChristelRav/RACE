<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Categorie extends CI_Model {
    public function getOne_nom($where) {
        $this->db->where('LOWER(nom)', $where);
        $query = $this->db->get('categorie'); 
        echo $this->db->last_query();
        return $query->row(); 
    }
    public function list(){
        $this->db->select("*");
        $this->db->from('categorie');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>