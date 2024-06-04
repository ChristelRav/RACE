<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Import extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Etape');
        $this->load->model('MD_Classement');
        $this->load->model('MD_Categorie');
        $this->load->model('MD_Import');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index1(){
        $data['classe'] = array();
        $data = array();
        if ($this->input->get('erreur1') != null) {
            $data['erreur1'] = explode(',', urldecode($this->input->get('erreur1')));
        } else if ($this->input->get('succes1') != null) {
            $data['succes1'] = urldecode($this->input->get('succes1'));
        }
        if ($this->input->get('erreur2') != null) {
            $data['erreur2'] = explode(',', urldecode($this->input->get('erreur2')));
        } else if ($this->input->get('succes2') != null) {
            $data['succes2'] = urldecode($this->input->get('succes2'));
        }
        $this->viewer('v_a_import1',$data);
	}
    public function import_csv1(){
        if (isset($_FILES['csv_file1']['name']) && $_FILES['csv_file1']['name'] != '' ||  isset($_FILES['csv_file2']['name']) && $_FILES['csv_file2']['name'] != '' ) {
            $resultat_import = $this->MD_Import->import1('csv_file1');
            $ri = $this->MD_Import->import1_2('csv_file2');
            
            $hasErrors = false;  $he = false;
            if (isset($resultat_import['erreur1'])) {
                foreach ($resultat_import['erreur1'] as $ligne => $erreurs) {
                    if (!empty($erreurs)) {
                        $hasErrors = true;
                        break;
                    }
                }
            }
            if (isset($ri['erreur2'])) {
                foreach ($ri['erreur2'] as $ligne => $erreurs) {
                    if (!empty($erreurs)) {
                        $he = true;
                        break;
                    }
                }
            }        
            if ($hasErrors && $he) {
                $e = $this->MD_Import->tab_Erreur($resultat_import, 'erreur1');
                $d = implode(',', $e);
                $e1 = $this->MD_Import->tab_Erreur($ri, 'erreur2');
                $d1 = implode(',', $e1);
                redirect('CTA_Import/index1?erreur1=' . urlencode($d) . '&erreur2=' . urlencode($d1));
            } 
            if(!$hasErrors && !$he){
                $data['succes1'] = 'Données  traitées correctement';
                redirect('CTA_Import/index1?succes1=' . urlencode($data['succes1']));
            }
            if (!$hasErrors && $he) {
                $e1 = $this->MD_Import->tab_Erreur($ri, 'erreur2'); 
                $d1 = implode(',', $e1);
                $data['succes1'] = 'Données Etape traitées correctement';
                redirect('CTA_Import/index1?erreur2=' . urlencode($d1) . '&succes1=' . urlencode($data['succes1']));
            } 
            if($hasErrors && !$he){
                $data['succes2'] = 'Données Etape traitées correctement';
                $e = $this->MD_Import->tab_Erreur($resultat_import, 'erreur1');
                $d = implode(',', $e);
                redirect('CTA_Import/index1?succes2=' . urlencode($data['succes2']) . '&erreur1=' .  urlencode($d));
            }
            
        }
       
       
    }
    
    public function index2(){
        $data = array();
        if ($this->input->get('erreur') != null) {
            $data['erreur'] = explode(',', urldecode($this->input->get('erreur')));
        } else if ($this->input->get('succes') != null) {
            $data['succes'] = urldecode($this->input->get('succes'));
        }
        $data['classe'] = array();
        $this->viewer('v_a_import2',$data);
	}
    public function import_csv2(){
        $resultat_import = $this->MD_Import->import2('csv_file');
        $hasErrors = false;
        if (isset($resultat_import['erreur'])) {
            foreach ($resultat_import['erreur'] as $ligne => $erreurs) {
                if (!empty($erreurs)) {
                    $hasErrors = true;
                    break;
                }
            }
        }
        if ($hasErrors) {
            $e = $this->MD_Import->tab_Erreur($resultat_import,'erreur');
            $d = implode(',', $e);
            redirect('CTA_Import/index2?erreur=' . urlencode($d));
        } else {
            $data['succes'] = 'Données traitées correctement';
            redirect('CTA_Import/index2?succes=' . urlencode($data['succes']));
        }
        
    }
}
?>