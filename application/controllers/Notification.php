<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notification extends CI_Controller {
    
	function __construct(){

		parent::__construct();
		
		 

		$this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_dashboard');
        $this->load->model('model_notification');
     
       
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
    
    public function notification(){
        $data['active_menu'] = "notification";
         $data['active_submenu'] = "send_notification";
        if($this->input->post('submit') != ''){
           
            $name_search = $this->input->post('name_search');
            $colony_search = $this->input->post('colony_search');
            $status_search = $this->input->post('status_search');
            $mobile_no = $this->input->post('mobile_no');
            $customer_type = $this->input->post('customer_type');
            
            
            $data['return_name'] = $name_search;
            $data['return_colony'] = $colony_search;
            $data['return_status']  =   $status_search;
            $data['return_mobile_no']  =   $mobile_no;
            $data['return_customer_type']  =   $customer_type;
            
            $data['select_colony'] = $this->model_notification->select_colony();
            
            if($customer_type == 'membership'){
                $data['all_customer'] = $this->model_notification->customer_report_multi_searchbar($name_search,$colony_search,$status_search,$mobile_no);
           
            }else if($customer_type == 'guest'){
                $data['all_customer'] = $this->model_notification->guest_report_multi_searchbar($name_search,$colony_search,$status_search,$mobile_no);
           
            }
            		
             $this->load->view('notification/notification',$data);
        }else if($this->input->post('submit_notification') != ''){
                
              $msg = $this->input->post('text_msg');
              $customer_id_array = $this->input->post('all_customer_id');
              $customer_mobile_no_array = $this->input->post('all_customer_mobile');
              
              $customer_id = explode(',',$customer_id_array);
              foreach($customer_id as $row){
                   $data['msg'] = $this->model_notification->send_notification($msg,$customer_id);
                  
              }
            
              $data['all_customer'] = $this->model_notification->select_customer_report();
              $this->load->view('notification/notification',$data);	
              
          }else{
             $data['all_customer'] = $this->model_notification->select_customer_report();
             $data['select_colony'] = $this->model_notification->select_colony();
             $this->load->view('notification/notification',$data);		
        }
    
       
		
	}    
    
    public function send_notification(){
          if(isset($_POST["title"])){
              
              $title = $_POST["title"];
              $msg = $_POST["msg"];
              $customer_id_array = $_POST["customer_id"];
              $customer_mobile_no_array = $_POST["mobile_no"];
              $send_type = 'notification';//$_POST["send_type"];
              $customer_type = $_POST["customer_type"];
              
              if($send_type == "sms"){
                  
                  
              }else if($send_type == "notification"){
                  
                  
                 /* $customer_id = explode(',',$customer_id_array);
                  foreach($customer_id as $row){
                       $data['msg'] = $this->model_notification->send_notification($title,$msg,$row);
                      
                  } */
                  
                 
                  
                       $data['msg'] = $this->model_notification->send_notification($title,$msg,$customer_id_array,$customer_type);
                
                  
              }else if($send_type == "both"){
                  
                  
                  
              }
              
              
          }
        
        
        
    }
    
    public function see_all_notification(){
        
        $data['active_menu'] = "notification";
         $data['active_submenu'] = "send_notification";
        
         if($this->input->post('submit') != ''){
              $customer_type = $this->input->post('customer_type');
            $name_search = $this->input->post('name_search');
            $status_search = $this->input->post('status_search');
          
             
            $data['r_customer_type']  = $customer_type;
            $data['r_name_search']  = $customer_type;
            $data['r_status_search']  = $customer_type;  
             
            $data['list'] = $this->model_notification->see_all_notification($customer_type,$name_search,$status_search);
            $this->load->view('notification/see_all_notification',$data); 
            
         }else{
          
           
             
          $data['list'] = $this->model_notification->see_all_notification('','','');
          $this->load->view('notification/see_all_notification',$data);
         
         }
    }
   
}
