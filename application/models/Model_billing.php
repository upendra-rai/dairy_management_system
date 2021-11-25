<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_billing extends CI_Model {
	function __construct(){
    date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
	}
    
    
    public function select_dairy_product(){
        
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
        
        $this->db->select('*');
        $this->db->from('dairy_products');
        $this->db->join('dairy_stock','dairy_stock.product_id = dairy_products.product_id','left');
        
        $this->db->where('stock_date',$today_stock_date);
        $data = $this->db->get();
        return $data->result();
        
    }

	
	public function select_e_product()
	{
		        $this->db->select('*');
				$this->db->from('product_details');
				$data = $this->db->get();
				return $data->result();
	}
    
    public function all_customer_list(){
                $this->db->select('*');
				$this->db->from('customer_details');
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->where('card_status','active');
				$data = $this->db->get();
				return $data->result();
        
        
    }
    
    
    public function cash_billing($product_details,$admin_id,$customer_id){
		date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today_stock_date = $date->format('Y-m-d');
        $tran_date = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');
        
        if($customer_id == ''){
            $customer_id = null;
        }
       
         $product_details = json_decode($product_details);
        
        $check_inventory = 'yes';
        
        foreach($product_details as $row){
        
		    $check_agent_stock = $this->db->get_where('dairy_stock',array('stock_date' => $today_stock_date, 'product_id' => $row->product_id));
            
            if($check_agent_stock->num_rows() == 1){
                if($check_agent_stock->result()[0]->remaining_qty >= $row->product_qty){
                    
                }else{
                    $check_inventory = 'no';
                }
            }else{
                $check_inventory = 'no';
            }
            
        }

		if($check_inventory == 'yes'){
            
            
            $this->db->set('customer_id',$customer_id);
            $this->db->set('bill_date',$time_stamp);
            
            if($this->db->insert('bill_details')){
                
                $bill_id = $this->db->insert_id();
            
            foreach($product_details as $row){
                    $get_time = date("H:i:s");
                    if($get_time >= '04:00:00'  && $get_time <= '14:00:00'){
                        $shift_id = 1;
                    }else{
                       $shift_id = 2;
                    }
                  
                   if($row->product_type == 'e_product'){
                       
                       $arr2 = array(
                        "customer_id" => $customer_id,
                        "transaction_amount" => $row->subtotal,
                        "ledger" => null,
                        "product_id" => null,
                        "e_product_id" =>  $row->product_id,
						"product_quantity" => $row->product_qty,
                        "user_id" =>  $admin_id,
                        "shift_id" => $shift_id,
                        "customer_type" =>  'Cash',
					    "transaction_date" => $time_stamp,
                        "bill_id" => $bill_id,

					   );
                   }else if($row->product_type == 'dairy_product'){
                       $arr2 = array(
                        "customer_id" => $customer_id,
                        "transaction_amount" => $row->subtotal,
                        "ledger" => null,
                        "product_id" => $row->product_id,
                        "e_product_id" => null,
						"product_quantity" => $row->product_qty,
                        "user_id" =>  $admin_id,
                        "shift_id" => $shift_id,
                        "customer_type" =>  'Cash',
					    "transaction_date" => $time_stamp,
                         "bill_id" => $bill_id,
					    );
                   }

					
					if($this->db->insert("transaction_detail", $arr2)){
                    

                            $this->db->where('stock_date',$today_stock_date);
							$this->db->where('product_id',$row->product_id);
                            $this->db->set('sold_qty','sold_qty+'.$row->product_qty,FALSE);
							$this->db->set('remaining_qty','remaining_qty-'.$row->product_qty,FALSE);
							if($this->db->update('dairy_stock')){
								
                                if($customer_id){
                                    
                                    $this->db->where('customer_id',$customer_id);
                                    $this->db->set('balance_amount','balance_amount -'.$row->subtotal,FALSE);
                                    if($this->db->update('current_balance')){
                                        echo 'success';
                                       
                                        
                                    }else{
                                        echo 'failed';
                                    }
                                    
                                }else{
                                   echo 'success'; 
                                   
                                }
                                
							}else{
                                 echo "failed";
                            }


					}else{
                        echo 'transaction not inserted';
                    };
		    	
            }
                 redirect('billing/print_invoice/'.$bill_id);
          }else{ 
             echo 'bill not inserted';
         }
		
		}else{ echo "insufficent_stock"; }
    }
    
    public function print_invoice($bill_id){
        
            $this->db->select('*, dairy_products.product_name AS d_product_name,product_details.product_name AS e_product_name ');
            $this->db->from('transaction_detail');
            $this->db->where('transaction_detail.bill_id',$bill_id);
            
            $this->db->join('bill_details','bill_details.bill_id = transaction_detail.bill_id');
            $this->db->join('dairy_products','dairy_products.product_id = transaction_detail.product_id','left');
            $this->db->join('product_details','product_details.product_id = transaction_detail.e_product_id','left');
        
            $this->db->join('customer_details','customer_details.customer_id = transaction_detail.customer_id','left');
           
            $data = $this->db->get();
            return $data->result();
        
    }

}
