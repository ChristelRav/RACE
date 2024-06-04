<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Temp extends CI_Model {
    public function insert($col1,$col2,$col3,$col4,$col5,$col6,$col7) {
        $col5 = DateTime::createFromFormat('d/m/Y', $col5)->format('Y-m-d');
        $col7 = DateTime::createFromFormat('d/m/Y H:i:s', $col7)->format('Y-m-d H:i:s');
        $sql = "insert into temp1 (etape_rang, numero_dossard,nom, genre, date_naissance, equipe, arrivee) values ( %s, %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3)
                           ,$this->db->escape($col4),$this->db->escape($col5),$this->db->escape($col6)
                           ,$this->db->escape($col7));
        $this->db->query($sql);
    }
    public function insert1($col1,$col2) {
        $sql = "insert into temp2 (classement,points) values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2));
        $this->db->query($sql);
    }
    public function insert3($col1,$col2,$col3,$col4,$col5,$col6) {
        $col5 = DateTime::createFromFormat('d/m/Y', $col5)->format('Y-m-d');
        $col6 = DateTime::createFromFormat('H:i:s', $col6)->format('H:i:s');
        $sql = "insert into temp3 (etape, longueur, nb_coureur, rang, date_depart, heure_depart) values ( %s, %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3)
                           ,$this->db->escape($col4),$this->db->escape($col5),$this->db->escape($col6));
        $this->db->query($sql);
    }
    public function insert_point(){
        $sql = "
        INSERT INTO point_etape (rang,point)
        SELECT classement , points FROM temp2";
        $this->db->query($sql);
    }
    public function insert_etape(){
        $sql = "
        INSERT INTO etape (nom, longueur, nbr_coureur, rang,date_etape, heure_depart)
        SELECT   etape,longueur,nb_coureur,rang,date_depart,heure_depart FROM temp3";
        $this->db->query($sql);   
    }
    public function insert_equipe(){
        $sql = " 
        INSERT INTO equipe (nom, pseudo, mot_passe)
        SELECT distinct t1.equipe,t1.equipe,t1.equipe
        FROM temp1 t1";
        $this->db->query($sql);
    }
    public function insert_coureur(){
        $sql = "
        INSERT INTO  coureur (id_equipe, nom, num_dossard, genre, date_naissance)
        SELECT  e.id_equipe,t1.nom,t1.numero_dossard,t1.genre,t1.date_naissance
        FROM temp1 t1
        JOIN equipe e ON e.nom = t1.equipe
        GROUP BY  e.id_equipe,t1.nom,t1.numero_dossard,t1.genre,t1.date_naissance";
        $this->db->query($sql);
    }
    public function insert_coureur_etape(){
        $sql = "
        INSERT INTO coureur_etape (id_etape, id_coureur,  heure_depart, heure_arrive) 
        SELECT e.id_etape,c.id_coureur,e.date_etape + e.heure_depart::time as heure_depart , t1.arrivee
        FROM temp1 t1
        JOIN etape e ON e.rang = t1.etape_rang
        JOIN coureur c ON c.nom = t1.nom AND c.genre = t1.genre AND c.date_naissance = t1.date_naissance
        AND c.num_dossard = t1.numero_dossard";
        $this->db->query($sql);
    }
}
?>