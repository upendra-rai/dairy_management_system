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

	public function index(){
	}

  public function orders(){
    $data['active_menu'] = "special_orders";
    $data['active_submenu'] = "orders";
      
    if($this->input->post('submit')){
             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $status = '';
        
           
             if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
            
             
             $data['return_colony'] = $colony;
             $data["select_colony"] = $this->model_orders->select_colony();
             $data["orders_list"] = $this->model_orders->filter_orders($customer_name,$colony,$status,$start,$end);
         //echo  json_encode($data);    
        // echo $start.$end;
         
         $this->load->view('orders/orders',$data);
            
    }else{  
      $data["orders_list"] = $this->model_orders->orders('');
      $data["select_colony"] = $this->model_orders->select_colony();
      
    //echo 	json_encode($data['new_order_count']) ;
      $this->load->view('orders/orders',$data);
    }

    }

		public function order_details($order_id){
	    $data['active_menu'] = "special_orders";
	    $data['active_submenu'] = "orders";
	    $data["detail"] = $this->model_orders->order_details($order_id);
			$data['select_product'] = $this->model_orders->estimated_customer_products($order_id);

			$data['select_product'] = $this->model_orders->estimated_customer_products($order_id);

			$data['order_item_details'] = $this->model_orders->order_item_details($order_id);


	    $this->load->view('orders/view_orders',$data);

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
       $data['active_menu'] = "special_orders";
	  $data['active_submenu'] = "placed_orders";
      if($this->input->post('submit')){
             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $status = 'placed';
        
           
             if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
            
             
             $data['return_colony'] = $colony;
             $data["select_colony"] = $this->model_orders->select_colony();
             $data["orders_list"] = $this->model_orders->filter_orders($customer_name,$colony,$status,$start,$end);
         //echo  json_encode($data);    
        // echo $start.$end;
         
         $this->load->view('orders/orders',$data);
            
    }else{
	 
  	  $data["orders_list"] = $this->model_orders->orders('placed');
  	  $this->load->view('orders/orders',$data);
      }
	}

	//=========********===========********========******========//
	// ************ Placed orders section ***********//
	//=========********===========********========******========//
	public function completed_orders(){
      $data['active_menu'] = "special_orders";
	  $data['active_submenu'] = "completed_orders";
     if($this->input->post('submit')){
             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $status = 'completed';
        
           
             if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
            
             
             $data['return_colony'] = $colony;
             $data["select_colony"] = $this->model_orders->select_colony();
             $data["orders_list"] = $this->model_orders->filter_orders($customer_name,$colony,$status,$start,$end);
         //echo  json_encode($data);    
        // echo $start.$end;
         
         $this->load->view('orders/orders',$data);
            
    }else{    
	  
  	$data["orders_list"] = $this->model_orders->orders('completed');
  	$this->load->view('orders/orders',$data);
     }
	}
	//=========********===========********========******========//
	// ************ Placed orders section ***********//
	//=========********===========********========******========//
	public function canceled_orders(){
	  $data['active_menu'] = "special_orders";
	  $data['active_submenu'] = "canceled_orders";
    if($this->input->post('submit')){
             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $status = 'canceled';
        
           
             if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
            
             
             $data['return_colony'] = $colony;
             $data["select_colony"] = $this->model_orders->select_colony();
             $data["orders_list"] = $this->model_orders->filter_orders($customer_name,$colony,$status,$start,$end);
         //echo  json_encode($data);    
        // echo $start.$end;
         
         $this->load->view('orders/orders',$data);
            
    }else{    
  	$data["orders_list"] = $this->model_orders->orders('canceled');
  	$this->load->view('orders/orders',$data);
    }
	}
    
    public function check_orders_count(){
        
		$this->model_orders->check_orders_count('new');
		/*$data['placed_order_count'] = $count_order['placed_order_count'];
		$data['completed_order_count'] = $count_order['completed_order_count'];
		$data['canceled_order_count'] = $count_order['canceled_order_count'];
        */
    }
    
    public function add_order(){
    $data['active_menu'] = "special_orders";
    $data['active_submenu'] = "add_order";
      
    if($this->input->post('submit')){
             $customer_id = $this->input->post('customer_id');
             $delivery_date  = $this->input->post('delivery_date');
             $product_array = $this->input->post('product_array');
             $total_price = $this->input->post('total_price');
        
             $data['all_customer_list'] = $this->model_orders->select_all_customers_for_drop_down();
             $data["select_product"] = $this->model_orders->select_product();
             
             if($customer_id === ''){
                 $data['return_customer_span_msg'] = 'Select customer name.';
                
                 
                  $this->load->view('orders/add_order',$data);     
             }else{
                 if($total_price != ''){
                      $data['msg'] = $this->model_orders->add_order($customer_id,$delivery_date,$product_array,$total_price);
                     
                 }else{
                     $data['empty_qty'] = 'yes';
                 }
                 $this->load->view('orders/add_order',$data);   
             }
    }else{  
     
      $data['all_customer_list'] = $this->model_orders->select_all_customers_for_drop_down();
      $data["select_product"] = $this->model_orders->select_product();
    //echo 	json_encode($data['new_order_count']) ;
      $this->load->view('orders/add_order',$data);
    }

    }
    
    public function filter_by_delivery_date($delivery_date){
        
      $data['active_menu'] = "special_orders";
	  $data['active_submenu'] = "placed_orders";
        
      if($this->input->post('submit')){
             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $status = 'placed';
        
           
             if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
            
             
             $data['return_colony'] = $colony;
             $data["select_colony"] = $this->model_orders->select_colony();
             $data["orders_list"] = $this->model_orders->filter_orders($customer_name,$colony,$status,$start,$end);
         //echo  json_encode($data);    
        // echo $start.$end;
         
         $this->load->view('orders/orders',$data);
            
      }else{
	 
  	  $data["orders_list"] = $this->model_orders->filter_by_delivery_date($delivery_date);
  	  $this->load->view('orders/orders',$data);
      }    
        
        
    }
}
