<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app_interface extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_app_interface');


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
    public function team_login(){

		if(isset($_POST['login']))
         {
	      $email=$_POST['email'];
	      $password=$_POST['password'];

	      $data["login_status"] = $this->model_app_interface->team_login_model($email,$password);
        }

	}

	public function customer_login(){

		if(isset($_POST['login']))
         {
	      $email=$_POST['email'];
	      $password=$_POST['password'];

	      $data["login_status"] = $this->model_app_interface->customer_login_model($email,$password);
        }

	}

	public function newragister_customer_login()
	{
		  if(isset($_POST['login']))
         {
	      $email=$_POST['email'];
	      $password=$_POST['password'];

	      $my_data = $this->model_app_interface->newragister_customer_login($email,$password);
              
           
		  $data["customer_id"] = $my_data['customer_id'];
          $data["user_role"] = $my_data['customer_role'];
           echo json_encode($data);     
         
        }
	}

	public function user_profile_data(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $login_email = $request->login_email;
		   $role = $request->role;

		   if($role == "agent"){
			   $data["user"] = $this->model_app_interface->user_profile_agent($login_email);
				 $data["user_role"] = 'agent';

		   }else if($role == "customers"){
			   $data["user"] = $this->model_app_interface->user_profile_customer($login_email);
				 $data["user_role"] = 'customers';

		   }else if($role == "ragister_customer"){
				 $my_data = $this->model_app_interface->user_profile_for_ragister_customer($login_email);
                 $data["user"] = $my_data['customer_data'];
                 $data["user_role"] = $my_data['customer_role'];
		         $data["new_customer_id"] = $my_data['new_customer_id'];
		        // $data["new_customer_id"]
			 }

		  echo json_encode($data);
	}

	public function barcode_data($linked_id){

	       $barcode_id = $linked_id;
		   $data["customer_data"] = $this->model_app_interface->fetch_barcode_data($barcode_id);
          
		   $data["customer_extra_order"] = $this->model_app_interface->select_customer_extra_order($barcode_id);
		   
		  echo json_encode($data);
	}

	public function quick_payment_transfer(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->linked_id;
		   $value = $request->value;
		   $products = $request->products;
		   $agent_id = $request->agent_id;
		   $product_quantity = $request->product_quantity;

		   $this->model_app_interface->quick_payment_transfer($linked_id,$value,$products,$agent_id,$product_quantity);
        
	}
	
    public function quick_cash_transfer(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

		   $value = $request->value;
		   $products = $request->products;
		   $agent_id = $request->agent_id;
		   $product_quantity = $request->product_quantity;

		   $this->model_app_interface->quick_cash_transfer($value,$products,$agent_id,$product_quantity);
        
	}
    
    
	public function daily_order_payment_transfer(){
		  $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->linked_id;
		   $agent_id = $request->agent_id;
           $shift = $request->shift;
		   
           if($shift == 'morning'){
                $this->model_app_interface->daily_order_payment_transfer_morning($linked_id,$agent_id);
           }else if($shift == 'evening'){
                $this->model_app_interface->daily_order_payment_transfer_evening($linked_id,$agent_id);
           }
		  
		  
	}
	
	public function submit_extra_order(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->linked_id;
		   $order_amount = $request->order_amount;
		   $order_id = $request->order_id;
		   $agent_id = $request->agent_id;
		   
		   $this->model_app_interface->submit_extra_order($linked_id,$order_amount,$order_id,$agent_id);
        

	}

	public function recharge_account(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->linked_id;
		   $value = $request->value;
		   $agent_id = $request->agent_id;
		   $this->model_app_interface->recharge_account($linked_id,$value,$agent_id);


	}

    public function select_all_colony(){
		   $data["colony"] = $this->model_app_interface->select_all_colony();
		    echo json_encode($data);
	}
    
    public function select_agent_colony(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $agent_id = $request->user_id;
           $data["colony"] = $this->model_app_interface->select_agent_colony($agent_id);
		   echo json_encode($data);
        
    }


	public function update_customer_profile(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->customer_id;

		   $first_name = $request->first_name;
		   $last_name = $request->last_name;
		   $user_img = $request->user_img;
		   $email = $request->email;
		   $mobile_no = $request->mobile_no;
		   $mobile_no2 = $request->mobile_no2;
           if($mobile_no2 == ''){

               $mobile_no2 = null;
           }

		   $delivery_type = $request->delivery_type;
		   $address1 = $request->address1;
		   $address2 = $request->address2;
		   $colony = $request->colony;
		   $city = $request->city;


		   //echo $linked_id.$first_name.$last_name.$email.$mobile_no.$mobile_no2.$delivery_type.$address1.$address2.$colony.$city;

		   $this->model_app_interface->update_customer_profile($linked_id,$first_name,$last_name,$user_img,$email,$mobile_no,$mobile_no2,$delivery_type,$address1,$address2,$colony,$city);


	}



    public function upload_customer_image(){

	  if($_FILES["file"]["name"] != "")
      {
	   $test = explode(".", $_FILES["file"]["name"]);
	   $extension = end($test);
	   $name = rand(100,99999).strtotime(date('Y-m-d H:i:s')).bin2hex(openssl_random_pseudo_bytes(4)).'.'.$extension;
	   $location = 'catalogs/img/customer_img/'.$name;
	   move_uploaded_file($_FILES["file"]["tmp_name"], $location);
	   echo '<img src="'.base_url().$location.'" alt="User" /><input type="hidden" id="customer_img_name" value="'.$name.'" /><input type="hidden" name="unlink_img" value="'.$name.'" />';
       $unlink_image = $_POST['unlink_image'];
	   if($unlink_image != ''){
       unlink('catalogs/img/customer_img/'.$unlink_image);
       }

      }

	}

	public function update_agent_profile(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->customer_id;

		   $name = $request->name;
		   $email = $request->email;
		   $mobile_no = $request->mobile_no;
		   $user_img = $request->user_img;


		   //echo $linked_id.$first_name.$last_name.$email.$mobile_no.$mobile_no2.$delivery_type.$address1.$address2.$colony.$city;

		   $this->model_app_interface->update_agent_profile($linked_id,$name,$email,$mobile_no,$user_img);


	}

    public function update_agent_password(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->customer_id;
           $n_pass = $request->n_pass;
           $this->model_app_interface->update_agent_password($linked_id,$n_pass);

    }

	public function update_customer_password(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);

	       $linked_id = $request->customer_id;
           $n_pass = $request->n_pass;

           $this->model_app_interface->update_customer_password($linked_id,$n_pass);

    }

	public function upload_team_image(){
	  if($_FILES["file"]["name"] != "")
      {
	   $test = explode(".", $_FILES["file"]["name"]);
	   $extension = end($test);
	   $name = rand(100,99999).strtotime(date('Y-m-d H:i:s')).bin2hex(openssl_random_pseudo_bytes(4)).'.'.$extension;
	   $location = 'catalogs/img/agent/'.$name;
	   move_uploaded_file($_FILES["file"]["tmp_name"], $location);
	   echo '<img src="'.base_url().$location.'" alt="User"/><input type="hidden" id="customer_img_name" value="'.$name.'" /><input type="hidden" name="unlink_img" value="'.$name.'" />';
       $unlink_image = $_POST['unlink_image'];
	   if($unlink_image != ''){
       unlink('catalogs/img/agent/'.$unlink_image);
       }

      }


	}


	public function user_transaction(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $user_id = $request->user_id;
		   $role = $request->role;
		   
		   $data["tran"] = $this->model_app_interface->user_transaction($user_id,$role);
		   echo json_encode($data);
           
		  
	}

	public function agent_transaction(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $user_id = $request->user_id;
		   $data["tran"] = $this->model_app_interface->agent_transaction($user_id);

		  echo json_encode($data);
	}


    public function search_transaction(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $user_id = $request->user_id;
           $my_date = $request->my_date;
           $role = $request->role;
		   $this->model_app_interface->search_transaction($user_id,$my_date,$role);
		   

	}

	public function search_agent_transaction(){

           $user_id =  $this->uri->segment(3);
           $shift =  $this->uri->segment(4);
           
           $dairy_product_id =  $this->uri->segment(5);
           
           $my_date =  $this->uri->segment(6);


		   $data["tran"] = $this->model_app_interface->search_agent_transaction($user_id,$shift,$my_date,$dairy_product_id);
           echo json_encode($data);
	}




    public function delete_last_transaction(){
        $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
          $last_transaction_id = $request->last_transaction_id;
         $this->model_app_interface->delete_last_transaction($last_transaction_id);

    }

    public function search_agent_recharges(){

           $user_id =  $this->uri->segment(3);
           $my_date =  $this->uri->segment(4);

		   $data["tran"] = $this->model_app_interface->search_agent_recharges($user_id,$my_date);
			echo json_encode($data);
	}

    public function agent_recharges(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $user_id = $request->user_id;
		   $data["rech"] = $this->model_app_interface->agent_recharges($user_id);

		  echo json_encode($data);


    }


    public function delete_last_recharge(){
        $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
          $last_transaction_id = $request->last_transaction_id;
         $this->model_app_interface->delete_last_recharge($last_transaction_id);

    }

    public function search_transaction_recharge(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);


	       $user_id = $request->user_id;
           $my_date = $request->my_date;
           $role = $request->role;
         
		   $this->model_app_interface->search_transaction_recharge($user_id,$my_date,$role);
           
	}

	public function recharge_transaction(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
          $role = $request->role;
	      $user_id = $request->user_id;
		  
		   $data["recharge_tran"] = $this->model_app_interface->recharge_transaction($user_id,$role);
		   echo json_encode($data);
		  
	}

	public function fetch_products(){
        $data["products"] = $this->model_app_interface->fetch_products();

		  echo json_encode($data);

    }
    
    public function fetch_products_for_transaction(){
        
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $customer_barcode = $request->customer_barcode;
        $data["products"] = $this->model_app_interface->fetch_products_for_transaction($customer_barcode);

		  echo json_encode($data);

    }

    public function fetch_recharge_limit(){
        $data["recharge_limit"] = $this->model_app_interface->fetch_recharge_limit();

		  echo json_encode($data);

    }


    public function add_payment(){

          if(isset($_POST['customer_id'],$_POST['recharge_amount'],$_POST['payment_id'])){
           $customer_id = $_POST['customer_id'];
           $recharge_amount = $_POST['recharge_amount'];
           $payment_id = $_POST['payment_id'];
           $role =  $_POST['role'];  
           //echo $customer_id.$recharge_amount;
                
              if($role == 'reagister_customer'){
                  $data["add_payment"] = $this->model_app_interface->guest_add_payment($customer_id,$recharge_amount,$payment_id);
              }else if($role == 'customers'){
                  $data["add_payment"] = $this->model_app_interface->add_payment($customer_id,$recharge_amount,$payment_id);
              }
              
		        
		   }else{
			   
              $postdata = file_get_contents("php://input");
              $request = json_decode($postdata);
	          $customer_id = $request->customer_id;
              $recharge_amount = $request->recharge_amount;
              $payment_id = $request->payment_id;
              $role = $request->role;
			  
			  if(!$payment_id){
				  $payment_id = '';
			  }
              
			   if($role == 'ragister_customer'){
                  $data["add_payment"] = $this->model_app_interface->guest_add_payment($customer_id,$recharge_amount,$payment_id);
              }else if($role == 'customers'){
                  $data["add_payment"] = $this->model_app_interface->add_payment($customer_id,$recharge_amount,$payment_id);
              }
              
			   
		   }

    }

	// //-----//////------/////--------/////////------///////
// //======= Vacation Section ======//////
// //-----//////------/////--------/////////-------//////

    public function select_vacation(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	       $customer_id = $request->customer_id;
		   $data["vacation_list"] = $this->model_app_interface->select_vacation($customer_id);
		   echo json_encode($data);
	}
    public function selected_vacation($id){
		   $data["selected_vacation"] = $this->model_app_interface->selected_vacation($id);
		   echo json_encode($data);
	}

    public function add_vacation(){
		  $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	      $customer_id = $request->customer_id;
		  $start_date = date('Y-m-d',strtotime($request->start_date));
		  $end_date = date('Y-m-d',strtotime($request->end_date));
		  $shift = $request->shift;
		  $this->model_app_interface->add_vacation($customer_id,$start_date,$end_date,$shift);

	}

	public function edit_vacation(){
		  $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	      $vacation_id = $request->vacation_id;
		  $start_date = date('Y-m-d',strtotime($request->start_date));
		  $end_date = date('Y-m-d',strtotime($request->end_date));
		  $shift = $request->shift;

		  $this->model_app_interface->edit_vacation($vacation_id,$start_date,$end_date,$shift);

	}

	public function delete_vacation(){
		  $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	      $vacation_id = $request->vacation_id;
		  $this->model_app_interface->delete_vacation($vacation_id);

	}
    
    public function stop_vacation(){
		  $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	      $vacation_id = $request->vacation_id;
		  $this->model_app_interface->stop_vacation($vacation_id);

	}

	public function vacation_maping(){
          $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
	       $customer_id = $request->customer_id;
		   $data["vacation_maping"] = $this->model_app_interface->vacation_maping($customer_id);
		   echo json_encode($data);
	}

// //-----//////------/////--------/////////------///////
// //======= Notification Section ======//////
// //-----//////------/////--------/////////-------//////

	public function user_notification(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $role = $request->role;
		   //echo 'sssss';
		   
		  $data["noti"] = $this->model_app_interface->user_notification($user_id,$role);
		   echo json_encode($data);
        

    }

    public function read_notification($id){

		   $data["noti"] = $this->model_app_interface->read_notification($id);
           $this->model_app_interface->change_notification_status($id);
		   echo json_encode($data);


    }

    public function count_notification(){

		   $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $role = $request->role;
		   $data["noti"] = $this->model_app_interface->count_notification($user_id,$role);
		   echo json_encode($data);


    }

// //-----//////------/////--------/////////------///////
// //======= Assigned Colony ======//////
// //-----//////------/////--------/////////-------//////
	public function assigned_colony_customer_list(){
           $colony_id =  $this->uri->segment(3);
           $shift =  $this->uri->segment(4);
		   $data["customer_list"] = $this->model_app_interface->assigned_colony_customer_list($colony_id,$shift);
		   echo json_encode($data);


    }

// //-----//////------/////--------/////////------///////
// //======= Agent stock ======//////
// //-----//////------/////--------/////////-------//////

	public function select_agent_stock(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
		   $data["stock_details"] = $this->model_app_interface->select_agent_stock($user_id);
		   echo json_encode($data);

    }

    public function select_agent(){
		   $data["select_agent"] = $this->model_app_interface->select_agent();
		   echo json_encode($data);
    }

    public function select_product(){
          $data["select_product"] = $this->model_app_interface->select_product();
		   echo json_encode($data);
    }

    public function returned_stock(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $this->model_app_interface->returned_stock($user_id);


    }

    // ------------ traansfer stock section ------------ //

    public function select_user_stock_by_product(){

           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $product_id = $request->product_id;
		   $data["stock_by_product"] = $this->model_app_interface->select_user_stock_by_product($user_id,$product_id);
		   echo json_encode($data);

    }

    public function transfer_stock(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $product_id = $request->product_id;
           $transfer_to = $request->transfer_to;
           $transfer_product_qty = $request->transfer_product_qty;
           $this->model_app_interface->transfer_stock($user_id,$product_id,$transfer_to,$transfer_product_qty);


    }

//=========********===========********========******========//
// ************ Agent Requirement Reports ***********//
//=========********===========********========******========//

    public function select_user_customer_list(){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	       $user_id = $request->user_id;
           $data["list"] = $this->model_app_interface->select_user_customer_list($user_id);
           $data['today_date'] = $mydate;

		   echo json_encode($data);

    }

      public function select_user_requirement(){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	         $user_id = $request->user_id;
           $data["product_list"] = $this->model_app_interface->select_user_requirement($user_id);
		      echo json_encode($data);

    }
    
     public function select_user_requirement_e_product(){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
	         $user_id = $request->user_id;
           $data["product_list"] = $this->model_app_interface->select_user_requirement_e_product($user_id);
		      echo json_encode($data);

    }

		public function select_user_requirement_customer_wise(){

			$user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            
			
			
			$data["requirement_list"] = $this->model_app_interface->select_user_requirement_customer_wise($user_id,$status,$colony_id,$shift);
		  echo json_encode($data);

		}
		
		public function count_pending_customers(){
			$user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
            $shift = $this->uri->segment(6);
            
			
			$data["count_pending"] = $this->model_app_interface->count_pending_customers($user_id,$status,$colony_id,$shift);
		    echo json_encode($data);
			
		}
		
		public function count_completed_customers(){
			$user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
			 $shift = $this->uri->segment(6);
		
            
			$data["count_completed"] = $this->model_app_interface->count_completed_customers($user_id,$status,$colony_id,$shift);
		    echo json_encode($data);
		}
    
    
        public function requirement_shift_wise(){
            
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
	         $shift = $request->shift_id;
             $agent_search = $request->user_id;
            $search_date = '';
            
           $data["req"] = $this->model_app_interface->requirement_shift_wise($agent_search,$shift,$search_date);
		   echo json_encode($data);
            
        }
//=========********===========********========******========//
// ************ customer ragistration section ***********//
//=========********===========********========******========//
   public function customer_ragistration_submit()
   {

     $postdata = file_get_contents("php://input");
     $request = json_decode($postdata);
     $first_name = $request->first_name;
     $last_name = $request->last_name;
     $mobile_no = $request->mobile_no;
     $address = $request->address;
     $colony = $request->colony;
		 $user_id = $request->user_id;
		 $password = $request->password;

     $ragistration = $this->model_app_interface->customer_ragistration_submit($first_name,$last_name,$mobile_no,$address,$colony,$user_id,$password);

   }
    
    public function customer_ragistration_check_mobile_no(){
         $postdata = file_get_contents("php://input");
         $request = json_decode($postdata);
         $mobile_no = $request->mobile_no;
         $my_data = $this->model_app_interface->customer_ragistration_check_mobile_no($mobile_no);
        
         $data["customer_id"] = $my_data['customer_id'];
          $data["user_role"] = $my_data['customer_role'];
           echo json_encode($data);   
        
    }
//=========********===========********========******========//
// ************ customer Special orders section ***********//
//=========********===========********========******========//
   public function customer_special_orders()
	 {
		 $postdata = file_get_contents("php://input");
		 $request = json_decode($postdata);
		 $customer_id = $request->customer_id;
		 $delivery_date = $request->delivery_date;
		 $product_array = $request->product_array;
		 $total_price = $request->total_price;

		$this->model_app_interface->customer_special_orders($customer_id,$product_array,$delivery_date,$total_price);
	 }

	 public function order_history()
	 {
		 $postdata = file_get_contents("php://input");
		 $request = json_decode($postdata);
		 $customer_id = $request->user_id;
		 $data['order_history'] = $this->model_app_interface->order_history($customer_id);
		 echo json_encode($data);
	 }

	 public function order_history_filter()
	 {
		 $customer_id = $this->uri->segment(3);
		 $date = $this->uri->segment(4);
     if($customer_id && $date){
			  $data['order_history'] = $this->model_app_interface->order_history_filter($customer_id,$date);
				echo json_encode($data);
		 }

	 }

	 public function order_details()
	 {
		 $postdata = file_get_contents("php://input");
		 $request = json_decode($postdata);
		 $order_id = $request->order_id;
		 $data['order_details'] = $this->model_app_interface->order_details($order_id);
		 $data{'item_details'} = $this->model_app_interface->order_item_details($order_id);
		 echo json_encode($data);
	 }

	 // //-----//////------/////--------/////////------///////
	 // //======= Location Tracking======//////
	 // //-----//////------/////--------/////////-------//////

	 // agent section

	 	public function location_tracking(){

	         if(isset($_POST["lat"],$_POST["lng"],$_POST["agent_id"])){
	 		    $lat = $_POST["lat"];
	 			$lng = $_POST["lng"];
	 			$agent_id = $_POST["agent_id"];
	 		    $this->model_app_interface->location_tracking($lat,$lng,$agent_id);
	 		}

	     }

	 	public function agent_customers_location(){
	           $postdata = file_get_contents("php://input");
	           $request = json_decode($postdata);


	 	       $login_email = $request->login_email;
	 		   $role = $request->role;

	 		   if($role == "agent"){
	 			   $data["user"] = $this->model_app_interface->agent_customers_location($login_email);

	 		   }

	 		  echo json_encode($data);
	 	}

	 	public function update_location(){
	 		$postdata = file_get_contents("php://input");
	         $request = json_decode($postdata);
	 	    $agent_id = 2;//$request->agent_id;
	 		$data["position"] = $this->model_app_interface->update_location($agent_id);
	 		echo json_encode($data);

	 	}
	 // customer section

	 	public function customer_data_for_location(){
	           $postdata = file_get_contents("php://input");
	           $request = json_decode($postdata);


	 	       $login_email = $request->login_email;
	 		   $role = $request->role;

	 		   if($role == "customers"){
	 			   $data["user"] = $this->model_app_interface->customer_data_for_location($login_email);
					 $data["user_role"] = 'customers';

	 		   }

	 		  echo json_encode($data);
	 	}


	 	public function customer_data_for_add_marker(){
	 		 $postdata = file_get_contents("php://input");
	           $request = json_decode($postdata);


	 	       $login_email = $request->login_email;
	 		   $role = $request->role;

	 		   if($role == "customers"){
	 			   $data["user"] = $this->model_app_interface->customer_data_for_add_marker($login_email);

	 		   }

	 		  echo json_encode($data);


	 	}

	 	public function customer_add_locations(){

	 		$postdata = file_get_contents("php://input");
	         $request = json_decode($postdata);
	 	    $customer_id = $request->user_id;
	 		$customer_lat = $request->user_lat;
	 		$customer_lng = $request->user_lng;

	 		$this->model_app_interface->customer_add_locations($customer_id,$customer_lat,$customer_lng);
	 	}
// //-----//////------/////--------/////////------///////
// //======= Ckeck app version number======//////
// //-----//////------/////--------/////////-------//////
	     public function check_app_version(){

	           $this->model_app_interface->check_app_version();

	     }
// //-----//////------/////--------/////////------///////
// //=======  Agent Extra Orders ======//////
// //-----//////------/////--------/////////-------////// 
     public function select_guest_extra_orders(){
		    $postdata = file_get_contents("php://input");
	         $request = json_decode($postdata);
	 	    $agent_id = $request->user_id;
		   $data["order_list"] = $this->model_app_interface->select_guest_extra_orders($agent_id);
	 		echo json_encode($data);
	 }
	 
	 public function select_agent_extra_order_filter(){

			$user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
			
			if(!$colony_id){
				$colony_id = '';
			}
			
			$data["order_list"] = $this->model_app_interface->select_agent_extra_order_filter($user_id,$status,$colony_id);
		  echo json_encode($data);

		}
		
	public function count_pending_extra_orders(){
		
		    $user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
			
			if(!$colony_id){
				$colony_id = '';
			}
			
			$data["count_pending"] = $this->model_app_interface->count_pending_extra_orders($user_id,$status,$colony_id);
		    echo json_encode($data);
		
	}	
	
	public function count_completed_extra_orders(){
		
		    $user_id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			$colony_id = $this->uri->segment(5);
			
			if(!$colony_id){
				$colony_id = '';
			}
			
			$data["count_completed"] = $this->model_app_interface->count_completed_extra_orders($user_id,$status,$colony_id);
		    echo json_encode($data);
		
	}
    
// //-----//////------/////--------/////////------///////
// //=======  Guest  Action Section ======//////
// //-----//////------/////--------/////////-------//////     
 
    public function guest_orders(){
		    $order_id = $this->uri->segment(3);
            //$data["guest"] = $this->model_app_interface->guest_account($guest_id);
			$data["list"] = $this->model_app_interface->guest_orders($order_id);
		    echo json_encode($data);
    }
    
    public function submit_guest_order(){
           $postdata = file_get_contents("php://input");
	       $request = json_decode($postdata);
	 	   $agent_id = $request->agent_id;
           $order_id = $request->order_id;
		   $data["order_list"] = $this->model_app_interface->submit_guest_order($order_id,$agent_id);
	 		//echo json_encode($data);
        
        
    }
 // //-----//////------/////--------/////////------///////
// //=======  Customer Manage Requirement======//////
// //-----//////------/////--------/////////-------//////     
    
    public function  customer_daily_requirement(){
        
           $postdata = file_get_contents("php://input");
	       $request = json_decode($postdata);
	 	   $customer_id = $request->customer_id;
           
		   $data["list"] = $this->model_app_interface->customer_daily_requirement($customer_id);
	 		echo json_encode($data);
        
    }
    
    public function update_customer_requirement(){
        
           $postdata = file_get_contents("php://input");
	       $request = json_decode($postdata);
	 	   $customer_id = $request->customer_id;
           $product_array = $request->product_array;
           
          $data["list"] = $this->model_app_interface->update_customer_requirement($customer_id,$product_array);
	 		
    }
// //-----//////------/////--------/////////------///////
// //=======  Customer Request For Membership ======//////
// //-----//////------/////--------/////////-------//////        
    
    public function check_membership_request(){
           $postdata = file_get_contents("php://input");
	       $request = json_decode($postdata);
	 	   $guest_id = $request->guest_id;
           $data["msg"] = $this->model_app_interface->check_membership_request($guest_id);
           echo json_encode($data);
    }
    
    public function get_membership(){
           $postdata = file_get_contents("php://input");
	       $request = json_decode($postdata);
	 	   $guest_id = $request->guest_id;
           $p_array = $request->p_array;
           $start_date = $request->start_date;
           $shift = $request->shift;
        
           $data["list"] = $this->model_app_interface->get_membership($guest_id,$p_array,$start_date,$shift);
    }
// //-----//////------/////--------/////////------///////
// //=======  Feedback Section ======//////
// //-----//////------/////--------/////////-------//////     
      public function feedback(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           
           $customer_id = $request->customer_id;
            $quality_rank = $request->quality_rank;
           $service_rank = $request->service_rank;
           $suggestion = $request->suggestion;
		   $this->model_app_interface->feedback($customer_id,$quality_rank,$service_rank,$suggestion);
           
        
        
    }
        
    public function select_feedback(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $customer_id = $request->customer_id;
		   $data["feedback"] = $this->model_app_interface->select_feedback($customer_id);
		   echo json_encode($data);
        
        
    }  
 // //-----//////------/////--------/////////------///////
// //=======  Calculate Agent Today Cash ======//////
// //-----//////------/////--------/////////-------//////      
    public function calculate_agent_cash(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $agent_id = $request->agent_id;
		   $data["my_data"] = $this->model_app_interface->calculate_agent_cash($agent_id);
		   echo json_encode($data);
        
    }
    
// //-----//////------/////--------/////////------///////
// //=======  Payment Gateway Details ======//////
// //-----//////------/////--------/////////-------//////     
    public function payment_gateway_details(){
        
         $data["my_data"] = $this->model_app_interface->payment_gateway_details();
		   echo json_encode($data);
        
    }
// //-----//////------/////--------/////////------///////
// //=======  Select App Content ======//////
// //-----//////------/////--------/////////-------//////       
    public function app_content(){
        
         $data["my_data"] = $this->model_app_interface->app_content();
		   echo json_encode($data);
        
    }
	
// //-----//////------/////--------/////////------///////
// //=======  SMS API ======//////
// //-----//////------/////--------/////////-------////// 	

     public function check_sms_balance(){
        
         $data["my_data"] = $this->model_app_interface->check_sms_balance();
		
        
    }
	
	public function insert_sended_msg(){
        
         $data["my_data"] = $this->model_app_interface->insert_sended_msg();
		
        
    }
	
// //-----//////------/////--------/////////------///////
// //=======  Send User Ragistration OTP ======//////
// //-----//////------/////--------/////////-------////// 	
     public function send_otp(){
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $mobile_no = $request->mobile_no;
		   $otp = $request->otp;
		   $data["my_data"] = $this->model_app_interface->send_otp($mobile_no, $otp );
		   echo json_encode($data);
        
    }
}
