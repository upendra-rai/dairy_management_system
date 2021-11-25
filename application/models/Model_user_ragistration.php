<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_user_ragistration extends CI_Model {



	function __construct(){



		parent::__construct();

	}

    public function customer_ragistration_detail($status)
    {
			$this->db->select('*');
			$this->db->from('customer_ragistration');
			$this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
			if($status && $status != 'all'){
				  if($status == 'pending'){
						$status = '';
                        $this->db->where_in('ragistration_status',['canceled',$status]);
					}else{
                      $this->db->where('ragistration_status',$status);
                  }
					
			}
			$this->db->order_by('ragistration_id','DESC');

			$data = $this->db->get();
			return $data->result();
    }

    public function read_request($request_id){
        
        $this->db->where('membership_request_id',$request_id);
        $this->db->set('notification_status','completed');
        $this->db->update('admin_notification');
        
    }
    
    public function customer_ragistration_filter($customer_name,$colony,$status){
            $this->db->select('*');
			$this->db->from('customer_ragistration');
			$this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
            if($status != ''){
                if($status != 'all'){
					$this->db->where('ragistration_status',$status);
                }
			}else{
                $this->db->where('ragistration_status','');
            }

            if($customer_name != ''){
                   $this->db->like('customer_nmae',$customer_name);

            }
           if($colony != ''){
                   $this->db->where('customer_ragistration.colony_id',$colony);

            }
            $data = $this->db->get();
			return $data->result();
    }


		public function cancel_ragistration($ragistration_id)
		{
			 $this->db->where('ragistration_id',$ragistration_id);
			 $this->db->set('ragistration_status','canceled');
			 if($this->db->update('customer_ragistration')){
				 echo 'success';
			 }else {
			 	echo 'failed';
			 }
		}

    public function selected_ragister_customer($ragister_id){

        $this->db->select('*');
        $this->db->from('customer_ragistration');
        $this->db->where('ragistration_id',$ragister_id);
        $this->db->join('membership_requests','membership_requests.guest_id = customer_ragistration.ragistration_id','left');
        $data = $this->db->get();
        return $data->result();

    }

		public function add_customer_submit_for_ragistered_customers($firstname,$lastname,$mobileno,$mobileno2,$email,$address1,$address2,$colony,$city,$delivery_type,$advance_payment,$card_no,$shift,$agent,$ragister_id,$estimate_product,$request_id,$card_type)
		{
            
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
					    'assigned_user_id' =>   $agent,
					    'ragistration_date' => $time_stamp,
			  );
			 if($this->db->insert('customer_details',$arr)){
				      $customer_id = $this->db->insert_id();
							// inserting customer product requirements
							foreach(json_decode($estimate_product) as $row){
                               $arrr = array(
                                'customer_id' => $customer_id,
                                'product_id' => $row->product_id,
                                
                                'selling_margin' => $row->selling_margin,
                               );

                               $this->db->insert('estimated_product_details',$arrr);
                            }
                // insert customer id into  customer ragistration table
								$this->db->where('ragistration_id',$ragister_id);
								$this->db->set('ragistration_status','completed');
								$this->db->set('assigned_customer_id',$customer_id);
								$this->db->update(customer_ragistration);
								// inserting atm card details
								$arr3 = array(
											 'customer_id' => $customer_id,
											 'card_status' => 'active',
											 'card_assign_time' => $time_stamp,
											 //'last_transaction_date' => $time_stamp,
								);
								$this->db->where('atm_card_no', $card_no);
								if($this->db->update('atm_card_detail', $arr3)){
									// inserting customer current balance
											$arr4 = array(
													'customer_id' => $customer_id,
													'balance_amount' => $advance_payment,
											);
											if($this->db->insert('current_balance', $arr4)){
												 // inserting customer delivery shift details
													if($shift === '3'){
															 $arr7 = array(
																		'customer_id' => $customer_id,
																		'shift_id' => '1',
																		'status' => '',
																);
																if($this->db->insert('delivery_status',$arr7)){
																		$arr8 = array(
																		'customer_id' => $customer_id,
																		'shift_id' => '2',
																		'status' => '',
																		);
																		$this->db->insert('delivery_status',$arr8);
																}
													}else{
															 $arr9 = array(
																		'customer_id' => $customer_id,
																		'shift_id' => $shift,
																		'status' => '',
																);
																$this->db->insert('delivery_status',$arr9);
													}
                                                
                                                    //********** transafer old ragister account data *******//
                                                    //********** transafer old ragister account data *******//
                                                           
                                                      $check_old_transaction = $this->db->get_where('transaction_detail', array('guest_id' => $ragister_id));
                                                      if($check_old_transaction->num_rows() > 0){
                                                           $this->db->where('guest_id',$ragister_id);
                                                           $this->db->set('customer_id',$customer_id);
                                                           $this->db->set('guest_id',null);
                                                           $this->db->set('customer_type','membership');
                                                           $this->db->update('transaction_detail');
                                                      }
                                                
                                                      $check_old_recharge = $this->db->get_where('recharge_detail', array('guest_id' => $ragister_id));
                                                      if($check_old_recharge->num_rows() > 0){
                                                           $this->db->where('guest_id',$ragister_id);
                                                           $this->db->set('customer_id',$customer_id);
                                                           $this->db->set('guest_id',null);
                                                           $this->db->set('customer_type','membership');
                                                           $this->db->update('recharge_detail');
                                                      }
                                                
                                                      $check_orders = $this->db->get_where('online_orders', array('guest_id' => $ragister_id));
                                                      if($check_orders->num_rows() > 0){
                                                           $this->db->where('guest_id',$ragister_id);
                                                           $this->db->set('customer_id',$customer_id);
                                                           $this->db->set('guest_id',null);
                                                           $this->db->set('order_type','membership');
                                                           $this->db->update('online_orders');
                                                          
                                                      }
                                                
                                                      $this->db->where('guest_id',$ragister_id);
                                                      $this->db->where('notification_type','membership_request');
                                                      $this->db->set('notification_status','completed');
                                                      $this->db->update('admin_notification');
                                                    //********** transafer old ragister account data *******//
                                                    //********** transafer old ragister account data *******//
													// checking customer advance payment request
													if($advance_payment !== "" && $advance_payment > 0){

														 // inserting customer recharge details
															$arr5 = array(
																	'customer_id' => $customer_id,
																	'recharge_amount' => $advance_payment,
																	'user_id' => '1',
																	'recharge_date' => $time_stamp,
															);
															if($this->db->insert('recharge_detail',$arr5)){

																 // inserting customer last recharge detail
																	$this->db->where('customer_id',$customer_id);
																	$this->db->set('last_recharge_date',$time_stamp);
																	if($this->db->update('atm_card_detail')){
																	 if(strlen($firstname) > 15){
																		$cus_name = substr($firstname,0, 15);
																	 }else{
																			 $cus_name = $firstname;
																	 }
                                                                        
                                                                     //ragistration msg
									
									//***************************//
                                    // ******** send sms *******//
									//**************************//
					
									$url = base_url()."send_dms_msg.php?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&card_no=".$card_no."&template=ragistration"; 
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
					
									$url = base_url()."send_dms_msg.php?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&recharge_amount=".+$advance_payment."&avl_balance=".+$advance_payment."&template=recharge"; 
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
                                                                        
																	//ragistration msg
																	
																	 redirect('./customer/manage_requirement_account_setup/'.$customer_id.'/'.$request_id);

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
				                                 	
				                                 					$url = base_url()."send_dms_msg.php?mobile_no=".$mobileno."&name=".urlencode($cus_name)."&card_no=".$card_no."&template=ragistration"; 
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
				                                 			    //$check =  json_decode($result);
																	 //print_r($result);
																	 redirect('./customer/manage_requirement_account_setup/'.$customer_id.'/'.$request_id);
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

public function select_colony(){

		$this->db->select('*');
		 $this->db->from('colony_detail');
		 $this->db->order_by('colony_name','ASC');
		 $data = $this->db->get();
		 return $data->result();

}

}
