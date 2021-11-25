<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_setting');
       
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			           redirect('./admin/login');
        }

	}

	public function smsaccount(){
        $data['active_menu'] = "orders";
    $data['active_submenu'] = "orders";    
    $data['sms_details'] = $this->model_setting->countsms();
    $this->load->view('/Setting/sms_account_view',$data);
	}
}
