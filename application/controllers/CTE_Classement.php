<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTE_Classement extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Etape');
        $this->load->model('MD_Classement');
        $this->load->model('MD_Categorie');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['classe'] = $this->MD_Classement->display_etape();
        $this->viewer('v_e_classement_coureur',$data);
	}
    public function equipe(){
        $data['etape'] = $this->MD_Etape->list();
        $data['categorie'] = $this->MD_Categorie->list();
        $data['classeC'] = $this->MD_Classement->display_categorie();
        $data['classe'] = $this->MD_Classement->classement_equipe();
        $this->viewer('v_e_classement_equipe',$data);
	}
    public function selection_etape(){
        $data['etape'] = $this->MD_Etape->list();
        $data['categorie'] = $this->MD_Categorie->list();
        $data['classe'] = $this->MD_Classement->selection_equipe($_POST['etape']);
        $this->viewer('v_e_classement_equipe',$data);
	}
    public function selection_categorie(){
        $data['etape'] = $this->MD_Etape->list();
        $data['categorie'] = $this->MD_Categorie->list();
        $data['classe'] = $this->MD_Classement->selection_categorie($_POST['categorie']);
        $this->viewer('v_e_classement_equipe',$data);
    }
}
