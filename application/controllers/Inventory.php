<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inventory extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_dashboard');
        $this->load->model('model_inventory');


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


    //  =========== ////////// ========  new update ======       ////////
   //  =========== ////////// ========  new update ======       ////////
  //  =========== ////////// ========  new update ======       ////////

     public function dairy_stock($date){
        $data['active_menu'] = "inventory";
        $data['active_submenu'] = "inventory";

         if($date !== '00-00-0000'){
             $search_date = date('Y-m-d',strtotime($date));

             $stock_data = $this->model_inventory->select_product($search_date);
             $data['select_product'] = $stock_data['stock'];
             $data['action'] = $stock_data['action'];
             $data['return_date'] = $date;
             
             
             // past stock
             $day_before = date( 'Y-m-d', strtotime( $search_date . ' -1 day' ) );
             
             $data['day_before_stock'] = $this->model_inventory->day_before_stock($day_before);
            
             
            // $data['product_requirement'] = $this->model_inventory->dairy_product_requirement($search_date);
             //echo json_encode($data);
              $this->load->view('inventory/dairy_stock',$data);
         }else{
            $data['action'] = 'no';
            $this->load->view('inventory/dairy_stock',$data);
         }
	   }
    
    
    public function carry_forward(){
        
        $carry_from = $this->input->post('carry_from');
        
        $transfer_qty = $this->input->post('transfer_qty');
        
        $produced_product = $this->input->post('add_in_product');
        
        $produced_qty = $this->input->post('produced_qty');
        
        $my_stock_date = $this->input->post('my_stock_date');
        
        
        $data['msg'] = $this->model_inventory->carry_forward_stock($carry_from,$transfer_qty,$produced_product,$produced_qty,$my_stock_date);
        
        
        
    }


    public function add_dairy_stock(){

        if(isset($_POST['product_id_array'],$_POST['product_qty_array'],$_POST['stock_date'],$_POST['action'])){

            $product_id_array = $_POST['product_id_array'];
            $product_qty_array = $_POST['product_qty_array'];
            $stock_date = date('Y-m-d',strtotime($_POST['stock_date']));
            $action = $_POST['action'];


          //  print_r($product_qty_array);
          $this->model_inventory->add_dairy_stock($product_id_array,$product_qty_array,$stock_date,$action);
        }
    }

// assign agent stock

    public function assign_agent_stock(){
         $data['active_menu'] = "inventory";
         $data['active_submenu'] = "assign_inventory";

        $date = $this->uri->segment(3);
        $agent_id = $this->uri->segment(4);

        if($date !== '00-00-0000' && $agent_id !== '0'){
             $search_date = date('Y-m-d',strtotime($date));

             $stock_data = $this->model_inventory->select_agent_stock($search_date,$agent_id);
             $data['select_product'] = $stock_data['stock'];
             $data['action'] = $stock_data['action'];
             $data['return_date'] = $date;
             $data['return_agent'] = $agent_id;
             $data['agent_list'] = $this->model_inventory->select_agent();
			 $data['dairy_avl_stock'] = $this->model_inventory->dairy_stock_report_filter($search_date);

             $this->load->view('inventory/assign_agent_stock',$data);
         }else{
            $data['action'] = 'no';
            $data['agent_list'] = $this->model_inventory->select_agent();

            $this->load->view('inventory/assign_agent_stock',$data);
         }
    }

    public function add_agent_dairy_stock(){
        if(isset($_POST['product_id_array'],$_POST['product_qty_array'],$_POST['stock_date'],$_POST['action'],$_POST['user_id'])){
            $product_id_array = $_POST['product_id_array'];
            $product_qty_array = $_POST['product_qty_array'];
            $stock_date = date('Y-m-d',strtotime($_POST['stock_date']));
            $action = $_POST['action'];
            $user_id = $_POST['user_id'];

          //  print_r($product_qty_array);
          $this->model_inventory->add_agent_dairy_stock($product_id_array,$product_qty_array,$stock_date,$action,$user_id);
        }
    }

// return agent stock
    public function return_stock(){
        $data['active_menu'] = "inventory";
        $data['active_submenu'] = "return_inventory";
        $date = $this->uri->segment(3);
        if($date !== '00-00-0000'){
             $search_date = date('Y-m-d',strtotime($date));


			 $data['dairy_avl_stock'] = $this->model_inventory->dairy_stock_report_filter($search_date);
             $data['return_stock_data'] = $this->model_inventory->return_stock_agent_select($search_date);
             $data['return_date'] = $date;
            // $data['return_agent'] = $agent_id;
            // $data['agent_list'] = $this->model_inventory->select_agent();
            $this->load->view('inventory/return_stock',$data);
         }else{
            $data['action'] = 'no';
            $data['agent_list'] = $this->model_inventory->select_agent();
            $this->load->view('inventory/return_stock',$data);
         }
	}

    public function return_stock_submit(){
        if(isset($_POST['stock_date'],$_POST['user_id'])){
             $search_date = date('Y-m-d',strtotime($_POST['stock_date']));
             $agent_id = $_POST['user_id'];


             $product_id_array = $_POST['product_id_array'];
             $remaining_product_qty_array = $_POST['remaining_product_qty_array'];
             $lost_product_qty_array = $_POST['lost_product_qty_array'];

             $this->model_inventory->return_stock_submit($search_date,$agent_id,$product_id_array,$remaining_product_qty_array,$lost_product_qty_array);
        }
    }

    public function return_stock_submit_update(){

        if(isset($_POST['stock_date'],$_POST['user_id'])){

             $search_date = date('Y-m-d',strtotime($_POST['stock_date']));
             $agent_id = $_POST['user_id'];

             $product_id_array = $_POST['product_id_array'];
             $remaining_product_qty_array = $_POST['remaining_product_qty_array'];
             $lost_product_qty_array = $_POST['lost_product_qty_array'];

             $this->model_inventory->return_stock_submit($search_date,$agent_id,$product_id_array,$remaining_product_qty_array,$lost_product_qty_array);

        }


    }


   public function stock_report(){
       $data['active_menu'] = "report";
       $data['active_submenu'] = "dairy_stock_report";

      if($this->input->post('submit') != '' && $this->input->post('start') != "" ){

          $start_date = $this->input->post('start');
          $end_date = $this->input->post('end');

          if($start_date != 'Start Date'){
                 $data['return_start'] = $start_date;
             }
          $data['select_agent'] = $this->model_inventory->select_agent();
          $data['stock_report'] = $this->model_inventory->stock_report_filter($start_date,$end_date);
          
            $data['sum_stock_report'] = $this->model_inventory->sum_stock_report($start_date,$end_date);
         
         // echo json_encode($data); 
           $this->load->view('inventory/dairy_stock_report',$data);
      }else{


        $data['select_agent'] = $this->model_inventory->select_agent();
        $data['stock_report'] = $this->model_inventory->dairy_stock_report();
        
        $data['all_product'] = $this->model_inventory->select_all_product();  
          
       // $var = array('produce','sold', 'lost')  
          
        foreach($data['all_product'] as $row){
            $p_id = $row->product_id;
            
            $data['produce'.$p_id] = 0;
             $data['sold'.$p_id] = 0;
             $data['lost'.$p_id] = 0;
        }  
          
          
        $this->load->view('inventory/dairy_stock_report',$data);

      }
    }

    public function agent_stock_report(){
       $data['active_menu'] = "report";
       $data['active_submenu'] = "agent_stock_report";

      if($this->input->post('submit') != '' && $this->input->post('start') != "" ){

          $start_date = $this->input->post('start');

          if($start_date != 'Start Date'){
                 $data['return_start'] = $start_date;
             }
          $agent_id =  $this->input->post('agent_search');
          $data['return_agent'] = $agent_id;
          $data['select_agent'] = $this->model_inventory->select_agent();
         $data['agent_stock_report'] = $this->model_inventory->agent_stock_report($start_date,$agent_id);
          $data['dairy_avl_stock'] = $this->model_inventory->dairy_stock_report_filter($start_date);

          if($agent_id == ''){
              $this->load->view('inventory/agent_stock_report',$data);
          }else{

              $this->load->view('inventory/single_agent_stock_report',$data);
          }
      }else{
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $search_date = $date->format('d-m-Y');
        $agent_id =  '';
        $data['select_agent'] = $this->model_inventory->select_agent();
        $data['agent_stock_report'] = $this->model_inventory->agent_stock_report($search_date,$agent_id);
        $data['dairy_avl_stock'] = $this->model_inventory->dairy_stock_report_filter($search_date);

    	$this->load->view('inventory/agent_stock_report',$data);

      }
    }


    

    public function transfer_agent_stock(){
        $data['active_menu'] = "inventory";
        $data['active_submenu'] = "transfer_stock";

         if($this->input->post('submit') != ''){


         }else{
              $data['select_agent'] = $this->model_inventory->select_agent();
               $data['select_product'] = $this->model_inventory->select_all_product();

              $this->load->view('inventory/transfer_stock',$data);

         }

    }


    public function selected_agent_stock(){

        if(isset($_POST['user_id'])){

            $user_id = $_POST['user_id'];
            $product_id = $_POST['product_id'];
            $this->model_inventory->selected_agent_stock_for_transfer($user_id,$product_id);

        }

    }

    public function transfer_stock_submit(){

        if(isset($_POST['product_id'])){

            $product_id = $_POST['product_id'];
            $transfer_from = $_POST['transfer_from'];
            $transfer_to = $_POST['transfer_to'];
            $transfer_qty = $_POST['transfer_qty'];

            $this->model_inventory->transfer_stock_submit($product_id,$transfer_from,$transfer_to,$transfer_qty);


        }
    }

    //  =========== ////////// ========  new update ======       ////////
   //  =========== ////////// ========  new update ======       ////////
  //  =========== ////////// ========  new update ======       ////////








    public function inventory(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "inventory";

        if($this->input->post('submit') != ''){

            $product_list = $this->input->post('product_list');
            $quantity = $this->input->post('quantity');
            $total_price = $this->input->post('total_price');
            $action = $this->input->post('action');

            if($action == 'insert'){

                $data['message'] = $this->model_inventory->insert_inventory($product_list,$quantity,$total_price);
            }
            $data['select_product'] = $this->model_inventory->select_product();
             $data['inventory_list'] = $this->model_inventory->select_inventory();
             $data['stock_list'] = $this->model_inventory->select_stock();
           $this->load->view('inventory/inventory',$data);

        }else{


             $data['select_product'] = $this->model_inventory->select_product();
             $data['inventory_list'] = $this->model_inventory->select_inventory();
             $data['stock_list'] = $this->model_inventory->select_stock();
             $this->load->view('inventory/inventory',$data);
        }



	}


    public function assign_inventory($inventory_id){
           $data['active_menu'] = "management";
        $data['active_submenu'] = "inventory";

        if($this->input->post('submit') != ''){

            $agent = $this->input->post('agent');
            $quantity = $this->input->post('quantity');
            $total_price = $this->input->post('total_price');
            $product_id = $this->input->post('product_id');

            $data['message'] = $this->model_inventory->assign_product($agent,$quantity,$total_price,$product_id);
             $data['select_agent'] = $this->model_inventory->select_agent();
             $data['select_product'] = $this->model_inventory->select_product();
             $data['selected_stock'] = $this->model_inventory->selected_stock($inventory_id);
             $data['selected_agent_stock'] = $this->model_inventory->selected_agent_stock($inventory_id);
             $data['agent_inventory_list'] = $this->model_inventory->agent_inventory_list($inventory_id);

             $this->load->view('inventory/assign_inventory',$data);


        }else{

             $data['select_agent'] = $this->model_inventory->select_agent();
             $data['select_product'] = $this->model_inventory->select_product();
             $data['selected_stock'] = $this->model_inventory->selected_stock($inventory_id);
             $data['selected_agent_stock'] = $this->model_inventory->selected_agent_stock($inventory_id);
             $data['agent_inventory_list'] = $this->model_inventory->agent_inventory_list($inventory_id);
             $this->load->view('inventory/assign_inventory',$data);


        }

    }

    public function send_notification(){
          if(isset($_POST["title"])){

              $title = $_POST["title"];
              $msg = $_POST["msg"];
              $customer_id_array = $_POST["customer_id"];
              $customer_mobile_no_array = $_POST["mobile_no"];
              $send_type = $_POST["send_type"];

              if($send_type == "sms"){

                  echo $customer_id_array;

                   $username = "sharmadairy@gmail.com";
	                                 $hash = "5ab31680b52065c0860857c56560fd89a0970b553b8c50e31036cd8e093c1d54";
	                                 $test = "1";
	                                 $sender =  "TXTLCL"; // This is who the message appears to be from.
	                                 $numbers = '917746839761'; // A single number or a comma-seperated list of numbers
                                     $message = rawurlencode('testing');
	                                 $message = urlencode($message);
	                                 $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	                                 $ch = curl_init('http://api.textlocal.in/send/?');
	                                 curl_setopt($ch, CURLOPT_POST, true);
	                                 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	                                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	                                 $result = curl_exec($ch); // This is the result from the API
	                                 curl_close($ch);
                                     $check =  json_decode($result);
                                     print_r($result);




              }else if($send_type == "notification"){


                  $customer_id = explode(',',$customer_id_array);
                  foreach($customer_id as $row){
                       $data['msg'] = $this->model_notification->send_notification($title,$msg,$row);

                  }


              }


          }

    }

    public function transfer_stock(){

        if(isset($_POST["product_id"])){

            $product_id = $_POST["product_id"];
            $agent_id = $_POST["agent_id"];
            $transfer_to = $_POST["transfer_by"];
            $transfer_quantity = $_POST["transfer_quantity"];
            $product_price = $_POST["total_product_price"];

           //echo $agent_id;

            if($transfer_to == '1'){
                 $data['msg'] = $this->model_inventory->transfer_stock_to_admin($product_id,$agent_id,$transfer_to,$transfer_quantity,$product_price);
            }else{

            $data['msg'] = $this->model_inventory->transfer_stock($product_id,$agent_id,$transfer_to,$transfer_quantity,$product_price);

            }
            //echo $data['msg'];
           // echo $product_id.$agent_id.$transfer_to.$transfer_quantity.$product_price;

        }



    }

    public function delete_inventory(){

        if(isset($_POST["inventory_id"],$_POST["product_id"])){

            $inventory_id = $_POST["inventory_id"];
            $product_id =  $_POST["product_id"];

            $this->model_inventory->delete_inventory($inventory_id,$product_id);
        }

    }


     public function delete_assigned_inventory(){

        if(isset($_POST["inventory_id"],$_POST["product_id"])){

            $inventory_id = $_POST["inventory_id"];
            $product_id =  $_POST["product_id"];
            $product_quantity = $_POST["product_quantity"];

            $this->model_inventory->delete_assigned_inventory($inventory_id);
        }

    }


    // inventory report section

    public function inventory_report(){
       $data['active_menu'] = "report";
       $data['active_submenu'] = "inventory_report";

      if($this->input->post('submit') != '' && $this->input->post('start') != "" && $this->input->post('end') != ""){
          $report_type = $this->input->post('report_type');



          $product_search = $this->input->post('product_search');

          $start = $this->input->post('start');
          $end = $this->input->post('end');

          $month_search = $this->input->post('month_search');

          if($start != 'Start Date'){
                 $data['return_start'] = $start;
             }
          if($end != 'End Date'){
               $data['return_end'] = $end;
           }

          $data['return_product'] = $product_search;
          $data['select_product'] = $this->model_inventory->select_product();

        if($report_type == 'inventory'){

            if($month_search === ''){

                $data['inventory_report'] = $this->model_inventory->inventory_report_filter($start,$end,$product_search);
                $this->load->view('inventory/inventory_report',$data);

            }else{


            }


        }else if($report_type == 'assigned_inventory'){

            $data['inventory_report'] = $this->model_inventory->assigned_inventory_report_filter($start,$end,$product_search);
            $this->load->view('inventory/assigned_inventory_report',$data);
        }


      }else{

        $data['select_product'] = $this->model_inventory->select_product();
        $data['select_agent'] = $this->model_inventory->select_agent();
        $data['inventory_report'] = $this->model_inventory->inventory_report();
             $this->load->view('inventory/inventory_report',$data);

      }
    }

    public function inventory_date_report(){

        $data['active_menu'] = "report";
        $data['active_submenu'] = "inventory_report";

        $date = $this->uri->segment(3);
        //$agent_id = $this->uri->segment(4);
        //$shift_id = $this->uri->segment(5);
        $product_id = $this->uri->segment(4);

        if($this->input->post('submit') != ''){
              $product_search = $this->input->post('product_search');

              $data['select_product'] = $this->model_inventory->select_product();
              $data['inventory_report'] = $this->model_inventory->inventory_date_report_filter($date,$product_search);
              $this->load->view('inventory/inventory_date_report',$data);

       }else{
        $data['select_product'] = $this->model_inventory->select_product();
        $data['inventory_report'] = $this->model_inventory->inventory_date_report($date,$product_id);
        $this->load->view('inventory/inventory_date_report',$data);
        }

    }


    public function assigned_inventory_date_report(){

        $data['active_menu'] = "report";
        $data['active_submenu'] = "inventory_report";

        $date = $this->uri->segment(3);
        //$agent_id = $this->uri->segment(4);
        //$shift_id = $this->uri->segment(5);
        $product_id = $this->uri->segment(4);

        if($this->input->post('submit') != ''){
              $product_search = $this->input->post('product_search');
              $agent_search = $this->input->post('agent_search');

              $data['select_agent'] = $this->model_inventory->select_agent();
              $data['select_product'] = $this->model_inventory->select_product();
              $data['inventory_report'] = $this->model_inventory->assigned_inventory_date_report_filter($date,$product_search,$agent_search);
              $this->load->view('inventory/assigned_inventory_date_report',$data);

       }else{
         $data['select_agent'] = $this->model_inventory->select_agent();
        $data['select_product'] = $this->model_inventory->select_product();
        $data['inventory_report'] = $this->model_inventory->assigned_inventory_date_report($date,$product_id);
        $this->load->view('inventory/assigned_inventory_date_report',$data);
        }

    }
//  =========== ////////// ========  Add Purchase ======       ////////
//  =========== ////////// ========  Add Purchase ======       ////////
//  =========== ////////// ========  Add Purchase ======       ////////
  public function add_purchase($date){
	    $data['active_menu'] = "inventory";
	    $data['active_submenu'] = "add_purchase";

			if($this->input->post('submit') != ''){

            $search_date = $this->input->post('search_date');
						$dealer = $this->input->post('dealer');
						$purchase_product_id = $this->input->post('purchase_product_id');
						$purchase_qty = $this->input->post('purchase_qty');
						$purchase_unit_price = $this->input->post('purchase_unit_price');
						$purchase_product_price = $this->input->post('purchase_product_price');
						$production_product_id =  $this->input->post('production_product_id');
						$production_qty =  $this->input->post('production_qty');

						$this->model_inventory->add_purchase($search_date,$dealer,$purchase_product_id,$purchase_unit_price,$purchase_qty,$purchase_product_price,$production_product_id,$production_qty);

					/* $data['product_list'] = $this->model_inventory->select_all_product();
					 $data['select_purchase'] = $this->model_inventory->select_purchase($date);
					 $this->load->view('inventory/add_purchase',$data); */

			}else{
		 if($date !== '00-00-0000'){
				$search_date = date('Y-m-d',strtotime($date));

				$data['return_date'] = $date;

				$data['product_list'] = $this->model_inventory->select_all_product();
        $data['select_all_supplyer'] = $this->model_inventory->select_all_supplyer();
				$data['select_purchase'] = $this->model_inventory->select_purchase($date);
				$this->load->view('inventory/add_purchase',$data);

	  	}
	  }
  }

	public function create_products($date)
	{
		$data['active_menu'] = "inventory";
		$data['active_submenu'] = "inventory";

		 if($date !== '00-00-0000'){
				 $search_date = date('Y-m-d',strtotime($date));

				 $stock_data = $this->model_inventory->select_product($search_date);
				 $data['select_product'] = $stock_data['stock'];
				 $data['action'] = $stock_data['action'];
				 $data['return_date'] = $date;

				 $this->load->view('inventory/create_products_for_stock',$data);
		 }else{
				$data['action'] = 'no';
				$this->load->view('inventory/create_products_for_stock',$data);
		 }
	}

}
