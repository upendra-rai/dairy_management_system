<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_dashboard');
        $this->load->model('model_orders');
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

	public function init_user(){
     //  $user_id = $this->session->userdata('uid');
      // $data["user_data"] = $this->model_dashboard->select_userdata($user_id);
       // return $data;
	}

	public function index(){
	}

  public function orders(){
    $data['active_menu'] = "orders";
    $data['active_submenu'] = "orders";
    //$data = $this->init_user(); 
    if($this->input->post('submit') != ''){
        
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $customer_type = $this->input->post('customer_type');
        $name_search = $this->input->post('name_search');
        $status_search = $this->input->post('status_search');  
        
        $data['return_start'] = $start;
        $data['return_end'] = $end;
        $data['r_customer_type'] = $customer_type;   
        $data['return_name'] = $name_search;  
        $data['r_order_status'] = $status_search; 
        
        $data["orders_list"] = $this->model_orders->orders_pending_and_placed($start,$end,$customer_type,$name_search,$status_search);
        $data["agent_list"] = $this->model_orders->select_team();
        $this->load->view('orders/orders',$data);
        
    }else{
         $data["orders_list"] = $this->model_orders->orders_pending_and_placed('','','','','');
         $data["agent_list"] = $this->model_orders->select_team();
         $this->load->view('orders/orders',$data);
        
    }

    }
    
    
    public function pending_orders(){
    $data['active_menu'] = "orders";
    $data['active_submenu'] = "pending_orders";
    //$data = $this->init_user(); 
     $data["orders_list"] = $this->model_orders->orders('');
     $data["agent_list"] = $this->model_orders->select_team();
    //echo 	json_encode($data['new_order_count']) ;
    $this->load->view('orders/order_list',$data);

    }

    public function order_details($order_id){
       
        $order_id = $this->uri->segment(3);
        $action = $this->uri->segment(4); 
            
        if($action && $action == 'placed' || $action == 'canceled'){
             $data["detail"] = $this->model_orders->order_accept_or_reject($order_id,$action);
        }else{
        
	    $data['active_menu'] = "special_orders";
	    $data['active_submenu'] = "orders";
	    $data["detail"] = $this->model_orders->order_details($order_id);
	    $this->load->view('orders/view_orders',$data);
        }
    }
    
    public function order_accept_or_reject(){
         $data['active_menu'] = "orders";
         $data['active_submenu'] = "orders";
        
         $order_id = $this->uri->segment(3);
         $agent_id = $this->uri->segment(4);
         $action = $this->uri->segment(5); 
         $data["detail"] = $this->model_orders->order_accept_or_reject($order_id,$agent_id,$action); 
        
        
       /* if(isset($_POST['status'],$_POST['order_id'])){
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];
           $data["detail"] = $this->model_orders->order_accept_or_reject($order_id,$status);  
            
        }
        */
       /* if($action){
             $data["detail"] = $this->model_orders->order_accept_or_reject($order_id,$action,$return_href);
        }*/
    }
    
    public function view_pending_and_placed_orders(){
          $data['active_menu'] = "orders";
         $data['active_submenu'] = "orders";
        
         
        
         $data["orders_list"] = $this->model_orders->orders_pending_and_placed('','','','','');;
         $data["agent_list"] = $this->model_orders->select_team();
    
         $this->load->view('orders/orders',$data);
        
        //echo json_encode($data);
    }
    
    public function order_dispatch_and_assign(){
        
      /*   $order_id = $this->uri->segment(3);
         $action = $this->uri->segment(4); 
        $delivery_person = $this->uri->segment(5); 
        $return_href = $this->uri->segment(6); 
        if($action){
             $data["detail"] = $this->model_orders->order_dispatch_and_assign($order_id,$action,$delivery_person,$return_href);
        } */
        
         if(isset($_POST['status'],$_POST['order_id'])){
              $order_id = $_POST['order_id'];
              $status = $_POST['status'];
              $delivery_person = $_POST['delivery_person'];
              $data["detail"] = $this->model_orders->order_dispatch_and_assign($order_id,$status,$delivery_person);
         }
        
    }

     public function accept_orders()
     {
        if(isset($_POST["order_id"])){

					$order_id = $_POST["order_id"];
					$status = 'placed';
					$this->model_orders->accept_orders($order_id,$status);
				}
     }

		 public function cancel_orders()
     {
        if(isset($_POST["order_id"])){

					$order_id = $_POST["order_id"];
					$status = 'canceled';
					$this->model_orders->accept_orders($order_id,$status);
				}
     }
//=========********===========********========******========//
// ************ Placed orders section ***********//
//=========********===========********========******========//
  public function placed_orders(){
     
	  $data['active_menu'] = "orders";
	  $data['active_submenu'] = "placed_orders";
      $user_id = $this->session->userdata('uid');
      
  	$data["orders_list"] = $this->model_orders->orders('placed');
    $data["all_delivery_person"] = $this->model_orders->all_delivery_person($user_id);
  	$this->load->view('orders/order_list',$data);

	}

//=========********===========********========******========//
// ************ Dispatched orders section ***********//
//=========********===========********========******========//
  public function dispatched_orders(){
    
	  $data['active_menu'] = "orders";
	  $data['active_submenu'] = "dispatched_orders";
      $user_id = $this->session->userdata('uid');
  	$data["orders_list"] = $this->model_orders->orders('dispatched');
    $data["all_delivery_person"] = $this->model_orders->all_delivery_person($user_id);  
  	$this->load->view('orders/order_list',$data);

	}
    
    public function change_order_delivery_person(){
         $order_id = $this->uri->segment(3);
        $delivery_person = $this->uri->segment(4); 
        $return_href = $this->uri->segment(5); 
        if($delivery_person){
             $data["detail"] = $this->model_orders->change_order_delivery_person($order_id,$delivery_person,$return_href);
        }
        
    }
	//=========********===========********========******========//
	// ************ Placed orders section ***********//
	//=========********===========********========******========//
	public function delivered_orders(){
      
	  $data['active_menu'] = "orders";
	  $data['active_submenu'] = "delivered_orders";
  	$data["orders_list"] = $this->model_orders->orders('delivered');
  	$this->load->view('orders/order_list',$data);

	}
	//=========********===========********========******========//
	// ************ Placed orders section ***********//
	//=========********===========********========******========//
	public function canceled_orders(){
         
	  $data['active_menu'] = "orders";
	  $data['active_submenu'] = "canceled_orders";
  	$data["orders_list"] = $this->model_orders->orders('canceled');
  	$this->load->view('orders/order_list',$data);

	}
}
