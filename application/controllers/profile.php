<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class team extends CI_Controller {
    
	function __construct(){

		parent::__construct();
		
		 

		$this->load->library('session');
         $this->load->helper('form');
        
        $this->load->model('model_dashboard');
        $this->load->model('model_profile');
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			redirect('./admin/login');
		}
		
	}

	public function init($active_menu){
        
		$uid = $this->session->userdata('uid');
		$data['user_data'] = $this->model_dashboard->user_data($uid);
		
		$data['active_menu'] = $active_menu;

		return $data;
	}

	public function index(){
       
		$data = $this->init('dashboard');

		
			 $this->load->helper('form');
		$this->load->view('team/team');

	}
    
   


}
