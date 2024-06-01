<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }
	private function viewer($page,$data){
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
		$_SESSION['baby'] = 'shark';
		$this->load->view('welcome_message');
	}	
	public function go(){
		$data['val'] = array();
		$this->viewer('welcome',$data);
	}	
}
