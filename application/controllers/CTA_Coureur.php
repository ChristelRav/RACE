<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Coureur extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Coureur');
        $this->load->model('MD_Coureur_Categorie');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['coureur'] = $this->MD_Coureur_Categorie->detail_categorie_coureur();
		$this->viewer('v_a_generation_categorie',$data);
	}	
    public function generer(){
        $this->MD_Coureur_Categorie->generation_categorie();
        redirect('CTA_Coureur');
    }
}
