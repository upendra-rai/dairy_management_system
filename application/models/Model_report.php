<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_report extends CI_Model {



	function __construct(){



		parent::__construct();

	}

    public function daily_transaction(){

                $this->db->select('* , SUM(transaction_amount) AS total_value , COUNT(transaction_id) as count_tran');
		    	$this->db->from('transaction_detail');
                $this->db->where('MONTH(transaction_date)',date('m'));
                $this->db->where('YEAR(transaction_date)',date('Y'));
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id','left');
                $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = transaction_detail.guest_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id','left');
                $this->db->order_by('transaction_date','DESC');
                $this->db->group_by('DATE(transaction_date)');
		    	$data = $this->db->get();
                return $data->result();



    }

    public function transaction_date_report($date,$agent_id,$shift_id,$product_id){

                $this->db->select('*,team_member.name,customer_details.first_name AS c_first_name,customer_details.last_name AS c_last_name ,c.colony_name as c_colony_name, r.colony_name as r_colony_name');
		    	$this->db->from('transaction_detail');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id','left');
                $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = transaction_detail.guest_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id','left');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id','left');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id','left');
                $this->db->join('colony_detail c', 'c.colony_id = customer_details.colony_id','left');
               $this->db->join('colony_detail r', 'r.colony_id = customer_ragistration.colony_id','left');
                $this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id','Left');

                $this->db->where('date(transaction_date)',$date);
                if( $agent_id != "null"){
                    $this->db->where('transaction_detail.user_id',$agent_id);
                };
                if( $shift_id != "null"){
                    $this->db->where('transaction_detail.shift_id',$shift_id);

                };
                if( $product_id != "null"){
                    $this->db->where('transaction_detail.product_id',$product_id);
                };



                $this->db->order_by('transaction_date','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function daily_recharge(){
                $this->db->select('* , SUM(recharge_amount) AS total_value , COUNT(recharge_id) as count_recharge');
		    	$this->db->from('recharge_detail');
                $this->db->where('MONTH(recharge_date)',date('m'));
                $this->db->where('YEAR(recharge_date)',date('Y'));
                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->group_by('DATE(recharge_date)');
                $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();
                return $data->result();
    }

    public function recharge_date_report($date,$agent_id){
                $this->db->select('*,team_member.name');
		    	$this->db->from('recharge_detail');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->where('date(recharge_date)',$date);
                if( $agent_id != ""){
                    $this->db->where('recharge_detail.user_id',$agent_id);
                };
                $this->db->order_by('recharge_id','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function daily_agent_report(){
                /*$this->db->select('* , transaction.tran_date,transaction.tran_by, SUM(tran_amount) AS total_value ');
		    	$this->db->from('app_team');
                $this->db->join('transaction', 'transaction.tran_by = app_team.team_id');
                $this->db->where('MONTH(tran_date)',date('m'));
                $this->db->group_by('DATE(tran_date)');
                $this->db->group_by('tran_by');
		    	$data = $this->db->get();
                return $data->result();*/

                $this->db->select('*');
		    	$this->db->from('team_member');
		    	$data = $this->db->get();
                return $data->result();
    }



     public function select_all_agent(){

                $this->db->select('*');
		    	$this->db->from('team_member');

		    	$data = $this->db->get();
                return $data->result();

     }
    public function select_agent($id){


                $this->db->select('*');
		    	$this->db->from('team_member');
                $this->db->where('user_id',$id);
		    	$data = $this->db->get();
                return $data->result();
    }

     public function select_product(){


                $this->db->select('*');
		    	$this->db->from('dairy_products');
		    	$data = $this->db->get();
                return $data->result();
    }

    public function select_shift(){


                $this->db->select('*');
		    	$this->db->from('delivery_shift');
		    	$data = $this->db->get();
                return $data->result();
    }
    public function agent_treansaction($id){
                $this->db->select('*, SUM(transaction_amount) AS total_value, COUNT(transaction_id) as count_tran');
		    	$this->db->from('transaction_detail');
                $this->db->where('transaction_detail.user_id',$id);
                $this->db->where('MONTH(transaction_date)',date('m'));
                $this->db->where('YEAR(transaction_date)',date('Y'));
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->group_by('DATE(transaction_date)');
                $this->db->order_by('transaction_date','DESC');
		    	$data = $this->db->get();

                return $data->result();

    }

     public function agent_recharge($id){
                $this->db->select('*, SUM(recharge_amount) AS total_re_value, COUNT(recharge_id) as count_re');
		    	$this->db->from('recharge_detail');
                $this->db->where('recharge_detail.user_id',$id);
                $this->db->where('MONTH(recharge_date)',date('m'));
                $this->db->where('YEAR(recharge_date)',date('Y'));
                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->group_by('DATE(recharge_date)');
                $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();

                return $data->result();

    }

   public function team_detail_transaction($team_id,$date){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->where('transaction_detail.user_id',$team_id);
                $this->db->where('date(transaction_date)',$date);
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                return $data->result();

   }

    public function team_detail_recharge($team_id,$date){
                $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->where('recharge_detail.user_id',$team_id);
                $this->db->where('date(recharge_date)',$date);
                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->order_by('recharge_id','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }


     public function select_colony(){

                $this->db->select('*');
		    	$this->db->from('colony_detail');
                 $this->db->order_by('colony_name','ASC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function select_customer_report(){

                $this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->order_by("first_name", "asc");
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = customer_details.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function customer_report_multi_searchbar($first_name,$last_name,$colony_search,$delivery_search,$status_search,$ac_type){


                $this->db->select('*');
		    	$this->db->from('customer_details');

                if($colony_search != ""){
                        $this->db->where("customer_details.colony_id", $colony_search);
                }
                if($delivery_search != ""){
                        $this->db->where("customer_details.d_type_id",$delivery_search);
                }
                if($status_search != ""){
                        $this->db->where("atm_card_detail.card_status",$status_search);
                }
                if($first_name != ""){
                         if($last_name == ""){

                            $this->db->like("first_name", $first_name);
				            $this->db->or_like("last_name", $first_name);
                            }else{

                                $this->db->like("first_name", $first_name);
			            	    $this->db->like("last_name", $last_name);
                            }
                }
        
                if($ac_type != ""){
                    
                    
                    $this->db->where("customer_details.ac_type", $ac_type);
                    
                }
        
               
        
                $this->db->order_by("first_name", "asc");
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = customer_details.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
		        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                 $data = $this->db->get();
                return $data->result();


    }

    public function transaction_date_multi_searchbar($colony_search,$delivery_search,$agent_search,$on_date,$shift_id,$customer_type,$product_search){
                $this->db->select('*,customer_details.first_name AS c_first_name,customer_details.last_name AS c_last_name ,c.colony_name as c_colony_name, r.colony_name as r_colony_name');
		    	$this->db->from('transaction_detail');
                $this->db->where('date(transaction_date)', $on_date);
                

                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id','left');
                $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = transaction_detail.guest_id','left');
                
                
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id','left');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id','left');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id','left');
                $this->db->join('colony_detail c', 'c.colony_id = customer_details.colony_id','left');
                $this->db->join('colony_detail r', 'r.colony_id = customer_ragistration.colony_id','left');
                $this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id','Left');
        
                if($colony_search != ""){
                    $this->db->where('customer_details.colony_id', $colony_search);

                };
               if($delivery_search != ""){
                     $this->db->where('customer_details.d_type_id', $delivery_search);

                };
               if($agent_search != ""){

                    $this->db->where('transaction_detail.user_id', $agent_search);

                }
                if($shift_id != ""){

                    $this->db->where('transaction_detail.shift_id', $shift_id);

                }
        
                 if($customer_type != ""){
                     $this->db->where('customer_type',$customer_type);
                 }
        
                if($product_search != ""){
                     $this->db->where('transaction_detail.product_id', $product_search);
                    
                }
             
                $this->db->order_by('transaction_date','DESC');
                 $data = $this->db->get();
                return $data->result();


    }


    public function recharge_date_multi_searchbar($colony_search,$delivery_search,$agent_search,$on_date){

                $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->where('date(recharge_date)', $on_date);
                if($colony_search != "" && $delivery_search == "" && $agent_search == ""){
                    $this->db->where('customer_details.colony_id', $colony_search);

                }else if($colony_search == "" && $delivery_search != "" && $agent_search == ""){
                     $this->db->where('customer_details.d_type_id', $delivery_search);

                }else if($colony_search == "" && $delivery_search == "" && $agent_search != ""){

                    $this->db->where('recharge_detail.user_id', $agent_search);

                }else if($colony_search != "" && $delivery_search != "" && $agent_search == ""){

                     $this->db->where('customer_details.d_type_id', $delivery_search);
                     $this->db->where('customer_details.colony_id', $colony_search);

                }else if($colony_search != "" && $delivery_search == "" && $agent_search != ""){

                     $this->db->where('customer_details.colony_id', $colony_search);
                     $this->db->where('recharge_detail.user_id', $agent_search);

                }else if($colony_search == "" && $delivery_search != "" && $agent_search != ""){
                     $this->db->where('customer_details.d_type_id', $delivery_search);
                     $this->db->where('recharge_detail.user_id', $agent_search);

                }else if($colony_search != "" && $delivery_search != "" && $agent_search != ""){
                     $this->db->where('customer_details.d_type_id', $delivery_search);
                    $this->db->where('customer_details.colony_id', $colony_search);
                    $this->db->where('recharge_detail.user_id', $agent_search);

                }

                $this->db->join('customer_details','customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = recharge_detail.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
		        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
               $this->db->order_by('recharge_date','DESC');
                 $data = $this->db->get();
                return $data->result();



    }

    public function customer_report_list($id){

                $this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->where('customer_details.customer_id',$id);
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = customer_details.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
		    	$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $data = $this->db->get();
                return $data->result();

    }

    public function customer_full_report_tran($id){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->where('transaction_detail.customer_id',$id);

                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
		        $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
				$this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id','Left');
                $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }
    public function customer_full_report_tran_search($start_date,$end_date,$id){
             $start = date('Y-m-d',strtotime($start_date));
             $end = date('Y-m-d',strtotime($end_date));
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->where('date(transaction_date) >=', $start);
                $this->db->where('date(transaction_date) <=', $end);
                $this->db->where('transaction_detail.customer_id',$id);
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
		        $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
				$this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id','Left');
                $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function customer_full_report_rech($id){
                $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->where('recharge_detail.customer_id',$id);

                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->order_by('recharge_date','DESC');
		        $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function customer_full_report_rech_search($start_date,$end_date,$id){
             $start = date('Y-m-d',strtotime($start_date));
             $end = date('Y-m-d',strtotime($end_date));

                $this->db->select('*');
		    	$this->db->from('recharge_detail');

                $this->db->where('date(recharge_date) >=', $start);
                $this->db->where('date(recharge_date) <=', $end);
                $this->db->where('recharge_detail.customer_id',$id);
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->order_by('recharge_date','DESC');
		        $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function transaction_report_search($start_date,$end_date,$agent_search,$product_search,$shift_id,$customer_type){




                $this->db->select('* , SUM(transaction_amount) AS total_value , COUNT(transaction_id) as count_tran');
		    	$this->db->from('transaction_detail');


                if($start_date != 'Start Date'){
                    $start = date('Y-m-d',strtotime($start_date));
                    $this->db->where('date(transaction_date) >=', $start);
                }
                if($end_date != 'End Date'){
                     $end = date('Y-m-d',strtotime($end_date));
                    $this->db->where('date(transaction_date) <=', $end);
                }
                if($agent_search != ''){
                     $this->db->where('user_id', $agent_search);

                }
                if($product_search != ''){
                     $this->db->where('product_id', $product_search);

                }

                if($shift_id != ''){
                     $this->db->where('transaction_detail.shift_id', $shift_id);

                }
        
                 if($customer_type != ''){
                     $this->db->where('transaction_detail.customer_type', $customer_type);

                }
        
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id','left');
                $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = transaction_detail.guest_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id','left');
                $this->db->group_by('DATE(transaction_date)');
                $this->db->order_by('transaction_date','DESC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function recharge_report_search($start_date,$end_date,$agent_search){

                $this->db->select('* , SUM(recharge_amount) AS total_value , COUNT(recharge_id) as count_recharge');
		    	$this->db->from('recharge_detail');
                 if($start_date != 'Start Date'){
                    $start = date('Y-m-d',strtotime($start_date));
                    $this->db->where('date(recharge_date) >=', $start);
                }
                if($end_date != 'End Date'){
                     $end = date('Y-m-d',strtotime($end_date));
                    $this->db->where('date(recharge_date) <=', $end);
                }
                if($agent_search != ''){
                     $this->db->where('user_id', $agent_search);

                }

                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->group_by('DATE(recharge_date)');
                $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();
                return $data->result();
    }


    public function agent_transection_searchbar($start_date,$end_date,$team_id){

           $start = date('Y-m-d',strtotime($start_date));
           $end = date('Y-m-d',strtotime($end_date));

                $this->db->select('* , SUM(transaction_amount) AS total_value , COUNT(transaction_id) as count_tran');
		    	$this->db->from('transaction_detail');
                $this->db->where('transaction_detail.user_id', $team_id);
                $this->db->where('date(transaction_date) >=', $start);
                $this->db->where('date(transaction_date) <=', $end);
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->group_by('DATE(transaction_date)');
                $this->db->order_by('transaction_date','DESC');
		    	$data = $this->db->get();
                //return $data->result();

            //echo json_encode($data);
            if($data->num_rows() > 0){

		          foreach($data->result() as $row){
				       echo '<tr class="click_tr" data-team_id="'.$row->user_id.'" data-date="'.date('Y-m-d',strtotime($row->transaction_date)).'">';

			           echo '<td>'.date('d-M-y',strtotime($row->transaction_date)).'</td>';
                       echo '<td>'.$row->total_value.'</td>';
                       echo '<td>'.$row->count_tran.'</td>';
			           echo ' </tr>';

				 }
				 }else{

					   echo '<tr>';
                      echo '<td>';
					  echo "No Result found";
                      echo '</td>';
                      echo '</tr>';
				 }

    }

    public function agent_recharge_searchbar($start_date,$end_date,$team_id){

           $start = date('Y-m-d',strtotime($start_date));
           $end = date('Y-m-d',strtotime($end_date));

                $this->db->select('* , SUM(recharge_amount) AS total_re_value , COUNT(recharge_id) as count_re');
		    	$this->db->from('recharge_detail');
                $this->db->where('recharge_detail.user_id', $team_id);
                $this->db->where('date(recharge_date) >=', $start);
                $this->db->where('date(recharge_date) <=', $end);
                $this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->group_by('DATE(recharge_date)');
                $this->db->order_by('recharge_date','DESC');
		    	$data = $this->db->get();
                //return $data->result();

            //echo json_encode($data);
            if($data->num_rows() > 0){

		          foreach($data->result() as $row){
				       echo '<tr class="click_tr2" data-team_id="'.$row->user_id.'" data-date="'.date('Y-m-d', strtotime($row->recharge_date)).'">';

			           echo '<td>'.date('d-M-y',strtotime($row->recharge_date)).'</td>';
                       echo '<td>'.$row->total_re_value.'</td>';
                       echo '<td>'.$row->count_re.'</td>';
			           echo ' </tr>';

				 }
				 }else{

					   echo '<tr>';
                      echo '<td>';
					  echo "No Result found";
                      echo '</td>';
                      echo '</tr>';
				 }

    }


    public function customerreport_recharge_searchbar($start_date,$end_date,$link_id){

           $start = date('Y-m-d',strtotime($start_date));
           $end = date('Y-m-d',strtotime($end_date));

                $this->db->select('* ');
		    	$this->db->from('recharge_detail');
                $this->db->where('customer_id', $link_id);
                $this->db->where('date(recharge_date) >=', $start);
                $this->db->where('date(recharge_date) <=', $end);
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->order_by('recharge_date','DESC');
                $this->db->order_by('recharge_id','DESC');
		    	$data = $this->db->get();
                //return $data->result();

            //echo json_encode($data);
            if($data->num_rows() > 0){
                  echo '<thead>';
                  echo '<tr>';

                  echo '<th>Recharge Date</th>';
                  echo '<th>Amount</th>';
                  echo '<th>Recharge By</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';
                  $total1 = 0;

		          foreach($data->result() as $row){
				       echo '<tr>';

			           echo '<td>'.date('d-M-y',strtotime($row->recharge_date)).'</td>';
                       echo '<td>'.$row->recharge_amount.'</td>';
                       echo '<td>'.$row->name.'</td>';
			           echo ' </tr>';
                      $total1 += $row->recharge_amount;
				   }
                     echo '</tbody>';
                     echo '<tfoot>';
                           echo '<tr>';
                           echo '<td style="border:1px solid #dddddd;">Total</td>';

                           echo '<td style="border:1px solid #dddddd;">'.$total1.'</td>';
                           echo '<td></td>';
                           echo '<tr>';
                       echo '</tfoot>';

				 }else{

					  echo '<tr>';
                      echo '<td>';
					  echo "No Result found";
                      echo '</td>';
                       echo '<tr>';
				 }

    }


     public function customerreport_tran_searchbar($start_date,$end_date,$link_id){

           $start = date('Y-m-d',strtotime($start_date));
           $end = date('Y-m-d',strtotime($end_date));

                $this->db->select('* ');
		    	$this->db->from('transaction_detail');
                $this->db->where('customer_id', $link_id);
                $this->db->where('date(transaction_date) >=', $start);
                $this->db->where('date(transaction_date) <=', $end);
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
                $this->db->order_by('transaction_date','DESC');
                $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                //return $data->result();

            //echo json_encode($data);
            if($data->num_rows() > 0){
                  echo '<thead>';
                  echo '<tr>';

                  echo '<th>Transaction Date</th>';
                  echo '<th>Product</th>';
                  echo '<th>Amount</th>';
                  echo '<th>Transaction By</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';

                  $total = 0;
		          foreach($data->result() as $row){
				       echo '<tr>';

			           echo '<td>'.date('d-M-y',strtotime($row->transaction_date)).'</td>';
                       echo '<td>'.$row->product_name.'</td>';
                       echo '<td>'.$row->transaction_amount.'</td>';
                       echo '<td>'.$row->name.'</td>';
			           echo ' </tr>';
                      $total += $row->transaction_amount;
				    }
                    echo '</tbody>';
                     echo '<tfoot>';
                           echo '<tr>';
                           echo '<td style="border:1px solid #dddddd;">Total</td>';

                           echo '<td></td>';
                           echo '<td style="border:1px solid #dddddd;">'.$total.'</td>';
                           echo '<td></td>';
                           echo '<tr>';
                       echo '</tfoot>';


				 }else{
                      echo '<tr>';
                      echo '<td>';
					  echo "No Result found";
                      echo '</td>';
                       echo '<tr>';
				 }

    }

    public function searchbar_result($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->where($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){

                       echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';

				 }
				 }else{

					 echo "No matching records found";
				 }

    }

	public function searchbar_like_result($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					 echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';

				 }
				 }else{

					 echo "No matching records found";
				 }

    }

    public function searchbar_like_list($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					   echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';

                  }
				 }else{


				 }

    }

    public function searchbar_like_list_number($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like("mobile_no", $search_for);
                $this->db->or_like("mobile_no2", $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					  echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';

                  }
				 }else{


				 }

    }
    public function searchbar_name_result($search_by,$firstname,$lastname){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like("customer_firstname", $firstname);
				$this->db->like("customer_lastname", $lastname);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                       echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';
				 }
				 }else{
                     echo "No matching records found";

				 }

    }

	public function searchbar_list_name($search_by,$firstname,$lastname){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like("customer_firstname", $firstname);
				$this->db->like("customer_lastname", $lastname);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                       echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';
				 }
				 }else{


				 }

    }

	public function search_by_date_result($from_date,$to_date){
           date_default_timezone_set('Asia/Kolkata');
		   $start = date("y-m-d",strtotime($from_date));
		   $end = date("y-m-d",strtotime($to_date));


	    	$this->db->select('*');
	    	$this->db->from('customers');
			$this->db->where('time_stamp >=', $start);
            $this->db->where('time_stamp <=', $end);

	    	$data = $this->db->get();

			if($data->num_rows() > 0){
		          foreach($data->result() as $row){
				     echo '<tr class="click_tr" data-card_no="'.$row->linked_no.'">';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
                       echo '<td>'.$row->linked_no.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
                       echo '<td>'.$row->mobile_no2.'</td>';
			           echo '<td>'.$row->email_id.'</td>';
                       echo '<td>'.$row->account.'</td>';
                       echo '<td>'.$row->delivery_type.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
			           echo ' </tr>';

				 }
				 }else{


				 }

	}


    public function atm_card_report(){

                $this->db->select('*');
		    	$this->db->from('atm_card_detail');
                 $this->db->order_by('atm_card_no','ASC');
                $this->db->join('customer_details','customer_details.customer_id = atm_card_detail.customer_id','left');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function atm_card_report_searchbar($card_search,$status_search){
               $this->db->select('*');
		    	$this->db->from('atm_card_detail');
                if($card_search != ''){
                    $this->db->where('atm_card_no',$card_search);
                }

              if($status_search != ''){

                    if($status_search == 'available'){
                        $this->db->where('card_status','');
                    }else{
                        $this->db->where('card_status',$status_search);
                    }

                }

                $this->db->order_by('atm_card_no','ASC');
                $this->db->join('customer_details','customer_details.customer_id = atm_card_detail.customer_id','left');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function atm_card_status(){

                $this->db->select('*');
		    	$this->db->from('atm_card_detail');
                $this->db->where('card_status','lost');
                $this->db->or_where('card_status','broken');
                $this->db->or_where('card_status','');
                $this->db->order_by('atm_card_no','ASC');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function atm_card_status_update($status,$id){

        $this->db->where('atm_id',$id);

        if($status == 'available'){
            $this->db->set('card_status','');
        }else{
            $this->db->set('card_status',$status);
        }

        if($this->db->update('atm_card_detail')){
            echo "success";
        }else{
            echo "failed";
        }

    }

    public function atm_card_status_searchbar($card_search,$status_search){
                $this->db->select('*');
		    	$this->db->from('atm_card_detail');
                if($card_search != ''){
                    $this->db->where('atm_card_no',$card_search);
                }

              if($status_search != ''){

                    if($status_search == 'available'){
                        $this->db->where('card_status','');
                    }else{
                        $this->db->where('card_status',$status_search);
                    }

                }
                $this->db->where('customer_id',null);
                $this->db->order_by('atm_card_no','ASC');
		    	$data = $this->db->get();
                return $data->result();
    }

//=========********===========********========******========//
// ************ Agent Requirement Reports ***********//
//=========********===========********========******========//

    public function daily_requirement_report($agent_search,$shift,$search_date){
           
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        
        if($search_date != ''){
            $today_day = date('j',strtotime($search_date));
            $week_day  = date('w',strtotime($search_date)); 
        }else{
          $today_day = $date->format('j');
          $week_day  = $date->format('w');    
        }
       
        $str_day = 'day_'.$today_day;  
        $week_array = array('sun','mon','tue','wed','thu','fri','sat');
        $current_week_day = $week_array[$week_day];
         
            $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
            $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();
          
        
             $this->db->select('customer_details.d_schedule,estimated_product_details.product_id,estimated_product_details.morning_shift_qty, estimated_product_details.evening_shift_qty,estimated_product_week_chart.'.$current_week_day.',estimated_product_month_chart.'.$str_day);
            $this->db->from('customer_details');
                     
                     if($vaction->num_rows() > 0){
                         
                         foreach($vaction->result() as $row){
                             $vacation_customer_id = $row->customer_id;
                             $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                         }
                     }
                        
                     $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
                     $this->db->join('estimated_product_details','estimated_product_details.customer_id = customer_details.customer_id');
                     $this->db->join('estimated_product_week_chart','estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id','left');
                 
                     $this->db->join('estimated_product_month_chart','estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id','left');
        
                     if($agent_search != ''){
                         $this->db->where('customer_details.assigned_user_id',$agent_search);
                     }
                     $this->db->where('atm_card_detail.card_status','active');
        
                     $customer_list = $this->db->get();
                    
                    
                  //  echo json_encode($customer_list->result());
        
            $this->db->select('*');
            $this->db->from('dairy_products');
            $product_list = $this->db->get();
        
        
            if($product_list->num_rows() > 0){
                
                $array = [];
                
                foreach($product_list->result() as $product_row){
                    $product_id = $product_row->product_id;
                    $product_name = $product_row->product_name;
                    $unit = $product_row->unit;
                    $unit_price = $product_row->product_price;
                    
                    $sum_qty = 0;

                    foreach($customer_list->result() as $customer_row){
                        
                      if($customer_row->product_id == $product_id){   
                        
                        $delivery_schedule = $customer_row->d_schedule;
                        
                        if($shift == 'morning'){  
                            if($delivery_schedule == 'daily'){
                                $qty = $customer_row->morning_shift_qty;
                                $sum_qty += $qty;
                            }else if($delivery_schedule == 'week'){
                                 $qty = json_decode($customer_row->$current_week_day)[0]->morning;
                                 $sum_qty += $qty;
                            }else if($delivery_schedule == 'month'){
                                $qty = json_decode($customer_row->$str_day)[0]->morning;
                                $sum_qty += $qty;
                            }
                        }else if($shift == 'evening'){
                            if($delivery_schedule == 'daily'){
                                $qty = $customer_row->evening_shift_qty;
                                $sum_qty += $qty;
                            }else if($delivery_schedule == 'week'){
                                 $qty = json_decode($customer_row->$current_week_day)[0]->evening;
                                 $sum_qty += $qty;
                            }else if($delivery_schedule == 'month'){
                                $qty = json_decode($customer_row->$str_day)[0]->evening;
                                $sum_qty += $qty;
                            }
                            
                        }else{
                            if($delivery_schedule == 'daily'){
                                $qty = $customer_row->morning_shift_qty + $customer_row->evening_shift_qty;
                                $sum_qty += $qty;
                            }else if($delivery_schedule == 'week'){
                                 $qty = json_decode($customer_row->$current_week_day)[0]->morning + json_decode($customer_row->$current_week_day)[0]->evening;
                                 $sum_qty += $qty;
                            }else if($delivery_schedule == 'month'){
                                $qty = json_decode($customer_row->$str_day)[0]->morning + json_decode($customer_row->$str_day)[0]->evening;
                                $sum_qty += $qty;
                            }
                            
                            
                            
                        }
                        
                      }
                    }
                    
                     $p_array = array('product_id' => $product_id, 'product_name' => $product_name, 'unit' => $unit, 'unit_price' => $unit_price ,'product_quantity'=> $sum_qty);
                    
                     array_push($array,$p_array);
                }
                
                
               // echo json_encode($array);
                return json_encode($array);
            }
        
        
        

    }
    
    
  /*  public function daily_requirement_report($agent_search,$shift){
           
            date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
         
            $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
            $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();
          if($shift){
             if($shift == 'morning'){
                 $shift_val = 'morning_shift_qty';
             }else if($shift == 'evening'){
                 
                 $shift_val = 'evening_shift_qty';
             }else{
                 
                 $shift_val = 'product_qty';
             } 
             
          }else{
              
              $shift_val = 'product_qty';
          }
        
           $this->db->select('dairy_products.product_name,dairy_products.unit,dairy_products.product_price,estimated_product_details.product_id, SUM(estimated_product_details.'.$shift_val.') AS product_qty_sum');
           $this->db->from('customer_details');
           $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
          $this->db->join('estimated_product_details','estimated_product_details.customer_id = customer_details.customer_id');
          $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
          $this->db->where('atm_card_detail.card_status','active');
          if($agent_search != ''){
               $this->db->where('customer_details.assigned_user_id',$agent_search);
          }
        
           
          
          //  remove vacation rows
            if($vaction->num_rows() > 0){
                
                foreach($vaction->result() as $row){
                    $vacation_customer_id = $row->customer_id;
                    $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                }
            }
            
            //  remove vacation rows

          $this->db->group_by('estimated_product_details.product_id');
          $data = $this->db->get()->result();
         // echo json_encode($data);

          return $data;

    }
    */
    
    public function select_all_e_product(){
        
            $this->db->select('*');
            $this->db->from('product_details');
            
            $data = $this->db->get();
            return $data->result();
    }
    
    public function daily_requirement_report_eproduct($agent_search){
           
            date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
         
            $this->db->select('*');
            $this->db->from('online_orders');
            $this->db->where('online_orders.delivery_date',$mydate);
            $this->db->where('online_orders.order_status','placed');
           
            
            if($agent_search){
                $this->db->where('online_orders.delivery_person',$agent_search);
            }
        
            $orders = $this->db->get();
        
           if($orders->num_rows() > 0){
                $item_array = array();
               
                foreach($orders->result() as $row){
                    
                    foreach(json_decode($row->online_order_details) as $order_row){
                        
                         $order_data = array('item_id' => $order_row->item_id,  'item_name' => $order_row->item_name, 'item_unit_price' => '', 'item_qty' => $order_row->item_qty);
                         array_push($item_array,$order_data);
                    }
                    
                }
               
               
               return json_encode($item_array);
           }

    }

		public function customer_wise_daily_requirement_report($agent_search,$customer_id){
            date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
         
            $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
            $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();

			$this->db->select('customer_details.first_name,customer_details.last_name, customer_details.customer_id');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->where('atm_card_detail.card_status','active');
			if($customer_id != ''){
				$this->db->where('customer_details.customer_id',$customer_id);
			}
			if($agent_search != ''){
				$this->db->where('customer_details.assigned_user_id',$agent_search);
			}
            
            //  remove vacation rows
            if($vaction->num_rows() > 0){
                
                foreach($vaction->result() as $row){
                    $vacation_customer_id = $row->customer_id;
                    $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                }
            }
            
            //  remove vacation rows
            
			$customer_list = $this->db->get();
			//return $customer_list->result();

			$this->db->select('*');
			$this->db->from('dairy_products');
			$all_products = $this->db->get();

	   if($customer_list->num_rows() > 0){
         $customer_array = array();

           foreach ($customer_list->result() as $customer_row) {
           	     $customer_id = $customer_row->customer_id;
								 $customer_name = $customer_row->first_name.' '.$customer_row->last_name;

								 $custome_array = array('customer_id' => $customer_id, 'customer_name' => $customer_name);

								 foreach($all_products->result() as $product_row){
								 $product_id =   $product_row->product_id;

								 $this->db->select('*');
			           $this->db->from('estimated_product_details');
								 //$this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
                 $this->db->where('estimated_product_details.customer_id',$customer_id);
								 $this->db->where('estimated_product_details.product_id',$product_id);
								 $product_data = $this->db->get();

								 //$list = array('mycustomer' => $customer_id, 'product_data' => $product_data->result());


                 if(isset($product_data->result()[0]->product_qty)){
									    $custome_array += ['product'.$product_id =>  $product_data->result()[0]->product_qty];
								 }else{
									     $custome_array += ['product'.$product_id =>  '-'];
								 }

                //  $customer_array['mycustomer'] =  $customer_id;

							  }
               array_push($customer_array,$custome_array);
           }
          // return $customer_array;
					// echo json_encode($customer_array);
         return json_encode($customer_array);
		 }


    }
    
    
    public function all_customres_date_wise_requirement($agent_search,$customer_id,$product_select){
        
        $this->db->select('*');
        $this->db->from('estimated_product_details');
        $this->db->join('customer_details','customer_details.customer_id = estimated_product_details.customer_id');
       $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->join('estimated_product_month_chart',' estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id', 'left');
         $this->db->join('estimated_product_week_chart',' estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id', 'left');
          $this->db->join('dairy_products',' dairy_products.product_id = estimated_product_details.product_id');
        
        if($agent_search){
            
            $this->db->where('customer_details.assigned_use_id',$agent_search);
            
        }
         if($customer_id){
            
            $this->db->where('customer_details.customer_id',$customer_id);
            
        }
        
        if($product_select){
            
            $this->db->where('estimated_product_details.product_id',$product_select);
            
        }
        
        
       $this->db->where('atm_card_detail.card_status','active');
        $data = $this->db->get();
        return $data->result();
         
        
        
    }


		public function edit_estimated_products($customer_id,$product_id,$product_qty)
		{
			 $check = $this->db->get_where('estimated_product_details', array('customer_id' => $customer_id, 'product_id' => $product_id, ));
			 if($check->num_rows() == 1){
				 $this->db->where('customer_id',$customer_id);
				 $this->db->where('product_id',$product_id);
				 $this->db->set('product_qty',$product_qty);
			   if($this->db->update('estimated_product_details')){
					 echo 'success';
				 }else{
					 echo 'failed';
				 }
			 }else{
				   $arr  = array(
						 'customer_id' =>  $customer_id,
						 'product_id'  =>  $product_id,
						 'product_qty' => $product_qty,
					 );
           if($this->db->insert('estimated_product_details',$arr)){
						 echo 'success';
	 				 }else{
	 					 echo 'failed';
	 				 }
			 }

		}
//=========********===========********========******========//
// ************ Admin Purchase Reports ***********//
//=========********===========********========******========//
  public function select_product_for_purchase_report(){
	   $this->db->select('*');
	   $this->db->from('dairy_products');
	   $this->db->order_by('product_id','asc');
	   $data = $this->db->get();
	   return $data->result();

   }

	 public function select_all_supplyer(){
 	   $this->db->select('*');
 	   $this->db->from('supplyer_details');
 	   $this->db->order_by('supplyer_name','asc');
 	   $data = $this->db->get();
 	   return $data->result();

    }

		public function admin_purchase_report($start,$end,$product,$supplyer){
				$start_date = date('Y-m-d',strtotime($start));
				$end_date = date('Y-m-d',strtotime($end));
				$date_array = array();

				$Variable1 = strtotime($start);
				$Variable2 = strtotime($end);
				for ($currentDate = $Variable1; $currentDate <= $Variable2;
																				 $currentDate += (86400)) {
						$Store = date('Y-m-d', $currentDate);
						$date_array[] = $Store;
				}
				$a = array();

        $product_array = array();
				for ($currentDate = $Variable1; $currentDate <= $Variable2;
																		$currentDate += (86400)) {

							$my_current_date = date('Y-m-d', $currentDate);


							$this->db->select('*');
							$this->db->from('dairy_stock');
							$this->db->where('date(dairy_stock.stock_date)', $my_current_date);
							$this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
							$one_date_all_product = $this->db->get();
							if($one_date_all_product->num_rows() > 0){
									$sum_sold_price = 0;
									foreach($one_date_all_product->result() as $row){
											$sum_sold_price += $row->sold_qty * $row->product_price;
									}
							}else{
								$sum_sold_price = 0;
							}


							$this->db->select('*,SUM(purchase_quantity) as sum_purchase_qty, SUM(purchase_price) as sum_purchase_price');
							$this->db->from('purchase_report');
							$this->db->where('date(purchase_report.purchase_date)', $my_current_date);
						  if($product != ''){
								  	$this->db->where('purchase_product_id', $product);
							}
							if($supplyer != ''){
								    $this->db->where('dealer_id', $supplyer);
							}

							$this->db->join('dairy_products','dairy_products.product_id = purchase_report.purchase_product_id');
							$this->db->join('supplyer_details','supplyer_details.supplyer_id = purchase_report.dealer_id');
							$this->db->group_by('purchase_product_id');
							$purchase = $this->db->get();
              $purchase_row = $purchase->result();

							if($purchase->num_rows() > 0){
                if($purchase_row[0]->sum_purchase_qty != ''){
								foreach($purchase_row as $rows){
	              $array1 = [ 'purchase_date' => $rows->purchase_date, 'product_name'=> $rows->product_name, 'purchase_unit_price' => $rows->purchase_unit_price, 'total_purchase_price' => $rows->sum_purchase_price, 'purchase_qty' =>  $rows->sum_purchase_qty,   'purchase_unit' => $rows->unit, 'sum_sold_price' => $sum_sold_price, 'supplyer_name' => $rows->supplyer_name,];
              	array_push($product_array,$array1);
							  }
						  	}
							}

					}

				 return json_encode($product_array);
				 //return $a;

		}
    
      public function admin_production_report($start,$end,$product){
          $this->db->select('*');
          $this->db->from('production_report');
          $this->db->join('dairy_products','dairy_products.product_id = production_report.product_id');
          if($start){
          if($start != 'Start Date'){
              $start = date('Y-m-d',strtotime($start));
              $this->db->where('production_date >=', $start);
          }
          }
          if($end){
          if($end != 'End Date'){
              $end = date('Y-m-d',strtotime($end));
              $this->db->where('production_date <=', $end);
          }
          }
          
          if($product != ''){
              $this->db->where('production_report.product_id', $product);
          }
          
          $this->db->order_by('production_date');
          
          $data = $this->db->get();
          return $data->result();
      }
    
    
      public function stock_return_report(){
          date_default_timezone_set('Asia/Kolkata');
              $date = new DateTime();
              $today = $date->format('Y-m-d');
          
          $check_return_stock = $this->db->get_where('returned_stock',array('stock_date' => $today));
          
          $this->db->select('*');
          $this->db->from('dairy_stock');
          $this->db->join('agent_stock','agent_stock.product_id = dairy_stock.product_id');          
         
          
          $this->db->join('team_member','team_member.user_id = agent_stock.user_id');
        //   $this->db->join('returned_stock','returned_stock.user_id = agent_stock.user_id');
        //    $this->db->join('returned_stock','returned_stock.stock_date = agent_stock.stock_date');
          $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
          if($check_return_stock->num_rows() > 0){
               $this->db->join('returned_stock','returned_stock.product_id = agent_stock.product_id');   
                 $this->db->where('returned_stock.stock_date', $today);
          }
          
          $this->db->where('dairy_stock.stock_date', $today);
           $this->db->where('agent_stock.stock_date', $today);
        
         //  $this->db->where('returned_stock.stock_date', $today);
            $data = $this->db->get();
            $d =  $data->result();
          
         return $d;
          
      }

     public function production_and_purchase_report($start,$end){
				$start_date = date('Y-m-d',strtotime($start));
				$end_date = date('Y-m-d',strtotime($end));
				$date_array = array();

				$Variable1 = strtotime($start);
				$Variable2 = strtotime($end);
				for ($currentDate = $Variable1; $currentDate <= $Variable2;
																				 $currentDate += (86400)) {
						$Store = date('Y-m-d', $currentDate);
						$date_array[] = $Store;
				}
				$a = array();

        $product_array = array();
				for ($currentDate = $Variable1; $currentDate <= $Variable2;
																		$currentDate += (86400)) {

							$my_current_date = date('Y-m-d', $currentDate);


							$this->db->select('*');
							$this->db->from('dairy_stock');
							$this->db->where('date(dairy_stock.stock_date)', $my_current_date);
							$this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
							$one_date_all_product = $this->db->get();
							if($one_date_all_product->num_rows() > 0){
									$sum_sold_price = 0;
									foreach($one_date_all_product->result() as $row){
											$sum_sold_price += $row->sold_qty * $row->product_price;
									}
							}


							$this->db->select('*');
							$this->db->from('dairy_products');
							$this->db->order_by('product_id','asc');
							$get_product = $this->db->get();
							$product = $get_product->result();

							$total_product_no = $get_product->num_rows();

							$all_product_total_sold_price = 0;



							foreach($product as $product_row ){


							$this->db->select('*,c1.product_name as purchase_product_name,c1.unit as purchase_unit');
							$this->db->from('dairy_stock');
							$this->db->where('date(dairy_stock.stock_date)', $my_current_date);
							$this->db->where('dairy_stock.product_id', $product_row->product_id);
							$this->db->join('raw_material_stock','raw_material_stock.stock_date = dairy_stock.stock_date');
							$this->db->join('dairy_products as c1','raw_material_stock.product_id = c1.product_id');
							$purchase = $this->db->get();
							if($purchase->num_rows() > 0){
                $all_product_total_sold_price += $purchase->result()[0]->sold_qty * $product_row->product_price;

	$array1 = [ 'total_product_no' => $total_product_no, 'date'=>$my_current_date,'product_name' => $product_row->product_name, 'produced_qty' =>  $purchase->result()[0]->produced_qty, 'sold_qty' => $purchase->result()[0]->sold_qty, 'remaining_qty' =>  $purchase->result()[0]->remaining_qty, 'raw_material_name' => $purchase->result()[0]->purchase_product_name, 'purchase_unit' => $purchase->result()[0]->purchase_unit, 'raw_material_qty' => $purchase->result()[0]->raw_material_qty, 'raw_material_price' => $purchase->result()[0]->raw_material_qty, 'sum_sold_price' => $sum_sold_price,];
						  }else{
								$array1 = [ 'total_product_no' => $total_product_no, 'date'=>$my_current_date, 'product_name' => $product_row->product_name, 'produced_qty' =>  '-', 'sold_qty' => '-', 'remaining_qty' =>  '-', 'raw_material_name' => '-', 'purchase_unit' => '-', 'raw_material_qty' => '-', 'raw_material_price' => '-', 'sum_sold_price' => '-',];
						  }
							array_push($product_array,$array1);

							}


					}

				 return json_encode($product_array);
				 //return $a;

		}

//=========********===========********========******========//
// ************ Customer Purchase Reports ***********//
//=========********===========********========******========//
    
public function customer_ledger_report($start,$end,$customer_id){
		$start_date = date('Y-m-d',strtotime($start));
		$end_date = date('Y-m-d',strtotime($end));
		$date_array = array();

		$Variable1 = strtotime($start);
		$Variable2 = strtotime($end);
		for ($currentDate = $Variable1; $currentDate <= $Variable2;
																		 $currentDate += (86400)) {
				$Store = date('Y-m-d', $currentDate);
				$date_array[] = $Store;
		}
		$a = array();

		for ($currentDate = $Variable1; $currentDate <= $Variable2;
																$currentDate += (86400)) {

					$my_current_date = date('Y-m-d', $currentDate);

					$this->db->select('*');
					$this->db->from('dairy_products');
					$this->db->order_by('product_id','asc');
					$product = $this->db->get()->result();

					$product_array = array('date'=>$my_current_date,);

					foreach($product as $product_row ){

					$this->db->select('customer_details.first_name,customer_details.last_name, customer_details.contact_1,transaction_detail.product_id,transaction_detail.product_quantity,transaction_detail.transaction_date, dairy_products.unit, SUM(product_quantity) AS qty_sum, SUM(transaction_amount) as price_sum');
					$this->db->from('customer_details');
					$this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
					$this->db->join('transaction_detail', 'transaction_detail.customer_id = customer_details.customer_id');
					$this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
					$this->db->where('date(transaction_date)', $my_current_date);
					$this->db->where('customer_details.customer_id', $customer_id);
					$this->db->where('transaction_detail.product_id', $product_row->product_id);
					$purchase = $this->db->get();

					if($purchase->num_rows() > 0){
						// $qty_and_price = +$purchase->result()[0]->qty_sum.' '.$purchase->result()[0]->unit.'/ Rs. '.+$purchase->result()[0]->price_sum;

						 $product_array += ['customer_name' => $purchase->result()[0]->first_name.' '.$purchase->result()[0]->last_name , 'mobile_no' => $purchase->result()[0]->contact_1 , 'product'.$product_row->product_id =>  $purchase->result()[0]->qty_sum, 'product'.$product_row->product_id.'_price' => $purchase->result()[0]->price_sum];
					}else{
						 $product_array += ['customer_name' => '-' , 'mobile_no' => '-', 'product'.$product_row->product_id =>  '-', 'product'.$product_row->product_id.'_price' => '-'];
					}



					}

					$this->db->select('*, SUM(recharge_amount) AS recharge_qty_sum');
					$this->db->from('recharge_detail');
					$this->db->join('customer_details', 'customer_details.customer_id = recharge_detail.customer_id');
					$this->db->where('date(recharge_date)', $my_current_date);
					$this->db->where('customer_details.customer_id', $customer_id);

					$recharge_report = $this->db->get();

					if($recharge_report->num_rows() > 0){
						 $product_array += ['recharge' =>  $recharge_report->result()[0]->recharge_qty_sum];
					}else{
						 $product_array += [ 'recharge' =>  '-'];
					}

				// $a += $product_array;
					array_push($a,$product_array);
			}

		 return json_encode($a);
		 //return $a;

   }

    public function select_customer_for_purchase_report($customer_id)
    {
			$this->db->select('*');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
			$this->db->where('customer_details.customer_id',$customer_id);
			$data = $this->db->get();
			return $data->result();
			
    }


public function ledger_total_product_wise_asc($start,$end,$customer_id){
				$start_date = date('Y-m-d',strtotime($start));
				$end_date = date('Y-m-d',strtotime($end));

				
				$this->db->select('*, transaction_date AS ledger_date ,dairy_products.product_name AS dairy_product_name, product_details.product_name AS e_product_name ');
				$this->db->from('transaction_detail');
				
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id
                ','left');    
    
               $this->db->join('product_details', 'product_details.product_id = transaction_detail.e_product_id
                ','left');    
				$this->db->where('date(transaction_date) >=', $start_date);
				$this->db->where('date(transaction_date) <=', $end_date);
				$this->db->where('transaction_detail.customer_id', $customer_id);
				
				$array1 = $this->db->get()->result();
    
    
                $this->db->select('*, recharge_date AS ledger_date');
				$this->db->from('recharge_detail');
				
				$this->db->where('date(recharge_date) >=', $start_date);
				$this->db->where('date(recharge_date) <=', $end_date);
				$this->db->where('recharge_detail.customer_id', $customer_id);
				
				$array2 = $this->db->get()->result();
                //return $data->result();
    
    
              /*  */
                $arr = array_merge($array1, $array2);
            return $arr;
              //  usort($arr, 'cmp');
    
           /*   function cmp($a, $b){
                    $ad = strtotime($a['transaction_date']);
                    $bd = strtotime($b['transaction_date']);
                    return ($ad-$bd);
                }*/   
          /* $price = array_column($array1, 'transaction_id');

         $v =   usort($price, SORT_DESC, $array1);
    
           print_r($v); */
             //return $arr;

				
}

			public function select_all_customers_for_drop_down(){
								$this->db->select('customer_details.customer_id,customer_details.first_name,customer_details.last_name,customer_details.contact_1,atm_card_detail.atm_card_no');
								$this->db->from('customer_details');
								$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
								$data = $this->db->get();
								return $data->result();
			}
    
//=========********===========********========******========//
// ************ Orders Reports Section ***********//
//=========********===========********========******========//     
    public function order_report($start,$end,$customer_id){
        
				$this->db->select('*,customer_details.first_name AS c_first_name, customer_details.last_name AS c_last_name ');
				$this->db->from('online_orders');
                $this->db->join('customer_details', 'customer_details.customer_id = online_orders.customer_id','left');
                $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = online_orders.guest_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id','left');
				
				
				if($customer_id){
					$this->db->where('customer_details.customer_id',$customer_id);
				}
				if($start && $start != 'Start Date'){
					
					$start = date('Y-m-d',strtotime($start));
					$this->db->where('online_order_date >=',$start);
				}
				
				if($end && $end != 'End Date'){
					
					$end = date('Y-m-d',strtotime($end));
					$this->db->where('online_order_date <=',$end);
				}
				$this->db->order_by('online_order_date','asc');
				$data = $this->db->get();
                return $data->result();
    }
    
//=========********===========********========******========//
// ************ Feedback Section ***********//
//=========********===========********========******========//     
     public function select_feedback($id){
        
               $this->db->select('*');
		       $this->db->from('feedback');
               $this->db->join('customer_details', 'customer_details.customer_id = feedback.customer_id');
               $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
              
               if($id != ''){
                   
                   $this->db->where('feedback_id',$id);
                   
               }
         
               $this->db->order_by('time_stamp','desc');
		       $data = $this->db->get();
               return $data->result();
        
    }
    
    public function select_feedback_filter($name_search,$colony_search){
              
                $this->db->select('*');
		    	$this->db->from('feedback');
               
                $this->db->join('customer_details', 'customer_details.customer_id = feedback.customer_id');
		        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
               
                if($colony_search != ""){
                    $this->db->where("customer_details.colony_id", $colony_search);
                }
              
                if($name_search != ""){
                    $this->db->like("first_name", $name_search);
                }
              
                $data = $this->db->get();
                return $data->result();

    }
    
    
//=========********===========********========******========//
// ************ Profit Report ***********//
//=========********===========********========******========//  
    
    public function profit_report($start,$end){
        $start = date('Y-m-d',strtotime($start));
         $end = date('Y-m-d',strtotime($end));
        
         // transaction
        $i = 0;
        
        $s_day = new DateTime($start);
        $e_day = new DateTime($end);
        
        $arr = array();
        
        for($i = $s_day; $i <= $e_day; $i->modify('+1 day')){
            
         $loop_date =  date('Y-m-d',strtotime($i->format("Y-m-d")));   
       
         $this->db->select('transaction_date,SUM(transaction_amount) AS sum_sell');
         $this->db->from('transaction_detail');
        
         $this->db->where('date(transaction_date)',$loop_date);    
        
         $sell = $this->db->get();
        //return $sell->result();
      
        
        // expanse
        
         $this->db->select('expanse.date,SUM(expanse_amount) AS sum_expanse');
         $this->db->from('expanse');
        
         $this->db->where('date(date)',$loop_date);    
        
         $expanse = $this->db->get();
        
        // 
        
         $this->db->select('purchase_date,SUM(purchase_quantity) AS sum_purchase');
         $this->db->from('purchase_report');
       
         $this->db->where('date(purchase_date)',$loop_date);    
         
         $purchase = $this->db->get();
        
         array_push($arr,array(
             
             'profit_date' => $loop_date,
             'total_sell' => $sell->result()[0]->sum_sell,
             'total_expanse' => $expanse->result()[0]->sum_expanse,
             'total_purchase' => $purchase->result()[0]->sum_purchase,
             
             ));
             
         
        }
        
        return json_encode($arr);  
       
    }
    
    
    
    public function edit_customer_daily_requirement($val,$product_id,$customer_id,$shift){
        
        $this->db->where('product_id',$product_id);
        $this->db->where('customer_id',$customer_id);
        
        if($shift == 1){
            $this->db->set('morning_shift_qty',$val);
            
        }else if($shift == 2){
            
            $this->db->set('evening_shift_qty',$val);
        }
        
        
        if($this->db->update('estimated_product_details')){
            
            
            echo 'success';
        }else{
            
            echo 'failed';
        }
    }
    
    public function edit_customer_week_requirement($morning_val,$evening_val,$estimated_id,$shift,$day_no){
        
       $a = array (array("morning" => floatval($morning_val),"evening" => floatval($evening_val),),);
        $a_encode  = json_encode($a);
        
        $this->db->where('estimated_id',$estimated_id);
        $this->db->set($day_no,$a_encode);
        if($this->db->update('estimated_product_week_chart')){
            echo 'success';
        }else{
            
            echo 'failed';
        }
        
       
    }
    
//=========********===========********========******========//
// ************ Bill Report ***********//
//=========********===========********========******========//         
    public function bill_report($start,$end,$card_no,$customer_type){
        
               $this->db->select('*, SUM(transaction_detail.transaction_amount) AS sum_bill_amount');
		       $this->db->from('bill_details');
               $this->db->join('customer_details', 'customer_details.customer_id = bill_details.customer_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = bill_details.customer_id','left');
               $this->db->join('transaction_detail', 'transaction_detail.bill_id = bill_details.bill_id');
        
               if($start){
                    $start = date('Y-m-d',strtotime($start));
                    $this->db->where('date(bill_details.bill_date) >=', $start);
                }
                if($end){
                     $end = date('Y-m-d',strtotime($end));
                    $this->db->where('date(bill_details.bill_date) <=', $end);
                }
        
               if($card_no){
                   
                   $this->db->where('atm_card_detail.atm_card_no',$card_no);
               }
               if($customer_type){
                   
                   $this->db->where('transaction_detail.customer_type',$customer_type);
               }
        
               $this->db->group_by('transaction_detail.bill_id');
               $this->db->order_by('bill_details.bill_date','desc');
		       $data = $this->db->get();
               return $data->result();
        
        
    }
    
    
    public function bill_detail_report($bill_id){
        
        
               $this->db->select('*');
		       $this->db->from('bill_details');
               $this->db->join('customer_details', 'customer_details.customer_id = bill_details.customer_id','left');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = bill_details.customer_id','left');
               $this->db->join('transaction_detail', 'transaction_detail.bill_id = bill_details.bill_id');
                 $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id','left');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id','left');
              
               $this->db->where('bill_details.bill_id',$bill_id);

		       $data = $this->db->get();
               return $data->result();
        
    }

}
