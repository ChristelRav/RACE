<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Coureur_Categorie extends CI_Model {
    public function list_coureur_categorie(){
        $sql = "
        SELECT c.id_coureur, c.id_equipe, c.nom AS nom_coureur, c.num_dossard, c.genre, c.date_naissance,e.nom AS nom_equipe,cc.id_categorie, ca.nom AS nom_categorie
        FROM coureur c
        JOIN equipe e ON e.id_equipe = c.id_equipe
        LEFT JOIN coureur_categorie cc ON cc.id_coureur = c.id_coureur
        LEFT JOIN categorie ca ON ca.id_categorie = cc.id_categorie";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function detail_categorie_coureur(){
        $result = array();
        $tab = $this->list_coureur_categorie();
        foreach ($tab as $row) {
            $result[$row->id_coureur]['id_coureur'] = $row->id_coureur;
            $result[$row->id_coureur]['nom_coureur'] = $row->nom_coureur;
            $result[$row->id_coureur]['num_dossard'] = $row->num_dossard;
            if ($row->genre == 'M') {
                $row->genre = 'Homme';
            } elseif ($row->genre == 'F') {
                $row->genre = 'Femme';
            }
            $result[$row->id_coureur]['genre'] = $row->genre;
            $result[$row->id_coureur]['date_naissance'] = $row->date_naissance;
            $result[$row->id_coureur]['id_equipe'] = $row->id_equipe;
            $result[$row->id_coureur]['nom_equipe'] = $row->nom_equipe;
            $result[$row->id_coureur]['detail_categorie'][] = array(
                'id_categorie' => $row->id_categorie,
                'categorie' => $row->nom_categorie
            );
        }
        return $result;
    }
    public function getOne($where) {
        $this->db->where('id_coureur_categorie', $where);
        $query = $this->db->get('coureur_categorie'); 
        return $query->row(); 
    }
    public function getOne_nom($where) {
        $this->db->where('nom', $where);
        $query = $this->db->get('categorie'); 
        return $query->row(); 
    }
    public function insert($col1,$col2) {
        $sql = "insert into coureur_categorie (id_coureur, id_categorie) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function generation_categorie(){
        $this->load->model('MD_Categorie');
        $result = array();
        $tab = $this->list_coureur_categorie();
        foreach ($tab as $row) {
            $result[$row->id_coureur]['id_coureur'] = $row->id_coureur;
            $result[$row->id_coureur]['nom_coureur'] = $row->nom_coureur;
            $result[$row->id_coureur]['num_dossard'] = $row->num_dossard;
            if ($row->genre == 'M') {
                $categ = $this->MD_Categorie->getOne_nom('homme');
                $this->insert($row->id_coureur,$categ->id_categorie);
            } elseif ($row->genre == 'F') {
                $categ = $this->MD_Categorie->getOne_nom('femme');
                $this->insert($row->id_coureur,$categ->id_categorie);
            }
            $result[$row->id_coureur]['genre'] = $row->genre;
            $result[$row->id_coureur]['date_naissance'] = $row->date_naissance;
            $date_naissance = $row->date_naissance;
            $date_naissance_obj = new DateTime($date_naissance);
            $date_actuelle = new DateTime();
            $diff = $date_actuelle->diff($date_naissance_obj);
            $age = $diff->y;
            if($diff->y < 18){
                $categ = $this->MD_Categorie->getOne_nom('junior');
                $this->insert($row->id_coureur,$categ->id_categorie);
            }
            $result[$row->id_coureur]['id_equipe'] = $row->id_equipe;
            $result[$row->id_coureur]['nom_equipe'] = $row->nom_equipe;
        }
    }
}
?>