<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTE_Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MDE_Equipe');
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
        $data = array();
        if($this->input->get('error') != null  )
        {
            $data['error'] = $this->input->get('error');
        }
		$this->load->view('pages/v_e_login',$data);
	}
    public function login(){
        echo $_POST['equipe'].' --- '.$_POST['pass'];
        $user = $this->MDE_Equipe->verify( $_POST['equipe'], $_POST['pass']);
        if ($user){
            $this->session->set_userdata('equipe', $user);
            redirect('CTE_Etape');
            return;
        }
        else{
            $data['error'] = 'Pseudo ou mot de passe invalide';
        }
        redirect('CTE_Login/index?error=' . urlencode($data['error']));
	}
    public function deconnect()	{
        $this->session->unset_userdata('equipe');
        redirect('CTE_Login/');
    }
}
