<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_orders extends CI_Model {
	function __construct(){
		parent::__construct();
	}



public function orders($status)
{
    
	 $this->db->select('*,customer_details.first_name AS c_first_name,customer_details.last_name AS c_last_name, customer_details.contact_1 AS c_contact_1');
	 $this->db->from('online_orders');
	 
     
     $this->db->join('customer_details','customer_details.customer_id = online_orders.customer_id','left');
     $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id','left');
    
	 $this->db->where('order_status',$status);
     
     $this->db->order_by('date(online_order_date)','desc');
     $this->db->order_by('online_order_id','desc');
    
	 $data = $this->db->get();
    return $data->result();
 	// $member_customer =  $data->result();
    
	/* $this->db->select('*');
	 $this->db->from('online_orders');
	 $this->db->join('customer_details','customer_details.customer_id = online_orders.customer_id','left');
    
	 $this->db->where('order_status',$status);
     $this->db->where('order_type','membership');
     $this->db->order_by('online_order_id','desc');
     $this->db->limit(100);
	 $data = $this->db->get();
 	 $member_customer =  $data->result();
    
     $this->db->select('*');
	 $this->db->from('online_orders');
	 $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.customer_id','left');
    
	 $this->db->where('order_status',$status);
     $this->db->where('order_type','e_order');
     $this->db->order_by('online_order_id','desc');
     $this->db->limit(100);
	 $data2 = $this->db->get();
 	 $ragister_customer =  $data2->result();
    
     return array_merge($member_customer, $ragister_customer);
    */
    
}
    
public function orders_pending_and_placed($start,$end,$customer_type,$name_search,$status_search){
    
    $status = array('','placed','canceled');
    
      $this->db->select('*,customer_details.first_name AS c_first_name,customer_details.last_name AS c_last_name, customer_details.contact_1 AS c_contact_1');
	 $this->db->from('online_orders');
	 $this->db->join('customer_details','customer_details.customer_id = online_orders.customer_id','left');
     $this->db->join('customer_ragistration','customer_ragistration.ragistration_id = online_orders.guest_id','left');
 
     if($start){
          $start = date('Y-m-d',strtotime($start));
         
          $this->db->where('online_order_date >=',$start);
     }
    
     if($end){
          $end = date('Y-m-d',strtotime($end));
          $this->db->where('online_order_date <=',$end);
     }
    
     if($customer_type == 'member'){
          $this->db->where('customer_details.customer_id !=','');
     }else if($customer_type == 'guest'){
          $this->db->where('customer_ragistration.ragistration_id !=','');
     }
    
     if($name_search){
         
          $this->db->like('customer_ragistration.first_name',$name_search);
         $this->db->or_like('customer_details.first_name',$name_search);
     }
     
     if($status_search ){
         if($status_search == 'all'){
             
         }else if($status_search == 'pending'){
             $this->db->where('order_status','');
         }else{
         $this->db->where('order_status',$status_search);
         }
     }else{
         	 $this->db->where_in('order_status',$status);
     }
    
     $this->db->order_by('date(online_order_date)','desc');
     $this->db->order_by('online_order_id','desc');
	 $data = $this->db->get();
    return $data->result();
    
    
}    
    

public function order_details($order_id)
{
	$this->db->select('*');
	$this->db->from('online_orders');
	$this->db->join('customer_details','customer_details.customer_id = online_orders.customer_id');

	$this->db->where('online_orders.online_order_id',$order_id);
	$data = $this->db->get();
	return $data->result();
}

public function order_accept_or_reject($order_id,$agent_id,$action){
    $this->db->where('online_orders.online_order_id',$order_id);
    $this->db->set('order_status',$action);
     $this->db->set('delivery_person',$agent_id);
    if($this->db->update('online_orders')){
         
        //echo 'success';
            redirect('./orders/view_pending_and_placed_orders');
        
    }else{
        
       //echo 'failed';
       redirect('./orders/view_pending_and_placed_orders');
    }
}
    
public function order_dispatch_and_assign($order_id,$action,$delivery_person){
    $this->db->where('online_orders.online_order_id',$order_id);
    $this->db->set('order_status',$action);
    if($action == 'dispatched'){
        $this->db->set('delivery_person',$delivery_person);
    }
    
    if($this->db->update('online_orders')){
          echo 'success';
        
    }else{
          echo 'failed';
    }
}    

public function change_order_delivery_person($order_id,$delivery_person,$return_href){
    $this->db->where('online_orders.online_order_id',$order_id);
    $this->db->set('delivery_person',$delivery_person);
    if($this->db->update('online_orders')){
            redirect('./orders/'.$return_href);
        
    }else{
        redirect('./orders/'.$return_href);
    }
    
}    
    
public function order_item_details($order_id)
{
	$this->db->select('*');
	$this->db->from('online_orders');
	$this->db->where('online_orders.online_order_id',$order_id);
	$data = $this->db->get();
	return $data;
}


public function accept_orders($order_id,$status)
{
		$this->db->where('online_order_id',$order_id);
		$this->db->set('order_status', $status);
		if($this->db->update('online_orders')){
			echo 'success';
		}else {
			echo 'failed';
		}
}


public function count_orders(){
	$this->db->select('count(online_order_id) AS total');
	$this->db->from('online_orders');
	$this->db->where('online_orders.order_status','');
	$new_order = $this->db->get();
  $n = $new_order->result();

	$this->db->select('count(online_order_id) AS total');
	$this->db->from('online_orders');
	$this->db->where('online_orders.order_status','placed');
	$placed_order = $this->db->get();
	$p = $placed_order->result();

	$this->db->select('count(online_order_id) AS total');
	$this->db->from('online_orders');
	$this->db->where('online_orders.order_status','completed');
	$completed_order = $this->db->get();
	$c = $completed_order->result();

	$this->db->select('count(online_order_id) AS total');
	$this->db->from('online_orders');
	$this->db->where('online_orders.order_status','canceled');
	$canceled_order = $this->db->get();
	$cn = $canceled_order->result();

	return array(
			'new_order_count' => $n,
			'placed_order_count' => $p,
			'completed_order_count' => $c,
			'canceled_order_count' => $cn,
	);

}

    
public function all_delivery_person($user_id){
    
    /*$check_user = $this->db->get_where('staff_member',array('staff_id' => $user_id));
    
    if($check_user->num_rows() == 1){
        
            $outlet_id = $check_user->result()[0]->outlet_id;
            
            $this->db->select('*');
	        $this->db->from('staff_member');
	        $this->db->where('staff_member.role','delivery');
            
           
        
	        $data = $this->db->get();
	        return $data->result();
        
    }
    
    */
}

    public function select_team(){

        $this->db->select('*');
        $this->db->from('team_member');
        $this->db->where('user_id !=' , '1');
        $this->db->where('user_id !=' , '21');
        $this->db->where('role','Agent');
        $data = $this->db->get();
        return $data->result();

    }

}
