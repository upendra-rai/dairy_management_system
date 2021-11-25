<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_notification extends CI_Model {



	function __construct(){



		parent::__construct();

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
    
 
    
    public function customer_report_list($id){
                
                $this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->where('customer_details.customer_id',$id);
                
		    	$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $data = $this->db->get();
                return $data->result();
        
    }
    
    public function customer_full_report_tran($id){
                $this->db->select('*');
		    	$this->db->from('transaction_detail');
                $this->db->where('transaction_detail.customer_id',$id);
                $this->db->where('MONTH(transaction_date)',date('m'));
                $this->db->where('YEAR(transaction_date)',date('Y'));
                $this->db->join('plan', 'plan.plan_id = transaction_detail.plan_id');
                $this->db->join('orders', 'orders.order_id = transaction_detail.order_id');
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
                $this->db->order_by('transaction_date','DESC');
		        $this->db->order_by('transaction_id','DESC');
		    	$data = $this->db->get();
                return $data->result();
        
    }
    
    
    
    public function transaction_report_search($start_date,$end_date){
        
           
          
        
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
             
                $this->db->join('customer_details', 'customer_details.customer_id = transaction_detail.customer_id');
                $this->db->group_by('DATE(transaction_date)');
                $this->db->order_by('transaction_date','DESC');
		    	$data = $this->db->get();
                return $data->result();
        
    }
    
    public function customer_report_multi_searchbar($name_search,$colony_search,$status_search,$mobile_no){
              
        
                $this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->order_by("first_name", "asc");
		       $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = customer_details.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                     if($colony_search != ""){
                        $this->db->where("customer_details.colony_id", $colony_search);
                }
                
                if($status_search != ""){
                        $this->db->where("card_status",$status_search);
                }
                if($name_search != ""){
                         
                            $this->db->like("first_name", $name_search);
				           
                }
                 if($mobile_no != ""){
                         
                            $this->db->like("contact_1", $mobile_no);
				           
                }    
        
                 $data = $this->db->get();
                return $data->result();
        
        
    }
    
    
    public function guest_report_multi_searchbar($name_search,$colony_search,$status_search,$mobile_no){
        
              $this->db->select('*, customer_ragistration.ragistration_id AS customer_id');
		    	$this->db->from('customer_ragistration');
                $this->db->where('ragistration_status','');
                $this->db->order_by("first_name", "asc");
        
                
		       
                $this->db->join('guest_current_balance', 'guest_current_balance.guest_id = customer_ragistration.ragistration_id');
                
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_ragistration.colony_id');
                     if($colony_search != ""){
                        $this->db->where("customer_ragistration.colony_id", $colony_search);
                }
                
                
                if($name_search != ""){
                         
                            $this->db->like("first_name", $name_search);
				           
                }
                 if($mobile_no != ""){
                         
                            $this->db->like("contact_1", $mobile_no);
				           
                }    
        
                 $data = $this->db->get();
                return $data->result();
        
        
    }
    
    public function send_notification($title,$msg,$customer_id_array,$customer_type){
        
        
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $time_stamp = $date->format('Y-m-d H:i:s');
        
        
        $customer_id = explode(',',$customer_id_array);
        $my_msg = 0;
        
        $i = 1;
        
        if($customer_type == 'membership'){
        
        foreach($customer_id as $row){
        $i++;
        $my_msg = $i;     
          $arr = array(
	        "customer_id" => $row,
              "guest_id" => null,
			"title"  => $title,
			"message" => $msg,
			"notification_date" => $time_stamp,
              "customer_type" => 'membership',
	      );
	   
	     $this->db->insert("notification",$arr); 
          }
        }else if($customer_type == 'guest'){
            echo "gg";
            
           foreach($customer_id as $row){
           $i++;
          $my_msg = $i;     
          $arr = array(
	        "customer_id" => null,
              "guest_id" => $row,
			"title"  => $title,
			"message" => $msg,
			"notification_date" => $time_stamp,
              "customer_type" => 'guest',
	      );
	   
	      $this->db->insert("notification",$arr); 
          } 
            
            
        }
        echo 'success';
    }
    
    public function see_all_notification($customer_type,$name_search,$status_search){
    
              $this->db->select('*,customer_details.first_name as f_name, customer_details.last_name as l_name');
              $this->db->from('admin_notification');
              $this->db->join('customer_details', 'customer_details.customer_id = admin_notification.customer_id','left');
               $this->db->join('customer_ragistration', 'customer_ragistration.ragistration_id = admin_notification.guest_id','left');
           
               if($customer_type == 'member'){
                 
                   if($name_search){
                       $this->db->like("customer_details.first_name", $name_search);
                   }
 
               }else if($customer_type == 'guest'){
                    if($name_search){
                       $this->db->like("customer_ragistration.first_name", $name_search);
                   }
               }
        
               
        
               if($status_search){
                    $this->db->where('notification_status',$status_search); 
               }
        
              
        
              $data = $this->db->get();
              return $data->result();
    
    
    
     }

}