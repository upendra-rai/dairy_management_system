<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class colony extends CI_Controller {
    
	function __construct(){

		parent::__construct();
		
		 

		$this->load->library('session');
         $this->load->helper('form');
        
        $this->load->model('model_dashboard');
        $this->load->model('model_colony');
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
		
        $this->load->helper('form');
        $data['active_menu'] = "management";
        $data['active_submenu'] = "colony";
        $data["colony"] = $this->model_colony->select_colony();
		$this->load->view('colony/colony',$data);

	}
   
    public function submit_colony(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "colony";
        if($this->input->post('myaction') != ""){
            $action = $this->input->post('myaction');
            $name = $this->input->post('colony_name');
            if($action == 'insert'){
            
            $data['message'] = $this->model_colony->add_colony_submit($name); 
            $data["colony"] = $this->model_colony->select_colony();
            $this->load->view('colony/colony',$data); 
            
            }else if($action == 'update'){
            
            $id =  $this->input->post('colony_id');   
                
            $data['message'] = $this->model_colony->update_colony_submit($name,$id); 
            $data["colony"] = $this->model_colony->select_colony();
            $this->load->view('colony/colony',$data); 
                
                
            }
            
        }else{
            
          $data["colony"] = $this->model_colony->select_colony();
           $this->load->view('colony/colony',$data); 
        }
        
        
    }
   
  
    
    public function delete_colony(){
        
        if(isset($_POST['del_id'])){
            
            $del_id = $_POST['del_id'];
            $this->model_colony->delete_colony($del_id);
        }
    }
}
