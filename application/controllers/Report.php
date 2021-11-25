<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_dashboard');
        $this->load->model('model_report');

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

    public function customer_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "customer";
        if($this->input->post('submit') != ''){

            $name_search = $this->input->post('name_search');
            $colony_search = $this->input->post('colony_search');
            $delivery_search = $this->input->post('delivery_search');
            $status_search = $this->input->post('status_search');
            $ac_type = $this->input->post('ac_type');

            $name = explode(" ", $name_search);
            if(isset($name[0])){
               $first_name =  $name[0];
            }else{
                $first_name = "";
            }

            if(isset($name[1])){
               $last_name =  $name[1];
            }else{
                $last_name =  "";
            }
            $data['return_name'] = $name_search;
            $data['return_colony'] = $colony_search;
            $data['return_delivery'] = $delivery_search;
            $data['return_status']  =   $status_search;
            $data['r_ac_type']  =   $ac_type;
            
            $data['select_colony'] = $this->model_report->select_colony();
            $data['all_customer'] = $this->model_report->customer_report_multi_searchbar($first_name,$last_name,$colony_search,$delivery_search,$status_search,$ac_type);
            $this->load->view('report/customer_report',$data);

        }else{
             $data['all_customer'] = $this->model_report->select_customer_report();
             $data['select_colony'] = $this->model_report->select_colony();
             $this->load->view('report/customer_report',$data);
        }



	}

   public function active_customer_quickreport(){
           $data['active_menu'] = "report";
           $data['active_submenu'] = "customer";

            $name_search = '';
            $colony_search = '';
            $delivery_search = '';
            $status_search = 'active';

            $first_name = '';
            $last_name = '';
            $data['return_name'] = $name_search;
            $data['return_colony'] = $colony_search;
            $data['return_delivery'] = $delivery_search;
            $data['return_status']  =   $status_search;
            $data['select_colony'] = $this->model_report->select_colony();
            $data['all_customer'] = $this->model_report->customer_report_multi_searchbar($first_name,$last_name,$colony_search,$delivery_search,$status_search);
            $this->load->view('report/quick_activecustomer_report.php',$data);

   }


    public function customer_full_recharge_report($id){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "customer";
         if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

             $start = $this->input->post('start');
             $end = $this->input->post('end');

              $data['return_start'] = $start;
              $data['return_end'] = $end;
              $data['customer_detail'] = $this->model_report->customer_report_list($id);
              $data['customer_recharge'] = $this->model_report->customer_full_report_rech_search($start,$end,$id);
              $this->load->view('report/customer_full_recharge_report',$data);
         }else{

             $data['customer_detail'] = $this->model_report->customer_report_list($id);
             $data['customer_recharge'] = $this->model_report->customer_full_report_rech($id);
             $this->load->view('report/customer_full_recharge_report',$data);

         }

    }

    public function customer_full_transaction_report($id){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "customer";
         if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

             $start = $this->input->post('start');
             $end = $this->input->post('end');

              $data['return_start'] = $start;
              $data['return_end'] = $end;
              $data['customer_detail'] = $this->model_report->customer_report_list($id);
             $data['customer_transaction'] = $this->model_report->customer_full_report_tran_search($start,$end,$id);
             $this->load->view('report/customer_full_transaction_report',$data);
         }else{

             $data['customer_detail'] = $this->model_report->customer_report_list($id);
             $data['customer_transaction'] = $this->model_report->customer_full_report_tran($id);
             $this->load->view('report/customer_full_transaction_report',$data);

         }



    }

	public function transaction_report(){

        $data['active_menu'] = "report";
        $data['active_submenu'] = "tran_report";


         if($this->input->post('submit') != '' && $this->input->post('start') != "" && $this->input->post('end') != ""){

             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $agent_search = $this->input->post('agent_search');
             $product_search = $this->input->post('product_search');
             $shift_id =  $this->input->post('shift');
             
             $customer_type =  $this->input->post('customer_type');


              if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }

              $data['return_agent'] = $agent_search;
              $data['return_product'] = $product_search;
              $data['return_shift'] = $shift_id;
              $data['return_customer_type'] = $customer_type;
             
              $data['daily_transaction'] = $this->model_report->transaction_report_search($start,$end,$agent_search,$product_search,$shift_id,$customer_type);
              $data['select_agent'] = $this->model_report->select_all_agent();
              $data['select_product'] = $this->model_report->select_product();
              $data['select_shift'] = $this->model_report->select_shift();
              $this->load->view('report/transaction_report',$data);
         }else{
             $data['select_agent'] = $this->model_report->select_all_agent();
             $data['select_product'] = $this->model_report->select_product();
             $data['daily_transaction'] = $this->model_report->daily_transaction();
             $data['select_shift'] = $this->model_report->select_shift();
             $this->load->view('report/transaction_report',$data);

         }



	}

    public function transaction_date_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "tran_report";

        $date = $this->uri->segment(3);
        $agent_id = $this->uri->segment(4);
        $shift_id = $this->uri->segment(5);
        $product_id = $this->uri->segment(6);

        /*if(!isset($agent_id)){
            $agent_id = "";
        }*/


        if($this->input->post('submit') != ''){

            $colony_search = $this->input->post('colony_search');
            $delivery_search = $this->input->post('delivery_search');
            $agent_search = $this->input->post('agent_search');
            $shift_id =  $this->input->post('shift');
            $customer_type =  $this->input->post('customer_type');
             $product_search = $this->input->post('product_search');
            
            $on_date = $date;

            $data['return_colony'] = $colony_search;
            $data['return_delivery'] = $delivery_search;
            $data['return_agent'] = $agent_search;
            $data['return_shift'] = $shift_id;
            $data['return_customer_type'] = $customer_type;
            $data['return_product'] = $product_search;
            
            $data['select_colony'] = $this->model_report->select_colony();
            $data['select_agent'] = $this->model_report->select_all_agent();
            $data['select_shift'] = $this->model_report->select_shift();
            $data['select_product'] = $this->model_report->select_product();
            $data['transaction_detail'] = $this->model_report->transaction_date_multi_searchbar($colony_search,$delivery_search,$agent_search,$on_date,$shift_id,$customer_type,$product_search);
            $this->load->view('report/transaction_date_report',$data);

        }else{


            $data['transaction_detail'] = $this->model_report->transaction_date_report($date,$agent_id,$shift_id,$product_id);
            $data['select_colony'] = $this->model_report->select_colony();
            $data['select_agent'] = $this->model_report->select_all_agent();
            $data['select_shift'] = $this->model_report->select_shift();
            $data['select_product'] = $this->model_report->select_product();
            $this->load->view('report/transaction_date_report',$data);

        }


    }

    public function recharge_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "rech_report";

        if($this->input->post('submit') != "" && $this->input->post('start') != "" && $this->input->post('end') != ""){

             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $agent_search = $this->input->post('agent_search');
              if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }
              $data['return_agent'] = $agent_search;
              $data['daily_recharge'] = $this->model_report->recharge_report_search($start,$end,$agent_search);
              $data['select_agent'] = $this->model_report->select_all_agent();
              $this->load->view('report/recharge_report',$data);
         }else{
             $data['select_agent'] = $this->model_report->select_all_agent();
             $data['daily_recharge'] = $this->model_report->daily_recharge();
             $this->load->view('report/recharge_report',$data);

         }

	}

    public function recharge_date_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "rech_report";

        $date = $this->uri->segment(3);
        $agent_id = $this->uri->segment(4);

        if(!isset($agent_id)){
            $agent_id = "";
        }

        if($this->input->post('submit') != ''){

            $colony_search = $this->input->post('colony_search');
            $delivery_search = $this->input->post('delivery_search');
            $agent_search = $this->input->post('agent_search');
            $on_date = $date;

            $data['return_colony'] = $colony_search;
            $data['return_delivery'] = $delivery_search;
            $data['return_agent'] = $agent_search;
            $data['select_colony'] = $this->model_report->select_colony();
            $data['select_agent'] = $this->model_report->select_all_agent();
            $data['recharge_detail'] = $this->model_report->recharge_date_multi_searchbar($colony_search,$delivery_search,$agent_search,$on_date);
            $this->load->view('report/recharge_date_report',$data);

        }else{
             $data['select_colony'] = $this->model_report->select_colony();
             $data['select_agent'] = $this->model_report->select_all_agent();
             $data['recharge_detail'] = $this->model_report->recharge_date_report($date,$agent_id);
             $this->load->view('report/recharge_date_report',$data);

        }



    }

    public function agent_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "age_report";
        $data['daily_report'] = $this->model_report->daily_agent_report();
        $this->load->view('report/agent_report',$data);

	}


    public function agent_daily_report($id){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "age_report";
        $data['select_agent'] = $this->model_report->select_agent($id);
        $data['agent_treansaction'] = $this->model_report->agent_treansaction($id);
        $data['agent_recharge'] = $this->model_report->agent_recharge($id);
        $this->load->view('report/agent_daily_report',$data);

    }

    public function agent_daily_recharge_report($id){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "age_report";
        $data['select_agent'] = $this->model_report->select_agent($id);
        $data['agent_recharge'] = $this->model_report->agent_recharge($id);
        $this->load->view('report/agent_daily_recharge_report',$data);

    }

    public function agent_daily_transaction_report($id){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "age_report";
        $data['select_agent'] = $this->model_report->select_agent($id);
        $data['agent_treansaction'] = $this->model_report->agent_treansaction($id);
        $this->load->view('report/agent_daily_transaction_report',$data);

    }
    public function agent_details_transaction(){
         $data['active_menu'] = "report";
         $data['active_submenu'] = "age_report";
         $team_id =  $this->uri->segment(3);
         $date =  $this->uri->segment(4);
         $data['select_agent'] = $this->model_report->select_agent($team_id);
         $data['transaction'] = $this->model_report->team_detail_transaction($team_id,$date);
         $this->load->view('report/agent_details_transaction',$data);

    }

    public function agent_details_recharge(){
         $data['active_menu'] = "report";
         $data['active_submenu'] = "age_report";
         $team_id =  $this->uri->segment(3);
         $date =  $this->uri->segment(4);
         $data['select_agent'] = $this->model_report->select_agent($team_id);
         $data['recharge'] = $this->model_report->team_detail_recharge($team_id,$date);
         $this->load->view('report/agent_details_recharge',$data);

    }

    public function tranreport_section_searchbar(){

        if(isset($_POST['start_date'],$_POST['end_date'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $this->model_report->tranreport_section_searchbar($start_date,$end_date);
        }else{

            echo "Something wrong";
        }

    }

    public function recharge_section_searchbar(){

        if(isset($_POST['start_date'],$_POST['end_date'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $this->model_report->recharge_section_searchbar($start_date,$end_date);
        }else{

            echo "Something wrong";
        }
    }

    public function agent_transection_searchbar(){
        if(isset($_POST['start_date'],$_POST['end_date'],$_POST['team_id'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $team_id = $_POST['team_id'];

            $this->model_report->agent_transection_searchbar($start_date,$end_date,$team_id);
        }else{

            echo "Something wrong";
        }


    }

    public function agent_recharge_searchbar(){
        if(isset($_POST['start_date'],$_POST['end_date'],$_POST['team_id'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $team_id = $_POST['team_id'];

            $this->model_report->agent_recharge_searchbar($start_date,$end_date,$team_id);
        }else{

            echo "Something wrong";
        }

    }

    public function customerreport_recharge_searchbar(){
        if(isset($_POST['start_date'],$_POST['end_date'],$_POST['link_id'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $link_id = $_POST['link_id'];

            $this->model_report->customerreport_recharge_searchbar($start_date,$end_date,$link_id);
        }else{

            echo "Something wrong";
        }

    }

    public function customerreport_tran_searchbar(){

        if(isset($_POST['start_date'],$_POST['end_date'],$_POST['link_id'])){

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $link_id = $_POST['link_id'];

            $this->model_report->customerreport_tran_searchbar($start_date,$end_date,$link_id);
        }else{

            echo "Something wrong";
        }

    }

	public function searchbar(){

		if(isset($_POST["search_by"],$_POST["search_for"])){

			$search_by  =  $_POST["search_by"];
			$search_for  =   $_POST["search_for"];
			$this->model_report->searchbar_result($search_by,$search_for);
		}else{
			echo "Something Wrong";

		}

	}
	public function searchbar_like(){

		if(isset($_POST["search_by"],$_POST["search_for"])){

			$search_by  =  $_POST["search_by"];
			$search_for  =   $_POST["search_for"];

		    echo $search_by.$search_for;

			$this->model_report->searchbar_like_result($search_by,$search_for);
		}else{
			echo "Something Wrong";

		}

	}

    public function searchbar_like_list(){

		if(isset($_POST["search_by"],$_POST["search_for"])){

			$search_by  =  $_POST["search_by"];
			$search_for  =   $_POST["search_for"];

		    echo $search_by.$search_for;

			$this->model_report->searchbar_like_list($search_by,$search_for);
		}else{
			echo "Something Wrong";

		}

	}

     public function searchbar_like_list_number(){

		if(isset($_POST["search_by"],$_POST["search_for"])){

			$search_by  =  $_POST["search_by"];
			$search_for  =   $_POST["search_for"];

		    echo $search_by.$search_for;

			$this->model_report->searchbar_like_list_number($search_by,$search_for);
		}else{
			echo "Something Wrong";

		}

	}

	public function searchbar_name(){

		if(isset($_POST["search_by"])){

			$search_by  =  $_POST["search_by"];
			$firstname  =   $_POST["firstname"];
			$lastname  =   $_POST["lastname"];



			$this->model_report->searchbar_name_result($search_by,$firstname,$lastname);
		}else{
			echo "Something Wrong";

		}

	}

    public function searchbar_list(){

		if(isset($_POST["search_by"])){

			$search_by  =  $_POST["search_by"];
			$firstname  =   $_POST["firstname"];
			$lastname  =   $_POST["lastname"];



			$this->model_report->searchbar_list_name($search_by,$firstname,$lastname);
		}else{
			echo "Something Wrong";

		}

	}

	public function search_by_date(){

		if(isset($_POST["from_date"],$_POST["to_date"])){

			$from_date  =  $_POST["from_date"];
			$to_date  =  $_POST["to_date"];

			 $this->model_report->search_by_date_result($from_date,$to_date);
		}else{
			echo "Something Wrong";

		}

	}


    public function atm_card_report(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "atm_card_report";
        if($this->input->post('submit') != ''){

            $card_search = $this->input->post('card_search');
            $status_search = $this->input->post('status_search');

            $data['return_card_search'] = $card_search;
            $data['return_status']  =   $status_search;

            $data['atm_card_report'] = $this->model_report->atm_card_report_searchbar($card_search,$status_search);
            $this->load->view('report/atm_card_report',$data);

        }else{
             $data['atm_card_report'] = $this->model_report->atm_card_report();
             $this->load->view('report/atm_card_report',$data);
        }



	}

	public function change_atm_card_status(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "atm_card_status";
        if($this->input->post('submit') != ''){

            $card_search = $this->input->post('card_search');
            $status_search = $this->input->post('status_search');

            $data['return_card_search'] = $card_search;
            $data['return_status']  =   $status_search;

            $data['atm_card_status'] = $this->model_report->atm_card_status_searchbar($card_search,$status_search);
            $this->load->view('report/atm_card_status',$data);

        }else if(isset($_POST['status'],$_POST['id'])){

            $status = $_POST['status'];
            $id = $_POST['id'];
            $this->model_report->atm_card_status_update($status,$id);
        }else{

             $this->load->view('report/atm_card_status',$data);
        }
    }

//=========********===========********========******========//
// ************ Agent Requirement Reports ***********//
//=========********===========********========******========//

    public function daily_requirement_report(){
         $data['active_menu'] = "report";
         $data['active_submenu'] = "daily_requirement_report";
        if($this->input->post('submit') != ''){
            $agent_search = $this->input->post('agent_search');
            $shift = $this->input->post('shift');
            $search_date = $this->input->post('date');
            $requirent_type = $this->input->post('requirent_type');

            $data['return_agent']  =   $agent_search;

            $data['requirement'] = $this->model_report->daily_requirement_report($agent_search,$shift,$search_date);
            $data['select_agent'] = $this->model_report->select_all_agent();
            
            $data['e_requirement'] = $this->model_report->daily_requirement_report_eproduct($agent_search);

             $data['e_product'] = $this->model_report->select_all_e_product();
            $data['r_shift'] = $shift;
            $data['r_date'] = $search_date;
            $data['r_agent'] = $agent_search;
            $data['r_type'] = $requirent_type;
            
            $this->load->view('report/daily_requirement_report',$data);

        }else{

            $agent_search = '';
            $shift = '';
            $search_date = '';
             $data['r_type'] = 'daily_requirement';
            
          // $data['select_agent'] = $this->model_report->select_all_agent();
           $data['requirement'] = $this->model_report->daily_requirement_report($agent_search,$shift,$search_date);
            
            $data['e_requirement'] = $this->model_report->daily_requirement_report_eproduct($agent_search);

				 $data['select_product'] = $this->model_report->select_product();
            $data['e_product'] = $this->model_report->select_all_e_product();
             $data['select_agent'] = $this->model_report->select_all_agent();
          //   echo json_encode($data);
         $this->load->view('report/daily_requirement_report',$data);
        }

    }

		public function edit_estimated_products()
		{
			if(isset($_POST['customer_id'],$_POST['product_id'])){
				$customer_id = $_POST['customer_id'];
				$product_id = $_POST['product_id'];
				$product_qty = $_POST['product_qty'];
        $this->model_report->edit_estimated_products($customer_id,$product_id,$product_qty);

			}
		}

//=========********===========********========******========//
// ************ Admin Purchase Reports ***********//
//=========********===========********========******========//
   public function admin_purchase_report()
   {
		 $data['active_menu'] = "report";
		 $data['active_submenu'] = "admin_purchase_report";

		if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

					 $start = $this->input->post('start');
					 $end = $this->input->post('end');
					 $product = $this->input->post('product');
           $supplyer = $this->input->post('supplyer');

						$data['return_start'] = $start;
						$data['return_end'] = $end;
						$data['return_product'] = $product;
						$data['return_supplyer'] = $supplyer;

			      $data['select_product'] = $this->model_report->select_product();
			      $data['select_all_supplyer'] = $this->model_report->select_all_supplyer();
			      $data['purchase_product_list'] = $this->model_report->select_product_for_purchase_report();
			      $data['purchase_report'] = $this->model_report->admin_purchase_report($start,$end,$product,$supplyer);
		        $this->load->view('report/admin_purchase_report',$data);
			 }else{

				   $data['select_product'] = $this->model_report->select_product();
				   $data['select_all_supplyer'] = $this->model_report->select_all_supplyer();
					 $this->load->view('report/admin_purchase_report',$data);

			 }
   }

	 public function production_and_purchase_report()
   {
		 $data['active_menu'] = "report";
		 $data['active_submenu'] = "purchase_report";

		if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

					 $start = $this->input->post('start');
					 $end = $this->input->post('end');
					 $customer_id = $this->input->post('customer_id');


						$data['return_start'] = $start;
						$data['return_end'] = $end;
					//	$data['return_card'] = $customer_id;
			 $data['purchase_product_list'] = $this->model_report->select_product_for_purchase_report();
			 $data['purchase_report'] = $this->model_report->production_and_purchase_report($start,$end);
			// $data['purchase_total_product_wise_asc'] = $this->model_inventory->purchase_total_product_wise_asc($start,$end,$customer_id);
			// $data['all_customer_list'] = $this->model_inventory->select_all_customers_for_drop_down();
        //   echo json_encode($data);
		      $this->load->view('report/admin_purchase_report',$data);
			 }else{

					 //echo json_encode($data);
					 $this->load->view('report/admin_purchase_report',$data);

			 }
   }
    
    public function admin_production_report()
   {
		 $data['active_menu'] = "report";
		 $data['active_submenu'] = "admin_production_report";

		if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

					 $start = $this->input->post('start');
					 $end = $this->input->post('end');
					 $product = $this->input->post('product');
          

						$data['return_start'] = $start;
						$data['return_end'] = $end;
						$data['return_product'] = $product;
						

			      $data['select_product'] = $this->model_report->select_product();
			     
			   
			      $data['production_report'] = $this->model_report->admin_production_report($start,$end,$product);
		        $this->load->view('report/admin_production_report',$data);
			 }else{

				   $data['select_product'] = $this->model_report->select_product();
				 
					 $this->load->view('report/admin_production_report',$data);

			 }
   }
    
   public function stock_return_report(){
       
       $data['active_menu'] = "report";
		 $data['active_submenu'] = "admin_production_report";

		if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

					 $start = $this->input->post('start');
					 $end = $this->input->post('end');
					 $product = $this->input->post('product');
          

						$data['return_start'] = $start;
						$data['return_end'] = $end;
						$data['return_product'] = $product;
						

			      $data['select_product'] = $this->model_report->select_product();
			     
			   
			      $data['production_report'] = $this->model_report->admin_production_report($start,$end,$product);
		        $this->load->view('report/admin_production_report',$data);
			 }else{
                    $data['report'] = $this->model_report->stock_return_report();
				   $data['select_product'] = $this->model_report->select_product();
				 
					 $this->load->view('report/stock_return_report',$data);

			 }
       
   }    
//=========********===========********========******========//
// ************ Customer Ledger Reports ***********//
//=========********===========********========******========//
	 public function customer_ledger(){
			$data['active_menu'] = "report";
			$data['active_submenu'] = "customer_ledger";

		 if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

						$start = $this->input->post('start');
						$end = $this->input->post('end');
						$customer_id = $this->input->post('customer_id');


						 $data['return_start'] = $start;
						 $data['return_end'] = $end;
						 $data['return_card'] = $customer_id;
				 //    $data['purchase_report'] = $this->model_inventory->purchase_report($start,$end,$card_no);
               if($customer_id != ''){
				
				$data['ledger'] = $this->model_report->ledger_total_product_wise_asc($start,$end,$customer_id);
				
		        $data['customer_details'] = $this->model_report->select_customer_for_purchase_report($customer_id);
               }
               $data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();
             
              // echo json_encode($data['ledger']);
		        $this->load->view('report/customer_ledger2',$data);
        }else{
						$data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();
						$this->load->view('report/customer_ledger2',$data);

       }

	 }
//=========********===========********========******========//
// ************ Customer orders List ***********//
//=========********===========********========******========//
	 public function customer_orders_list(){
 			 $data['active_menu'] = "management";
 			 $data['active_submenu'] = "customer_orders_list";
 			if($this->input->post('submit') != ''){
 					$agent_search = $this->input->post('agent_search');
					$customer_id = $this->input->post('customer_id');
                    $product_select = $this->input->post('product_select');

 					$data['return_agent']  =   $agent_search;

 					$data['customer_requirement_list'] = $this->model_report->all_customres_date_wise_requirement($agent_search,$customer_id,$product_select);
 					$data['select_agent'] = $this->model_report->select_all_agent();
					$data['select_product'] = $this->model_report->select_product();
                    $data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();
					//echo $agent_search;
 					$this->load->view('report/customer_orders_list',$data);

 			}else{

 				 $agent_search = '';
				 $customer_id = '';
                 $product_select = '';
                
 				 $data['select_agent'] = $this->model_report->select_all_agent();
 				 $data['customer_requirement_list'] = $this->model_report->all_customres_date_wise_requirement($agent_search,$customer_id,$product_select);
 				 $data['select_product'] = $this->model_report->select_product();
				 $data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();
 				//   echo json_encode($data['customer_requirement_list']);
 			   $this->load->view('report/customer_orders_list',$data);
 			}

 	}
//=========********===========********========******========//
// ************ Orders Reports Section ***********//
//=========********===========********========******========//    
     public function order_report(){
			$data['active_menu'] = "report";
			$data['active_submenu'] = "order_report";

		 if($this->input->post('submit') != '' && $this->input->post('start') != "Start Date" && $this->input->post('end') != "End Date"){

						$start = $this->input->post('start');
						$end = $this->input->post('end');
						$customer_id = $this->input->post('customer_id');


						 $data['return_start'] = $start;
						 $data['return_end'] = $end;
						 $data['return_card'] = $customer_id;
				$data['order_report'] = $this->model_report->order_report($start,$end,$customer_id);
				$data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();
		        $this->load->view('report/order_report',$data);
      }else{
						$data['all_customer_list'] = $this->model_report->select_all_customers_for_drop_down();

						//echo json_encode($data);
						$this->load->view('report/order_report',$data);
      }

	 }
    
    public function daily_requirement_report_eproduct(){
     $data['all_customer_list'] = $this->model_report->daily_requirement_report_eproduct('');
     echo json_encode($data);
    }
    
    
//=========********===========********========******========//
// ************ Feedback Section ***********//
//=========********===========********========******========//        
    
     public function feedback(){
        $data['active_menu'] = "report";
        $data['active_submenu'] = "feedback";
        
         $id = $this->uri->segment("3");
         
         
        if($this->input->post('submit') != ''){
           
            $name_search = $this->input->post('name_search');
            $colony_search = $this->input->post('colony_search');
           
            $data['return_name'] = $name_search;
            $data['return_colony'] = $colony_search;
            
            $data['select_colony'] = $this->model_report->select_colony();
          
            $data['all_customer'] = $this->model_report->select_feedback_filter($name_search,$colony_search);
            $this->load->view('report/feedback',$data);		
            
        }else if($id){
             $data['all_customer'] = $this->model_report->select_feedback($id);
             $data['select_colony'] = $this->model_report->select_colony();
           
             $this->load->view('report/feedback',$data);		
        }else if(!$id){
             $data['all_customer'] = $this->model_report->select_feedback('');
             $data['select_colony'] = $this->model_report->select_colony();
           
             $this->load->view('report/feedback',$data);
            
        }
    
       
		
	} 
    
    
//=========********===========********========******========//
// ************ Profit Report ***********//
//=========********===========********========******========//  
    
    public function profit_report(){
        
        $data['active_menu'] = "report";
        $data['active_submenu'] = "profit_report";
        
        if($this->input->post('submit')){

				$start = $this->input->post('start');
				$end = $this->input->post('end');
				
				$data['return_start'] = $start;
				$data['return_end'] = $end;
            
            
				
			   $data['list'] = $this->model_report->profit_report($start,$end);
            
                
            
		      //  $this->load->view('report/profit_report',$data);
                
        
               //  $data['total_sell'] = $list['total_sell'];
                // $data['total_expanse'] = $list['total_expanse'];
                // $data['total_purchase'] = $list['total_purchase'];
            
                // echo json_encode($data['list']);
            
                  $this->load->view('report/profit_report',$data);
			 }else{

				   $data['select_product'] = $this->model_report->select_product();
				   $data['select_all_supplyer'] = $this->model_report->select_all_supplyer();
				   $this->load->view('report/profit_report',$data);

			 }
        
    }
    
    
//=========********===========********========******========//
// ************ Edit customer requirement ***********//
//=========********===========********========******========// 
    
    
    public function edit_customer_daily_requirement(){
       
        if(isset($_POST['val'])){
            
            $val = $_POST['val'];
            $product_id = $_POST['product_id'];
            $customer_id = $_POST['customer_id'];
            $shift = $_POST['shift'];
            
            $data['list'] = $this->model_report->edit_customer_daily_requirement($val,$product_id,$customer_id,$shift);
            
            
        }
        
    }
    
    public function edit_customer_week_requirement(){
        
                
        if(isset($_POST['estimated_id'])){
            
            $morning_val = $_POST['morning_val'];
            $evening_val = $_POST['evening_val'];
            
            $estimated_id = $_POST['estimated_id'];
           
            $shift = $_POST['shift'];
            $day_no = $_POST['day_no'];
            
            $data['list'] = $this->model_report->edit_customer_week_requirement($morning_val,$evening_val,$estimated_id,$shift,$day_no);
            
            
        }
        
    }
    
    
//=========********===========********========******========//
// ************ Bill Report ***********//
//=========********===========********========******========//     
    
    public function bill_report(){

        $data['active_menu'] = "report";
        $data['active_submenu'] = "bill_report";


         if($this->input->post('submit') != '' && $this->input->post('start') != "" && $this->input->post('end') != ""){

             $start = $this->input->post('start');
             $end = $this->input->post('end');
             $card_no = $this->input->post('card_no');
             $customer_type =  $this->input->post('customer_type');


              if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }
             if($end != 'End Date'){
                  $data['return_end'] = $end;
              }

              $data['return_card_no'] = $card_no;
            
              $data['return_customer_type'] = $customer_type;
             
              $data['list'] = $this->model_report->bill_report($start,$end,$card_no,$customer_type);
             
              $this->load->view('report/bill_report',$data);
         }else{
             
             $start = '';
             $end = '';
             $card_no = '';
             $customer_type =  '';
             
             $data['select_agent'] = $this->model_report->select_all_agent();
             $data['select_product'] = $this->model_report->select_product();
             $data['list'] = $this->model_report->bill_report($start,$end,$card_no,$customer_type);
             $data['select_shift'] = $this->model_report->select_shift();
             $this->load->view('report/bill_report',$data);

         }



	}
    
    public function bill_detail_report(){
          $data['active_menu'] = "report";
        $data['active_submenu'] = "bill_report";
      
         if($this->input->post('submit') ){
             $bill_id = $this->input->post('bill_id');
             redirect(base_url().'/report/bill_detail_report/'.$bill_id);
         }else{
             $bill_id = $this->uri->segment(3);
        
             $data['list'] = $this->model_report->bill_detail_report($bill_id);
            
             $this->load->view('report/bill_detail_report',$data);

         }
        
    }
    
}
