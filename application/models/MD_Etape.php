<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Etape extends CI_Model {
    public function list(){
        $this->db->select("*");
        $this->db->from('etape');
        $this->db->order_by('rang', 'ASC');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>