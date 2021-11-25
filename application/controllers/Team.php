<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class team extends CI_Controller {
    
	function __construct(){

		parent::__construct();
		
		 

		$this->load->library('session');
         $this->load->helper('form');
        
        $this->load->model('model_dashboard');
        $this->load->model('model_team');
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
        $data['active_submenu'] = "team";
        
        $data["team"] = $this->model_team->select_team();
		$this->load->view('team/team',$data);

	}
   
    public function add_team(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "team";
        if($this->input->post('team_name') != ""){
            
            $name = $this->input->post('team_name');
            $email = $this->input->post('team_email');
            $number = $this->input->post('team_number');
            $role = $this->input->post('team_role');
            $user_name = $this->input->post('user_name');
            $pass1 = $this->input->post('team_pass1');
            $pass2 = $this->input->post('team_pass2');
             
           
            
            if($pass1 == $pass2){
                
                $data['message'] = $this->model_team->add_team_submit($name,$email,$number,$role,$user_name,$pass1); 
                $data['team_name'] = $name;
                $data['team_email'] = $email;
                $data['team_number'] = $number;
                $data['team_role'] = $role;
                $data['user_name'] = $user_name;
                $data['pass'] = $pass1;
                $data['exist'] = "This username is already taken";
                $this->load->view('team/add_team',$data);
            }else{
                $data['team_name'] = $name;
                $data['team_email'] = $email;
                $data['team_number'] = $number;
                $data['team_role'] = $role;
                $data['user_name'] = $user_name;
                $data['unmatch'] = "Password is not matched";
                $this->load->view('team/add_team',$data);
                
            }
            
            
            
        }else{
            
          
           $this->load->view('team/add_team',$data); 
        }
        
        
    }
   
     public function add_submit(){
         if(isset($_POST["name"],$_POST["email"],$_POST["mobile"])){
             
             $name = $_POST["name"];
             $eamil = $_POST["email"];
             $mobile = $_POST["mobile"];
             //echo $name.$eamil.$mobile;
             
             $this->model_team->add_team_submit($name,$eamil,$mobile);
         }
         
    }
    
    public function edit_team( $team_id){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "team";    
        
        if($this->input->post('up_teamname') != ""){
            
            $name = $this->input->post('up_teamname');
            $email = $this->input->post('up_team_email');
            $number = $this->input->post('up_team_number');
            $role = $this->input->post('up_teamrole');
            $user_name = $this->input->post('up_user_name');
            $pass1 = $this->input->post('up_pass1');
            $pass2 = $this->input->post('up_pass2'); 
            
            if($pass1 == $pass2){
                $data['message'] = $this->model_team->edit_team_submit($name,$email,$number,$role,$user_name,$pass1,$team_id); 
                $data['team_name'] = $name;
                $data['team_email'] = $email;
                $data['team_number'] = $number;
                $data['team_role'] = $role;
                $data['user_name'] = $user_name;
                $data['pass'] = $pass1;
                $data['exist'] = "This username is already taken";
                $this->load->view('team/edit_team',$data);
            }else{
                $data['team_name'] = $name;
                $data['team_email'] = $email;
                $data['team_number'] = $number;
                $data['team_role'] = $role;
                $data['user_name'] = $user_name;
                $data['pass'] = "";
                $data['unmatch'] = "Password is not matched";
                $this->load->view('team/edit_team',$data);
            }
            
            
        }else{
        $data["team_edit"] = $this->model_team->edit_team($team_id);
        $this->load->view('team/edit_team',$data);
            
        }
    }
    
     public function edit_submit(){
         if(isset($_POST["team_id"],$_POST["name"],$_POST["email"],$_POST["mobile"])){
             $team_id = $_POST["team_id"];
             $name = $_POST["name"];
             $eamil = $_POST["email"];
             $mobile = $_POST["mobile"];
             
             $this->model_team->edit_team_submit($team_id,$name,$eamil,$mobile);
         }
         
    }
    
    public function delete_member(){
        
        if(isset($_POST['del_id'])){
            
            $del_id = $_POST['del_id'];
            $this->model_team->delete_team_member($del_id);
        }
    }
    
    // Assign Location
    
    public function assign_location(){
        
        if(isset($_POST['del_id'])){
            
            $del_id = $_POST['del_id'];
            $this->model_team->delete_team_member($del_id);
        }
    }
    
}
