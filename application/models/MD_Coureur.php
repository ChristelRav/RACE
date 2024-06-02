<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Coureur extends CI_Model {
    public function list_coureur_equipe($where){
        $this->db->select("*");
        $this->db->from('coureur');
        $this->db->where('id_equipe',$where);
        $query = $this->db->get();
        return $query->result();  
    }
}
?>