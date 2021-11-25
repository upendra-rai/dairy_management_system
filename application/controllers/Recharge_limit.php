<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recharge_limit extends CI_Controller {
    
	function __construct(){

		parent::__construct();
		
		 

		$this->load->library('session');
         $this->load->helper('form');
        
        $this->load->model('model_dashboard');
        $this->load->model('model_recharge_limit');
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
		$this->load->view('home', $data);
	}

	public function recharge_limit(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "recharge_limit";
        if($this->input->post('amount') != ''){
            
            $amount = $this->input->post('amount');
            $data['message'] = $this->model_recharge_limit->update_recharge_limit($amount);
             $data['amount'] = $this->model_recharge_limit->select_recharge_limit();
		    $this->load->view('recharge_limit/recharge_limit',$data);
        }else{
            
            $data['amount'] = $this->model_recharge_limit->select_recharge_limit();
		    $this->load->view('recharge_limit/recharge_limit',$data);
            
        }
        
      
	}



}
