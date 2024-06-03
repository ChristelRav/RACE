<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Point_Etape extends CI_Model {
    public function getOne($where) {
        $this->db->where('id_point_etape', $where);
        $query = $this->db->get('point_etape'); 
        return $query->row(); 
    }
    public function insert($col1,$col2) {
        $sql = "insert into point_etape (rang, point) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
}
?>