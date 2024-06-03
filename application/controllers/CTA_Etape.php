<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Etape extends CI_Controller {
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
		$this->viewer('v_a_list_etape',$data);
	}	
    public function affecter_Horaire(){
        $data['coureur'] = $this->MD_Coureur_Etape->display_list($_GET['etape']);
        $data['etape'] = $_GET['etape'];
        $this->viewer('v_a_list_coureur_horaire',$data);
    }
    public function update_horaire(){
        $coureur = $this->MD_Coureur_Etape->display_list($_GET['etape']);
        foreach( $coureur as $c) {
            $hd = 'hd' . $c->id_coureur_etape; $ha = 'ha' . $c->id_coureur_etape;  $ce = 'ce' .$c->id_coureur_etape; 
            echo $_GET[$hd].'  ----   '. $_GET[$ha].'---'.$_GET[$ce].' !!!';
            $this->MD_Coureur_Etape->update($_GET[$ce],$_GET[$hd],$_GET[$ha]);
        } 
        $this->MD_Coureur_Etape->update($_GET['ce'],$_GET['hd'],$_GET['ha']);
        redirect('CTA_Etape/affecter_Horaire?etape=' .$_GET['etape']);
    }
}
