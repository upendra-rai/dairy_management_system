<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_app_interface extends CI_Model {



	function __construct(){



		parent::__construct();
		
		
		 

	}



	public function team_login_model($data1,$data2){



		$check = $this->db->get_where('team_member', array(

					'user_name like binary' => $data1,

					'password' => $data2,


				));


		if($check->num_rows() == 1){
          echo $check->result()[0]->user_id;

    }else{
		echo "failed";
	}
    }


	public function customer_login_model($email,$password){
		   $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->where('atm_card_no',$email);
        $this->db->where('password like binary',$password);
        $check = $this->db->get();
		   if($check->num_rows() == 1){
            echo $check->result()[0]->customer_id;
       }else{
	    	echo "failed";
	     }
	}

	public function newragister_customer_login($email,$password)
	{
		$check_user = $this->db->get_where('customer_ragistration',array('ragistration_user_id' => $email, 'ragistration_password' => $password,));

		if($check_user->num_rows() == 1){
			  $ragistration_status = $check_user->result()[0]->ragistration_status;
			  $new_customer_id = $check_user->result()[0]->assigned_customer_id;
			  $ragistration_id = $check_user->result()[0]->ragistration_id;
			    if($ragistration_status == 'completed'){
					 return array(
		               'customer_id' => $new_customer_id,
		               'customer_role' => 'customers',
					  
		             );
				}else{
					if($ragistration_id){
					  return array(
		               'customer_id' => $ragistration_id,
		               'customer_role' => 'ragister_customer',
		              );
				    }else{
 	    	        return array(
		               'customer_id' => 'no',
		               'customer_role' => 'no',
		              );
 	               }
				}
    }else{
		 return array(
		               'customer_id' => 'no',
		               'customer_role' => 'no',
		              );
		}
 }

	public function user_profile_agent($login_email){

        $this->db->select('*');
        $this->db->from('team_member');
		$this->db->where('user_id', $login_email);
        $data = $this->db->get()->result();

		return $data;

    }

	public function user_profile_customer($login_email){

        $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->where('customer_details.customer_id', $login_email);
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
        $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
        $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
		    $data = $this->db->get()->result();
	    	return $data;

    }

		public function user_profile_for_ragister_customer($login_email)
		{
			$check_user = $this->db->get_where('customer_ragistration',array('ragistration_id' => $login_email));

			if($check_user->num_rows() == 1){
          $ragistration_status = $check_user->result()[0]->ragistration_status;

					if($ragistration_status === 'completed'){
						 $customer_id = $check_user->result()[0]->assigned_customer_id;
             if($customer_id){
						 $this->db->select('*');
		         $this->db->from('customer_details');
		         $this->db->where('customer_details.customer_id', $customer_id);
		         $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
		         $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
		         $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
		         $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
		 		     $data = $this->db->get()->result();

						 return array(
		               'customer_data' => $data,
		               'customer_role' => 'customers',
					   'new_customer_id' => $customer_id,
		             );

					   }
					}else{
						$this->db->select('*');
						$this->db->from('customer_ragistration');
						$this->db->where('customer_ragistration.ragistration_id', $login_email);
                        $this->db->join('guest_current_balance','guest_current_balance.guest_id = customer_ragistration.ragistration_id');
						$data = $this->db->get()->result();
						return array(
									'customer_data' => $data,
									'customer_role' => 'ragister_customer',
									'new_customer_id' => 'not_assign',
								);
					}
			}

		}

	public function fetch_barcode_data($barcode_id){

        $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
        $this->db->where('qr_code', $barcode_id);
        $check_delivery_schedule = $this->db->get();
        
        if($check_delivery_schedule->num_rows() == 1){
        
        $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
		$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
        $this->db->join('estimated_product_details','estimated_product_details.customer_id = customer_details.customer_id');
        
        
        $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
            
        if($check_delivery_schedule->result()[0]->d_schedule == 'week' ){
             $this->db->join('estimated_product_week_chart','estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id');
        }else if($check_delivery_schedule->result()[0]->d_schedule == 'month'){
             $this->db->join('estimated_product_month_chart','estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id');
            
        }    
            
        $this->db->where('qr_code', $barcode_id);
        $data = $this->db->get()->result();

		return $data;
        }

    }

	public function quick_payment_transfer($linked_id,$value,$products,$agent_id,$product_quantity){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');

		$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' => $today_stock_date, 'user_id' => $agent_id, 'product_id' => $products));

		if($check_agent_stock->num_rows() == 1){

		if($check_agent_stock->result()[0]->remaining_qty >= $product_quantity){

        $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
		$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id , 'card_status' => 'active'));

        if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$avalible_ballance = ($ac_ballance-$value);

				$arr = array(
		        'balance_amount' => $avalible_ballance,
		        );

		    	$this->db->where('customer_id',$linked_id);
		    	if($this->db->update('current_balance',$arr)){

					$tran_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');

                    $get_time = date("H:i:s");
                    if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                        $shift_id = 1;
                    }else{
                       $shift_id = 2;
                    }

					$arr2 = array(
                        "customer_id" => $linked_id,
                        "transaction_amount" => $value,
                        "ledger" => $avalible_ballance,
                        "product_id" => $products,
						"product_quantity" => $product_quantity,
                        "user_id" =>  $agent_id,
                        "shift_id" => $shift_id,
					    "transaction_date" => $time_stamp,

					);
					if($this->db->insert("transaction_detail", $arr2)){
                        $arr3 = array(
                            "last_transaction_date" => $time_stamp,
                        );
                        $this->db->where('customer_id',$linked_id);
                        if($this->db->update('atm_card_detail',$arr3)){

                            $this->db->where('stock_date',$today_stock_date);
							$this->db->where('user_id',$agent_id);
							$this->db->where('product_id',$products);
                            $this->db->set('sold_qty','sold_qty+'.$product_quantity,FALSE);
							$this->db->set('remaining_qty','remaining_qty-'.$product_quantity,FALSE);
							if($this->db->update('agent_stock')){
								$this->db->where('stock_date',$today_stock_date);
							    $this->db->where('product_id',$products);
                                $this->db->set('sold_qty','sold_qty+'.$product_quantity,FALSE);
                                if($this->db->update('dairy_stock')){
                                $this->db->where('customer_id',$linked_id);
                                $this->db->set('last_delivery_date',$time_stamp);
                                if($shift_id == 1){
                                    $this->db->set('morning_last_delivery',$time_stamp);
                                }else if($shift_id == 2){
                                     $this->db->set('evening_last_delivery',$time_stamp);
                                }    
                                    
                                $this->db->update('customer_details');     
								echo "successful";
                                }else{
                                    echo "failed";
                                }
							}else{
                                 echo "failed";
                            }



                        }else{
                            echo "failed";
                        }

					};
		    	}else{
		    		echo "failed";
		    	};

		}else{
			echo "blocked";
		}
		}else{ echo "insufficent_stock"; }
		}else{ echo "insufficent_stock"; }
    }
	
    
    public function quick_cash_transfer($value,$products,$agent_id,$product_quantity){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');

		$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' => $today_stock_date, 'user_id' => $agent_id, 'product_id' => $products));

		if($check_agent_stock->num_rows() == 1){

		if($check_agent_stock->result()[0]->remaining_qty >= $product_quantity){


					$tran_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');

                    $get_time = date("H:i:s");
                    if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                        $shift_id = 1;
                    }else{
                       $shift_id = 2;
                    }

					$arr2 = array(
                        "customer_id" => null,
                        "transaction_amount" => $value,
                        "ledger" => null,
                        "product_id" => $products,
						"product_quantity" => $product_quantity,
                        "user_id" =>  $agent_id,
                        "shift_id" => $shift_id,
                        "customer_type" =>  'Cash',
					    "transaction_date" => $time_stamp,

					);
					if($this->db->insert("transaction_detail", $arr2)){
                    

                            $this->db->where('stock_date',$today_stock_date);
							$this->db->where('user_id',$agent_id);
							$this->db->where('product_id',$products);
                            $this->db->set('sold_qty','sold_qty+'.$product_quantity,FALSE);
							$this->db->set('remaining_qty','remaining_qty-'.$product_quantity,FALSE);
							if($this->db->update('agent_stock')){
								$this->db->where('stock_date',$today_stock_date);
							    $this->db->where('product_id',$products);
                                $this->db->set('sold_qty','sold_qty+'.$product_quantity,FALSE);
                                if($this->db->update('dairy_stock')){
                                 
								echo "successful";
                                }else{
                                    echo "failed";
                                }
							}else{
                                 echo "failed";
                            }


					};
		    	
		
		}else{ echo "insufficent_stock"; }
		}else{ echo "insufficent_stock"; }
    }
	
	
	public function daily_order_payment_transfer($linked_id,$agent_id){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
        
        
        
	    $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
	    $get_customer_requirement = $this->db->get_where('estimated_product_details',array('customer_id' => $linked_id, 'product_qty !=' => 0));
		
		
		$agent_stock_status = 'yes';
		
		if($get_customer_requirement->num_rows() > 0){
			
			$msg = '';
			
			foreach($get_customer_requirement->result() as $customer_req_row){
			
			$require_product_id = $customer_req_row->product_id;
			$require_product_qty = $customer_req_row->product_qty;
			$require_product_price = ($customer_req_row->product_price + $customer_req_row->selling_margin) * $require_product_qty;
			
			$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' =>$today_stock_date, 'user_id' => $agent_id, 'product_id' => $require_product_id, 'remaining_qty >=' => $require_product_qty));
			
			if($check_agent_stock->num_rows() > 0){
				
				
			}else{
				$agent_stock_status = 'no';
			}
			
			  if($agent_stock_status == 'yes'){
				  $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
	            	$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id , 'card_status' => 'active'));

                     if($check->num_rows() == 1){
		              	$ac_ballance = $check->result()[0]->balance_amount;
		              	$avalible_ballance = ($ac_ballance-$require_product_price);
                     
		              		$arr = array(
		                      'balance_amount' => $avalible_ballance,
		                      );
                     
		                  	$this->db->where('customer_id',$linked_id);
		                  	if($this->db->update('current_balance',$arr)){

			            		$tran_date = $date->format('Y-m-d');
                                $time_stamp = $date->format('Y-m-d H:i:s');
                        
                                $get_time = date("H:i:s");
                                if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                                    $shift_id = 1;
                                }else{
                                   $shift_id = 2;
                                }

				            	$arr2 = array(
                                    "customer_id" => $linked_id,
                                    "transaction_amount" => $require_product_price,
                                    "ledger" => $avalible_ballance,
                                    "product_id" => $require_product_id,
				            		"product_quantity" => $require_product_qty,
                                    "user_id" =>  $agent_id,
                                    "shift_id" => $shift_id,
				            	    "transaction_date" => $time_stamp,
                            
				            	);
				            	if($this->db->insert("transaction_detail", $arr2)){
                                    $arr3 = array(
                                        "last_transaction_date" => $time_stamp,
                                    );
                                    $this->db->where('customer_id',$linked_id);
                                    if($this->db->update('atm_card_detail',$arr3)){
                            
                                        $this->db->where('stock_date',$today_stock_date);
				            			$this->db->where('user_id',$agent_id);
				            			$this->db->where('product_id',$require_product_id);
                                    $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
						        	$this->db->set('remaining_qty','remaining_qty-'.$require_product_qty,FALSE);
					         		if($this->db->update('agent_stock')){
					         			$this->db->where('stock_date',$today_stock_date);
					         		    $this->db->where('product_id',$require_product_id);
                                         $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
                                         if($this->db->update('dairy_stock')){
                                           
                                           $this->db->where('customer_id',$linked_id);
                                           $this->db->set('last_delivery_date',$time_stamp);
                                           $this->db->update('customer_details');     
                                             
                                             
					         			   $msg = "successful";
                                         }else{
                                             $msg = "failed";
                                         }
					         		}else{
                                          $msg = "failed";
                                     }
                        }else{
                            $msg = "failed";
                        }

					};
		    	}else{
		    		$msg = "failed";
		    	};

		}else{
			$msg = "blocked";
		}
				  
			  }else{
				  $msg = "insufficent_stock";
			  }
			  
			}
		}else{
			$msg = "insufficent_stock";
		}
	   
	   echo $msg;

    }
    
    
    
    public function daily_order_payment_transfer_morning($linked_id,$agent_id){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
        $today_day = $date->format('j');
        $str_day = 'day_'.$today_day;
        
        $week_day  = $date->format('w');
        $week_array = array('sun','mon','tue','wed','thu','fri','sat');
        $current_week_day = $week_array[$week_day];
        
	  
		
        $get_customer_detail = $this->db->get_where('customer_details',array('customer_id' => $linked_id));
        $delivery_schedule = $get_customer_detail->result()[0]->d_schedule;
        
        
        $this->db->select('*');
        $this->db->from('estimated_product_details');
        $this->db->where('estimated_product_details.customer_id',$linked_id);
        $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
        if($delivery_schedule == 'month'){
        $this->db->join('estimated_product_month_chart','estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id','left');    
        }else if($delivery_schedule == 'week'){
         $this->db->join('estimated_product_week_chart','estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id','left');    
        }
        $get_customer_requirement = $this->db->get();
		
		$agent_stock_status = 'yes';
		
		if($get_customer_requirement->num_rows() > 0){
			
			$msg = '';
			
			foreach($get_customer_requirement->result() as $customer_req_row){
			
			
                
            if($delivery_schedule == 'month'){
                $require_product_qty = json_decode($customer_req_row->$str_day)[0]->morning;
            }else if($delivery_schedule == 'week'){
                $require_product_qty = json_decode($customer_req_row->$current_week_day)[0]->morning;
            }else if($delivery_schedule == 'daily'){
                $require_product_qty = $customer_req_row->morning_shift_qty;
            }    
             
            if($require_product_qty > 0){       
                 
			$require_product_id = $customer_req_row->product_id;
			$require_product_price = ($customer_req_row->product_price + $customer_req_row->selling_margin) * $require_product_qty;
			
			$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' =>$today_stock_date, 'user_id' => $agent_id, 'product_id' => $require_product_id, 'remaining_qty >=' => $require_product_qty));
			
			if($check_agent_stock->num_rows() > 0){
				
				
			}else{
				$agent_stock_status = 'no';
			}
			
			  if($agent_stock_status == 'yes'){
				  $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
	            	$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id , 'card_status' => 'active'));

                     if($check->num_rows() == 1){
		              	$ac_ballance = $check->result()[0]->balance_amount;
		              	$avalible_ballance = ($ac_ballance-$require_product_price);
                     
		              		$arr = array(
		                      'balance_amount' => $avalible_ballance,
		                      );
                     
		                  	$this->db->where('customer_id',$linked_id);
		                  	if($this->db->update('current_balance',$arr)){

			            		$tran_date = $date->format('Y-m-d');
                                $time_stamp = $date->format('Y-m-d H:i:s');
                        
                                $get_time = date("H:i:s");
                                if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                                    $shift_id = 1;
                                }else{
                                   $shift_id = 2;
                                }

				            	$arr2 = array(
                                    "customer_id" => $linked_id,
                                    "transaction_amount" => $require_product_price,
                                    "ledger" => $avalible_ballance,
                                    "product_id" => $require_product_id,
				            		"product_quantity" => $require_product_qty,
                                    "user_id" =>  $agent_id,
                                    "shift_id" => $shift_id,
				            	    "transaction_date" => $time_stamp,
                            
				            	);
				            	if($this->db->insert("transaction_detail", $arr2)){
                                    $arr3 = array(
                                        "last_transaction_date" => $time_stamp,
                                    );
                                    $this->db->where('customer_id',$linked_id);
                                    if($this->db->update('atm_card_detail',$arr3)){
                            
                                        $this->db->where('stock_date',$today_stock_date);
				            			$this->db->where('user_id',$agent_id);
				            			$this->db->where('product_id',$require_product_id);
                                    $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
						        	$this->db->set('remaining_qty','remaining_qty-'.$require_product_qty,FALSE);
					         		if($this->db->update('agent_stock')){
					         			$this->db->where('stock_date',$today_stock_date);
					         		    $this->db->where('product_id',$require_product_id);
                                         $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
                                         if($this->db->update('dairy_stock')){
                                           
                                           $this->db->where('customer_id',$linked_id);
                                           $this->db->set('morning_last_delivery',$time_stamp);
                                           $this->db->update('customer_details');     
                                             
                                             
					         			   $msg = "successful";
                                         }else{
                                             $msg = "failed";
                                         }
					         		}else{
                                          $msg = "failed";
                                     }
                        }else{
                            $msg = "failed";
                        }

					};
		    	}else{
		    		$msg = "failed";
		    	};

		}else{
			$msg = "blocked";
		}
				  
			  }else{
				  $msg = "insufficent_stock";
			  }
			  
			} // filter greater then zero qty product
        }
		}else{
			$msg = "insufficent_stock";
		}
	   
	   echo $msg;

    }
    
    
    
    
    
    public function daily_order_payment_transfer_evening($linked_id,$agent_id){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
        $today_day = $date->format('j');
        $str_day = 'day_'.$today_day;
        
        $week_day  = $date->format('w');
        $week_array = array('sun','mon','tue','wed','thu','fri','sat');
        $current_week_day = $week_array[$week_day];
        
	  
		
        $get_customer_detail = $this->db->get_where('customer_details',array('customer_id' => $linked_id));
        $delivery_schedule = $get_customer_detail->result()[0]->d_schedule;
        
        
        $this->db->select('*');
        $this->db->from('estimated_product_details');
        $this->db->where('estimated_product_details.customer_id',$linked_id);
        $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
        if($delivery_schedule == 'month'){
        $this->db->join('estimated_product_month_chart','estimated_product_month_chart.estimated_id = estimated_product_details.estimated_id','left');    
        }else if($delivery_schedule == 'week'){
         $this->db->join('estimated_product_week_chart','estimated_product_week_chart.estimated_id = estimated_product_details.estimated_id','left');    
        }
        $get_customer_requirement = $this->db->get();
		
		$agent_stock_status = 'yes';
		
		if($get_customer_requirement->num_rows() > 0){
			
			$msg = '';
			
			foreach($get_customer_requirement->result() as $customer_req_row){
			
			
                
            if($delivery_schedule == 'month'){
                $require_product_qty = json_decode($customer_req_row->$str_day)[0]->evening;
            }else if($delivery_schedule == 'week'){
                $require_product_qty = json_decode($customer_req_row->$current_week_day)[0]->evening;
            }else if($delivery_schedule == 'daily'){
                $require_product_qty = $customer_req_row->evening_shift_qty;
            }    
             
            if($require_product_qty > 0){       
                 
			$require_product_id = $customer_req_row->product_id;
			$require_product_price = ($customer_req_row->product_price + $customer_req_row->selling_margin) * $require_product_qty;
			
			$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' =>$today_stock_date, 'user_id' => $agent_id, 'product_id' => $require_product_id, 'remaining_qty >=' => $require_product_qty));
			
			if($check_agent_stock->num_rows() > 0){
				
				
			}else{
				$agent_stock_status = 'no';
			}
			
			  if($agent_stock_status == 'yes'){
				  $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
	            	$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id , 'card_status' => 'active'));

                     if($check->num_rows() == 1){
		              	$ac_ballance = $check->result()[0]->balance_amount;
		              	$avalible_ballance = ($ac_ballance-$require_product_price);
                     
		              		$arr = array(
		                      'balance_amount' => $avalible_ballance,
		                      );
                     
		                  	$this->db->where('customer_id',$linked_id);
		                  	if($this->db->update('current_balance',$arr)){

			            		$tran_date = $date->format('Y-m-d');
                                $time_stamp = $date->format('Y-m-d H:i:s');
                        
                                $get_time = date("H:i:s");
                                if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                                    $shift_id = 1;
                                }else{
                                   $shift_id = 2;
                                }

				            	$arr2 = array(
                                    "customer_id" => $linked_id,
                                    "transaction_amount" => $require_product_price,
                                    "ledger" => $avalible_ballance,
                                    "product_id" => $require_product_id,
				            		"product_quantity" => $require_product_qty,
                                    "user_id" =>  $agent_id,
                                    "shift_id" => $shift_id,
				            	    "transaction_date" => $time_stamp,
                            
				            	);
				            	if($this->db->insert("transaction_detail", $arr2)){
                                    $arr3 = array(
                                        "last_transaction_date" => $time_stamp,
                                    );
                                    $this->db->where('customer_id',$linked_id);
                                    if($this->db->update('atm_card_detail',$arr3)){
                            
                                        $this->db->where('stock_date',$today_stock_date);
				            			$this->db->where('user_id',$agent_id);
				            			$this->db->where('product_id',$require_product_id);
                                    $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
						        	$this->db->set('remaining_qty','remaining_qty-'.$require_product_qty,FALSE);
					         		if($this->db->update('agent_stock')){
					         			$this->db->where('stock_date',$today_stock_date);
					         		    $this->db->where('product_id',$require_product_id);
                                         $this->db->set('sold_qty','sold_qty+'.$require_product_qty,FALSE);
                                         if($this->db->update('dairy_stock')){
                                           
                                           $this->db->where('customer_id',$linked_id);
                                           $this->db->set('evening_last_delivery',$time_stamp);
                                           $this->db->update('customer_details');     
                                             
                                             
					         			   $msg = "successful";
                                         }else{
                                             $msg = "failed";
                                         }
					         		}else{
                                          $msg = "failed";
                                     }
                        }else{
                            $msg = "failed";
                        }

					};
		    	}else{
		    		$msg = "failed";
		    	};

		}else{
			$msg = "blocked";
		}
				  
			  }else{
				  $msg = "insufficent_stock";
			  }
			  
			} // filter greater then zero qty product
        }
		}else{
			$msg = "insufficent_stock";
		}
	   
	   echo $msg;

    }
    
    
    
    
    
    
    
    
    
    
	
	public function submit_extra_order($linked_id,$order_amount,$order_id,$agent_id){
		   date_default_timezone_set('Asia/Kolkata');
           $date = new DateTime();
           $today_stock_date = $date->format('Y-m-d');
		   $time_stamp = $date->format('Y-m-d H:i:s');
		  
		   $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
		   $check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id , 'card_status' => 'active'));
		
		   if($check->num_rows() == 1){
			   $my_current_balance = $check->result()[0]->balance_amount;
			   
			   $ledger_bal = $my_current_balance - $order_amount;
			   
			   
			   $this->db->where('customer_id',$linked_id);
			   $this->db->set('balance_amount','balance_amount -'.$order_amount,FALSE);
			   if($this->db->update('current_balance')){
				   
				   $this->db->where('online_order_id',$order_id);
				   $this->db->set('order_status','delivered');
				   if($this->db->update('online_orders')){
                       
                       $get_order = $this->db->get_where('online_orders',array('online_order_id' => $order_id ));
                       
                       if($get_order->num_rows() == 1){
                           
                           
                           $get_time = date("H:i:s");
                                if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                                    $shift_id = 1;
                                }else{
                                   $shift_id = 2;
                                }
                       
                           foreach(json_decode($get_order->result()[0]->online_order_details) as $row ){
                               
                               $item_id = $row->item_id;
                               $item_qty = $row->item_qty;
                               
					            $arr2 = array(
                                    "customer_id" => $linked_id,
                                    "transaction_amount" => $order_amount,
                                    "ledger" => $ledger_bal,
                                    "product_id" => null,
                                    "e_product_id" => $item_id,
				            		"product_quantity" => $item_qty,
                                    "user_id" =>  $agent_id,
                                    "shift_id" => $shift_id,
									"order_id" => $order_id,
									"customer_type" => 'membership',
				            	    "transaction_date" => $time_stamp,
                            
				            	);
				            	if($this->db->insert("transaction_detail", $arr2)){
                                  
                                  $get_e_product = $this->db->get_where('product_details', array( 'product_id' => $item_id )); 
                                    
                                  if($get_e_product->num_rows() == 1){   
                                      
                                  $dairy_product_id =   $get_e_product->result()[0]->dairy_product_id;     
                                    
                                  $this->db->where('stock_date',$today_stock_date);
				                  $this->db->where('user_id',$agent_id);
				                  $this->db->where('product_id',$dairy_product_id);
                                  $this->db->set('sold_qty','sold_qty+'.$item_qty,FALSE);
						          $this->db->set('remaining_qty','remaining_qty-'.$item_qty,FALSE);
					         		if($this->db->update('agent_stock')){
					         			$this->db->where('stock_date',$today_stock_date);
					         		    $this->db->where('product_id',$dairy_product_id);
                                         $this->db->set('sold_qty','sold_qty+'.$item_qty,FALSE);
                                         if($this->db->update('dairy_stock')){
                                           
                                           $this->db->where('customer_id',$linked_id);
                                           $this->db->set('evening_last_delivery',$time_stamp);
                                           $this->db->update('customer_details');     
                                             
                                             
					         			   $msg = "successful";
                                         }else{
                                             $msg = "failed";
                                         }
                           
                                    }
                                  }
                                }
                               
                               
                               
                           }
                           
                           
                            
                           
					      echo 'success';
                       }
					   
				   }else{
					   echo 'failed';
				   }
			   }else{
					   echo 'failed';
				   }
			   
		   }else{
			   echo 'blocked';
		   }
	}
	

	public function update_delivery_status($linked_id,$value,$products,$agent_id,$product_quantity){

            date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $today_date = $date->format('Y-m-d');
            $time_stamp = $date->format('Y-m-d H:i:s');
        


		$check_agent_stock = $this->db->get_where('agent_stock',array('stock_date' => $today_date, 'user_id' => $agent_id, 'product_id' => $products));

		if($check_agent_stock->num_rows() == 1){

		if($check_agent_stock->result()[0]->remaining_qty >= $product_quantity){
			
			$this->db->where('customer_id',$linked_id);
            $this->db->set('last_delivery_date',$time_stamp);
            $this->db->update('customer_details');
         
        }
        }
          		
	}


	public function recharge_account($linked_id,$value,$agent_id){

        $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
		$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_id, 'card_status' => 'active'));
		if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$total_ballance = ($ac_ballance+$value);
				$arr = array(
		        'balance_amount' => $total_ballance,
		        );
		    	$this->db->where('customer_id',$linked_id);
		    	if($this->db->update('current_balance',$arr)){
					date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$re_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');
					$arr2 = array(
                        'customer_id' =>  $linked_id,
                        'recharge_amount' => $value,
                        'user_id' =>  $agent_id,
					    'recharge_date' => $time_stamp,

					);
					if($this->db->insert('recharge_detail',$arr2)){
                        $arr3 = array(
                            "last_recharge_date" => $time_stamp,
                        );
                        $this->db->where('customer_id',$linked_id);
                        if($this->db->update('atm_card_detail',$arr3)){
							            $this->db->select('*');
										$this->db->from('customer_details');
										$this->db->where('customer_details.customer_id',$linked_id);
										$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
										$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
										$get_sms_value = $this->db->get();
							            if($get_sms_value->num_rows() == 1){

										$get_name = $get_sms_value->result()[0]->first_name;

										$get_atm = $get_sms_value->result()[0]->atm_card_no;

										$get_balance = $get_sms_value->result()[0]->balance_amount;

										$get_number = $get_sms_value->result()[0]->contact_1;

										if(isset($get_name,$get_atm,$get_balance,$get_number,$value)){

										if(strlen($get_name) > 15){
                                            $cus_name = substr($get_name,0, 15);

                                        }else{

                                            $cus_name = $get_name;
                                        }

                                   //***************************//
                                    // ******** send sms *******//
									//**************************//
					                 $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
									$url = $msg_server."?mobile_no=".$get_number."&name=".urlencode($cus_name)."&recharge_amount=".+$value."&avl_balance=".+$get_balance."&template=recharge&client_url=".base_url(); 
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
										}
										}
                            echo "successful";
                        }else{
                            echo "failed";
                        }

					};
		    	}else{
		    		echo "failed1";
		    	};
		}else{
			echo "blocked";
		}
    }



    public function select_all_colony(){
        $this->db->select('*');
        $this->db->from('colony_detail');
        $this->db->order_by('colony_name','ASC');
        $data = $this->db->get();
        return $data->result();
    }
    
     public function select_agent_colony($agent_id){
        $this->db->select('colony_detail.colony_id,colony_detail.colony_name');
        $this->db->from('colony_detail');
        $this->db->join('customer_details','customer_details.colony_id = colony_detail.colony_id'); 
        $this->db->where('customer_details.assigned_user_id',$agent_id);  
        $this->db->group_by('colony_detail.colony_id'); 
        $this->db->order_by('colony_name','ASC');
        $data = $this->db->get();
        return $data->result();
    }

	public function update_customer_profile($linked_id,$first_name,$last_name,$user_img,$email,$mobile_no,$mobile_no2,$delivery_type,$address1,$address2,$colony,$city){

		$arr = array(

		    'first_name' => $first_name,
			'last_name' => $last_name,
			'customer_image' => $user_img,
            'email_address' => $email,
			'contact_1' => $mobile_no,
			'contact_2' => $mobile_no2,
			'address_1' => $address1,
			'address_2' => $address2,
            'colony_id' => $colony,
            'd_type_id' => $delivery_type,
			'city' => $city,


		);

		$this->db->where('customer_id',$linked_id);
		if($this->db->update('customer_details',$arr)){

                       echo "success";


		}else{

			echo "fail";

		};




	}


	public function update_agent_profile($linked_id,$name,$email,$mobile_no,$user_img){

		$arr = array(

		    'name' => $name,
			'image' => $user_img,
			'email' => $email,
			'contact' => $mobile_no,


		);

		$this->db->where('user_id',$linked_id);
		if($this->db->update('team_member',$arr)){

			echo "success";

		}else{

			echo "fail";
		};
	}

   public function update_agent_password($linked_id,$n_pass){
       $arr = array(

		    'password' => $n_pass,

		);

		$this->db->where('user_id',$linked_id);
		if($this->db->update('team_member',$arr)){

			echo "success";

		}else{

			echo "fail";
		};

   }

   public function update_customer_password($linked_id,$n_pass){

       $arr = array(

		    'password' => $n_pass,

		);

		$this->db->where('customer_id',$linked_id);
		if($this->db->update('customer_details',$arr)){

			echo "success";

		}else{

			echo "fail";
		};

   }



   public function user_transaction($user_id,$role){

	    $this->db->select('*');
        $this->db->from('transaction_detail');
       
        if($role == 'ragister_customer'){
            $this->db->where('guest_id', $user_id);
            $this->db->where('customer_type', 'guest');
        }else{
            $this->db->where('customer_id', $user_id);
            $this->db->where('customer_type', 'membership');
        }
		
		$this->db->where('MONTH(transaction_date)',date('m'));
        $this->db->where('YEAR(transaction_date)',date('Y'));
        $this->db->join('dairy_products','dairy_products.product_id = transaction_detail.product_id','left');
		$this->db->order_by('transaction_date','DESC');
		$this->db->order_by('transaction_id','DESC');
        $data = $this->db->get()->result();

		return $data;


   }

   public function search_transaction($user_id,$my_date,$role){
        $my_month = date('m',strtotime($my_date));
        $my_year = date('Y',strtotime($my_date));

        $this->db->select('*');
        $this->db->from('transaction_detail');
		if($role == 'ragister_customer'){
            $this->db->where('guest_id', $user_id);
            $this->db->where('customer_type', 'guest');
        }else{
            $this->db->where('customer_id', $user_id);
            $this->db->where('customer_type', 'membership');
        }
		$this->db->where('MONTH(transaction_date)',$my_month);
        $this->db->where('YEAR(transaction_date)',$my_year);
        $this->db->join('dairy_products','dairy_products.product_id = transaction_detail.product_id','left');
		$this->db->order_by('transaction_date','DESC');
		$this->db->order_by('transaction_id','DESC');
        $data = $this->db->get();

        if($data->num_rows() > 0){

            foreach($data->result() as $rows){
                
                if(!$rows->order_id){

                echo ' <tr>';
                echo '<td><img src="../images/left arrow.png" alt="" /><p>'.$rows->product_name.'<span class="d_span">'.date('d-M-Y',strtotime($rows->transaction_date)).'</span><span class="t_span">'.date('h:i:s a',strtotime($rows->transaction_date)).'</span></p></td>';
                echo '<td><span>'.number_format($rows->product_quantity,2).' '.$rows->unit.'</span><br><i class="fa fa-rupee"></i> '.$rows->transaction_amount.'<br> '; if($rows->ledger){ echo ' <span class="ledger">bal.  <i class="fa fa-rupee" ></i> '.number_format($rows->ledger,1).'</span>'; } echo '</td>';
                echo ' </tr>';
                }else if($rows->order_id){
                echo ' <tr>';
                echo '<td><img src="../images/left arrow.png" alt="" /><p>Order ID # '.$rows->order_id.'<span class="d_span">'.date('d-M-Y',strtotime($rows->transaction_date)).'</span><span class="t_span">'.date('h:i:s a',strtotime($rows->transaction_date)).'</span></p></td>';
                echo '<td><span>Total</span><br><i class="fa fa-rupee"></i> '.$rows->transaction_amount.'<br> '; if($rows->ledger){ echo ' <span class="ledger">bal.  <i class="fa fa-rupee" ></i> '.number_format($rows->ledger,1).'</span>'; } echo '</td>';
                echo ' </tr>';
                    
                }
 



            }

        }else{

        }



   }


   public function recharge_transaction($user_id,$role){

	    $this->db->select('*');
        $this->db->from('recharge_detail');
		if($role == 'ragister_customer'){
            $this->db->where('guest_id', $user_id);
            $this->db->where('customer_type', 'guest');
        }else{
            $this->db->where('customer_id', $user_id);
            $this->db->where('customer_type', 'membership');
        }

		$this->db->order_by('recharge_date','DESC');
		$this->db->order_by('recharge_id','DESC');
        $data = $this->db->get()->result();

		return $data;

   }
     public function search_transaction_recharge($user_id,$my_date,$role){
        $my_month = date('m',strtotime($my_date));
        $my_year = date('Y',strtotime($my_date));

        $this->db->select('*');
        $this->db->from('recharge_detail');
		if($role == 'ragister_customer'){
            $this->db->where('guest_id', $user_id);
            $this->db->where('customer_type', 'guest');
        }else{
            $this->db->where('customer_id', $user_id);
            $this->db->where('customer_type', 'membership');
        }
		$this->db->where('MONTH(recharge_date)',$my_month);
        $this->db->where('YEAR(recharge_date)',$my_year);
		$this->db->order_by('recharge_date','DESC');
		$this->db->order_by('recharge_id','DESC');
        $data = $this->db->get();

        if($data->num_rows() > 0){

            foreach($data->result() as $rows){

                echo ' <tr>';
                echo '<td><img src="../images/left arrow.png" alt="" /><p>'.date('M d,Y',strtotime($rows->recharge_date)).'</p></td>';
                echo '<td><i class="fa fa-rupee"></i> '.$rows->recharge_amount.'</td>';
                echo ' </tr>';

            }

        }else{

        }
   }

   public function fetch_products(){
       $this->db->select('*');
       $this->db->from('dairy_products');
       $data = $this->db->get()->result();
       return $data;
   }
    
    public function fetch_products_for_transaction($customer_barcode){
       $this->db->select('dairy_products.product_id,dairy_products.product_name,dairy_products.unit,dairy_products.product_price,estimated_product_details.selling_margin');
         
       $this->db->from('atm_card_detail'); 
       $this->db->where('qr_code',$customer_barcode);     
       $this->db->join('estimated_product_details','estimated_product_details.customer_id = atm_card_detail.customer_id','left');
       $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id','left');    
       $data = $this->db->get();
       return $data->result();
   }

   public function fetch_recharge_limit(){
       $this->db->select('*');
       $this->db->from('recharge_limit');
       $data = $this->db->get()->result();
       return $data;
   }
   // Agent transaction sale and recharge report


    public function agent_transaction($user_id){
	    date_default_timezone_set('Asia/Kolkata');
	    $get_time = date("H:i:s");
        if($get_time >= '04:00:00'  && $get_time <= '15:00:00'){
            $shift_id = 1;
        }else{
           $shift_id = 2;
        }

	    $this->db->select('*');
        $this->db->from('transaction_detail');
		$this->db->where('user_id', $user_id);
        //$this->db->where('transaction_detail.shift_id', $shift_id);
		$this->db->where('date(transaction_date)',date('Y-m-d'));
        $this->db->join('dairy_products','dairy_products.product_id = transaction_detail.product_id','left');
		$this->db->join('customer_details','customer_details.customer_id = transaction_detail.customer_id','left');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = transaction_detail.customer_id','left');

		$this->db->order_by('transaction_id','DESC');
        $data = $this->db->get()->result();

		return $data;


   }
   public function search_agent_transaction($user_id,$shift,$my_date,$dairy_product_id){

        $this->db->select('*');
        $this->db->from('transaction_detail');
		$this->db->where('user_id', $user_id);
		$this->db->where('date(transaction_date)',$my_date);

        if($shift != "all"){

         $this->db->where('transaction_detail.shift_id', $shift);
        }
       
        if($dairy_product_id != "all"){

         $this->db->where('transaction_detail.product_id', $dairy_product_id);
        }
       
        $this->db->join('dairy_products','dairy_products.product_id = transaction_detail.product_id','left');
		$this->db->join('customer_details','customer_details.customer_id = transaction_detail.customer_id','left');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = transaction_detail.customer_id','left');
		$this->db->order_by('transaction_id','DESC');
        $data = $this->db->get()->result();

        return $data;

   }

   public function delete_last_transaction($last_transaction_id){

       $check = $this->db->get_where('transaction_detail',array('transaction_id' => $last_transaction_id));

       if($check->num_rows() == 1){
           $customer_id = $check->result()[0]->customer_id;
           $amount = $check->result()[0]->transaction_amount;

           $user_id = $check->result()[0]->user_id;
           $stock_date = date('Y-m-d', strtotime($check->result()[0]->transaction_date));
           $product_id = $check->result()[0]->product_id;
           $product_qty = $check->result()[0]->product_quantity;

           $this->db->where('customer_id',$customer_id);
           $this->db->set('balance_amount','balance_amount + '.$amount, FALSE);
           if($this->db->update('current_balance')){

               $this->db->where('transaction_id',$last_transaction_id);
               if($this->db->delete('transaction_detail')){

                   $this->db->where('stock_date',$stock_date);
                   $this->db->where('user_id',$user_id);
                   $this->db->where('product_id',$product_id);
                   $this->db->set('remaining_qty','remaining_qty + '.$product_qty, FALSE);
                   $this->db->set('sold_qty','sold_qty - '.$product_qty, FALSE);
                   if($this->db->update('agent_stock')){
                        $this->db->where('stock_date',$stock_date);
                        $this->db->where('product_id',$product_id);
                        $this->db->set('sold_qty','sold_qty - '.$product_qty, FALSE);
                       if($this->db->update('dairy_stock')){
                        echo 'success';
                       }else{
                           echo 'fail';
                       }
                   }else{
                        echo 'fail';
                   }

               }else{

                   echo 'fail';
               }

           }else{

               echo 'fail';
           }
       }


   }

   public function search_agent_recharges($user_id,$my_date){

        $this->db->select('*');
        $this->db->from('recharge_detail');
		$this->db->where('user_id', $user_id);
		$this->db->where('date(recharge_date)',$my_date);
		$this->db->join('customer_details','customer_details.customer_id = recharge_detail.customer_id');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = recharge_detail.customer_id');
		$this->db->order_by('recharge_id','DESC');
        $data = $this->db->get()->result();

        return $data;



   }
   public function agent_recharge_transaction($user_id){

	    $this->db->select('*');
        $this->db->from('recharge_detail');
		$this->db->where('user_id', $user_id);
		$this->db->where('date(recharge_date)',date('Y-m-d'));
		$this->db->order_by('recharge_id','DESC');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = recharge_detail.customer_id');
        $data = $this->db->get()->result();

		return $data;

   }

   public function agent_search_transaction_recharge($user_id,$my_date){

        $this->db->select('*');
        $this->db->from('recharge_detail');
		$this->db->where('user_id', $user_id);
		$this->db->where('date(recharge_date)',$my_date);
		$this->db->order_by('recharge_id','DESC');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = recharge_detail.customer_id');
        $data = $this->db->get();

        if($data->num_rows() > 0){

            foreach($data->result() as $rows){

                echo ' <tr>';
                echo '<td><img src="../images/left arrow.png" alt="" /><p>'.date('M d,Y',strtotime($rows->recharge_date)).'</p></td>';
                echo '<td>Rs '.$rows->recharge_amount.'</td>';

                echo ' </tr>';

            }

        }else{

        }
   }


   public function agent_recharges($user_id){
       date_default_timezone_set('Asia/Kolkata');
        $this->db->select('*');
        $this->db->from('recharge_detail');
		$this->db->where('user_id', $user_id);
		$this->db->where('date(recharge_date)',date('Y-m-d'));
		$this->db->join('customer_details','customer_details.customer_id = recharge_detail.customer_id');
		$this->db->join('atm_card_detail','atm_card_detail.customer_id = recharge_detail.customer_id');
		$this->db->order_by('recharge_id','DESC');
        $data = $this->db->get()->result();

		return $data;

   }

   public function delete_last_recharge($last_transaction_id){

       $check = $this->db->get_where('recharge_detail',array('recharge_id' => $last_transaction_id));

       if($check->num_rows() == 1){
           $customer_id = $check->result()[0]->customer_id;
           $amount = $check->result()[0]->recharge_amount;

           $check2 = $this->db->get_where('current_balance', array('customer_id' => $customer_id));

           $check_balance = $check2->result()[0]->balance_amount - $amount;

           if($check_balance < 0){
               echo 'invalid';
           }else{

           $this->db->where('customer_id',$customer_id);
           $this->db->set('balance_amount','balance_amount - '.$amount, FALSE);
           if($this->db->update('current_balance')){

               $this->db->where('recharge_id',$last_transaction_id);
               if($this->db->delete('recharge_detail')){

                   echo 'success';

               }else{

                   echo 'fail';
               }

           }else{

               echo 'fail';
           }
           }
       }

   }


    public function add_payment($customer_id,$recharge_amount,$payment_id){

        $this->db->select('*');
        $this->db->from('atm_card_detail');
        $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
        $this->db->where('atm_card_detail.customer_id',$customer_id);
        $this->db->where('card_status','active');
        $check = $this->db->get();

		if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$total_ballance = ($ac_ballance+$recharge_amount);
				$arr = array(
		        'balance_amount' => $total_ballance,
		        );
		    	$this->db->where('customer_id',$customer_id);
		    	if($this->db->update('current_balance',$arr)){
					date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$re_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');
					$arr2 = array(
                        'customer_id' =>  $customer_id,
                        'recharge_amount' => $recharge_amount,
                        'user_id' =>  '21',
					    'recharge_date' => $time_stamp,
                        'payment_id' => $payment_id,

					);
					if($this->db->insert('recharge_detail',$arr2)){

							            $this->db->select('*');
										$this->db->from('customer_details');
										$this->db->where('customer_details.customer_id',$customer_id);
										$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
										$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
										$get_sms_value = $this->db->get();
							            if($get_sms_value->num_rows() == 1){

										$get_name = $get_sms_value->result()[0]->first_name;

										$get_atm = $get_sms_value->result()[0]->atm_card_no;

										$get_balance = $get_sms_value->result()[0]->balance_amount;

										$get_number = $get_sms_value->result()[0]->contact_1;

										if(isset($get_name,$get_atm,$get_balance,$get_number,$value)){

												if(strlen($get_name) > 15){
													$cus_name = substr($get_name,0, 15);

												}else{

													$cus_name = $get_name;
												}

                                                //***************************//
												// ******** send sms *******//
												//**************************//
								                 $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
												$url = $msg_server."?mobile_no=".$get_number."&name=".urlencode($cus_name)."&recharge_amount=".+$value."&avl_balance=".+$get_balance."&template=recharge&client_url=".base_url(); 
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


					};
		    	}else{
		    		echo "failed1";
		    	};
		}else{
			echo "blocked";
		}
    }
    
    public function guest_add_payment($customer_id,$recharge_amount,$payment_id){

        
			    $this->db->set('balance_amount','balance_amount +'.$recharge_amount,FALSE);
		    	$this->db->where('guest_id',$customer_id);
		    	if($this->db->update('guest_current_balance')){
					date_default_timezone_set('Asia/Kolkata');
                    $date = new DateTime();
					$re_date = $date->format('Y-m-d');
                    $time_stamp = $date->format('Y-m-d H:i:s');
					$arr2 = array(
                        'customer_id' =>  null,
                        'guest_id' => $customer_id,
                        'recharge_amount' => $recharge_amount,
                        'user_id' =>  '21',
					    'recharge_date' => $time_stamp,
                        'payment_id' => $payment_id,
                        'customer_type' => 'guest',

					);
					if($this->db->insert('recharge_detail',$arr2)){

							            $this->db->select('*');
										$this->db->from('customer_ragistration');
										
										$this->db->join('guest_current_balance','guest_current_balance.guest_id = customer_ragistration.ragistration_id');
										$get_sms_value = $this->db->get();
							            if($get_sms_value->num_rows() == 1){

										$get_name = $get_sms_value->result()[0]->first_name;

										$get_atm = '';

										$get_balance = $get_sms_value->result()[0]->balance_amount;

										$get_number = $get_sms_value->result()[0]->contact_1;

										if(isset($get_name,$get_atm,$get_balance,$get_number,$value)){

											if(strlen($get_name) > 15){
												$cus_name = substr($get_name,0, 15);

											}else{

												$cus_name = $get_name;
											 }
                                                //***************************//
												// ******** send sms *******//
												//**************************//
								                 $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
												$url = $msg_server."?mobile_no=".$get_number."&name=".urlencode($cus_name)."&recharge_amount=".+$value."&avl_balance=".+$get_balance."&template=recharge&client_url=".base_url(); 
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


					};
		    	}else{
		    		echo "failed1";
		    	};
		
    }

	// //-----//////------/////--------/////////------///////
// //======= Vacation Section ======//////
// //-----//////------/////--------/////////-------//////

   public function select_vacation($customer_id){
	   $this->db->select('*');
	   $this->db->from('vacation');
	   $this->db->where('customer_id',$customer_id);
	    $this->db->order_by('vacation_id','DESC');
	   $data = $this->db->get();
	   return $data->result();


   }

   public function add_vacation($customer_id,$start_date,$end_date,$shift){

	   $arr = array(
	     "customer_id" => $customer_id,
		 "start_date"  => $start_date,
		 "end_date"    => $end_date,
		 "shift"       => $shift,

	   );

	   if($this->db->insert("vacation",$arr)){

		   echo "success";
	   }else{

		   echo "fail";
	   };

   }

   public function selected_vacation($id){
	   $this->db->select('*');
	   $this->db->from('vacation');
	   $this->db->where('vacation_id',$id);

	   $data = $this->db->get();
	   return $data->result();



   }

   public function edit_vacation($vacation_id,$start_date,$end_date,$shift){
	   $arr = array(

	         "start_date" => $start_date,
			 "end_date"   => $end_date,
			 "shift"       => $shift,

	   );
	   $this->db->where('vacation_id',$vacation_id);
	   if($this->db->update('vacation',$arr)){

		   echo "success";
	   }else{

		   echo "fail";
	   }
   }

	public function delete_vacation($vacation_id){

		$this->db->where('vacation_id',$vacation_id);
		if($this->db->delete('vacation')){

		   echo "success";
	   }else{

		   echo "fail";
	   }
	}

    
    public function stop_vacation($vacation_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');

        $this->db->where('vacation_id',$vacation_id);
        $this->db->set('end_date',$today);
		if($this->db->update('vacation')){

		   echo "success";
	   }else{

		   echo "fail";
	   }
        
    }
    
    
	public function vacation_maping($customer_id){
	    $this->db->select('*');
	    $this->db->from('vacation');
	   $this->db->where('customer_id',$customer_id);
	    //$this->db->order_by('vacation_id','DESC');
	   $data = $this->db->get();
	   $y = array();

	   foreach($data->result() as $row){
		   $k = 0;
		   for($i = $row->start_date;   $i <= $row->end_date; $i = date('Y-m-d', strtotime($row->start_date.'+'.$k.' day'))){
		      $k++;
			  $y[] = $i;
		   }
		   //echo $row->vacation_id;
	   }

	   return $y;

	}

// //-----//////------/////--------/////////------///////
// //======= Notification Section ======//////
// //-----//////------/////--------/////////-------//////

     public function user_notification($user_id,$role){
	    $this->db->select('*');
        $this->db->from('notification');
         
        if($role == 'customers'){
            $this->db->where('notification.customer_id', $user_id);
        }else{
            $this->db->where('notification.guest_id', $user_id);
            
        }

        $this->db->order_by('notification_id','desc');
        $data = $this->db->get()->result();
		return $data;
    }

    public function read_notification($id){


	    $this->db->select('*');
        $this->db->from('notification');
        $this->db->where('notification_id',$id);
       
        $data = $this->db->get()->result();
		return $data;
   }

   public function change_notification_status($id){

       $this->db->where('notification_id',$id);
       $this->db->set('notification_status','read');
       $this->db->update('notification');
   }

    public function count_notification($user_id,$role){
	    $this->db->select('COUNT(notification_id) AS new_notification');
        $this->db->from('notification');
         if($role == 'customers'){
            $this->db->where('notification.customer_id', $user_id);
        }else{
            $this->db->where('notification.guest_id', $user_id);
            
        }
		$this->db->where('notification_status', '');
        $data = $this->db->get()->result();
		return $data;
    }

// //-----//////------/////--------/////////------///////
// //======= Assigned colony Section ======//////
// //-----//////------/////--------/////////-------//////

    public function assigned_colony_customer_list($colony_id,$shift){

            $this->db->select('*');
            $this->db->from('customer_details');
            $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
            $this->db->join('delivery_status','delivery_status.customer_id = customer_details.customer_id');
            $this->db->where('customer_details.colony_id',$colony_id);
            $this->db->where('delivery_status.status','');
            if($shift != '3'){

                 $this->db->where('delivery_status.shift_id',$shift);
            }


            $data = $this->db->get()->result();
            return $data;

    }
// //-----//////------/////--------/////////------///////
// //======= Agent stock ======//////
// //-----//////------/////--------/////////-------//////

	public function select_agent_stock($user_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        $this->db->select('*');
        $this->db->from('agent_stock');
        $this->db->where('date(agent_stock.stock_date)',$today);
        $this->db->where('user_id',$user_id);
        $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
        $data = $this->db->get()->result();
        return $data;
    }

    public function select_agent(){
        $this->db->select('*');
        $this->db->from('team_member');
        $data = $this->db->get()->result();
        return $data;
    }

    public function select_product(){
        $this->db->select('*');
        $this->db->from('dairy_products');
        $data = $this->db->get()->result();
        return $data;
    }

    public function returned_stock($user_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');

        $get_data = $this->db->get_where('agent_stock',array('stock_date' => $today, 'user_id' => $user_id));

        if($get_data->num_rows() > 0){

            foreach($get_data->result() as $rows){

                $product_qty = $rows->remaining_qty;

                $this->db->where('stock_date',$today);
                $this->db->where('product_id',$rows->product_id);
                $this->db->set('remaining_qty','remaining_qty +'.$product_qty,FALSE);
                if($this->db->update('dairy_stock')){

                     $this->db->where('stock_date',$today);
                     $this->db->where('user_id',$user_id);
                     $this->db->where('product_id',$rows->product_id);
                     $this->db->set('remaining_qty',null);
                     $this->db->set('assigned_qty','assigned_qty -'.$product_qty,FALSE);

                    if($this->db->update('agent_stock')){

                        $return_product_id = $rows->product_id;

                        $arr = array(
                           'stock_date' => $today,
                            'user_id' => $user_id,
                            'product_id' =>$return_product_id,
                            'returned_qty' => $product_qty,


                        );

                        if($this->db->insert('returned_stock',$arr)){


                        }
                    }
                }
            }
             echo 'success';
        }
    }
    // -------------- transfer stock section ------------//

    public function select_user_stock_by_product($user_id,$product_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        $this->db->select('*');
        $this->db->from('agent_stock');
        $this->db->where('date(agent_stock.stock_date)',$today);
        $this->db->where('user_id',$user_id);
        $this->db->where('agent_stock.product_id',$product_id);
        $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
        $data = $this->db->get()->result();
        return $data;

    }

    public function transfer_stock($user_id,$product_id,$transfer_to,$transfer_product_qty){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

       $check_reciver_account = $this->db->get_where('agent_stock',array('stock_date' => $mydate , 'user_id' => $transfer_to, 'product_id' => $product_id));
       if($check_reciver_account->num_rows() == 1){

               $this->db->where('stock_date',$mydate);
               $this->db->where('user_id',$user_id);
               $this->db->where('product_id',$product_id);

               $this->db->set('remaining_qty','remaining_qty -'.$transfer_product_qty, FALSE);
               $this->db->set('transferred_stock','transferred_stock +'.$transfer_product_qty, FALSE);
               $this->db->set('transferred_to',$transfer_to);

               if($this->db->update('agent_stock')){
                    $this->db->where('stock_date',$mydate);
                    $this->db->where('user_id',$transfer_to);
                    $this->db->where('product_id',$product_id);

                    $this->db->set('remaining_qty','remaining_qty +'.$transfer_product_qty, FALSE);
                   $this->db->set('received_stock','received_stock +'.$transfer_product_qty, FALSE);
                    $this->db->set('received_by',$user_id);

                    if($this->db->update('agent_stock')){
                               echo "success";
                    }else{ echo "failed"; }

               }else{ echo "failed"; }
     }else{ echo "invalid_reciever"; }

   }

	 //=========********===========********========******========//
	 // ************ Agent Requirement Reports ***********//
	 //=========********===========********========******========//

    public function select_user_customer_list($user_id){


        $this->db->select('*');
        $this->db->from('customer_details');
        $this->db->where('assigned_user_id',$user_id);
        $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
        $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');

        $data = $this->db->get()->result();
        return $data;
    }

    public function select_user_requirement($user_id){


        $this->db->select('dairy_products.product_name,dairy_products.unit,dairy_products.product_price,estimated_product_details.product_id, SUM(estimated_product_details.product_qty) AS product_qty_sum');
           $this->db->from('customer_details');
           $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
          $this->db->join('estimated_product_details','estimated_product_details.customer_id = customer_details.customer_id');
          $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
          $this->db->where('atm_card_detail.card_status','active');
          $this->db->where('customer_details.assigned_user_id',$user_id);

          $this->db->group_by('estimated_product_details.product_id');
          $data = $this->db->get()->result();
         // echo json_encode($data);

          return $data;
    }
    
    
   
     public function requirement_shift_wise($agent_search,$shift,$search_date){
           
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
    
    
    
    public function select_user_requirement_e_product($user_id){
        
        $this->db->select('*');
        $this->db->from('product_details');
        $data = $this->db->get();
        
        if($data->num_rows() > 0){
            
            
           
            
            
        }
        
        
    } 



		public function select_user_requirement_customer_wise($user_id,$status,$colony_id,$shift){
			date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
            
            
            $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
             $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();

			$this->db->select('customer_details.first_name,customer_details.last_name,colony_detail.colony_name ,customer_details.customer_id,customer_details.last_delivery_date,customer_details.morning_last_delivery,customer_details.evening_last_delivery ,atm_card_detail.qr_code,customer_location.customer_lat,customer_location.customer_lng,customer_details.address_1');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
            $this->db->join('customer_location','customer_location.customer_id = customer_details.customer_id','left');
			$this->db->where('atm_card_detail.card_status','active');
            $this->db->where('customer_details.assigned_user_id',$user_id);
            
            if($shift != 'all'){
             if($shift == 1){
                 $this->db->where_in('customer_details.shift_id',[1,3]);
             }else if($shift == 2){
                 $this->db->where_in('customer_details.shift_id',[2,3]);
             }else{
                  $this->db->where('customer_details.shift_id',$shift);
             }                   
            }
                
			if($colony_id != 'all'){
				$this->db->where('customer_details.colony_id',$colony_id);
			}
            if($vaction->num_rows() > 0){
                
                foreach($vaction->result() as $row){
                    $vacation_customer_id = $row->customer_id;
                    $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                }
            }
            
           
           if($shift == 1){

			if($status == 'pending'){
				 $this->db->where('Date(morning_last_delivery) !=',$mydate);
			}else if($status == 'completed'){
                $this->db->where('Date(morning_last_delivery)',$mydate);
			}
           }else if($shift == 2){
               if($status == 'pending'){
				 $this->db->where('Date(evening_last_delivery) !=',$mydate);
			   }else if($status == 'completed'){
                $this->db->where('Date(evening_last_delivery)',$mydate);
			   }
           }
        
            $this->db->order_by('last_transaction_date','asc');
			$customer_list = $this->db->get();
			return $customer_list->result();
            
          /*  $this->db->select('*');
            $this->db->from('vaction');
            $this->db->where('start_date >=' $mydate);
            $this->db->where('end_date <=' $mydate);
            $vaction =  $this->db->get()->result();
            
            foreach($customer_list as $row){
                
                
            } */

    }
    
	 public function count_pending_customers($user_id,$status,$colony_id,$shift){
		    date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
         
           $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
             $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();


			$this->db->select('COUNT(customer_details.customer_id) AS sum_pending_customer');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->where('atm_card_detail.card_status','active');
			
			$this->db->where('customer_details.assigned_user_id',$user_id);
			
			if($colony_id != 'all'){
				$this->db->where('customer_details.colony_id',$colony_id);
			}
         
            if($shift != 'all'){
             if($shift == 1){
                 $this->db->where_in('customer_details.shift_id',[1,3]);
                 $this->db->where('Date(morning_last_delivery) !=',$mydate);
             }else if($shift == 2){
                 $this->db->where_in('customer_details.shift_id',[2,3]);
                 $this->db->where('Date(evening_last_delivery) !=',$mydate);
             }else{
                  $this->db->where('customer_details.shift_id',$shift);
                  $this->db->where('Date(last_delivery_date) !=',$mydate);
             }                   
            }
			
            if($vaction->num_rows() > 0){
                
                foreach($vaction->result() as $row){
                    $vacation_customer_id = $row->customer_id;
                    $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                }
            }
         
			$customer_list = $this->db->get();
			return $customer_list->result();

	 }
	 public function count_completed_customers($user_id,$status,$colony_id,$shift){
		    date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
         
            
           $this->db->select('*');
            $this->db->from('vacation');
            $this->db->where('start_date <=',$mydate);
             $this->db->where('end_date >=',$mydate);
            $vaction =  $this->db->get();

			$this->db->select('COUNT(customer_details.customer_id) AS sum_completed_customer');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->where('atm_card_detail.card_status','active');
			
			$this->db->where('customer_details.assigned_user_id',$user_id);
			
			if($colony_id != 'all'){
				$this->db->where('customer_details.colony_id',$colony_id);
			}
         
            if($shift != 'all'){
             if($shift == 1){
                 $this->db->where_in('customer_details.shift_id',[1,3]);
                 $this->db->where('Date(morning_last_delivery)',$mydate);
                 
             }else if($shift == 2){
                 $this->db->where_in('customer_details.shift_id',[2,3]);
                 $this->db->where('Date(evening_last_delivery)',$mydate);
                  
             }else{
                  $this->db->where('customer_details.shift_id',$shift);
                  $this->db->where('Date(last_delivery_date)',$mydate);
             }                   
            }
         
            if($vaction->num_rows() > 0){
                
                foreach($vaction->result() as $row){
                    $vacation_customer_id = $row->customer_id;
                    $this->db->where('customer_details.customer_id !=',$vacation_customer_id);
                }
            }
			$customer_list = $this->db->get();
			return $customer_list->result();

	 }
//=========********===========********========******========//
// ************ customer ragistration section ***********//
//=========********===========********========******========//

		public function customer_ragistration_submit($first_name,$last_name,$mobile_no,$address,$colony,$user_id,$password)
		{
			date_default_timezone_set('Asia/Kolkata');
			$date = new DateTime();
			$mydate = $date->format('Y-m-d');
			$time_stamp = $date->format('Y-m-d H:i:s');
      $check_user_id = $this->db->get_where('customer_ragistration',array('ragistration_user_id' => $user_id));

			if($check_user_id->num_rows() > 0){
				$my_array  = array(
						 'ragistration_id' => 'no',
						 'ragistration_msg' => 'invalid_user_id',
			   );
				 echo json_encode($my_array);
			}else{
			   $arr = array(
            'first_name' => $first_name,
						'last_name'  => $last_name,
						'contact_1' => $mobile_no,
						'address' => $address,
						'colony_id' => $colony,
						'ragistration_user_id' => $user_id,
						'ragistration_password' => $password,
						'ragistration_date' => $time_stamp,
				 );

				 if($this->db->insert('customer_ragistration',$arr)){
					  $ragistration_id = $this->db->insert_id();
                     
                      $arr22 = array(
                          
                           'guest_id' => $ragistration_id,
                           'balance_amount' => 0,
                           'account_status' => 'active',
                      
                      );
                     
                     if($this->db->insert('guest_current_balance',$arr22)){
                         $my_array  = array(
							    'ragistration_id' => $ragistration_id,
								'ragistration_msg' => 'success',
						);
						echo json_encode($my_array);
                     }else{
					    echo 'failed';
				    } 
                          
					  
				 }else{
					  echo 'failed';
				 }
			 }
		}
    
        public function customer_ragistration_check_mobile_no($mobile_no){
             $check_user = $this->db->get_where('customer_ragistration',array('contact_1' => $mobile_no));
             if($check_user->num_rows() == 1){
			  $ragistration_status = $check_user->result()[0]->ragistration_status;
			  $new_customer_id = $check_user->result()[0]->assigned_customer_id;
			  $ragistration_id = $check_user->result()[0]->ragistration_id;
			    if($ragistration_status == 'completed'){
					 return array(
		               'customer_id' => $new_customer_id,
		               'customer_role' => 'customers',
					  
		             );
				}else{
					if($ragistration_id){
					  return array(
		               'customer_id' => $ragistration_id,
		               'customer_role' => 'ragister_customer',
		              );
				    }else{
 	    	        return array(
		               'customer_id' => 'no',
		               'customer_role' => 'no',
		              );
 	               }
				}
             }else{
		           return array(
		               'customer_id' => 'no',
		               'customer_role' => 'no',
		              );
		    }
            
            
        }
//=========********===========********========******========//
// ************ customer Special orders section ***********//
//=========********===========********========******========//
		   public function customer_special_orders($customer_id,$product_array,$delivery_date,$total_price)
			 {
				 date_default_timezone_set('Asia/Kolkata');
				 $date = new DateTime();
				 $mydate = $date->format('Y-m-d');
				 $time_stamp = $date->format('Y-m-d H:i:s');

				 $delivery_date = date('Y-m-d',strtotime($delivery_date));

				    $p = json_encode($product_array);
				    $arr = array(
							    'order_date' => $time_stamp,
                  'customer_id' => $customer_id,
									'order_details' => $p,
									'total_price' => $total_price,
									'delivery_date' => $delivery_date,
						);
						if($this->db->insert('special_orders',$arr)){
							echo 'success';
						}else {
							echo 'failed';
						}
			 }

			 public function order_history($customer_id)
			 {
				 $this->db->select('*');
				 $this->db->from('special_orders');
				 $this->db->where('special_orders.customer_id', $customer_id);
				 $this->db->order_by('order_date','desc');
				 $data = $this->db->get();
				 return $data->result();
			 }

      public function order_history_filter($customer_id,$date)
      {
				$month = date('m',strtotime($date));
				$this->db->select('*');
				$this->db->from('special_orders');
				$this->db->where('special_orders.customer_id', $customer_id);
				$this->db->where('Month(order_date)', $month);
				 $this->db->order_by('order_date','desc');
				$data = $this->db->get();
				return $data->result();
      }

			public function order_details($order_id)
			{
				$this->db->select('*');
				$this->db->from('special_orders');
				$this->db->where('special_orders.special_order_id', $order_id);

				$data = $this->db->get();
				return $data->result();
			}

			public function order_item_details($order_id)
			{
				$this->db->select('*');
				$this->db->from('special_orders');
				$this->db->where('special_orders.special_order_id',$order_id);
				$data = $this->db->get();
				if($data->num_rows() == 1){
			        $data_array = array();

					     $item_data = $data->result()[0]->order_details;


			         foreach(json_decode($item_data) as $row){
			           $qty = $row->qty;
								 $product_id = $row->product_id;

								 $this->db->select('*');
								 $this->db->from('dairy_products');
								 $this->db->where('dairy_products.product_id',$product_id);
								 $data = $this->db->get();
			           if($data->num_rows() > 0){
									 $detail = ['product_id' => $product_id, 'product_name' => $data->result()[0]->product_name, 'unit' => $data->result()[0]->unit, 'order_qty' => $qty];
								 }else{
								   $detail = ['product_id' => $product_id, 'product_name' => '-', 'unit' => '-', 'order_qty' => '-'];
								 }
								 array_push($data_array,$detail);

							 }

							 return json_encode($data_array);
				}
			}


// //-----//////------/////--------/////////------///////
// //======= Location Tracking======//////
// //-----//////------/////--------/////////-------//////

			 // agent Section
			 	
    public function location_tracking($lat,$lng,$agent_id){

			 		$check_agent = $this->db->get_where('agent_location',array( "agent_id" => $agent_id));

			 		if($check_agent->num_rows() > 0){
			 			$get_lat = $check_agent->result()[0]->lat;
			 			$get_lng = $check_agent->result()[0]->lng;
			 			if($lat != $get_lat && $lng != $get_lng){

			 			$arr1 = array(

			 			    "lat" => $lat,
			 				"lng" => $lng

			 			);
			 			$this->db->where("agent_id",$agent_id);
			 			$this->db->update('agent_location',$arr1);


			 			}


			 		}
			 	}

			 	public function agent_customers_location($login_email){
			 		$this->db->select('*');
			         $this->db->from('team_member');
			         $this->db->where('team_member.user_id', $login_email);
			 		$this->db->join('agent_location','agent_location.agent_id = team_member.user_id');
			         $this->db->join('customer_details','customer_details.assigned_user_id = team_member.user_id','left');
			 		$this->db->join('customer_location','customer_location.customer_id = customer_details.customer_id','left');


			 		$data = $this->db->get()->result();
			 		return $data;

			 	}

			 	public function update_location($agent_id){

			 	   $this->db->select('*');
			        $this->db->from('agent_location');
			 	   $this->db->where('agent_location.agent_id', $agent_id);
			 	   $this->db->join('team_member','team_member.user_id = agent_location.agent_id');
			 	   $data = $this->db->get();

			 	   return $data->result();

			    }
			 // customer_section

			     public function customer_data_for_location($login_email){

			         $this->db->select('*');
			         $this->db->from('customer_details');
			         $this->db->where('customer_details.customer_id', $login_email);
			 		$this->db->join('customer_location','customer_location.customer_id = customer_details.customer_id','left');
			         $this->db->join('agent_location','agent_location.agent_id = customer_details.assigned_user_id','left');
			 		$this->db->join('team_member','team_member.user_id = customer_details.assigned_user_id','left');
			 		$data = $this->db->get()->result();
			 		return $data;

			     }

			     public function customer_data_for_add_marker($login_email){

			 		$this->db->select('*');
			         $this->db->from('customer_details');
			         $this->db->where('customer_details.customer_id', $login_email);
			 		$this->db->join('customer_location','customer_location.customer_id = customer_details.customer_id','left');
			 		$data = $this->db->get()->result();
			 		return $data;


			 	}

			 	public function customer_add_locations($customer_id,$customer_lat,$customer_lng){

			 		$check_customer = $this->db->get_where('customer_location',array('customer_id' => $customer_id));

			 		if($check_customer->num_rows() > 0 ){
			 			$arr2 = array(
			 			    "customer_lat" =>  $customer_lat,
			 				"customer_lng" =>  $customer_lng
			 			);

			 			$this->db->where('customer_id',$customer_id);
			 			if($this->db->update('customer_location',$arr2)){
			 				echo "success";
			 			}else{
			 				echo "failed";
			 			}

			 		}else{
			 			$arr = array(
			 			    "customer_id" => $customer_id,
			 			    "customer_lat" =>  $customer_lat,
			 				"customer_lng" =>  $customer_lng
			 			);
			 		    if($this->db->insert('customer_location',$arr)){
			 		    	echo "success";
			 		    }else{
			 		    		echo "failed";
			 	        };
			 		}
			 	}

// //-----//////------/////--------/////////------///////
// //======= Ckeck app version number======//////
// //-----//////------/////--------/////////-------//////
			     public function check_app_version(){

			           $this->db->select('*');
			 		  $this->db->from('app_version');
			 		  $data = $this->db->get();

			 		  if($data->num_rows() == 1){

			 			   $version_code = $data->result()[0]->version_no;
			 			   echo $version_code;
			 		  }else{

			 			  echo "failed";
			 		  }
			     }
				 
// //-----//////------/////--------/////////------///////
// //======= select customer extra order ======//////
// //-----//////------/////--------/////////-------//////	
     
       public function select_customer_extra_order($barcode_id){
		            date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
				  
		              $this->db->select('*');
			 		  $this->db->from('atm_card_detail');
					  $this->db->where('qr_code',$barcode_id);
					  $this->db->join('online_orders','online_orders.customer_id = atm_card_detail.customer_id');
					  $this->db->where('order_type','membership');
					  $this->db->where('date(delivery_date)', $mydate);
					  $this->db->where('order_status','placed');
			 		  $data1 = $this->db->get();
					  
                      return $data1->result();	

                     				  
		   
	   }	
// //-----//////------/////--------/////////------///////
// //=======  Agent Extra Orders ======//////
// //-----//////------/////--------/////////-------////// 

       public function select_guest_extra_orders($agent_id){
                   date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
				  
		              $this->db->select('*');
			 		  $this->db->from('online_orders');
					  $this->db->where('date(delivery_date)',$mydate);
					  $this->db->where('order_type','e_order');
					 
					  $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id');
				      
                    $this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
					   
				     $this->db->where('online_orders.delivery_person',$agent_id);
                     //$this->db->group_by('online_orders.customer_id');
			 		  $data1 = $this->db->get();
					  
                      return $data1->result();	

	   }

       public function select_agent_extra_order_filter($user_id,$status,$colony_id){
		   
		            date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
				  
		              $this->db->select('*');
			 		  $this->db->from('online_orders');
					  
					 
					  $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id');
					   $this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
					   
					   
					   if($user_id){
					   
					    $this->db->where('online_orders.delivery_person',$user_id);
					   }
					   
					   if($colony_id){
						    $this->db->where('customer_ragistration.colony_id',$colony_id);
					   }
					   
					   if($status){
						   
						   if($status == 'placed' || $status == 'delivered'){
						     $this->db->where('order_status',$status);
						   }
					   }
					   $this->db->where('date(delivery_date)',$mydate);
					  $this->db->where('order_type','e_order');
					 
					   
			 		  $data1 = $this->db->get();
					  
                      return $data1->result();	
		   
	   }

       public function count_pending_extra_orders($user_id,$status,$colony_id){
                  
				  date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
				  
		              $this->db->select('COUNT(online_orders.online_order_id) AS sum_extra_orders');
			 		  $this->db->from('online_orders');
					  $this->db->where('date(delivery_date)',$mydate);
					  $this->db->where('order_type','e_order');
					  $this->db->where('order_status','placed');
					 
					  $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id');
					   $this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
					    
						 $this->db->where('online_orders.delivery_person',$user_id);
						 
						 if($colony_id){
							 $this->db->where('online_orders.colony_id',$colony_id);
						 }
			 		  $data1 = $this->db->get();
					  
                      return $data1->result();	
	   
	   }

       public function count_completed_extra_orders($user_id,$status,$colony_id){
                  
				  date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
				  
		              $this->db->select('COUNT(online_orders.online_order_id) AS sum_extra_orders');
			 		  $this->db->from('online_orders');
					  $this->db->where('date(delivery_date)',$mydate);
					  $this->db->where('order_type','e_order');
					  $this->db->where('order_status','delivered');
					  
					  $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id');
					   $this->db->join('colony_detail','colony_detail.colony_id = customer_ragistration.colony_id');
					    $this->db->where('online_orders.delivery_person',$user_id);
						 
						 if($colony_id){
							 $this->db->where('online_orders.colony_id',$colony_id);
						 }
			 		  $data1 = $this->db->get();
					  
                      return $data1->result();	
	   
	   }	
    
// //-----//////------/////--------/////////------///////
// //=======  Guest  Action Section ======//////
// //-----//////------/////--------/////////-------//////     
 
    public function guest_account($guest_id){
                  
		   $this->db->select('*');
           $this->db->from('customer_ragistration');
           $this->db->where('ragistration_id',$guest_id);
           $data = $this->db->get();
					  
                      return $data->result();	
    }  
    
    public function guest_orders($order_id){
                    date_default_timezone_set('Asia/Kolkata');
				    $date = new DateTime();
				    $mydate = $date->format('Y-m-d');
		   $this->db->select('*');
           $this->db->from('customer_ragistration');
           $this->db->where('online_order_id',$order_id);
           $this->db->join('online_orders','online_orders.guest_id = customer_ragistration.ragistration_id');
           $this->db->where('date(delivery_date)',$mydate);
           $this->db->where('order_type','e_order');
           $this->db->where('order_status','placed');
          $data = $this->db->get();
					  
                      return $data->result();	
    } 
    
    public function submit_guest_order($order_id,$agent_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s'); 
        
        $get_order = $this->db->get_where('online_orders',array('online_order_id' => $order_id));
        
        if($get_order->num_rows() == 1){
            
            $paid_amount = $get_order->result()[0]->paid_amount;
            $guest_id = $get_order->result()[0]->guest_id;
            
            if($paid_amount && $guest_id){
                 
                     $arr2 = array(
                                   'customer_id' => null,
                                    'guest_id' => $guest_id,
                                    'transaction_amount' => $paid_amount,
                                    'user_id' => $agent_id,
                                    'order_id' => $order_id,
                                    'customer_type' => 'guest',
                                    'transaction_date' => $time_stamp,
                                );
                  if( $this->db->insert('transaction_detail',$arr2)){
                           $this->db->where('online_order_id',$order_id);
                           $this->db->set('order_status','delivered');
                           $this->db->set('delivery_person',$agent_id);
                           if($this->db->update('online_orders')){
                               echo 'success';   
                           }else{
                               echo 'failed';
                           }         
            
				  }else {
                      echo 'failed';
				 } 
                
            }else{
                echo 'failed';
            }
            
        }else{
                echo 'failed';
            }
        
        
    }
    
// //-----//////------/////--------/////////------///////
// //=======  Customer Manage Requirement======//////
// //-----//////------/////--------/////////-------//////     
    
    public function  customer_daily_requirement($customer_id){
        
           $this->db->select('*');
           $this->db->from('estimated_product_details');
           $this->db->where('customer_id',$customer_id);
           
       $this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');
           $data = $this->db->get();
					  
                      return $data->result();	
        
    }  
    
    public function update_customer_requirement($customer_id,$product_array){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s'); 
        
        $msg = 'failed';
        
        foreach($product_array as $row_product){
            $product_id =  $row_product->product_id;
            $morning_qty = $row_product->morning_qty;
            $evening_qty = $row_product->evening_qty;
            
            
            $this->db->where('customer_id',$customer_id);
            $this->db->where('product_id',$product_id);
            
           if($morning_qty > 0){
            $this->db->set('morning_shift_qty',$morning_qty);
           }
            
           if($evening_qty > 0){    
            $this->db->set('evening_shift_qty',$evening_qty);
           }
            
            $this->db->update('estimated_product_details');
        }
        
        $msg = 'success';
        
        if($msg == 'success'){
            $arr2 = array(
               'customer_id' => $customer_id,
                'guest_id' => null,
                'title' => 'Requirement Update',
                'msg' => '',
                'notification_type' => 'requirement_update',
                'notification_status' => 'unread',
                'notification_date' => $time_stamp,
            
            );
            
            if($this->db->insert('admin_notification',$arr2)){
                echo 'success';
            }else{
              echo 'failed';
            }
        }
        
    }
    
// //-----//////------/////--------/////////------///////
// //=======  Customer Request For Membership ======//////
// //-----//////------/////--------/////////-------//////     
    
    public function check_membership_request($guest_id){
        
           $this->db->select('*');
           $this->db->from('membership_requests');
           $this->db->where('guest_id',$guest_id);
           $this->db->where('status','active');
           $data = $this->db->get();
          
           if($data->num_rows() > 0){
               return 'yes';
           }else{
               return 'no';
           }
        
    }
    
    public function get_membership($guest_id,$p_array,$start_date,$shift){
        
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');  
        
        $p_array = json_encode($p_array);
        
        $check_request = $this->db->get_where('membership_requests',array('guest_id' => $guest_id)); 
           
       if($check_request->num_rows() == 1){
           
             $start_date = date('Y-m-d',strtotime($start_date));
           
             $arr = array(
                 'estimated_product' => $p_array,
                 'start_date' => $start_date,
                 'shift' => $shift,
                 'status' => 'active',
             );
              $this->db->where('guest_id',$guest_id);  
              if($this->db->update('membership_requests',$arr)){
                $request_id = $check_request->result()[0]->request_id;
                 $arr2 = array(
                    'customer_id' => null,
                     'guest_id' => $guest_id,
                     'membership_request_id' => $request_id,
                     'title' => 'Membership Request',
                     'msg' => '',
                     'notification_type' => 'membership_request',
                     'notification_status' => 'unread',
                     
                     'notification_date' => $time_stamp,
                 
                 );
                 
                 if($this->db->insert('admin_notification',$arr2)){
                     echo 'success';
                 }else{
                   echo 'failed';
                 }
                 }else{
                     echo 'failed';
                 }   
        }else{
                 
                 $start_date = date('Y-m-d',strtotime($start_date));
                 $arr = array(
                 
                    'guest_id' => $guest_id,
                     'estimated_product' => $p_array,
                     'start_date' => $start_date,
                     'shift' => $shift,
                     'status' => 'active',
                 );
                     
                 if($this->db->insert('membership_requests',$arr)){
                   $request_id = $this->db->insert_id();
                   $arr2 = array(
                      'customer_id' => null,
                       'guest_id' => $guest_id,
                       'membership_request_id' => $request_id,
                       'title' => 'Membership Request',
                       'msg' => '',
                       'notification_type' => 'membership_request',
                       'notification_status' => 'unread',
                       
                       'notification_date' => $time_stamp,
                   
                   );
                   
                   if($this->db->insert('admin_notification',$arr2)){
                       echo 'success';
                   }else{
                     echo 'failed';
                   }
                   
               }else{
                   echo 'failed';
               }   
        }
    }
    
 // //-----//////------/////--------/////////------///////
// //=======  Feedback Section ======//////
// //-----//////------/////--------/////////-------//////      
  public function feedback($customer_id,$quality_rank,$service_rank,$suggestion){
       date_default_timezone_set('Asia/Kolkata');
       $date = new DateTime();
       $time_stamp = $date->format('Y-m-d H:i:s');
      
      $check = $this->db->get_where('feedback',array( 'customer_id' => $customer_id ));
      
      if($check->num_rows() == 1){
           if($suggestion != ''){
                 $arr = array(
          
                    'quality_rank' => $quality_rank,
                    'service_rank' => $service_rank,
                    'suggestion' =>  $suggestion,
                    'time_stamp' =>  $time_stamp,
                
                  );
               
           }else{
               $arr = array(
          
                    'quality_rank' => $quality_rank,
                    'service_rank' => $service_rank,
                    'time_stamp' =>  $time_stamp,
                
                  );
               
           }
             
          
            $this->db->where('customer_id',$customer_id);
            if($this->db->update('feedback',$arr)){
                echo "success";
            }else{
                echo "failed";
            }
          
          
      }else{
          
          $arr2 = array(
          
               'customer_id' => $customer_id,
              'quality_rank' => $quality_rank,
              'service_rank' => $service_rank,
              'suggestion' =>  $suggestion,
              'time_stamp' =>  $time_stamp,
          
          );
          
          if($this->db->insert('feedback',$arr2)){
              
              echo "success";
          }else{
              
              echo "failed";
          }
          
      }
      
      
  }  
    
  public function select_feedback($customer_id){
      
        $this->db->select('*');
        $this->db->from('feedback');
        $this->db->where('customer_id',$customer_id);
        $data = $this->db->get();
       return $data->result();
      
      
  }    
 // //-----//////------/////--------/////////------///////
// //=======  Calculate Agent Today Cash ======//////
// //-----//////------/////--------/////////-------//////       
  public function calculate_agent_cash($agent_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        $this->db->select('SUM(transaction_amount) AS total_cash_transaction');
        $this->db->from('transaction_detail');
        $this->db->where('user_id',$agent_id);
        $this->db->where('customer_type','cash');
        $this->db->where('date(transaction_date)',$today);
        $transaction = $this->db->get();
       
      
        $this->db->select('SUM(recharge_amount) AS total_cash_recharge');
        $this->db->from('recharge_detail');
        $this->db->where('user_id',$agent_id);
        $this->db->where('date(recharge_date)',$today);
        $recharge = $this->db->get();
      
        return array(
            'cash_transaction' => $transaction->result(),
            'cash_recharge' => $recharge->result(),
        );
      
  } 
    
 // //-----//////------/////--------/////////------///////
// //=======  Payment Gateway Details ======//////
// //-----//////------/////--------/////////-------//////     
    public function payment_gateway_details(){
        
        $this->db->select('*');
        $this->db->from('payment_gateway_details');
        $data = $this->db->get();
        return $data->result();
        
    }
    
// //-----//////------/////--------/////////------///////
// //=======  Select App Content ======//////
// //-----//////------/////--------/////////-------//////       
    public function app_content(){
        
        $this->db->select('*');
        $this->db->from('app_content');
        $data = $this->db->get();
        return $data->result();
        
    }  



   public function check_sms_balance(){
	   
	   
	    $this->db->select('*');
        $this->db->from('sms_account');
        $data = $this->db->get();

		if($data->num_rows() == 1){
			
			echo $data->result()[0]->credit_bal;
		}
   }

    public function insert_sended_msg(){
		
		$this->db->set('sended_sms','sended_sms + 1',FALSE);
		$this->db->update('sms_account');	
	}  
	
// //-----//////------/////--------/////////------///////
// //=======  Send User Ragistration OTP ======//////
// //-----//////------/////--------/////////-------////// 	
     public function send_otp( $mobile_no ,$otp){
      
		                            //***************************//
                                    // ******** send sms *******//
									//**************************//
					                 $msg_server = 'https://www.dms.avsprimetechnology.com/send_dms_msg.php'; 
									$url = $msg_server."?mobile_no=".$mobile_no."&otp_number=".$otp."&template=otp&client_url=".base_url(); 
		                            $cSession = curl_init(); 
                                    curl_setopt($cSession,CURLOPT_URL,$url); 
                                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                                    $result=curl_exec($cSession);
                                    curl_close($cSession);
		                            //print_r($result);
							        //***************************//
                                    // ******** send sms *******//
        
    }	
    
}
