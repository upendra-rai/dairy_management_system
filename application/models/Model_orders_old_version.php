<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_orders extends CI_Model {
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

public function orders($status)
{
	 $this->db->select('*');
	 $this->db->from('special_orders');
	 $this->db->join('customer_details','customer_details.customer_id = special_orders.customer_id');
	 $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
	 $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
	 $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
	 $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
	 $this->db->where('order_status',$status);
     $this->db->order_by('order_date','desc');
	 $data = $this->db->get();
 	 return $data->result();
}

public function filter_orders($customer_name,$colony,$status,$start,$end){
     $this->db->select('*');
	 $this->db->from('special_orders');
	 $this->db->join('customer_details','customer_details.customer_id = special_orders.customer_id');
	 $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
	 $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
	 $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
	 $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
     if($colony != ''){
         $this->db->where('customer_details.colony_id',$colony);
     }
     if($start != ''){
         $start = date('Y-m-d',strtotime($start));
         $this->db->where('date(order_date) >=', $start);
     }
     
    if($end != ''){
     $end = date('Y-m-d',strtotime($end));
     $this->db->where('date(order_date) <=', $end);
    }
	 $this->db->where('order_status',$status);
	 $data = $this->db->get();
 	 return $data->result();
}    
 
public function filter_by_delivery_date($delivery_date){
    
    $this->db->select('*');
	 $this->db->from('special_orders');
	 $this->db->join('customer_details','customer_details.customer_id = special_orders.customer_id');
	 $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
	 $this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
	 $this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
	 $this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
    
     if($delivery_date){
         
         $this->db->where('delivery_date', $delivery_date);
     }
    
	 $this->db->where('order_status','placed');
	 $data = $this->db->get();
 	 return $data->result();
}    
    
public function order_details($order_id)
{
	$this->db->select('*,customer_details.password as customer_password');
	$this->db->from('special_orders');
	$this->db->join('customer_details','customer_details.customer_id = special_orders.customer_id');
	$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
	$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');

	$this->db->join('delivery_type_details','delivery_type_details.d_type_id = customer_details.d_type_id');
	$this->db->join('colony_detail','colony_detail.colony_id = customer_details.colony_id');
	$this->db->join('team_member','team_member.user_id = customer_details.assigned_user_id');
	$this->db->where('special_orders.special_order_id',$order_id);
	$data = $this->db->get();
	return $data->result();
}

public function estimated_customer_products($order_id){
		$this->db->select('*');
        $this->db->from('special_orders');
        $this->db->where('special_orders.special_order_id',$order_id);
		$this->db->join('customer_details','customer_details.customer_id = special_orders.customer_id');
		$this->db->join('estimated_product_details','estimated_product_details.customer_id = customer_details.customer_id');
		$this->db->join('dairy_products','dairy_products.product_id = estimated_product_details.product_id');

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


public function accept_orders($order_id,$status)
{
		$this->db->where('special_order_id',$order_id);
		$this->db->set('order_status', $status);
		if($this->db->update('special_orders')){
			echo 'success';
		}else {
			echo 'failed';
		}
}


public function count_orders(){
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

	return array(
			'new_order_count' => $n,
			'placed_order_count' => $p,
			'completed_order_count' => $c,
			'canceled_order_count' => $cn,
	);

}
    
public function check_orders_count($val){
    $this->db->select('count(special_order_id) AS total');
	$this->db->from('special_orders');
    if($val == 'new'){
	 $this->db->where('special_orders.order_status','');
    }
	$new_order = $this->db->get();
    
    if($new_order->num_rows() == 1){
        echo $new_order->result()[0]->total;
    }
}    

     public function select_product(){


                $this->db->select('*');
		    	$this->db->from('dairy_products');
		    	$data = $this->db->get();
                return $data->result();
    }
    
    public function select_all_customers_for_drop_down(){
								$this->db->select('customer_details.customer_id,customer_details.first_name,customer_details.last_name,customer_details.contact_1,atm_card_detail.atm_card_no');
								$this->db->from('customer_details');
								$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
								$data = $this->db->get();
								return $data->result();
			}
    
    public function add_order($customer_id,$delivery_date,$product_array,$total_price){
                 date_default_timezone_set('Asia/Kolkata');
				 $date = new DateTime();
				 $mydate = $date->format('Y-m-d');
				 $time_stamp = $date->format('Y-m-d H:i:s');

				 $delivery_date = date('Y-m-d',strtotime($delivery_date));

				    //$p = json_encode($product_array);
				    $arr = array(
							    'order_date' => $time_stamp,
                                   'customer_id' => $customer_id,
									'order_details' => $product_array,
									'total_price' => $total_price,
									'delivery_date' => $delivery_date,
						);
						if($this->db->insert('special_orders',$arr)){
							 redirect('orders/orders');
						}else {
							echo 'failed';
						}
    }


}
