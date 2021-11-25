<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_dashboard extends CI_Model {



	function __construct(){


       date_default_timezone_set("Asia/Calcutta");
		parent::__construct();

	}

    public function update_my_profile($fname,$email){

        $arr = array(
            'name' => $fname,
            'email' => $email,

        );

        $this->db->where('user_id','1');
        if($this->db->update('team_member',$arr)){

            echo "success";

        }else{

            echo "fail";
        };
    }


     public function change_pass($n_pass){

        $arr = array(
           'password' => $n_pass,
        );

        $this->db->where('user_id','1');
        if($this->db->update('team_member',$arr)){

            echo "success";

        }else{

            echo "fail";
        };
    }


	public function user_data($uid){
		$data = $this->db->get_where('team_member', array(
				'user_id' => '1'
			));
		return $data->result();

	}

	public function update_pic($thumb_img, $uid){
		$arr = array(
				'image' => $thumb_img
			);

		$this->db->where('user_id', $uid);
		if($this->db->update('team_member', $arr)){
			return '<div id="notification" class="alert alert-success">Profile picture updated.</div>';
		} else {
			return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';
		}
	}

	public function update_info($uid){
		$fname = ucfirst(strtolower($this->input->post('fname')));
		$lname = ucfirst(strtolower($this->input->post('lname')));
		$email = $this->input->post('email');
		$arr = array(
				'name' => $fname,
				'email' => $email
			);
		$this->db->where('user_id', $uid);
		if($this->db->update('team_member', $arr)){
			return '<div id="notification" class="alert alert-success">Profile successfully updated.</div>';
		} else {
			return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';
		}
	}

	public function update_pass($uid){
		$password = $this->input->post('password');
		$arr = array(
				'password' => $password
			);
		$this->db->where('user_id', $uid);
		if($this->db->update('team_member', $arr)){
			return '<div id="notification" class="alert alert-success">Password successfully updated.</div>';
		} else {
			return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';
		}

	}

	public function enter_code(){
         $qr_code = 1001;
		$link_no = 2050001;

		for($i = 1; $i <= 1000; $i++){

			echo "The number is: ".$i." <br>";

			$arr = array(

		       'qr_code' => "MD_".$qr_code++,
			   'atm_card_no'    => $link_no++,

		    );

		    $this->db->insert('atm_card_detail',$arr);
		}
	}
    
    
    public function enter_auto_card(){
         $qr_code = 1001;
		$link_no = 1050001;

		for($i = 1; $i <= 1000; $i++){

			echo "The number is: ".$i." <br>";

			$arr = array(

		       'qr_code' => "DMS_".$qr_code++,
			   'atm_card_no'  => $link_no++,
                'card_type'  => 'digital',

		    );

		    $this->db->insert('atm_card_detail',$arr);
		}
	}


   public function select_today_recharge(){
            $this->db->select('* , SUM(recharge_amount) AS total');
			      $this->db->from('recharge_detail');
            $this->db->where('date(recharge_date)',date('Y-m-d'));
			      $data = $this->db->get()->result();
            return $data;
  }

  public function select_yesterday_recharge(){
            $yes = date('Y-m-d',strtotime("-1 days"));
            $this->db->select('* , SUM(recharge_amount) AS total');
			      $this->db->from('recharge_detail');
            $this->db->where('date(recharge_date)',$yes);
			      $data = $this->db->get()->result();
            return $data;
  }

  public function select_month_recharge(){
            $this->db->select('* , SUM(recharge_amount) AS total');
			$this->db->from('recharge_detail');
			$this->db->where('MONTH(recharge_date)',date('m'));
            $this->db->where('YEAR(recharge_date)',date('Y'));
			$data = $this->db->get()->result();

            return $data;
  }

  public function select_lastmonth_recharge(){
            $yes = date('m',strtotime("-1 month"));
            $this->db->select('* , SUM(recharge_amount) AS total');
			$this->db->from('recharge_detail');
            $this->db->where('MONTH(recharge_date)',$yes);
            $this->db->where('YEAR(recharge_date)',date('Y'));
			$data = $this->db->get()->result();

            return $data;
  }

  public function select_year_recharge(){

            $this->db->select('* , SUM(recharge_amount) AS total');
			$this->db->from('recharge_detail');
            $this->db->where('YEAR(recharge_date)',date('Y'));
			$data = $this->db->get()->result();
            return $data;
  }



  public function select_today_sell(){
            $this->db->select('* , SUM(transaction_amount) AS total');
			$this->db->from('transaction_detail');
            $this->db->where('date(transaction_date)',date('Y-m-d'));
			$data = $this->db->get()->result();
            return $data;
  }

  public function select_yesterday_sell(){
            $yes = date('Y-m-d',strtotime("-1 days"));
            $this->db->select('* , SUM(transaction_amount) AS total');
			$this->db->from('transaction_detail');
            $this->db->where('date(transaction_date)',$yes);
			$data = $this->db->get()->result();
            return $data;
  }

  public function select_month_sell(){
            $this->db->select('* , SUM(transaction_amount) AS total');
			$this->db->from('transaction_detail');
			$this->db->where('MONTH(transaction_date)',date('m'));
            $this->db->where('YEAR(transaction_date)',date('Y'));
			$data = $this->db->get()->result();

            return $data;
  }

  public function select_lastmonth_sell(){
            $yes = date('m',strtotime("-1 month"));
            $this->db->select('SUM(transaction_amount) AS total');
			$this->db->from('transaction_detail');
            $this->db->where('MONTH(transaction_date)',$yes);
            $this->db->where('YEAR(transaction_date)',date('Y'));
			$data = $this->db->get()->result();

            return $data;
  }

  public function select_year_sell(){

            $this->db->select('* , SUM(transaction_amount) AS total');
			$this->db->from('transaction_detail');
            $this->db->where('YEAR(transaction_date)',date('Y'));
			$data = $this->db->get()->result();
            return $data;
  }





 public function select_barchart_transaction(){

            $this->db->select('transaction_date,SUM(transaction_amount) AS bar_tran');
			$this->db->from('transaction_detail');
            $this->db->where("YEAR(transaction_date)",date('Y'));

            $this->db->group_by('MONTH(transaction_date)');
            $this->db->order_by('transaction_date','DESC');
			$data = $this->db->get()->result();
            return $data;
  }

   public function select_barchart_recharge(){

            $this->db->select('recharge_date,SUM(recharge_amount) AS bar_re');
			$this->db->from('recharge_detail');
            $this->db->where("YEAR(recharge_date)",date('Y'));

            $this->db->group_by('MONTH(recharge_date)');
            $this->db->order_by('recharge_date','DESC');
			$data = $this->db->get()->result();
           //echo json_encode($data);
           return $data;
  }




  public function my_data_cleaner($before_year){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->where('date(transaction_date) <=', $before_year);
        if($this->db->delete('transaction_detail')){

            $this->db->where('date(recharge_date) <=', $before_year);
            if($this->db->delete('recharge_detail')){
                echo "success";
                $cookie_name = "sharma_dairy_data_cleaner";
                $cookie_value = 'sharmadairy';
                setcookie($cookie_name, $cookie_value, time() + 86400, "/");

            }

        }else{

            echo "fail";
            unset($_COOKIE["sharma_dairy_data_cleaner"]);
        };

  }

  public function my_block_transaction($before_tenday){
        $arr = array(
            'card_status' => 'blocked',
        );

        $this->db->where('card_status', 'active');
        $this->db->where('date(last_transaction_date) <=', $before_tenday);
        if($this->db->update('atm_card_detail',$arr)){
            echo "success";
            $cookie_name = "sharma_dairy_card_blocker";
            $cookie_value = 'sharmadairy';
            setcookie($cookie_name, $cookie_value, time() + 86400, "/");
        }else{
            echo "fail";
            unset($_COOKIE["sharma_dairy_card_blocker"]);
        };

  }

  public function total_customer(){
      $this->db->select('customer_details.customer_id');
      $this->db->from('customer_details');
      $data = $this->db->get()->result();
      $count =  count($data);
      return $count;

  }

   public function total_active_customer(){
      $this->db->select('customer_details.customer_id');
      $this->db->from('customer_details');
      $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
      $this->db->where('card_status','active');
      $data = $this->db->get()->result();
      $count =  count($data);
      return $count;

  }

   public function total_blocked_customer(){
      $this->db->select('customer_details.customer_id');
      $this->db->from('customer_details');
      $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');

      $this->db->where('card_status','blocked');
      $data = $this->db->get()->result();
      $count =  count($data);
      return $count;

  }

  public function total_blocked_customer_detail(){
      $this->db->select('*');
      $this->db->from('customer_details');
      $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
      $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
       $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
      $this->db->where('card_status','blocked');
      $data = $this->db->get()->result();
      //$count =  count($data);
      return $data;

  }

   public function total_terminate(){
      $this->db->select('*');
      $this->db->from('customer_details');
      $this->db->where('customer_status','terminated');
      $this->db->join('terminated_customer','terminated_customer.customer_id = customer_details.customer_id');
      $data = $this->db->get()->result();

      $count =  count($data);
      return $count;

  }

	public function select_colony(){

						 $this->db->select('*');
			 $this->db->from('colony_detail');
							$this->db->order_by('colony_name','ASC');
			 $data = $this->db->get();
						 return $data->result();

 }

  public function terminate_customer_select(){
      $this->db->select('*');
      $this->db->from('customer_details');
      $this->db->where('customer_status','terminated');
      $this->db->join('terminated_customer','terminated_customer.customer_id = customer_details.customer_id');
       $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
       $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
      $this->db->order_by('terminate_date','DESC');
      $this->db->order_by('serial_no','DESC');
      $data = $this->db->get()->result();
      return $data;

  }

	public function terminate_customer_filter($first_name,$last_name,$colony_search){
		  $this->db->select('*');
			$this->db->from('customer_details');
			if($colony_search != ""){
							$this->db->where("customer_details.colony_id", $colony_search);
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
			$this->db->join('terminated_customer','terminated_customer.customer_id = customer_details.customer_id');
       $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
       $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
      $this->db->order_by('terminate_date','DESC');
      $this->db->order_by('serial_no','DESC');
      $data = $this->db->get()->result();
      return $data;
	}

    public function select_duplicate_entry(){
	  $this->db->select('*,COUNT(transaction_id) as no_of_entry');
      $this->db->from('transaction_detail');
	  $this->db->group_by('DATE(transaction_date)')->having('COUNT(transaction_id) >', '1');
	  $this->db->group_by('customer_id')->having('COUNT(transaction_id) >', '1');
	  $this->db->group_by('transaction_amount')->having('COUNT(transaction_id) >', '1');
      $data = $this->db->get()->result();
	  echo json_encode($data);

  }


   // vacation couting

   public function today_vacation(){
      $today_date = date('Y-m-d');

      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$today_date);
      $this->db->where('end_date >=',$today_date);
      $this->db->where_in('shift',['morning','both']);
      $data = $this->db->get()->result();
      //return $data;


      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$today_date);
      $this->db->where('end_date >=',$today_date);
      $this->db->where_in('shift',['evening','both']);
      $eve = $this->db->get()->result();

      return array(
          'morning' => $data,
          'evening' => $eve
      );
  }

  public function tommrow_vacation(){
      $tommrow_date = date('Y-m-d', strtotime('+1 day'));

      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$tommrow_date);
      $this->db->where('end_date >=',$tommrow_date);
      $this->db->where_in('shift',['morning','both']);
      $data = $this->db->get()->result();
      //return $data;


      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$tommrow_date);
      $this->db->where('end_date >=',$tommrow_date);
      $this->db->where_in('shift',['evening','both']);
      $eve = $this->db->get()->result();

      return array(
          'morning' => $data,
          'evening' => $eve
      );
  }

   public function after_tommrow_vacation(){
      $mydate = date('Y-m-d', strtotime('+2 day'));

      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$mydate);
      $this->db->where('end_date >=',$mydate);
      $this->db->where_in('shift',['morning','both']);
      $data = $this->db->get()->result();
      //return $data;


      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$mydate);
      $this->db->where('end_date >=',$mydate);
      $this->db->where_in('shift',['evening','both']);
      $eve = $this->db->get()->result();

      return array(
          'morning' => $data,
          'evening' => $eve
      );
  }

   public function after_tommrow_tommrow_vacation(){
      $mydate = date('Y-m-d', strtotime('+3 day'));

      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$mydate);
      $this->db->where('end_date >=',$mydate);
      $this->db->where_in('shift',['morning','both']);
      $data = $this->db->get()->result();
      //return $data;


      $this->db->select('*, count(vacation_id) AS total_vac');
      $this->db->from('vacation');
      $this->db->where('start_date <=',$mydate);
      $this->db->where('end_date >=',$mydate);
      $this->db->where_in('shift',['evening','both']);
      $eve = $this->db->get()->result();

      return array(
          'morning' => $data,
          'evening' => $eve
      );
  }

   public function view_vacation($date,$shift){

     $this->db->select('*');
     $this->db->from('vacation');
     $this->db->join('customer_details','customer_details.customer_id = vacation.customer_id');
     $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
      $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
     $this->db->where('start_date <=',$date);
     $this->db->where('end_date >=',$date);
     $this->db->where_in('shift',[$shift,'both']);
     //$this->db->or_where('shift','both');
     $data = $this->db->get()->result();
            return $data;
   }

   public function view_vacation_searchbar($date,$shift){
	    if($date != 'Start Date'){
            $mydate = date('Y-m-d',strtotime($date));

        }


		$this->db->select('*');
        $this->db->from('vacation');
        $this->db->join('customer_details','customer_details.customer_id = vacation.customer_id');
        $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
         $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->where('start_date <=',$mydate);
        $this->db->where('end_date >=',$mydate);

		if($shift == 'both'){
            $this->db->where_in('shift',['morning','evening','both']);

        }else{

			$this->db->where_in('shift',[$shift,'both']);
		}

        //$this->db->or_where('shift','both');
        $data = $this->db->get()->result();
        return $data;

	}

   public function select_shift(){

	   $this->db->select('*');
       $this->db->from('delivery_shift');
	   $data = $this->db->get();

	   return $data->result();
   }


	 //select user reagistration

	 public function user_ragistration()
	 {

		 // today ragistration
		 $this->db->select('count(ragistration_id) AS total');
		 $this->db->from('customer_ragistration');
		 $total_ragistration = $this->db->get()->result();

     // today ragistration
		 $this->db->select('count(ragistration_id) AS total');
		 $this->db->from('customer_ragistration');
		 $this->db->where_in('ragistration_status',['','canceled']);
		 $new_ragistration = $this->db->get()->result();

		 // yesterday ragistration
		 $this->db->select('count(ragistration_id) AS total');
		 $this->db->from('customer_ragistration');
		 $this->db->where('ragistration_status','completed');
		 $completed_ragistration = $this->db->get()->result();

     // this month
		 $this->db->select('count(ragistration_id) AS total');
		 $this->db->from('customer_ragistration');
		 $this->db->where('ragistration_status','canceled');
		 $canceled_ragistration = $this->db->get()->result();



		 return array(
			    'total_ragistration' => $total_ragistration,
					'new_ragistration' => $new_ragistration,
					'completed_ragistration' => $completed_ragistration,
					'canceled_ragistration' => $canceled_ragistration,

				);

	 }

	 public function count_orders1(){
	 	$this->db->select('count(special_order_id) AS total');
	 	$this->db->from('special_orders');
	 	$this->db->where('special_orders.order_status','');
	 	$new_order = $this->db->get();
	   $n = $new_order->result();

	 	$this->db->select('count(special_order_id) AS total');
	 	$this->db->from('special_orders');
	 	$this->db->where('special_orders.order_status','placed');
	 	$placed_order = $this->db->get();
	 	$p = $placed_order->result();

	 	$this->db->select('count(special_order_id) AS total');
	 	$this->db->from('special_orders');
	 	$this->db->where('special_orders.order_status','completed');
	 	$completed_order = $this->db->get();
	 	$c = $completed_order->result();

	 	$this->db->select('count(special_order_id) AS total');
	 	$this->db->from('special_orders');
	 	$this->db->where('special_orders.order_status','canceled');
	 	$canceled_order = $this->db->get();
	 	$cn = $canceled_order->result();

	 	echo $n;
	 	/*return array(
	 			'new_order_count' => $n,
	 			'placed_order_count' => $p,
	 			'completed_order_count' => $c,
	 			'canceled_order_count' => $cn,
	 	);*/

	 }
    
     public function new_order(){
         
        $this->db->select('*,customer_details.first_name AS c_first_name, customer_details.last_name AS c_last_name');
	 	$this->db->from('online_orders');
	 	$this->db->where('online_orders.order_status','');
        $this->db->join('customer_details','customer_details.customer_id = online_orders.customer_id','left'); 
        $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id','left');  
	 	$data = $this->db->get();
	    return $data->result();
         
         
     }
    
     public function order_delivery_datewise_count(){
         
         $today = date('Y-m-d');
         $second = date('Y-m-d', strtotime('+1 day'));
         $third = date('Y-m-d', strtotime('+2 day'));
         $forth = date('Y-m-d', strtotime('+3 day'));
         $fifth = date('Y-m-d', strtotime('+4 day'));
         
         $this->db->select('count(online_order_id) AS total');
	 	 $this->db->from('online_orders');
	 	 $this->db->where('online_orders.order_status','placed');
         $this->db->where('delivery_date', $today);
	 	 $today_delivery = $this->db->get()->result();
         
         $this->db->select('count(online_order_id) AS total');
	 	 $this->db->from('online_orders');
	 	 $this->db->where('online_orders.order_status','placed');
         $this->db->where('delivery_date', $second);
	 	 $second_day_delivery = $this->db->get()->result();
         
         $this->db->select('count(online_order_id) AS total');
	 	 $this->db->from('online_orders');
	 	 $this->db->where('online_orders.order_status','placed');
         $this->db->where('delivery_date', $third);
	 	 $third_day_delivery = $this->db->get()->result();
         
         $this->db->select('count(online_order_id) AS total');
	 	 $this->db->from('online_orders');
	 	 $this->db->where('online_orders.order_status','placed');
         $this->db->where('delivery_date', $forth);
	 	 $forth_day_delivery = $this->db->get()->result();
         
         $this->db->select('count(online_order_id) AS total');
	 	 $this->db->from('online_orders');
	 	 $this->db->where('online_orders.order_status','placed');
         $this->db->where('delivery_date', $fifth);
	 	 $fifth_day_delivery = $this->db->get()->result();
	     
         return array(
	 			'today_delivery' => $today_delivery,
	 			'second_day_delivery' => $second_day_delivery,
	 			'third_day_delivery' => $third_day_delivery,
	 			'forth_day_delivery' => $forth_day_delivery,
                'fifth_day_delivery' => $fifth_day_delivery,
	 	);
     }
    
    
    
      public function genrate_order(){
          date_default_timezone_set('Asia/Kolkata');
          $date = new DateTime();
          $today = $date->format('Y-m-d');
          $time_stamp = $date->format('Y-m-d H:i:s');
          
          $this->db->select('*');
          $this->db->from('customer_details');
          $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
          $this->db->where('card_status','active');
          $member_customer = $this->db->get();
          
          if($member_customer->num_rows() > 0){
              
              
              
              foreach($member_customer->result() as $members_list){
               
                  
                  $customer_id = $members_list->customer_id;
                  
                  $this->db->select('*');
                  $this->db->from('estimated_product_details');
                  $this->db->where('customer_id',$customer_id);
                  $member_requirement = $this->db->get();
                  
                  if($member_requirement->num_rows() > 0){
                       
                  foreach($member_requirement->result() as $member_requirement_list){
                       
                      $product_id = $member_requirement_list->product_id;
                      $product_qty = $member_requirement_list->product_qty;
                      
                      if($product_qty > 0){
                      $arr = array(
                      
                          'customer_id' => $customer_id,
                          'customer_type' => 'membership',
                          'product_id' => $product_id,
                          //'order_id' => null,
                          'genrated_order_type' => 'daily_order',
                          'order_amount' => $product_qty,
                          'genrated_order_date' => $time_stamp,
                      
                      );
                       
                       if($this->db->insert('genrated_orders',$arr)){
                           echo 'success';
                       }else{
                           echo 'failed';
                       }
                      }
                  }
                  }
                  
                  $this->db->select('*');
                  $this->db->from('online_orders');
                  $this->db->where('customer_id',$customer_id);
                  $this->db->where('delivery_date',$today);
                  $this->db->where('order_status','placed');
                  $this->db->where('order_type','membership');
                  $member_extra_order = $this->db->get();
                  
                  if($member_extra_order->num_rows() > 0){
                  foreach($member_extra_order->result() as $member_extra_order){
                      
                      $order_id = $member_extra_order->online_order_id;
                      $paid_amount = $member_extra_order->paid_amount;
                      
                      $arr2 = array(
                      
                          'customer_id' => $customer_id,
                          'customer_type' => 'membership',
                          'product_id' => null,
                          'order_id' => $order_id,
                          'genrated_order_type' => 'extra_order',
                          'order_amount' => $paid_amount,
                          'genrated_order_date' => $time_stamp,
                      
                      );
                      
                      $this->db->insert('genrated_orders',$arr2);
                  }
                  }
              }      
              
              
          }
          
          
          // genrate e orders
          $this->db->select('*');
          $this->db->from('online_orders');
          $this->db->where('delivery_date',$today);
          $this->db->where('order_status','placed');
          $this->db->where('order_type','e_order');
          $guest_order = $this->db->get();
          if($guest_order->num_rows() > 0){
              
              foreach($guest_order->result() as $guest_order_row){
                  
                   $guest_order_id = $guest_order_row->online_order_id;
                   $guest_id = $guest_order_row->customer_id;
                   $guest_order_amount = $guest_order_row->paid_amount;
                  
                    $arr3 = array(
                      
                          'customer_id' => $guest_id,
                          'customer_type' => 'guest',
                          'product_id' => null,
                          'order_id' => $guest_order_id,
                          'genrated_order_type' => 'extra_order',
                          'order_amount' => $guest_order_amount,
                          'genrated_order_date' => $time_stamp,
                      
                      );
                      
                      $this->db->insert('genrated_orders',$arr3);
              }
              
          }
          
      }
    
    
    public function select_admin_notification(){
        
          $this->db->select('*,customer_details.first_name as c_first_name, customer_details.last_name as c_last_name');
          $this->db->from('admin_notification');
          $this->db->where('notification_status','unread');
          $this->db->join('customer_details','customer_details.customer_id = admin_notification.customer_id','left');
          $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = admin_notification.guest_id','left');
        
         
          $data = $this->db->get();
	      return $data->result();
    }
    
    public function view_requirement_update($id,$notification_id){
        
        $check = $this->db->get_where('admin_notification', array('notification_id' => $notification_id));
        
        if($check->num_rows() == 1){
            
            
            $this->db->where('notification_id',$notification_id);
            $this->db->set('notification_status','completed');
            if($this->db->update('admin_notification')){
                
                redirect(base_url().'customer/manage_requirement/'.$id);
                
            }
        }
        
    }
    
    
    
    public function feedback_notification(){
        
         $this->db->select('*');
          $this->db->from('feedback');
          $this->db->where('feedback_status','');
          $this->db->join('customer_details','customer_details.customer_id = feedback.customer_id');
          
          $data = $this->db->get();
	      return $data->result();
        
    }
    
    public function read_feedback($id){
        
        $this->db->where('feedback_id',$id);
        $this->db->set('feedback_status','read');
        if($this->db->update('feedback')){
            
            redirect(base_url().'report/feedback/'.$id);
        }else{
             redirect(base_url().'report/feedback');
        }
    }
    
    // carry formfard stock   verifypos
    
    
    public function auto_carry_forward_stock(){

      date_default_timezone_set('Asia/Kolkata');
          $date = new DateTime();
          $today = $date->format('Y-m-d');
          
        $tommorow = date('Y-m-d', strtotime($today .' -1 day'));
        
        
        $check_today_stock =  $this->db->get_where('dairy_stock',array( 'stock_date' => $today ));
        
        if($check_today_stock->num_rows() > 0){  
        }else{
            
            $this->db->select('*');
            $this->db->from('dairy_products');
            $product_row = $this->db->get();
            
            
            if($product_row->num_rows() > 0){
                
                foreach($product_row->result() as $row){
                    
                    $p_id = $row->product_id;
                    
                    $arr = array(
                      
                        'stock_date' => $today,
                        'product_id' => $p_id,
                    );
                    
                    $this->db->insert('dairy_stock',$arr);
                }
                
            }
            
            
        }
        
        $check_stock = $this->db->get_where('dairy_stock',array( 'stock_date' => $tommorow ));
        
        if($check_stock->num_rows() > 0 ){
   
        
            
            foreach($check_stock->result() as $row){
                         
                $product_id = $row->product_id;
                $remaining_qty = $row->remaining_qty;
                
                if($remaining_qty > 0){
               
                $check_today_stock = $this->db->get_where('dairy_stock',array( 'stock_date' => $today, 'product_id' => $product_id ));
                
                
                if($check_today_stock->num_rows() > 0){
                    // update Query
                      
                    $this->db->where('stock_date',$today);
                    $this->db->where('product_id',$product_id);
                    $this->db->set('produced_qty','produced_qty +'.$remaining_qty,FALSE);
                     $this->db->set('remaining_qty','remaining_qty +'.$remaining_qty,FALSE);
                    if( $this->db->update('dairy_stock')){
                        $this->db->where('stock_date',$today);
                        $this->db->where('product_id',$tommorow);
                        $this->db->set('remaining_qty','remaining_qty -'.$remaining_qty,FALSE);
                        $this->db->set('carry_qty','carry_qty +'.$remaining_qty,FALSE);
                        
                        
                        $this->db->update('dairy_stock');
                        
                    };
                    
                    
                }
                }
                
            }
            
            
        }
        
      
        
    }
    
    
    public function location_auto_seq(){
        
        $this->db->select('*');
        $this->db->from('customer_location');
        $this->db->order_by('customer_lat','desc');
        $this->db->order_by('customer_lng','desc');
        
        $this->db->where('customer_lat >', '22.97566067');
        
        $data = $this->db->get();
        
        return $data->result();
        
    }


}
