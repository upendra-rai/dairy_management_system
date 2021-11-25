<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_ragistration extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');
				$this->load->model('model_customer');
        $this->load->model('model_user_ragistration');
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
        $data['active_submenu'] = "product";
        $data["product"] = $this->model_product->select_product();
		   $this->load->view('product/product',$data);

	}


	 public function customer_ragistration_detail($status)
	 {
         $data['active_menu'] = "home";
         if($this->input->post('submit')){

             $customer_name = $this->input->post('name_search');
             $colony  = $this->input->post('colony_search');
             $status = $this->input->post('status');

             $data['return_status'] = $status;
             $data['return_colony'] = $colony;
             $data['ragistration_details'] = $this->model_user_ragistration->customer_ragistration_filter($customer_name,$colony,$status);
             	$data['select_colony'] = $this->model_user_ragistration->select_colony();
            $this->load->view('customer_ragistration/customer_list',$data);

         }else{
					 	$data['select_colony'] = $this->model_user_ragistration->select_colony();
             $data['ragistration_details'] = $this->model_user_ragistration->customer_ragistration_detail($status);
            //echo json_encode($data);
		    $this->load->view('customer_ragistration/customer_list',$data);
         }


	 }


	 public function cancel_ragistration()
	 {
	 	  if(isset($_POST['ragistration_id'])){
            $ragistration_id =  $_POST['ragistration_id'];
				      $data['ragistration_details'] = $this->model_user_ragistration->cancel_ragistration($ragistration_id);
			}
	 }
// ********========********========********========//
	          //////// Add ragister Customer ///////
// ********========********========********========//
	    public function add_ragister_customer(){
             $ragister_id = $this->uri->segment(3);
              $request_id =    $this->uri->segment(4);  
            
            
	          $data['active_menu'] = "customer";
            
             $this->model_user_ragistration->read_request($request_id);
            
	          if($this->input->post('firstname') != ''){
	              $firstname  =  $this->input->post("firstname");
	              $lastname  =  $this->input->post("lastname");
	              $mobileno  =  $this->input->post("mobileno");
	              $mobileno2  =  $this->input->post("mobileno2");
	              if($mobileno2 == ''){
	                  $mobileno2 = null;
	              }
	            $email  =  $this->input->post("email");
	            $address1  =  $this->input->post("address1");
	            $address2  =  $this->input->post("address2");
	            $colony  =  $this->input->post("colony");
	            $city  =  $this->input->post("city");
	            $delivery_type  =  $this->input->post("delivery_type");
	            $advance_payment  =  $this->input->post("advance_payment");
	            $card_no  =  $this->input->post("card_no");
	            $shift = $this->input->post("shift");

	            $agent = $this->input->post('agent');
	            $estimate_product = $this->input->post("estimate_product");
                  
                  
                  $card_type = $this->input->post("card_type");
                  
	             $data['message'] =  $this->model_user_ragistration->add_customer_submit_for_ragistered_customers($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$shift,$agent,$ragister_id,$estimate_product,$request_id,$card_type);
	             if($data['message'] == "taken" || $data['message'] == "invalid" || $data['message'] == "lost"){
	                 $data['r_first_name'] = $firstname;
	                 $data['r_lastname'] = $lastname;
	                 $data['r_mobileno'] = $mobileno;
	                 $data['r_mobileno2'] = $mobileno2;
	                 $data['r_email'] = $email;
	                 $data['r_address1'] = $address1;
	                 $data['r_address2'] = $address2;
	                 $data['r_colony'] = $colony;
	                 $data['r_city'] = $city;
	                 $data['r_delivery_type'] = $delivery_type;
	                 $data['r_advance_payment'] = $advance_payment;
	                 $data['r_card_no'] = $card_no;
	                 $data['r_shift'] = $shift;

	                 $data['r_agent'] = $agent;
	                   $data['r_estimate_product'] = $estimate_product;
			         
			         $data['r_explode_product_qty'] = json_decode($estimate_product);

	                 $data['select_colony'] = $this->model_customer->select_colony();
	                 $data['select_agent'] = $this->model_customer->select_agent();
	                 $data['select_product'] = $this->model_customer->select_product();
	                 $this->load->view('customer/add_customer',$data);
	             }else{
	                 $data['select_colony'] = $this->model_customer->select_colony();
	                 $this->load->view('customer/add_customer',$data);
	             }
	          }else{
	             $data['select_colony'] = $this->model_customer->select_colony();
	             $data['select_recharge_limit'] = $this->model_customer->select_recharge_limit();
	             $data['select_agent'] = $this->model_customer->select_agent();
	             $data['select_product'] = $this->model_customer->select_product();
                 $data['select_ragister_customer'] = $this->model_user_ragistration->selected_ragister_customer($ragister_id);
                  
                
                  

							 $data['r_first_name'] =  $data['select_ragister_customer'][0]->first_name;
							 $data['r_lastname'] = $data['select_ragister_customer'][0]->last_name;
							 $data['r_mobileno'] = $data['select_ragister_customer'][0]->contact_1;
							 $data['r_address1'] = $data['select_ragister_customer'][0]->address;
							 $data['r_colony'] = $data['select_ragister_customer'][0]->colony_id;
                             $data['r_shift'] = $data['select_ragister_customer'][0]->shift;
                  

	             $this->load->view('customer/add_customer',$data);
	          }
	    }
	// ********========********========********========//
	    //////// Add ragister Customer ///////
	// ********========********========********========//


}
