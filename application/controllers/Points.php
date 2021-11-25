<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class points extends CI_Controller {

	function __construct(){

		parent::__construct();

		     $this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_points');
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			redirect('./admin/login');
		}
	}

	public function init_user(){
       $user_id = $this->session->userdata('uid');
			 $data["user_data"] = $this->model_points->select_userdata($user_id);
       return $data;
	}

	public function index(){

	}

  public function point_settings()
  {
		$data = $this->init_user();
		$data['active_menu'] = "parameter";
		$data['active_submenu'] = "point_setting";
        
        if($this->input->post('submit')){
              $point_value = $this->input->post('point_value');
              $loyal_point = $this->input->post('loyal_point');
              $loyal_sales_figure = $this->input->post('loyal_sales_figure');
              $reffer_point = $this->input->post('reffer_point');
            
              echo $point_value.$loyal_point.$loyal_sales_figure.$reffer_point;
            
             $data["msg"] = $this->model_points->update_point_setting($point_value,$loyal_point,$loyal_sales_figure,$reffer_point);
		     $this->load->view('parameter/point', $data);
        }else{
             $data["mysetting"] = $this->model_points->select_app_setting();
		     $this->load->view('parameter/point', $data);
        }
      
       
  }

	
}
