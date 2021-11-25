<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_account extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_dashboard');
        $this->load->model('model_manage_account');
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
		$this->load->view('home', $data);

	}
/*  //////// Add Customer /////// */
    
    public function transaction(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
       
        if($this->input->post('submit')){
                
            $my_date = $this->input->post('my_date');
            $amount = $this->input->post('amount');
            $product = $this->input->post('product');
            $qty = $this->input->post('qty');
            $by = $this->input->post('by');
            
            $my_date =  date('Y-m-d H:i:s',strtotime($my_date));
            
            $data['all_agent'] = $this->model_manage_account->make_transaction($my_date,$amount,$product,$qty,$by,$linked_no);
             
        }else{
               
               $data['all_agent'] = $this->model_manage_account->select_agent();
                $data['detail'] = $this->model_manage_account->view_customer($linked_no);
                $data['minimum_recharge'] =  $this->model_manage_account->select_recharge_limit();
               $data['detail_transaction'] =  $this->model_manage_account->customer_tran_report2($linked_no);
                $data['select_product'] = $this->model_manage_account->edit_customer_products($linked_no);
               $data['all_customer_list'] = $this->model_manage_account->select_all_customers_for_drop_down();
            
		        $this->load->view('customer/manage_account',$data);
        }
	}
    
    
    
    public function delete_transaction(){
        
        if(isset($_POST['del_id'])){
            $del_id = $_POST['del_id'];
           
            $data['action'] = $this->model_manage_account->delete_transaction($del_id);
            
        }
    }
    
    public function delete_recharge(){
       
        if(isset($_POST['del_id'])){
            $del_id = $_POST['del_id'];
           
            $data['action'] = $this->model_manage_account->delete_recharge($del_id);
            
        }

    }
    
    
    public function recharge(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
       
        if($this->input->post('submit')){
                
            $my_date = $this->input->post('my_date');
            $amount = $this->input->post('amount');
            $t_id = $this->input->post('t_id');
            $by = $this->input->post('by');
            
            $my_date =  date('Y-m-d H:i:s',strtotime($my_date));
            
            $data['all_agent'] = $this->model_manage_account->make_recharge($my_date,$amount,$t_id,$by,$linked_no);
             
        }else{
               
               $data['all_agent'] = $this->model_manage_account->select_agent();
                $data['detail'] = $this->model_manage_account->view_customer($linked_no);
               
               $data['detail_recharge'] =  $this->model_manage_account->customer_rech_report2($linked_no);
                $data['select_product'] = $this->model_manage_account->edit_customer_products($linked_no);
            $data['all_customer_list'] = $this->model_manage_account->select_all_customers_for_drop_down();
		        $this->load->view('customer/manage_account_recharges',$data);
        }
	}
    
    
     public function account_balance(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
       
        if($this->input->post('submit')){
                
            
            $amount = $this->input->post('amount');
         
            $data['list'] = $this->model_manage_account->manage_account_balance($amount,$linked_no);
             
        }else{
               
               $data['all_agent'] = $this->model_manage_account->select_agent();
                $data['detail'] = $this->model_manage_account->view_customer($linked_no);
               
               $data['detail_recharge'] =  $this->model_manage_account->customer_rech_report2($linked_no);
                $data['select_product'] = $this->model_manage_account->edit_customer_products($linked_no);
            
            $data['all_customer_list'] = $this->model_manage_account->select_all_customers_for_drop_down();
		        $this->load->view('customer/manage_account_balance',$data);
        }
	}
    
    
    public function log_history(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
       
        if($this->input->post('submit')){
                
         
             
        }else{
               
               $data['all_agent'] = $this->model_manage_account->select_agent();
                $data['detail'] = $this->model_manage_account->view_customer($linked_no);
               
               $data['log_history'] =  $this->model_manage_account->log_history($linked_no);
                $data['all_customer_list'] = $this->model_manage_account->select_all_customers_for_drop_down();
		        $this->load->view('customer/log_history',$data);
        }
        
        
    }
    
	
}
