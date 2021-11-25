<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('session');
         $this->load->helper('form');
        $this->load->model('model_emp');
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			           redirect('./admin/login');
        }

	}
    public function index(){
        $this->load->view('/employees');
    }

	public function emp_details(){
        $data['active_menu'] = "emp";
        $data['active_submenu'] = "emp_details"; 
      
        $this->load->view('/employees',$data);
       
      
      
    
	}
    public function add_emp(){
        $data['active_menu'] = "employee";
        $data['active_submenu'] = "employee_details";  
         if($this->input->post('submit')){
        $minimum_fat_value = $this->input->post('minimum_fat_value');
        $maximum_fat_value =   $this->input->post('maximum_fat_value');
        $fat_rate =           $this->input->post('fat_rate');
            //echo $edit_id. $minimum_fat_value.$maximum_fat_value.$fat_rate;
        $this->model_collection->edit_milk_fat($minimum_fat_value,$maximum_fat_value,$fat_rate);
       
    }else{
     echo $edit_id;        
             
    $data['list'] = $this->model_collection->selected_fat_rate($edit_id);
     $data['fat_details'] = $this->model_collection->fat_rate();
    $this->load->view('/Collection/fat_rate_view',$data);
      
     }   
	}
    
    public function edit_fat_rate(){
        $data['active_menu'] = "collection";
        $data['active_submenu'] = "fat_rate";  
        $edit_id=$this->uri->segment(3);
         if($this->input->post('submit')){
        $minimum_fat_value = $this->input->post('minimum_fat_value');
        $maximum_fat_value =   $this->input->post('maximum_fat_value');
        $fat_rate =           $this->input->post('fat_rate');
            //echo $edit_id. $minimum_fat_value.$maximum_fat_value.$fat_rate;
        $this->model_collection->edit_milk_fat($edit_id,$minimum_fat_value,$maximum_fat_value,$fat_rate);
       
    }else{
     echo $edit_id;        
             
    $data['list'] = $this->model_collection->selected_fat_rate($edit_id);
     $data['fat_details'] = $this->model_collection->fat_rate();
    $this->load->view('/Collection/fat_rate_view',$data);
      
     }   
	}
    public function delete_fat_rate(){
        $fat_id = $this->uri->segment(3);
		echo $fat_id;
		$this->model_collection->delete_data($fat_id);
    }
    
    public function snf(){
        $data['active_menu'] = "collection";
        $data['active_submenu'] = "snf";
        if($this->input->post('submit')){
        $minimum_price=$this->input->post('minimum_price');
        $maximum_price=$this->input->post('maximum_price');
        $snf_value=$this->input->post('snf_value');
        $this->model_collection->edit_snf($minimum_price,$maximum_price,$snf_value);
       
    }else{
      $data['list'] = $this->model_collection->snf();
    $this->load->view('/Collection/snf_view',$data);

        
    }
}
}
?>