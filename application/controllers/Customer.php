<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_dashboard');
        $this->load->model('model_customer');
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
	public function add_customer(){
        $data['active_menu'] = "customer";
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
            
         $ac_type = $this->input->post("ac_type");     
         $balance_restricted = $this->input->post("balance_restricted");     

          $agent = $this->input->post('agent');
          $estimate_product = $this->input->post("estimate_product");
            
            $card_type = $this->input->post("card_type");
          
          
           $data['message'] =  $this->model_customer->add_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$shift,$agent,$estimate_product, $ac_type , $balance_restricted,$card_type);
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
               
               $data['r_ac_type'] = $ac_type;
               $data['r_bl_res'] = $balance_restricted;
               

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
		       $this->load->view('customer/add_customer',$data);
        }
	}
    
    
    public function manage_requirement_account_setup(){
         $data['active_menu'] = "customer";
        $id = $this->uri->segment(3);
        $request_id = $this->uri->segment(4);
         if($this->input->post('submit') != ''){
             
             $delivery_schedule = $this->input->post('schedule');

             if($delivery_schedule == 'Week'){
                 $day_array = $this->input->post("req_array_week");
                 
                 
                 $this->model_customer->manage_requirement_schedule_week($day_array,$id,'week','account_setup');
                 
             }else if($delivery_schedule == 'Month'){
                 
                 $day_array = $this->input->post("req_array_month");
                 $this->model_customer->manage_requirement_schedule_month($day_array,$id,'month','account_setup');
             }else if($delivery_schedule == 'everyday'){
                 
                 $day_array = $this->input->post("req_array_daily");
                 $this->model_customer->manage_requirement_schedule_daily($day_array,$id,'account_setup');
             }
  
             
         }else{
             
           $data['select_product'] = $this->model_customer->select_product();
           $data['select_req'] = $this->model_customer->select_estimated_product($id);
            $data['selected_customer'] = $this->model_customer->selected_customer($id);
             $data['selected_requested_product'] = $this->model_customer->selected_requested_product($request_id);
             //echo json_encode($data);
		       $this->load->view('customer/manage_customer_requirement',$data);
        
         }
        
    }
    
    
    public function manage_requirement($id){
         $data['active_menu'] = "customer";
         
         if($this->input->post('submit') != ''){
             
             $delivery_schedule = $this->input->post('schedule');
             
             
             
             if($delivery_schedule == 'Week'){
                 $day_array = $this->input->post("req_array_week");
                 
                 
                 $this->model_customer->manage_requirement_schedule_week($day_array,$id,'week','updation');
                 
             }else if($delivery_schedule == 'Month'){
                 
                 $day_array = $this->input->post("req_array_month");
                 $this->model_customer->manage_requirement_schedule_month($day_array,$id,'month','updation');
             }else if($delivery_schedule == 'everyday'){
                 
                 $day_array = $this->input->post("req_array_daily");
                 $this->model_customer->manage_requirement_schedule_daily($day_array,$id,updation);
             }
             
             
             
             
             
         }else{
             
         
           $data['select_product'] = $this->model_customer->select_product();
             $data['select_req'] = $this->model_customer->select_estimated_product($id);
             
             $data['selected_customer'] = $this->model_customer->selected_customer($id);
       //      echo json_encode($data);
		       $this->load->view('customer/manage_customer_requirement',$data);
        
         }
        
        
    }


	public function form_submit(){

		if(isset($_POST["card_no"])){

			$firstname  =  $_POST["firstname"];
			$lastname  =  $_POST["lastname"];
			$mobileno  =  $_POST["mobileno"];
            $mobileno2  =  $_POST["mobileno2"];
			$email  =  $_POST["email"];
			$address1  =  $_POST["address1"];
			$address2  =  $_POST["address2"];
			$postcode  =  $_POST["postcode"];
			$colony  =  $_POST["colony"];
			$city  =  $_POST["city"];
            $delivery_type  =  $_POST["delivery_type"];
			$advance_payment  =  $_POST["advance_payment"];
			$card_no  =  $_POST["card_no"];
            

			/* echo $firstname.$lastname.$mobileno.$email.$address1.$address2.$postcode.$colony.$city.$advance_payment.$card_no; */

			$this->model_customer->add_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$postcode,$colony,$city,$delivery_type,$advance_payment,$card_no);
		}

	}





/*  ////////\\\\\\\\ ///////\\\\\\\\\\ */

/*  //////// list Customer /////// */

	public function list_customer(){

        $data['active_menu'] = "customer";
		$data['customer_list'] = $this->model_customer->fetch_customer();
		$this->load->view('customer/list_customer',$data);
	}

	public function view_customer(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
        $switch = $this->uri->segment(4);
        if(isset($switch)){

                $data['switch'] =  $this->uri->segment(4);
                $data['detail_recharge'] =  $this->model_customer->customer_rech_report2($linked_no);
                $data['detail_transaction'] =  $this->model_customer->customer_tran_report2($linked_no);
              
                $data['detail_vacation'] =  $this->model_customer->customer_vacation($linked_no);
               
                $data['detail'] = $this->model_customer->view_customer($linked_no);

                $data['minimum_recharge'] =  $this->model_customer->select_recharge_limit();

                $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);
		        $this->load->view('customer/view_customer',$data);
        }else{
                $data['switch'] =  "no";
                $data['detail'] = $this->model_customer->view_customer($linked_no);
                $data['minimum_recharge'] =  $this->model_customer->select_recharge_limit();
                $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);
		        $this->load->view('customer/view_customer',$data);
        }

	}
    
    public function view_terminated_customer(){
        $data['active_menu'] = "customer";
        $linked_no =  $this->uri->segment(3);
        $switch = $this->uri->segment(4);
        if(isset($switch)){

                $data['switch'] =  $this->uri->segment(4);
                $data['detail_recharge'] =  $this->model_customer->terminated_customer_rech_report2($linked_no);
                $data['detail_transaction'] =  $this->model_customer->terminated_customer_tran_report2($linked_no);
                $data['detail'] = $this->model_customer->view_terminated_customer($linked_no);

                $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);
		        $this->load->view('customer/view_terminated_customer',$data);
        }else{
                $data['switch'] =  "no";
                $data['detail'] = $this->model_customer->view_terminated_customer($linked_no);
                $data['minimum_recharge'] =  $this->model_customer->select_recharge_limit();
                $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);
		        $this->load->view('customer/view_terminated_customer',$data);
        }

	}


    public function assign_card($linked_no){
		$data['active_menu'] = "customer";
        if($this->input->post('customer_id') != ''){
            $customer_id = $this->input->post('customer_id');
            $old_card = $this->input->post('old_card_no');
            $new_card = $this->input->post('new_card_no');
            $card_status = $this->input->post('card_status');

            $data['message'] = $this->model_customer->assign_card($customer_id,$old_card,$new_card,$card_status);
            $data['edit_detail'] = $this->model_customer->edit_customer($linked_no);
            $this->load->view('customer/assign_card',$data);

        }else{

        $data['edit_detail'] = $this->model_customer->edit_customer($linked_no);
		$this->load->view('customer/assign_card',$data);

        }
	}

	public function edit_customer($linked_no){
        $data['active_menu'] = "customer";
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
			$card_no  =  $this->input->post("customer_id");
            $shift_selected =  $this->input->post("shift");
            
            $ac_type =  $this->input->post("ac_type");
            $balance_restricted =  $this->input->post("balance_restricted");
            

            $agent = $this->input->post('agent');
             $estimate_product = $this->input->post("estimate_product");

           $data['message'] =  $this->model_customer->edit_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$agent,$estimate_product,$shift_selected ,$ac_type, $balance_restricted);
           $data['edit_detail'] = $this->model_customer->edit_customer($linked_no);
             $data['select_colony'] = $this->model_customer->select_colony();
            $data['select_agent'] = $this->model_customer->select_agent();
            $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);

            $this->load->view('customer/edit_customer',$data);
        }else{

		   $data['edit_detail'] = $this->model_customer->edit_customer($linked_no);
           $data['select_product'] = $this->model_customer->edit_customer_products($linked_no);
             $data['select_colony'] = $this->model_customer->select_colony();
            $data['select_agent'] = $this->model_customer->select_agent();
		  $this->load->view('customer/edit_customer',$data);
        }


	}

	public function form_submit_edit(){

		if(isset($_POST["card_no"])){

			$firstname  =  $_POST["firstname"];
			$lastname  =  $_POST["lastname"];
			$mobileno  =  $_POST["mobileno"];
            $mobileno2  =  $_POST["mobileno2"];
			$email  =  $_POST["email"];
			$address1  =  $_POST["address1"];
			$address2  =  $_POST["address2"];
			$postcode  =  $_POST["postcode"];
			$colony  =  $_POST["colony"];
			$city  =  $_POST["city"];
            $delivery_type  =  $_POST["delivery_type"];
			$advance_payment  =  $_POST["advance_payment"];
			$card_no  =  $_POST["card_no"];

			/* echo $firstname.$lastname.$mobileno.$email.$address1.$address2.$postcode.$colony.$city.$advance_payment.$card_no; */

			$this->model_customer->edit_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$postcode,$colony,$city,$delivery_type,$advance_payment,$card_no);
		}

	}


    public function recharge_account(){
        if(isset($_POST['link_id'],$_POST['recharge_value'])){

			$recharge_value = $_POST['recharge_value'];
			$link_id = $_POST['link_id'];
            $r_mobile = $_POST['mobile_no'];

			$this->model_customer->recharge_account($recharge_value,$link_id,$r_mobile);



		}else{

            echo "something wrong";
        }
	}

    public function block_accout(){
        if(isset($_POST['link_id'])){
			$link_id = $_POST['link_id'];
			$this->model_customer->block_accout($link_id);
		}else{
            echo "something wrong";
        }
	}

    public function unblock_accout(){
        if(isset($_POST['link_id'])){
			$link_id = $_POST['link_id'];
			$this->model_customer->unblock_accout($link_id);
		}else{
            echo "something wrong";
        }
	}

	public function delete_customer(){
        if(isset($_POST['link_id'])){

			$link_id = $_POST['link_id'];
			$this->model_customer->delete_customer($link_id);

		}
	}

    public function customer_tran_report($id){

        $this->model_customer->customer_tran_report($id);

    }

    public function customer_rech_report($id){

        $this->model_customer->customer_rech_report($id);

    }

    public function delete_transaction(){
         $transaction_id =  $this->uri->segment(3);
         $customer_id =  $this->uri->segment(4);
         $this->model_customer->delete_transaction($transaction_id,$customer_id);

    }
    public function delete_recharge(){
         $transaction_id =  $this->uri->segment(3);
         $customer_id =  $this->uri->segment(4);
         $this->model_customer->delete_recharge($transaction_id,$customer_id);

    }
/*  ////////\\\\\\\\ ///////\\\\\\\\\\ */


	public function enter_code(){

		$this->model_dashboard->enter_code();
	}

    public function send_sms(){

                $username = "sharmadairy@gmail.com";
	            $hash = "5ab31680b52065c0860857c56560fd89a0970b553b8c50e31036cd8e093c1d54";

	            // Config variables. Consult http://api.textlocal.in/docs for more info.
	            $test = "0";

	            // Data for text message. This is the text message data.
	            $sender = "SDAIRY"; // This is who the message appears to be from.
	            $numbers = 8827408341; // A single number or a comma-seperated list of numbers
	            $message = rawurlencode('Dear vivek%nYour card number 2050003 has been successfully recharged with 500 Available balance 200%nThank You,%nTeam Sharma Dairy');
	            // 612 chars or less
	            // A single number or a comma-seperated list of numbers
	            $message = urlencode($message);
	            $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	            $ch = curl_init('http://api.textlocal.in/send/?');
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            $result = curl_exec($ch); // This is the result from the API
	            curl_close($ch);
		        print_r($result);
                $check =  json_decode($result);
                echo $check->status;

    }
    
    
    ////////////**************///////////
    
    
    
    public function add_vacation(){
        
        
         if($this->input->post('submit') != ''){
           
             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $v_customer_id = $this->input->post('v_customer_id');
             
             $multidate = $this->input->post("multidate");
             
             if($v_customer_id ){
                 
                 $this->model_customer->add_vacation($start,$end,$v_customer_id,$multidate);
             }else{
                 
                 redirect(base_url().'customer/view_customer/'.$v_customer_id.'/vacation');
             }
         }
    }
    
    
    public function delete_vacation(){
        
        if(isset($_POST["del_id"])){
            
            $del_id = $_POST["del_id"];
            $this->model_customer->delete_vacation($del_id);
            
        }
    }



}
