<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_customer extends CI_Model {

	function __construct(){

		parent::__construct();

	}



	public function add_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$shift,$agent,$estimate_product , $ac_type , $balance_restricted,$card_type){

        // get disgital card 
        if($card_type == 2){
           $get_auto_card = $this->db->get_where('atm_card_detail',array('customer_id' => null, 'card_status' => '', 'card_type' => 'digital' ));
           $card_no =  $get_auto_card->result()[0]->atm_card_no;   
                        
        }
        // get disgital card 
        
		$check1 = $this->db->get_where('atm_card_detail',array('atm_card_no' => $card_no));
		if($check1->num_rows() == 1){

            $check = $this->db->get_where('atm_card_detail',array('atm_card_no' => $card_no,'card_status' => ''));

		if($check->num_rows() == 1){

			date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $mydate = $date->format('Y-m-d');
            $time_stamp = $date->format('Y-m-d H:i:s');

			$arr = array(

		    'first_name' => $firstname,
			'last_name' => $lastname,
            'email_address' => $email,
			'contact_1' => $mobileno,
            'contact_2' => $mobileno2,
			'address_1' => $address1,
			'address_2' => $address2,
			'colony_id' => $colony,
			'city' => $city,
            'shift_id' => $shift,
            'd_type_id' => $delivery_type,
            'password' => $mobileno,
            'ac_type' => $ac_type,
            'balance_restricted' =>   $balance_restricted, 
            'assigned_user_id' =>   $agent,
            'ragistration_date' => $time_stamp,

		    );


		    if($this->db->insert('customer_details',$arr)){
		    	$customer_id = $this->db->insert_id();

                  
                   foreach(json_decode($estimate_product) as $row){
                      
                       $arrr = array(
                            'customer_id' => $customer_id,
                            'product_id' => $row->product_id,
                            'selling_margin' => $row->selling_margin,
                           
                       );

                       $this->db->insert('estimated_product_details',$arrr);
                   }
                   
                   
                    
                     $arr3 = array(
                         'customer_id' => $customer_id,
                         'card_status' => 'active',
                         'card_assign_time' => $time_stamp,
                         //'last_transaction_date' => $time_stamp,
                    );
                    $this->db->where('atm_card_no', $card_no);
                    if($this->db->update('atm_card_detail', $arr3)){
                        $arr4 = array(
                            'customer_id' => $customer_id,
                            'balance_amount' => $advance_payment,
                        );
                        if($this->db->insert('current_balance', $arr4)){

                                 $arr7 = array(
                                      'customer_id' => $customer_id,
                                      'shift_id' => '1',
                                      'status' => '',
                                  );
                                  $this->db->insert('delivery_status',$arr7);
                            
                            if($advance_payment !== "" && $advance_payment > 0){
                       
                                $arr5 = array(
                                    'customer_id' => $customer_id,
                                    'recharge_amount' => $advance_payment,
                                    'user_id' => '1',
                                    'recharge_date' => $time_stamp,
                                );
                                if($this->db->insert('recharge_detail',$arr5)){
                                    $this->db->where('customer_id',$customer_id);
                                    $this->db->set('last_recharge_date',$time_stamp);
                                    if($this->db->update('atm_card_detail')){

                                     if(strlen($firstname) > 15){
                                      $cus_name = substr($firstname,0, 15);
                                     }else{
                                         $cus_name = $firstname;
                                     }
                                    //ragistration msg
									$msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
									//***************************//
                                    // ******** send sms *******//
									//**************************//
					               
									$url = $msg_server."?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&card_no=".$card_no."&template=ragistration&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
                                        
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//


                                    // recharge msg
                                     
									 
									//***************************//
                                    // ******** send sms *******//
									//**************************//
					
									$url = $msg_server."?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&recharge_amount=".+$advance_payment."&avl_balance=".+$advance_payment."&card_no".$card_no."&template=recharge&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//
									 
                                     //print_r($result);
                                     redirect('./customer/manage_requirement_account_setup/'.$customer_id);

                                    }else{
                                        return "failed";
                                    }

                                }
                            }else{
                                    if(strlen($firstname) > 15){
                                        $cus_name = substr($firstname,0, 15);
                                     }else{
                                         $cus_name = $firstname;
                                     }
                                    //ragistration msg
                                    //***************************//
                                    // ******** send sms *******//
									//**************************//
					                $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
									$url = $msg_server."?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&card_no=".$card_no."&template=ragistration&client_url=".base_url();  
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//
                                     
                                   //print_r($result);
                                      redirect('./customer/manage_requirement_account_setup/'.$customer_id);
                            }
                        }else{
                            return "failed";
                        }
                    }else{
                        return "failed";
                    }

		    }else{
			    return "failed";
		    };
		}else{
             $this->db->select('*');
             $this->db->from('atm_card_detail');
             $this->db->where('atm_card_no',$card_no);
             $this->db->where_in('card_status',array('active','blocked'));
             //$this->db->where_in('card_status','blocked');

            $check_status = $this->db->get();
            if($check_status->num_rows() == 1){
               return 'taken';

            }else{
                return 'lost';

            }

        }
        }else{

			return "invalid";
		}
	}

  
    public function manage_requirement_schedule_month($day_array,$id,$d_schedule,$action){

        $check = $this->db->get_where('estimated_product_details',array('customer_id' => $id));
        if($check->num_rows() > 0){
           $this->db->where('customer_id',$id);
           $this->db->set('d_schedule','month');
           if($this->db->update('customer_details')){    
            
            foreach(json_decode($day_array) as $row){
              $check_es = $this->db->get_where('estimated_product_month_chart',array('estimated_id'=> $row->estimated_id));   
               if($check_es->num_rows() == 1){   
                $this->db->where('estimated_id',$row->estimated_id);
                foreach(json_decode($row->qty) as $r_row){
                   $a = array (
                       array(
                       "morning" => floatval($r_row->morning),
                       "evening" => floatval($r_row->evening),
                       ),);
                    $a_encode  = json_encode($a);
                   $this->db->set('day_'.$r_row->day, $a_encode);
                    
                }
                $this->db->update('estimated_product_month_chart');
               
              }else{
                $this->db->set('estimated_id',$row->estimated_id);
                foreach(json_decode($row->qty) as $r_row){
                   $a = array (
                       array(
                       "morning" => floatval($r_row->morning),
                       "evening" => floatval($r_row->evening),
                       ),);
                    $a_encode  = json_encode($a);
                  $this->db->set('day_'.$r_row->day, $a_encode);
                }
                $this->db->insert('estimated_product_month_chart');
               }
            }
          
            }
            
           if($action == 'account_setup'){
              redirect(base_url().'customer/view_customer/'.$id.'/001');
           }else{
              redirect(base_url().'customer/manage_requirement/'.$id.'?delivery_schedule=Month');
           }
        }
    }
    
    
    public function manage_requirement_schedule_week($day_array,$id,$d_schedule,$action){
        
        $check = $this->db->get_where('estimated_product_details',array('customer_id' => $id));
        if($check->num_rows() > 0){
                 
           $this->db->where('customer_id',$id);
           $this->db->set('d_schedule','week');
           if($this->db->update('customer_details')){    

            foreach(json_decode($day_array) as $row){
               $check_es = $this->db->get_where('estimated_product_week_chart',array('estimated_id'=> $row->estimated_id));    
               if($check_es->num_rows() == 1){    
               $this->db->where('estimated_id',$row->estimated_id);
                $r_row = json_decode($row->qty);
                    
                    $a = array (array("morning" => floatval($r_row[0]->morning),"evening" => floatval($r_row[0]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('sun', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[1]->morning),"evening" => floatval($r_row[1]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('mon', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[2]->morning),"evening" => floatval($r_row[2]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('tue', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[3]->morning),"evening" => floatval($r_row[3]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('wed', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[4]->morning),"evening" => floatval($r_row[4]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('thu', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[5]->morning),"evening" => floatval($r_row[5]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('fri', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[6]->morning),"evening" => floatval($r_row[6]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('sat', $a_encode);
 
                $this->db->update('estimated_product_week_chart');
               }else{
                   
                   $this->db->set('estimated_id',$row->estimated_id);
                   $r_row = json_decode($row->qty);
                    $a = array (array("morning" => floatval($r_row[0]->morning),"evening" => floatval($r_row[0]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('sun', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[1]->morning),"evening" => floatval($r_row[1]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('mon', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[2]->morning),"evening" => floatval($r_row[2]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('tue', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[3]->morning),"evening" => floatval($r_row[3]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('wed', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[4]->morning),"evening" => floatval($r_row[4]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('thu', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[5]->morning),"evening" => floatval($r_row[5]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('fri', $a_encode);
                
                    $a = array (array("morning" => floatval($r_row[6]->morning),"evening" => floatval($r_row[6]->evening),),);
                    $a_encode  = json_encode($a);
                    $this->db->set('sat', $a_encode);
                    $this->db->insert('estimated_product_week_chart');
                   
               }
             } 
            }
            
           
        }
        
        if($action == 'account_setup'){
              redirect(base_url().'customer/view_customer/'.$id.'/001');
        }else{
             redirect(base_url().'customer/manage_requirement/'.$id.'?delivery_schedule=Week');
        }
        
        
    }
    
    
    public function manage_requirement_schedule_daily($day_array,$id,$action){
        
        $check = $this->db->get_where('estimated_product_details',array('customer_id' => $id));
        
        if($check->num_rows() > 0){
            
           $this->db->where('customer_id',$id);
           $this->db->set('d_schedule','daily');
           if($this->db->update('customer_details')){    
                
                foreach(json_decode($day_array) as $row){
                    
                    $this->db->where('customer_id',$id);
                    $this->db->where('product_id',$row->product_id);
                    $this->db->set('morning_shift_qty',floatval($row->morning));
                     $this->db->set('evening_shift_qty',floatval($row->evening));
                    $this->db->update('estimated_product_details');
                    
                }
               
               
           }
        
        
        }
         if($action == 'account_setup'){
              redirect(base_url().'customer/view_customer/'.$id.'/001');
        }else{
             redirect(base_url().'customer/manage_requirement/'.$id.'?delivery_schedule=everyday');
        }
        
    }
    
    public function selected_requested_product($request_id){
        
        $this->db->select('*');
        $this->db->from('membership_requests');
        $this->db->where('request_id',$request_id);
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
    
    public function select_estimated_product($id){

                $this->db->select('*, estimated_product_details.estimated_id AS es_id');
		    	$this->db->from('estimated_product_details');
                $this->db->where('customer_id',$id);
                $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
               $this->db->join('estimated_product_week_chart','estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id','left');
               $this->db->join('estimated_product_month_chart','estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id','left');
          
		    	$data = $this->db->get();
                return $data->result();

     }
    
    
    public function selected_customer($id){
        
                $this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->where('customer_id',$id);
		    	$data = $this->db->get();
                return $data->result();
        
    }

    public function select_agent(){

                $this->db->select('*');
		    	$this->db->from('team_member');
		    	$data = $this->db->get();
                return $data->result();

     }

     public function select_recharge_limit(){

        $this->db->select('*');
        $this->db->from('recharge_limit');
        $data = $this->db->get();
        return $data->result();

    }

    public function select_product(){
                $this->db->select('*');
		    	$this->db->from('dairy_products');
		    	$data = $this->db->get();
                return $data->result();
    }

   
	public function edit_customer_submit($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$agent,$estimate_product,$shift_selected  ,$ac_type, $balance_restricted){

		$check = $this->db->get_where('customer_details',array('customer_id' => $card_no));

		if($check->num_rows() == 1){

			$arr = array(

		    'first_name' => $firstname,
			'last_name' => $lastname,
            'email_address' => $email,
			'contact_1' => $mobileno,
            'contact_2' => $mobileno2,
			'address_1' => $address1,
			'address_2' => $address2,
			'colony_id' => $colony,
            'shift_id' => $shift_selected,
            'd_type_id' => $delivery_type,
            'ac_type' => $ac_type,
            'balance_restricted' =>  $balance_restricted,   
            'assigned_user_id'   => $agent,
			'city' => $city,

		    );

		    $this->db->where('customer_id',$card_no);
		    if($this->db->update('customer_details',$arr)){
		    	  foreach(json_decode($estimate_product) as $row){
                              //echo $card_no;

                                 $this->db->where('customer_id',$card_no);
                                 $this->db->where('product_id',$row->product_id);
                              
                                 $this->db->set('selling_margin',$row->selling_margin);
                                 $this->db->update('estimated_product_details');
                            } 
                
                
		    	 redirect('./customer/view_customer/'.$card_no.'/002');

		    }else{

			return "failed";
		    };


		}else{

			return "invalid";
		}



	}

	public function fetch_customer(){


		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('ac_assign','yes');
		$data = $this->db->get();
		return $data->result();


	}


	public function view_customer($linked_no){

		$this->db->select('*,customer_details.password as customer_password,');
		$this->db->from('customer_details');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
         $this->db->join('delivery_shift','delivery_shift.shift_id = customer_details.shift_id','left');
        $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
        $this->db->join('team_member', 'team_member.user_id = customer_details.assigned_user_id');
        $this->db->where('customer_details.customer_id',$linked_no);
		$data = $this->db->get();
		return $data->result();


	}
    
    public function view_terminated_customer($linked_no){

		$this->db->select('*,customer_details.password as customer_password,');
		$this->db->from('customer_details');
        
        $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
        $this->db->join('team_member', 'team_member.user_id = customer_details.assigned_user_id');
        $this->db->where('customer_details.customer_id',$linked_no);
		$data = $this->db->get();
		return $data->result();


	}

    public function assign_card($customer_id,$old_card,$new_card,$card_status){

       $check   = $this->db->get_where('atm_card_detail', array('atm_card_no' => $new_card));
      if($check->num_rows() == 1){
          $check_aval = $this->db->get_where('atm_card_detail', array('atm_card_no' => $new_card, 'customer_id' => null, 'card_status' => ''));
          if($check_aval->num_rows() == 1){

            date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $time_stamp = $date->format('Y-m-d H:i:s');
            $last_transaction_date = $this->db->get_where('atm_card_detail', array('atm_card_no' => $old_card, 'customer_id' => $customer_id));

           $arr = array(

               'customer_id' => $customer_id,
               'card_status' => 'active',
               'card_assign_time' => $time_stamp,
               'last_transaction_date' => $last_transaction_date->result()[0]->last_transaction_date,
               'last_recharge_date' => $last_transaction_date->result()[0]->last_recharge_date,
           );

          $this->db->where('atm_card_no',$new_card);
          if($this->db->update('atm_card_detail',$arr)){

              $arr2 = array(
                  'customer_id' => null,
                  'card_status' => $card_status,
                  'card_assign_time' => '',
                  'last_transaction_date' => '',
                  'last_recharge_date' => '',

              );
              $this->db->where('atm_card_no',$old_card);
              if($this->db->update('atm_card_detail',$arr2)){
                                  $this->db->select('*');
                                  $this->db->from('customer_details');
                                  $this->db->where('customer_details.customer_id',$customer_id);
                                  $get_name = $this->db->get();

                                  if($get_name->num_rows() == 1){
                                      $cus_first_name = $get_name->result()[0]->first_name;
                                      if(strlen($cus_first_name) > 15){
                                         $cus_name = substr($cus_first_name,0, 15);
                                       }else{
                                         $cus_name = $cus_first_name;
                                       }

                                      $mobile_no = $get_name->result()[0]->contact_1;

                                    if(isset($cus_name,$new_card,$mobile_no)){
                                    //***************************//
                                    // ******** send sms *******//
									//**************************//
					                $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php';
									$url = $msg_server."?mobile_no=".$mobile_no."&name=".urlencode($cus_name)."&card_no=".$new_card."&template=change_card&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//
                                      }
                                      }
                  return "success";
              }else{

                  return "failed";
              }


          }else{

                  return "failed";
              }
          }else{
             $this->db->select('*');
             $this->db->from('atm_card_detail');
             $this->db->where('atm_card_no',$new_card);
             $this->db->where_in('card_status',array('active','blocked'));
             //$this->db->where_in('card_status','blocked');

            $check_status = $this->db->get();
            if($check_status->num_rows() == 1){
               return 'assigned';

            }else{
                return 'lost';

            }

          }
      }else{

          return "invalid";
      }


    }
	public function edit_customer($linked_no){
		    $this->db->select('*');
		    $this->db->from('customer_details');
	    	$this->db->where('customer_details.customer_id',$linked_no);
        $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
		    $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
        $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
        $data = $this->db->get();
		    return $data->result();
	}

    public function edit_customer_products($linked_no){
        $this->db->select('*');
		    $this->db->from('estimated_product_details');
		    $this->db->where('estimated_product_details.customer_id',$linked_no);
        $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
        $data = $this->db->get();
		    return $data->result();
    }

    public function recharge_account($recharge_value,$link_id,$r_mobile){

        $check = $this->db->get_where('current_balance',array('customer_id' => $link_id));

        if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$total_ballance = ($ac_ballance+$recharge_value);
            $arr = array(
		        'balance_amount' => $total_ballance,
		        );
		    $this->db->where('customer_id',$link_id);
            if($this->db->update('current_balance',$arr)){
                    date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$re_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');
                $arr2 = array(
                    'customer_id' => $link_id,
                    'recharge_amount' => $recharge_value,
                    'user_id' =>  '1',
                    'recharge_date' => $time_stamp,

                );
                if($this->db->insert('recharge_detail',$arr2)){
						$this->db->where('customer_id',$link_id);
                        $this->db->set('last_recharge_date',$time_stamp);
                        if($this->db->update('atm_card_detail')){

                            if(isset($r_mobile,$total_ballance)){
                             $this->db->select('*');
                             $this->db->from('customer_details');
                             $this->db->where('customer_details.customer_id',$link_id);
                             $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
                             $customer_name_get = $this->db->get();
                            if($customer_name_get->num_rows() == 1){
                                $customer_name = $customer_name_get->result()[0]->first_name;
                                if(strlen($customer_name) > 15){
                                    $cus_name = substr($customer_name,0, 15);
                                }else{
                                    $cus_name = $customer_name;
                                }
                                $atm_card = $customer_name_get->result()[0]->atm_card_no;
                               }else{
                                  $cus_name = 'customer';
                                  $atm_card = 'card_no';
                               }
							        //***************************//
                                    // ******** send sms *******//
									//**************************//
					                $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php';
									$url = $msg_server."?mobile_no=".$r_mobile."&name=".urlencode($cus_name)."&recharge_amount=".+$recharge_value."&avl_balance=".+$total_ballance."&card_no=".$atm_card."&template=recharge&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//

                               echo 'success';

                            }
                        }else{
                            echo "fail";
                        }
				}else{
                    echo "fail";
                };

            }else{
                echo "fail";
            }

        }

    }


    public function block_accout($link_id){
        $arr = array(
		        'card_status' => 'blocked',
		        );

        $this->db->where('customer_id',$link_id);

        if($this->db->update('atm_card_detail',$arr)){

                echo "success";
            }else{
                echo "fail";
            }

    }

    public function unblock_accout($link_id){
                    date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$current_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');

        $arr = array(
		        'card_status' => 'active',
                'last_transaction_date' => $time_stamp,
		        );

        $this->db->where('customer_id',$link_id);

        if($this->db->update('atm_card_detail',$arr)){

                echo "success";
            }else{
                echo "fail";
            }

    }
    public function delete_customer($link_id){

		$arr = array(
            'customer_id' => null,
            'card_status' => '',
            'card_assign_time' => '',
            'last_transaction_date' => '',
            'last_recharge_date' => '',
		    );

		    $this->db->where('customer_id',$link_id);
		    if($this->db->update('atm_card_detail',$arr)){
                $this->db->where('customer_id',$link_id);
                $check = $this->db->get('current_balance');
                if($check->num_rows() == 1){
					
					$returning_amount = $check->result()[0]->balance_amount;
					
                    date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$current_date = $date->format('Y-m-d');

                     $arr2 = array(
                           'customer_id' => $link_id,
                           'amount_returned' => $check->result()[0]->balance_amount,
                           'terminate_date' => $current_date,

                     );
                    if($this->db->insert('terminated_customer',$arr2)){
                          $arr3 = array(
                              'customer_status' => 'terminated',
                          );
                          $this->db->where('customer_id',$link_id);
                          if($this->db->update('customer_details',$arr3)){
                              $this->db->where('customer_id',$link_id);
                              if($this->db->delete('current_balance')){

                                  $this->db->where('customer_id',$link_id);
                                  $this->db->delete('estimated_product_details');
                                  
                                  
                                  $check_ragistration = $this->db->get_where('customer_ragistration',array('assigned_customer_id' => $link_id));
                                  
                                  if($check_ragistration->num_rows() == 1){
                                  
                                  $this->db->where('assigned_customer_id',$link_id);
                                   $this->db->set('assigned_customer_id',0);
                                  $this->db->set('ragistration_status','');
                                  $this->db->update('customer_ragistration');
                                  }
                                  $this->db->select('*');
                                  $this->db->from('customer_details');
                                  $this->db->where('customer_details.customer_id',$link_id);
                                  $this->db->join('terminated_customer','terminated_customer.customer_id = customer_details.customer_id');
                                  $get_name = $this->db->get();

                                  if($get_name->num_rows() == 1){
                                      $cus_first_name = $get_name->result()[0]->first_name;
                                      if(strlen($cus_first_name) > 15){
                                         $cus_name = substr($cus_first_name,0, 15);
                                      }else{
                                         $cus_name = $cus_first_name;
                                      }

                                      $return_amount = $get_name->result()[0]->amount_returned;
                                      $mobile_no = $get_name->result()[0]->contact_1;

                                    if(isset($cus_name,$return_amount,$mobile_no)){

									//***************************//
                                    // ******** send sms *******//
									//**************************//
					                $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php';
									$url = $msg_server."?mobile_no=".$mobile_no."&name=".urlencode($cus_name)."&avl_balance=".+$returning_amount."&template=terminate&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
									//**************************//
										
										
                                      }

                                  }
                                  echo "success";
                              }else{
                                  echo "failed";
                              }
                          }else{

                              echo "failed";
                          }

                    }else{

                        echo "failed";
                    }


                }else{

                    echo "failed";
                }

	     }else{

                    echo "failed";
                }

    }



    public function customer_tran_report($id){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
                $this->db->where('customer_id',$id);
                $this->db->where('MONTH(transaction_date)',date('m'));
                $this->db->where('YEAR(transaction_date)',date('Y'));
		        $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');

		    	$data = $this->db->get();

              if($data->num_rows() > 0){
		         $i=1; foreach($data->result() as $row){

                       echo '<tr>';
                       echo '<td>'.$i++.'</td>';
                       echo '<td>'.date('d-M-Y', strtotime($row->transaction_date)).'</td>';
                       echo '<td>'.$row->transaction_amount.'</td>';
                       echo '<td>'.$row->product_name.'</td>';
                       echo '<td>'.$row->name.'</td>';
                       echo '<td><a href="'.base_url().'/customer/delete_transaction/'.$row->transaction_id.'/'.$row->customer_id.'"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a></td>';
                       echo '</tr>';


                  }

              }else{

                       echo '<tr>';
                       echo '<td>No Record Found</td>';

                       echo '</tr>';
              }


    }

    public function delete_transaction($transaction_id,$customer_id){
        $check = $this->db->get_where('transaction_detail', array('transaction_id' => $transaction_id));

        if($check->num_rows() == 1){
            echo "gg";
            $amount = $check->result()[0]->transaction_amount;

            $this->db->where('transaction_id',$transaction_id);
            if($this->db->delete('transaction_detail')){

                $this->db->set('balance_amount', 'balance_amount + '.$amount,FALSE);
                $this->db->where('customer_id',$customer_id);
                if($this->db->update('current_balance')){

                    redirect('./customer/view_customer/'.$customer_id.'/transaction');
                }

            }
        }else{
            echo "something wrong";
        }

    }
     public function delete_recharge($transaction_id,$customer_id){
        $check = $this->db->get_where('recharge_detail', array('recharge_id' => $transaction_id));

        if($check->num_rows() == 1){

            $amount = $check->result()[0]->recharge_amount;

            $this->db->where('recharge_id',$transaction_id);
            if($this->db->delete('recharge_detail')){

                $this->db->set('balance_amount', 'balance_amount - '.$amount,FALSE);
                $this->db->where('customer_id',$customer_id);
                if($this->db->update('current_balance')){

                    redirect('./customer/view_customer/'.$customer_id.'/recharge');
                }

            }
        }else{
            echo "something wrong";
        }

    }

    public function customer_rech_report($id){
                 $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->where('customer_id',$id);
                $this->db->where('MONTH(recharge_date)',date('m'));
                $this->db->where('YEAR(recharge_date)',date('Y'));
		        $this->db->order_by('recharge_date','DESC');
		        $this->db->order_by('recharge_id','DESC');
		    	$data = $this->db->get();

              if($data->num_rows() > 0){
		         $i=1; foreach($data->result() as $row){

                       echo '<tr>';
                       echo '<td>'.$i++.'</td>';
                       echo '<td>'.date('d-M-Y', strtotime($row->recharge_date)).'</td>';
                       echo '<td>'.$row->recharge_amount.'</td>';
                       echo '<td>'.$row->name.'</td>';
                       echo '<td><a href="<?php echo base_url(); ?>/customer/delete_recharge/'.$row->recharge_id.'/'.$row->customer_id.'"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a></td>';
                       echo '</tr>';


                  }

              }else{

                       echo '<tr>';
                       echo '<td>No Record Found</td>';

                       echo '</tr>';
              }

    }

    public function customer_rech_report2($id){
                $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
                $this->db->where('recharge_detail.customer_id',$id);
		        $this->db->order_by('recharge_date','DESC');
		        $this->db->order_by('recharge_id','DESC');
                $this->db->limit(10);
		    	$data = $this->db->get();
                return $data->result();


    }

    public function customer_tran_report2($id){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
                $this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id');
                $this->db->where('customer_id',$id);
		        $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
                $this->db->limit(10);
		    	$data = $this->db->get();
                return $data->result();


    }
    
    
    public function terminated_customer_rech_report2($id){
                $this->db->select('*');
		    	$this->db->from('recharge_detail');
                $this->db->join('team_member', 'team_member.user_id = recharge_detail.user_id');
                $this->db->where('recharge_detail.customer_id',$id);
		        $this->db->order_by('recharge_date','DESC');
		        $this->db->order_by('recharge_id','DESC');
		    	$data = $this->db->get();
                return $data->result();


    }

    public function terminated_customer_tran_report2($id){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
                $this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id');
                $this->db->where('customer_id',$id);
		        $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                return $data->result();


    }
    
    
    public function customer_vacation($linked_no){
                $this->db->select('*');
		    	$this->db->from('vacation');
               
                $this->db->where('vacation.customer_id',$linked_no);
		        $this->db->order_by('vacation_id','DESC');
		    	$data = $this->db->get();
                return $data->result();
        
    }
    
    
    public function add_vacation($start,$end,$v_customer_id,$multidate){
        
        
        
        
        if($multidate){
            
            $ex = explode(",",$multidate);
            
            foreach($ex as $row){
                
                $val = date('Y-m-d',strtotime($row));
                
                 $arr2 = array(
        
                    'customer_id' => $v_customer_id,
                    'start_date' => $val,
                    'end_date'  => $val,
                     'shift' => 'morning',
         
                 );
                $this->db->insert('vacation',$arr2);
            
            }
            
             redirect(base_url().'customer/view_customer/'.$v_customer_id.'/vacation');
        }else if($start || $end){
        
        
        $arr = array(
        
              'customer_id' => $v_customer_id,
              'start_date' => $start,
              'end_date'  => $end,
               'shift' => 'morning',
         
        );
        
        
        if($this->db->insert('vacation',$arr)){
            
            redirect(base_url().'customer/view_customer/'.$v_customer_id.'/vacation');
            
        }else{
            
            redirect(base_url().'customer/view_customer/'.$v_customer_id.'/vacation');
        }
        }else{
            redirect(base_url().'customer/view_customer/'.$v_customer_id.'/vacation');
     }
        
    }
    
    
    public function delete_vacation($del_id){
        
        $this->db->where('vacation_id',$del_id);
       if($this->db->delete('vacation')){
            
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    
    
//=========********===========********========******========//
// ************ Customer orders List ***********//
//=========********===========********========******========// 
    
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



}
