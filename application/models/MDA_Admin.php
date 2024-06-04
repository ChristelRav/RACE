<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MDA_Admin extends CI_Model{
    //login
    public function verify($email, $password) {
        $query = $this->db->get_where('admin', array('email' => $email, 'mot_passe' => $password));
        $client = $query->result_array();
        return $client;
    }
    public function truncate_all_tables() {
        $tables = [
            'temp3',
            'temp2',
            'temp1',
            'penalite',
            'point_etape',
            'coureur_etape',
            'coureur_categorie',
            'etape',
            'coureur',
            'categorie',
            'equipe'
        ];
        foreach ($tables as $table) {
            $sql = "TRUNCATE TABLE $table RESTART IDENTITY CASCADE;";
            $this->db->query($sql);
        }
    }
}
?>