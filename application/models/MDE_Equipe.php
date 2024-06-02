<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MDE_Equipe extends CI_Model{
    //login
    public function verify($email, $password) {
        $query = $this->db->get_where('equipe', array('pseudo' => $email, 'mot_passe' => $password));
        $client = $query->result_array();
        return $client;
    }
}
?>