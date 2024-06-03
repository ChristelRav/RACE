<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_Import extends CI_Model {
    public function import1($csv){
        $this->load->model('MD_Etape');
        if (isset($_FILES[$csv]['name']) && $_FILES[$csv]['name'] != '') {
            $path = $_FILES[$csv]['tmp_name'];
            $file = fopen($path, 'r'); 
            $csv_data = []; $ln = 0; $fl = true;
            $erreur = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $ln++;
                if ($fl) {
                    $fl = false;
                    continue; 
                }
                 $csv_data[] = $line;  
                 echo $line[0].' -- '.$line[1].' -- '.$line[2].' -- '.$line[3].' -- '.$line[4].' -- '.$line[5].'<br>';    $error_check = $this->controle2($ln, $line[0]);
                 $error_check = $this->controle1($ln,$line[3],$line[1],$line[2],$line[4],$line[5]);
                 if (!empty($error_check)) {
                     $erreur[$ln] = $error_check;
                 }
            }
            if (!empty($erreur)) {
                echo 'ERROR';
                $data['erreur1'] = $erreur;
                return $data;
            } else {
                foreach ($csv_data as $line) {
                    $this->MD_Etape->insert($line[0],str_replace(',', '.', $line[1]),$line[2],$line[3],$line[4],$line[5]);
                }
                return;
            }
            fclose($file);
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
        }
    }
    public function controle1($ln,$rang,$long,$nb,$date,$heure){
        $this->load->model('MD_Csv');
        $erreur_date = [];
        if (!$this->MD_Csv->is_positive($rang)) {$erreur_date[] = 'Rang Etape invalide';   echo $rang.'!!!<br>';}
        if (!$this->MD_Csv->is_positive($long)) {$erreur_date[] = 'kilometre invalide';   echo $long.'!!!<br>';}
        if (!$this->MD_Csv->is_positive($nb)) {$erreur_date[] = 'Nb coureur invalide';   echo $nb.'!!!<br>';}
        if (!$this->MD_Csv->is_valid_date($date)) {$erreur_date[] = 'Date invalide';  echo $date.'???<br>';}
        if (!$this->MD_Csv->is_valid_time($heure)) {$erreur_date[] = 'Heure depart invalide';  echo $heure.'???<br>';}
        return $erreur_date;
    }
    //CSV 1 / 2
    public function import1_2($csv){
        $this->load->model('MD_Temp');
        if (isset($_FILES[$csv]['name']) && $_FILES[$csv]['name'] != '') {
            $path = $_FILES[$csv]['tmp_name'];
            $file = fopen($path, 'r'); 
            $csv_data = []; $ln = 0; $fl = true;
            $erreur = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $ln++;
                if ($fl) {
                    $fl = false;
                    continue; 
                }
                $error_check = $this->controle1_2($ln,$line[0],$line[1],$line[4],$line[6]);
                if (!empty($error_check)) {
                    $erreur[$ln] = $error_check;
                }
                $csv_data[] = $line;  
            }
            if (!empty($erreur)) {
                echo 'ERROR';
                $data['erreur2'] = $erreur;
                return $data;
            } else {
                foreach ($csv_data as $line) {
                    echo $line[0].' -- '.$line[1].' -- '.$line[2].' -- '.$line[3].' -- '.$line[4].' -- '.$line[5].' -- '.$line[6].'<br>';   
                    $this->MD_Temp->insert($line[0],$line[1],$line[2],$line[3],$line[4],$line[5],$line[6]); 
                }
                $this->MD_Temp->insert_equipe();
                $this->MD_Temp->insert_coureur();
                $this->MD_Temp->insert_coureur_etape();
                return;
            }
            fclose($file);
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
        }
    }
    public function controle1_2($ln,$rang,$num,$date,$heure){
        $this->load->model('MD_Csv');
        $erreur_date = [];
        if (!$this->MD_Csv->is_positive($rang)) {$erreur_date[] = 'Rang Etape invalide';   echo $rang.'!!!<br>';}
        if (!$this->MD_Csv->is_positive($num)) {$erreur_date[] = 'numero dossard invalide';   echo $num.'!!!<br>';}
        if (!$this->MD_Csv->is_valid_date($date)) {$erreur_date[] = 'Date naissance invalide';  echo $date.'???<br>';}
        if (!$this->MD_Csv->is_valid_datetime($heure)) {$erreur_date[] = 'Heure arrivee invalide';  echo $heure.'???<br>';}
        return $erreur_date;
    }
    //CSV 2
    public function import2($csv){
        $this->load->model('MD_Point_Etape');
        if (isset($_FILES[$csv]['name']) && $_FILES[$csv]['name'] != '') {
            $path = $_FILES[$csv]['tmp_name'];
            $file = fopen($path, 'r'); 
            $csv_data = []; $ln = 0; $fl = true;
            $erreur = [];
            while (($line = fgetcsv($file, 1000, ',')) !== FALSE) {
                $ln++;
                if ($fl) {
                    $fl = false;
                    continue; 
                }
               
                $error_check = $this->controle2($ln, $line[0]);
                if (!empty($error_check)) {
                    $erreur[$ln] = $error_check;
                }
                 $csv_data[] = $line;   
            }
            if (!empty($erreur)) {
                echo 'ERROR';
                $data['erreur'] = $erreur;
                return $data;
            } else {
                echo 'COUCOU';
                foreach ($csv_data as $line) {
                    $this->MD_Point_Etape->insert($line[0], $line[1]);
                }
                return;
            }
            fclose($file);
        } else {
            $this->session->set_flashdata('message', 'Veuillez sélectionner un fichier CSV.');
        }
    }
    public function controle2($ln,$rang){
        $this->load->model('MD_Csv');
        $erreur_date = [];
        if (!$this->MD_Csv->is_positive($rang)) {$erreur_date[] = 'Rang invalide';   echo $rang.'!!!<br>';}
        return $erreur_date;
    }
    public function tab_Erreur($resultat_import, $val){
        $erreurs = [];
        if (isset($resultat_import[$val]) && is_array($resultat_import[$val])) {
            foreach ($resultat_import[$val] as $ligne => $erreurs_ligne) {
                foreach ($erreurs_ligne as $erreur) {
                    $erreurs[] = "Ligne $ligne : $erreur";
                }
            }
        }
        return $erreurs;
    }
    
}
?>