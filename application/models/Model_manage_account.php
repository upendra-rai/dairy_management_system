<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_manage_account extends CI_Model {

	function __construct(){

		parent::__construct();

	}

    public function select_all_customers_for_drop_down(){
								$this->db->select('customer_details.customer_id,customer_details.first_name,customer_details.last_name,customer_details.contact_1,atm_card_detail.atm_card_no');
								$this->db->from('customer_details');
								$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
								$data = $this->db->get();
								return $data->result();
			}
   
    
    public function make_transaction($my_date,$amount,$product,$qty,$by,$linked_no){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
           $time_stamp = $date->format('Y-m-d H:i:s');

        $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
		$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_no,));

        if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$avalible_ballance = ($ac_ballance-$amount);

				$arr = array(
		        'balance_amount' => $avalible_ballance,
		        );

		    	$this->db->where('customer_id',$linked_no);
		    	if($this->db->update('current_balance',$arr)){

					
                    $get_time = date("H:i:s", strtotime($my_date));
                    if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                        $shift_id = 1;
                    }else{
                       $shift_id = 2;
                    }

					$arr2 = array(
                        "customer_id" => $linked_no,
                        "transaction_amount" => $amount,
                        "ledger" => $avalible_ballance,
                        "product_id" => $product,
						"product_quantity" => $qty,
                        "user_id" =>  $by,
                        "shift_id" => $shift_id,
					    "transaction_date" => $my_date,

					);
					if($this->db->insert("transaction_detail", $arr2)){
                         
                        
                        $log = $amount.' rs transactions were done.';
            
                         $arr55 = array(
                         
                             'date' =>  $time_stamp,
                             'customer_id' => $linked_no,
                             'log_amount' => $amount,
                             'log_details' => $log,
                         
                         );
                         
                         if($this->db->insert('log_details',$arr55)){
                            redirect(base_url().'/manage_account/transaction/'.$linked_no);
                             
                         }else{
                             redirect(base_url().'/manage_account/transaction/'.$linked_no);
                         }
                        
                    
					}else{
		    		redirect(base_url().'/manage_account/transaction/'.$linked_no);
		    	   };
		    	 }else{
		    		redirect(base_url().'/manage_account/transaction/'.$linked_no);
		    	};

		}else{
			redirect(base_url().'/manage_account/transaction/'.$linked_no);
		}
		
    }
    
    
    public function make_recharge($my_date,$amount,$t_id,$by,$linked_no){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
           $time_stamp = $date->format('Y-m-d H:i:s');

        $this->db->join('current_balance','current_balance.customer_id = atm_card_detail.customer_id');
		$check = $this->db->get_where('atm_card_detail', array('atm_card_detail.customer_id' => $linked_no,));

        if($check->num_rows() == 1){
			$ac_ballance = $check->result()[0]->balance_amount;
			$avalible_ballance = ($ac_ballance+$amount);

				$arr = array(
		        'balance_amount' => $avalible_ballance,
		        );

		    	$this->db->where('customer_id',$linked_no);
		    	if($this->db->update('current_balance',$arr)){

					
                    $get_time = date("H:i:s", strtotime($my_date));
                    if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                        $shift_id = 1;
                    }else{
                       $shift_id = 2;
                    }

					$arr2 = array(
                        "customer_id" => $linked_no,
                        "recharge_amount" => $amount,
                        "user_id" => $by,
                        "recharge_date" => $my_date,
                        "payment_id" => $t_id,
                        "customer_type" => 'membership',
					    

					);
					if($this->db->insert("recharge_detail", $arr2)){
                      
                        
                        $log = $amount.' rs recharge were done.';
            
                         $arr55 = array(
                         
                             'date' =>  $time_stamp,
                             'customer_id' => $linked_no,
                             'log_amount' => $amount,
                             'log_details' => $log,
                         
                         );
                         
                         if($this->db->insert('log_details',$arr55)){
                               redirect(base_url().'/manage_account/recharge/'.$linked_no);
                             
                         }else{
                                redirect(base_url().'/manage_account/recharge/'.$linked_no);
                         }
                    
					}else{
		    		redirect(base_url().'/manage_account/recharge/'.$linked_no);
		    	   };
		    	 }else{
		    		redirect(base_url().'/manage_account/recharge/'.$linked_no);
		    	};

		}else{
			redirect(base_url().'/manage_account/recharge/'.$linked_no);
		}
        
        
    }
    
    public function delete_transaction($del_id){
        date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $mydate = $date->format('Y-m-d');
            $time_stamp = $date->format('Y-m-d H:i:s');
        
        
        $this->db->select('*');
        $this->db->from('transaction_detail');
        $this->db->where('transaction_detail.transaction_id',$del_id);
        $this->db->join('customer_details','customer_details.customer_id = transaction_detail.customer_id');
        $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');   $check = $this->db->get(); 
            
        if($check->num_rows() == 1){
            
            $customer_id = $check->result()[0]->customer_id;
            $transaction_amount =  $check->result()[0]->transaction_amount;   
            
            if($customer_id && $transaction_amount){
                
                $this->db->where('transaction_detail.transaction_id',$del_id);
                if($this->db->delete('transaction_detail')){
                    
                    $this->db->where('customer_id',$customer_id);
                    $this->db->set('balance_amount','balance_amount +'.$transaction_amount,FALSE);
                    if($this->db->update('current_balance')){
                        
                         $log = 'Transaction of '.$transaction_amount.' rs was deleted.';
            
                         $arr55 = array(
                         
                             'date' =>  $time_stamp,
                             'customer_id' => $del_id,
                             'log_amount' => $transaction_amount,
                             'log_details' => $log,
                         
                         );
                         
                         if($this->db->insert('log_details',$arr55)){
                               echo 'success';
                             
                         }else{
                               echo 'failed';
                         }
                        
                        
                       
                    }else{
                        echo 'failed';
                     }
                    
                }
            }
            
            
        }
        
    }

      public function delete_recharge($del_id){
        date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $mydate = $date->format('Y-m-d');
            $time_stamp = $date->format('Y-m-d H:i:s');  
          
        $this->db->select('*');
        $this->db->from('recharge_detail');
        $this->db->where('recharge_detail.recharge_id',$del_id);
        $this->db->join('customer_details','customer_details.customer_id = recharge_detail.customer_id');
        $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');   $check = $this->db->get(); 
            
        if($check->num_rows() == 1){
            
            $customer_id = $check->result()[0]->customer_id;
            $recharge_amount =  $check->result()[0]->recharge_amount;   
            
            if($customer_id && $recharge_amount){
                
                $this->db->where('recharge_detail.recharge_id',$del_id);
                if($this->db->delete('recharge_detail')){
                    
                    $this->db->where('customer_id',$customer_id);
                    $this->db->set('balance_amount','balance_amount -'.$recharge_amount,FALSE);
                    if($this->db->update('current_balance')){
                        
                         $log = 'Recharge of '.$recharge_amount.' rs was deleted.';
            
                         $arr55 = array(
                         
                             'date' =>  $time_stamp,
                             'customer_id' => $del_id,
                             'log_amount' => $recharge_amount,
                             'log_details' => $log,
                         
                         );
                         
                         if($this->db->insert('log_details',$arr55)){
                               echo 'success';
                             
                         }else{
                               echo 'failed';
                         }
                    }else{
                        echo 'failed';
                     }
                    
                }
            }
            
            
        }

    }
    
    
    
    
    public function manage_account_balance($amount,$linked_no){
        date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $mydate = $date->format('Y-m-d');
            $time_stamp = $date->format('Y-m-d H:i:s');
        
        $check = $this->db->get_where('current_balance',array('customer_id' => $linked_no ));
        
        if($check->num_rows() == 1){
        
        $current_balance = $check->result()[0]->balance_amount;    
            
        $this->db->where('customer_id',$linked_no);
        $this->db->set('balance_amount', $amount);
        if($this->db->update('current_balance')){
            
            $log = 'Current balance updated. New balance ='.$amount.' | Previous balance = '.$current_balance;
            
            $arr55 = array(
            
                'date' =>  $time_stamp,
                'customer_id' => $linked_no,
                'log_amount' => $amount,
                'log_details' => $log,
            
            );
            
            if($this->db->insert('log_details',$arr55)){
                redirect(base_url().'/manage_account/account_balance/'.$linked_no);
                
            }else{
                redirect(base_url().'/manage_account/account_balance/'.$linked_no);
            }
        }else{
            redirect(base_url().'/manage_account/account_balance/'.$linked_no);
        }
        }else{
            redirect(base_url().'/manage_account/account_balance/'.$linked_no);
        }
        
    }
    
    
    public function log_history($linked_no){
        
        $this->db->select('*');
        $this->db->from('log_details');
        $this->db->where('customer_id',$linked_no);
        $this->db->order_by('date','desc');
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
					
									$url = base_url()."send_dms_msg.php?mobile_no=".$r_mobile."&name=".urlencode($cus_name)."&recharge_amount=".+$recharge_value."&avl_balance=".+$total_ballance."&template=recharge"; 
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
					
									$url = base_url()."send_dms_msg.php?mobile_no=".$mobile_no."&name=".urlencode($cus_name)."&avl_balance=".+$returning_amount."&template=terminate"; 
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
                $this->db->select('*,dairy_products.product_name AS dairy_product, product_details.product_name AS e_product');
		    	$this->db->from('transaction_detail');
                $this->db->join('team_member', 'team_member.user_id = transaction_detail.user_id');
                $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id','left');
                $this->db->join('product_details', 'product_details.product_id = transaction_detail.e_product_id','left');
                 $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id');
                $this->db->join('delivery_shift', 'delivery_shift.shift_id = transaction_detail.shift_id');
                $this->db->where('transaction_detail.customer_id',$id);
		        $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
               
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


}
