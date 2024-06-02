<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTA_Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MDA_Admin');
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
		$this->load->view('pages/v_a_login',$data);
	}
    public function login(){
        echo $_POST['email'].' --- '.$_POST['mdp'];
        $user = $this->MDA_Admin->verify( $_POST['email'], $_POST['mdp']);
        if ($user){
            $this->session->set_userdata('admin', $user);
            redirect('CTA_Etape');
            return;
        }
        else{
            $data['error'] = 'Email ou mot de passe invalide';
        }
        redirect('CTA_Login/index?error=' . urlencode($data['error']));
	}
    public function deconnect()	{
        $this->session->unset_userdata('admin');
        redirect('CTA_Login/');
    }
    public function  reinitialise(){
        $this->MDA_Admin->truncate_all_tables();
        redirect('CTA_Etape');
    }
}
