<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_e_commerce_app_interface extends CI_Model {



	function __construct(){



		parent::__construct();
        date_default_timezone_set('Asia/Kolkata');

	}

/* *********||*********|******************|*********||********* */
/* *********||*********|User Login Section|*********||********* */
/* *********||*********|******************|*********||********* */

    public function user_login_model($user_name,$password){
		$check = $this->db->get_where('staff_member', array(
					'user_name' => $user_name,
					'user_password' => $password,
				));
		if($check->num_rows() == 1){
          echo $check->result()[0]->staff_id;
        }else{
	    	echo "failed";
	    }
    }

    public function user_ragistration_submit($customer_name,$mobile_no,$address)
    {
			$check = $this->db->get_where('customer_details', array(
						'contact_1' => $mobile_no,
					));
       if($check->num_rows() > 0){
				 return array(
					 'msg' => 'already_exist',
					 'customer_id' => '',
				 );
			 }else{

				   $arr = array(
						    'customer_name' => $customer_name,
								'contact_1' => $mobile_no,
								'contact_2' => 0,
                                'address' => $address,
								'dob' =>  0000-00-00,
								'anniversary' => 0000-00-00,
								'class_id' => 1,
								'customer_type' => 'food_delivery_app',
					 );

					 if($this->db->insert('customer_details',$arr)){
						  $customer_id = $this->db->insert_id();
						   return array(
								   'msg' => 'success',
									 'customer_id' => $customer_id,
							 );
					 }else{
						   return array(
								 'msg' => 'failed',
								 'customer_id' => '',
							 );
					 }
			 }

    }

		public function submit_login($mobile_no)
    {
			$check = $this->db->get_where('customer_details', array(
						'contact_1' => $mobile_no,
						'customer_type' => 'food_delivery_app',
					));
       if($check->num_rows() == 1){
				   $customer_id = $check->result()[0]->customer_id;
					 if($customer_id){
						 return array(
								 'msg' => 'success',
								 'customer_id' => $customer_id,
						 );
					 }
			 }else{

				 return array(
						 'msg' => 'account_no_exist',
						 'customer_id' => '',
				 );
			 }

    }

		public function customer_profile_data($customer_id)
		{
			  $this->db->select('*');
				$this->db->from('customer_details');
				$this->db->where('customer_details.customer_id',$customer_id);
                $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
                 $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
				$data = $this->db->get();
				return $data->result();
		}
    
    
    public function update_customer_profile($linked_id,$customer_name,$email_id,$mobile_no,$address){
        
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $time_stamp = $date->format('Y-m-d H:i:s');
		
        $check  = $this->db->get_where('customer_details', array( 'customer_id !=' => $linked_id,   'contact_1' => $mobile_no));
        
        if($check->num_rows() > 0 ){
            
            echo "invalid_mobile";
            
        }else{
            
            $check_email = $this->db->get_where('customer_details', array( 'customer_id !=' => $linked_id, 'email_id' =>$email_id));
        
            if($check_email->num_rows > 0){
                
                echo "invalid_email";
            }else{
            
        $arr = array(
		    'customer_name' => $customer_name,
			'contact_1' => $mobile_no,
            'email_id' => $email_id,
			'address' => $address,			
		); 
        $this->db->where('customer_id',$linked_id);
		if($this->db->update('customer_details',$arr)){
          
           echo "success";
             
		}else{
			echo "fail";
		};
       
            }
            
        }
	}
/* *********||*********|******************|*********||********* */
/* *********||*********|Merchant List Section|*********||********* */
/* *********||*********|******************|*********||********* */
    
    public function select_outlet(){
          $this->db->select('*');
          $this->db->from('outlet_details');
          $data = $this->db->get();
          return $data->result();
    }    
/* *********||*********|******************|*********||********* */
/* *********||*********|Customer product Section|*********||********* */
/* *********||*********|******************|*********||********* */

     public function banner_list(){

	      $this->db->select('*');
          $this->db->from('app_banner');
          $data = $this->db->get();
          return $data->result();

	}
    
     public function select_offer_banner(){

	      $this->db->select('*');
          $this->db->from('offer_banner');
          $data = $this->db->get();
          return $data->result();

	}

    public function product_category_list($merchant_id){

	      $this->db->select('*');
          $this->db->from('product_category');
					$this->db->where('outlet_id',$merchant_id);
          $this->db->where('category_status','active');
          $data = $this->db->get();
          return $data->result();

	}

/* *********||*********|******************|*********||********* */
/* *********||*********|Customer Item Details Section|*********||********* */
/* *********||*********|******************|*********||********* */
    public function select_subcategory_by_category($category_id){
          $this->db->select('*');
          $this->db->from('product_sub_category');

          $this->db->where('product_sub_category.product_category_id',$category_id);
          $this->db->where('product_subcategory_status','active');
          $data = $this->db->get();


         if($data->num_rows() > 0){
              $return_array = array();

              foreach($data->result() as $row){

                  $mysub_category_id =  $row->product_sub_category_id;
                  $mysub_category_name = $row->product_sub_category_name;
                  $base_href = base_url();

                  $this->db->select('*, product_details.product_id as my_product_id');
                  $this->db->from('product_details');
                  $this->db->where('product_details.product_sub_category_id',$mysub_category_id);
                  $this->db->where('product_details.product_status','active');
                  $product_data = $this->db->get()->result();
                  $encoded_product_data = json_encode($product_data);

                  $custome_array = array('base_href' => $base_href, 'sub_category_id' => $mysub_category_id, 'sub_category_name' => $mysub_category_name,'product_data' => $encoded_product_data);

                  array_push($return_array,$custome_array);

              }

             return $return_array;

          }else{
             $return_array = array();

             

                  $base_href = base_url();

                  $this->db->select('*, product_details.product_id as my_product_id');
                  $this->db->from('product_details');
                  $this->db->where('product_details.product_category_id',$category_id);
                  $this->db->where('product_details.product_status','active');
                  $product_data = $this->db->get()->result();
                  $encoded_product_data = json_encode($product_data);

                  $custome_array = array('base_href' => $base_href, 'sub_category_id' => '', 'sub_category_name' => 'All','product_data' => $encoded_product_data);

                  array_push($return_array,$custome_array);

             return $return_array;
             
             
         }
    }

    public function select_product_by_subcategory($subcategory_id){
          $this->db->select('*');
          $this->db->from('product_details');
          $this->db->where('product_details.product_sub_category_id',$subcategory_id);
          $this->db->where('product_status','active');
          $data = $this->db->get();
          return $data->result();
    }

    public function count_cart_items($customer_id){
       /*   $this->db->select('*, count(cart_item_details.cart_id) AS total_items , sum(product_details.product_unit_price) AS total_price');
          $this->db->from('cart_item_details');
          $this->db->join('product_details','product_details.product_id = cart_item_details.product_id');
          $this->db->where('cart_item_details.customer_id',$customer_id);

          $data = $this->db->get();
          return $data->result();
		  */
    }

    public function select_cart($customer_id){
          $this->db->select('*');
          $this->db->from('cart_item_details');
          $this->db->join('product_details','product_details.product_id = cart_item_details.product_id');
          $this->db->where('cart_item_details.customer_id',$customer_id);

          $data = $this->db->get();
          return $data->result();
    }

    public function add_item_to_cart($customer_id,$product_id,$product_qty,$product_price,$action){

        $get_product_avl = $this->db->get_where('cart_item_details',array('customer_id' => $customer_id, 'product_id' => $product_id));

        if($get_product_avl->num_rows() == 1){

             if($action == 'update'){

              $cart_id = $get_product_avl->result()[0]->cart_id;

              $this->db->where('cart_id',$cart_id);
              $this->db->set('total_item_quantity','total_item_quantity +'.$product_qty,FALSE);
              $this->db->set('total_item_price','total_item_price +'.$product_price,FALSE);
               if($this->db->update('cart_item_details')){
                   echo 'success';
               }else{
                   echo 'failed';
               }
						 }else if($action == 'remove'){
	                 $this->db->where('customer_id',$customer_id);
									 $this->db->where('product_id',$product_id);
									 if($this->db->delete('cart_item_details')){
		                   echo 'success';
		               }else{
		                   echo 'failed';
		               }
						 }

        }else{

					  $this->db->select('*');
						$this->db->from('product_details');
						$this->db->where('product_id',$product_id);
						$this->db->join('product_category','product_category.product_category_id = product_details.product_category_id');
            $check_restorent = $this->db->get();
            if($check_restorent->num_rows() == 1){

                 $restorent_id = $check_restorent->result()[0]->outlet_id;

								 $arr = array(

	                       "customer_id" =>  $customer_id,
	                       "product_id" => $product_id,
	                       "total_item_quantity" => $product_qty,
	                       "total_item_price" => $product_price,
	                       "extra_items_id" => 1,
												 "outlet_id" => $restorent_id,

	               );

	               if($this->db->insert('cart_item_details',$arr)){
	                   echo 'success';
	               }else{
	                   echo 'failed';
	               }
						}

        }
    }

/* *********||*********|******************|*********||********* */
/* *********||*********|cart Section|*********||********* */
/* *********||*********|******************|*********||********* */

  public function select_cart_data($customer_id){
		   /*   $this->db->select('*,SUM(cart_item_details.total_item_price) as sum_item_price');
		      $this->db->from('cart_item_details');
					$this->db->where('cart_item_details.customer_id',$customer_id);
					$this->db->join('outlet_details','outlet_details.outlet_id = cart_item_details.outlet_id');
					$this->db->group_by('cart_item_details.outlet_id');
					$outlet = $this->db->get();



					if($outlet->num_rows() > 0){
            $return_cart_array = array();

						 foreach($outlet->result() as $row){
						 $outlet_id = $row->outlet_id;
						 $outlet_name = $row->outlet_name;
						 $sum_item_price = $row->sum_item_price;

             $cart_data = array('outlet_name' => $outlet_name, 'sum_item_price' => $sum_item_price, );


						 $this->db->select('*');
						 $this->db->from('cart_item_details');
						 $this->db->where('cart_item_details.customer_id',$customer_id);
						 $this->db->where('cart_item_details.outlet_id',$outlet_id);
						 $this->db->join('product_details','product_details.product_id = cart_item_details.product_id');

						 $data = $this->db->get();
						 //return $data->result();
             if($data->num_rows() > 0){
               $cart_encode = json_encode($data->result());

							 $cart_data += ['cart_details' => $cart_encode];
						 }
						 array_push($return_cart_array,$cart_data);
					 }


						return $return_cart_array;
					}

          */

  }

	public function submit_online_orders($customer_id,$cart_item_array,$cart_total_price,$cart_total_qty,$payment_id,$type,$tax_amount,$packing_charge,$delivery_charge,$total,$point_discount,$coupan_discount,$pay_amount,$delivery_details,$outlet_id,$order_type,$delivery_date){    $date = new DateTime();
         $time_stamp = $date->format('Y-m-d H:i:s');
         $today = $date->format('Y-m-d');   
         $delivery_date = date('Y-m-d',strtotime($delivery_date));
         if($type == 'wallet'){
         
         
        $this->db->select('*');
        $this->db->from('guest_current_balance'); 
        $this->db->where('guest_id',$customer_id);  
      
         $check_wallet = $this->db->get();    
             
            
         if($check_wallet->num_rows() == 1){
             $wallet_balance = $check_wallet->result()[0]->balance_amount;
             
             if($wallet_balance >= $pay_amount){
                 $valid = 'yes';
             }else{
                  $valid = 'no';
             }
             
            
         }else{
             $valid = 'no';
         }  
         }else{
             $valid = 'yes';
         }
         
         if($valid == 'yes'){
                      if($point_discount){
                          
                           $this->db->where('guest_id',$customer_id);
                           $this->db->set('loyalty_points',0);
                           $this->db->update('customer_points');
                          
                      }
             
                      $check_loyalty = $this->db->get('delivery_app_settings');
                       $sales_figure = $check_loyalty->result()[0]->loyalty_sales_figure;
                       $sales_point = $check_loyalty->result()[0]->loyalty_sales_point;
                       if(!$sales_figure){
                            $sales_figure = 0;
                        }  
                       
                      if($sales_figure > 0){
                            
                            if($pay_amount >= $sales_figure){
                                
                                $check_user_loyalty_point = $this->db->get_where('customer_points',array('guest_id' => $customer_id));
                                
                                if($check_user_loyalty_point->num_rows() > 0){
                                   $this->db->where('guest_id',$customer_id);
                                   $this->db->set('loyalty_points','loyalty_points + '.$sales_point,FALSE);
                                    
                                   $this->db->update('customer_points');
                                }else{
                                     
                                     $my_arr = array(
                                        'guest_id' => $customer_id,
                                        'loyalty_points' => $sales_point,
                                        'customer_type' => 'guest',
                                     );
                                   
                                   $this->db->insert('customer_points',$my_arr);
                                 }
                            }
                            
                         } 
                                                                                                                        
                                                                                                                            
							$arr = array(
                                    'customer_id' => null,
                                    'guest_id' => $customer_id,
									'online_order_details' => $cart_item_array,
                                    'delivery_details' => $delivery_details, 
                                    'cart_total' => $cart_total_price,
                                    'total_order_price' => $total,
                                    'order_tax' => $tax_amount,
                                    'packing_charge' => $packing_charge,
                                    'delivery_charge' => $delivery_charge,
                                    'point_discount' => $point_discount,
                                    'coupan_discount' => $coupan_discount,
                                    'paid_amount' => $pay_amount,
                                    'payment_method' => $type,
									'online_order_date' => $time_stamp,
									'delivery_date' => $delivery_date,
                                    'outlet_id' => $outlet_id,
                                    'order_type' => 'e_order',
							);
							if($this->db->insert('online_orders',$arr)){
                                $online_order_id = $this->db->insert_id();
								
                                 if($type == 'wallet'){
                                            $this->db->where('guest_id',$customer_id);
                                            $this->db->set('balance_amount','balance_amount - '.$pay_amount,FALSE );
                                            if($this->db->update('guest_current_balance')){
                                                    echo $online_order_id;
                                             }else{
                                                   echo 'failed';
                                              }
                                              
                                    }else{
                                        echo $online_order_id;
                                    }
                                
                                
                           /*  $arr2 = array(
                                   'customer_id' => null,
                                    'guest_id' => $customer_id,
                                    'transaction_amount' => $pay_amount,
                                    'user_id' => 21,
                                    'order_id' => $online_order_id,
                                    'customer_type' => 'guest',
                                    'transaction_date' => $time_stamp,
                                    
                                
                                );
                               
                                if( $this->db->insert('transaction_detail',$arr2)){
                                    
                                   
                                    
                             
                                
							}else {
								echo 'failed';
							} */
                                
         }else{
             echo 'invalid';
         }
         }
  }
    
    
   public function submit_members_orders($customer_id,$cart_item_array,$cart_total_price,$cart_total_qty,$payment_id,$type,$tax_amount,$packing_charge,$delivery_charge,$total,$point_discount,$coupan_discount,$pay_amount,$delivery_details,$outlet_id,$delivery_date,$applied_coupan){    $date = new DateTime();
         $time_stamp = $date->format('Y-m-d H:i:s');
         $today = $date->format('Y-m-d');  
         $delivery_date = date('Y-m-d',strtotime($delivery_date));
         
                    if($point_discount){
                          
                           $this->db->where('customer_id',$customer_id);
                           $this->db->set('loyalty_points',0);
                           $this->db->update('customer_points');
                          
                      }
                     
                       $check_loyalty = $this->db->get('delivery_app_settings');
                       $sales_figure = $check_loyalty->result()[0]->loyalty_sales_figure;
                       $sales_point = $check_loyalty->result()[0]->loyalty_sales_point;
                       if(!$sales_figure){
                            $sales_figure = 0;
                        }                                                                                                
                        if($sales_figure > 0){
                            
                            if($pay_amount >= $sales_figure){
                                
                                $check_user_loyalty_point = $this->db->get_where('customer_points',array('customer_id' => $customer_id));
                                
                                if($check_user_loyalty_point->num_rows() > 0){
                                   $this->db->where('customer_id',$customer_id);
                                   $this->db->set('loyalty_points','loyalty_points + '.$sales_point,FALSE);
                                   $this->db->update('customer_points');
                                }else{
                                     
                                     $my_arr = array(
                                        'customer_id' => $customer_id,
                                        'loyalty_points' => $sales_point,
                                     );
                                   
                                   $this->db->insert('customer_points',$my_arr);
                                 }
                            }
                            /* $loyalty_point = $cart_total_price / $per_loyalty_cost;
                             $rount_point = round($loyalty_point);
                             if($rount_point){
                                 $check_user_loyalty_point = $this->db->get_where('customer_points',array('customer_id' => $customer_id));
                                 
                                 if($check_user_loyalty_point->num_rows() > 0){
                                 
                                   $this->db->where('customer_id',$customer_id);
                                   $this->db->set('loyalty_points','loyalty_points + '.$rount_point,FALSE);
                                   $this->db->update('customer_points');
                                 }else{
                                     
                                     $my_arr = array(
                                        'customer_id' => $customer_id,
                                        'loyalty_points' => $rount_point,
                                     );
                                   
                                   $this->db->insert('customer_points',$my_arr);
                                 }
                             }*/
                         } 
             
                         if($coupan_discount){
                             
                             $coupan_id = explode(',',$applied_coupan);
                             
                             if($coupan_id){
                                 
                                 foreach($coupan_id as $coupan_row){
                                     
                                     $this->db->set('customer_promo_code_status','used');
                                     $this->db->where('customer_id',$customer_id);
                                     $this->db->where('promo_code_id',$coupan_row);
                                     $this->db->update('customer_promo_code');
                                 }
                             }
                             
                         }
                               
                       
                            
							$arr = array(
                                   
                                    'customer_id' => $customer_id,
                                    'guest_id' => null,
									'online_order_details' => $cart_item_array,
                                    'delivery_details' => $delivery_details, 
                                    'cart_total' => $cart_total_price,
                                    'total_order_price' => $total,
                                    'order_tax' => $tax_amount,
                                    'packing_charge' => $packing_charge,
                                    'delivery_charge' => $delivery_charge,
                                    'point_discount' => $point_discount,
                                    'coupan_discount' => $coupan_discount,
                                    'paid_amount' => $pay_amount,
                                    'payment_method' => 'wallet',
									'online_order_date' => $time_stamp,
									'delivery_date' => $delivery_date,
                                    'outlet_id' => $outlet_id,
                                    'order_type' => 'membership',
							);
							if($this->db->insert('online_orders',$arr)){
                                $online_order_id = $this->db->insert_id();
                                echo $online_order_id;
							}else {
								echo 'failed';
							}
        
  }
/* *********||*********|******************|*********||********* */
/* *********||*********|Search Items Section|*********||********* */
/* *********||*********|******************|*********||********* */
	  public function search_items($val)
	  {
			$this->db->select('*,product_details.product_id as my_product_id');
			$this->db->from('product_details');
			$this->db->like('product_details.product_name',$val);
			$this->db->where('product_details.product_status','active');
			$data = $this->db->get();
			return $data->result();

	   }

		 public function fetch_selected_item_details($item_id)
		 {
			 $this->db->select('*,product_details.product_id as my_product_id');
 			 $this->db->from('product_details');
 		   $this->db->like('product_details.product_id',$item_id);
 			 $data = $this->db->get();
 			 return $data->result();
		 }

//=========********===========********========******========//
// ************ customer Special orders section ***********//
//=========********===========********========******========//

		 			 public function order_history($customer_id,$role)
		 			 {
		 				 $this->db->select('*');
		 				 $this->db->from('online_orders');
		 				 
                         
                         if($role == 'ragister_customer'){
                             $this->db->where('online_orders.guest_id', $customer_id);
                             $this->db->where('order_type','e_order');
                         }else{
                             $this->db->where('online_orders.customer_id', $customer_id);
                             
                         }
                         
		 				 $this->db->order_by('online_order_date','desc');
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
		 				$this->db->from('online_orders');
		 				$this->db->where('online_orders.online_order_id', $order_id);

		 				$data = $this->db->get();
		 				return $data->result();
		 			}

		 			/*public function order_item_details($order_id)
		 			{
		 				$this->db->select('*');
		 				$this->db->from('online_orders');
		 				$this->db->where('online_orders.online_order_id',$order_id);
		 				$data = $this->db->get();
		 				return $data;
		 			}
          */

// //-----//////------/////--------/////////------///////
// //======= Notification Section ======//////
// //-----//////------/////--------/////////-------//////

					     public function user_notification($user_id){
						    $this->db->select('*');
					        $this->db->from('notification');
					        $this->db->join('customer_details','customer_details.customer_id = notification.customer_id');
							$this->db->where('notification.customer_id', $user_id);
					        $this->db->order_by('notification_id','desc');
					        $data = $this->db->get()->result();
							return $data;
					    }

					    public function read_notification($id){


						    $this->db->select('*');
					        $this->db->from('notification');
					        $this->db->where('notification_id',$id);
					        $this->db->join('customer_details','customer_details.customer_id = notification.customer_id');
					        $data = $this->db->get()->result();
							return $data;
					   }

					   public function change_notification_status($id){

					       $this->db->where('notification_id',$id);
					       $this->db->set('notification_status','read');
					       $this->db->update('notification');
					   }

					    public function count_notification($user_id){
						    $this->db->select('COUNT(notification_id) AS new_notification');
					        $this->db->from('notification');
					        $this->db->where('customer_id', $user_id);
							$this->db->where('notification_status', '');
					        $data = $this->db->get()->result();
							return $data;
					    }
    
// //-----//////------/////--------/////////------///////
// //======= delivery app Setting ======//////
// //-----//////------/////--------/////////-------//////    
    
     public function select_app_setting(){
         $this->db->select('*');
         $this->db->from('delivery_app_settings');
         $data = $this->db->get();
         return $data->result();
       
     }
 // //-----//////------/////--------/////////------///////
// //======= Point Section ======//////
// //-----//////------/////--------/////////-------//////     
    
    public function user_point($user_id,$role){
         $this->db->select('*');
         $this->db->from('customer_points');
         if($role == 'ragister_customer'){
            $this->db->where('guest_id', $user_id);
         }else{
             $this->db->where('customer_id', $user_id);
         }
         $data = $this->db->get();
         return $data->result();
         
    }
    
// //-----//////------/////--------/////////------///////
// //======= Feedback Section ======//////
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
// //======= Wallet Section ======//////
// //-----//////------/////--------/////////-------//////      
  public function add_money($customer_id,$recharge_amount,$payment_id,$type){
      date_default_timezone_set('Asia/Kolkata');
      $date = new DateTime();
      $time_stamp = $date->format('Y-m-d H:i:s');
      
      
      $check  = $this->db->get_where('current_balance',array('customer_id' => $customer_id));
      
      if($check->num_rows() == 1){
          
          $this->db->where('customer_id',$customer_id);
          $this->db->set('balance_amount','balance_amount +'.$recharge_amount,FALSE);
          if($this->db->update('current_balance')){
              $arr = array(
                  'customer_id' => $customer_id,
                  'recharge_amount' => $recharge_amount,
                  'recharge_date' => $time_stamp,
                  'payment_id' => $payment_id,
                  'type' => $type,
              
              );
              
              if($this->db->insert('recharge_detail',$arr)){
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
// //======= Promo Code Section ======//////
// //-----//////------/////--------/////////-------//////   
    public function select_customer_promo_code($customer_id){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        
        $this->db->select('*');
        $this->db->from('customer_promo_code');
        $this->db->where('customer_id',$customer_id);
        $this->db->join('promo_code','promo_code.promo_id = customer_promo_code.promo_code_id');
        $this->db->where('validate_from <=',$today);
        $this->db->where('validate_to >=',$today);
        $data = $this->db->get();
       return $data->result();
        
    } 
    
    public function check_apply_coupan($apply_type,$apply_id){
        
        $this->db->select('*');
        $this->db->from('product_details');
        
        if($apply_type == 'category'){
             $this->db->where('product_category_id',$apply_id);
        }
        
        if($apply_type == 'subcategory'){
             $this->db->where('product_sub_category_id',$apply_id);
        }
        
        if($apply_type == 'product'){
             $this->db->where('product_id',$apply_id);
        }
        
        $data = $this->db->get();
         return $data->result();
    }
    
// //-----//////------/////--------/////////------///////
// //======= Ckeck app version number======//////
// //-----//////------/////--------/////////-------//////
			     public function check_app_version(){

			           $this->db->select('*');
			 		  $this->db->from('app_version');
			 		  $data = $this->db->get();
                     return $data->result();
			     }
				     

}
