<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTE_Etape extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Etape');
        $this->load->model('MD_Coureur');
        $this->load->model('MD_Coureur_Etape');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['etape'] = $this->MD_Etape->list();
        $data['coureur'] = $this->MD_Coureur->list_coureur_equipe($_SESSION['equipe'][0]['id_equipe']);
		$this->viewer('v_e_list_etape',$data);
	}	
    public function affecter_Etape(){
        $tab = $_POST['coureur'];
        for ($i=0; $i < count($tab); $i++) { 
             $this->MD_Coureur_Etape->insert($_POST['id'],$tab[$i],$_POST['de'],$_POST['hd']);
        }
        redirect('CTE_Etape');
    }
}
