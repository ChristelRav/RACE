<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Penalite extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Penalite');
        $this->load->model('MD_Etape');
        $this->load->model('MDE_Equipe');
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['equipe'] = $this->MDE_Equipe->list();
        $data['etape'] = $this->MD_Etape->list();
        $data['penalite'] = $this->MD_Penalite->list_equipe_penalite();
		$this->viewer('v_a_penalite',$data);
	}	
    public function insert_penalite(){
        $this->MD_Penalite->insert($_POST['etape'],$_POST['equipe'],$_POST['temps']);
        redirect('CTA_Penalite');
    }
    public function delete_penalite(){
        $this->MD_Penalite->delete($_POST['id']);
        redirect('CTA_Penalite');   
    }
}
