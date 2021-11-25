<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_promo_code extends CI_Model {
	function __construct(){
		parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
	}

     public function select_colony(){
        
                $this->db->select('*');
		    	$this->db->from('colony_detail');
                 $this->db->order_by('colony_name','ASC');
		    	$data = $this->db->get();
                return $data->result();
        
    }
    
   public function select_promo(){

    	$this->db->select('*');
    	$this->db->from('promo_code');
      $this->db->order_by('promo_id','desc');

    	$data = $this->db->get();
    	return $data->result();

    }

   public function selected_promo($id){

    	$this->db->select('*');
    	$this->db->from('promo_code');
        $this->db->where('promo_id',$id);
    	$data = $this->db->get();
    	return $data->result();

    }

	public function add($add_promo_code,$add_detail, $add_discount,$discount_type,$add_date_from,  $add_date_to,$add_term_condition,$product_category,$product_list){
        $current_date = date('Y-m-d');
        $discount = array('type' => $discount_type, 'value' => $add_discount);
        $discount = json_encode($discount);
        
        $apply_on = array('type' => $product_category, 'id' => $product_list);
        $apply_on = json_encode($apply_on);

    	$arr = array(
		            'promo_code'   => $add_promo_code,
                    'promo_discount'      => $discount,

                    'promo_detail'      => $add_detail,
                    'validate_from'    => $add_date_from,

                    'validate_to'   => $add_date_to,
                    'term_condition'  => $add_term_condition,
                    'created_on'  => $current_date,
                    'apply_on' => $apply_on,


                );
			if($this->db->insert('promo_code', $arr)){
                
              redirect('./promo_code/promocode');   
            }
    }

	public function edit($add_promo_code,$add_detail, $add_discount,$discount_type,$add_date_from,  $add_date_to,$add_term_condition,$id,$product_category,$product_list){
           
        
           $discount = array('type' => $discount_type, 'value' => $add_discount);
           $discount = json_encode($discount);
        
           $apply_on = array('type' => $product_category, 'id' => $product_list);
           $apply_on = json_encode($apply_on);    
        
    	 	$arr = array(
		            'promo_code'   => $add_promo_code,
                    'promo_discount'      => $discount,

                    'promo_detail'      => $add_detail,
                    'validate_from'    => $add_date_from,

                    'validate_to'   => $add_date_to,
                    'term_condition'  => $add_term_condition,
                    'apply_on' => $apply_on,

            );

			$this->db->where('promo_id', $id);
			if($this->db->update('promo_code', $arr)){
            redirect('./promo_code/promocode');   
            }

    }

	public function delete_promo($id){

    	$this->db->where('promo_id', $id);
		if($this->db->delete('promo_code')){
            
            echo 'success';
        }else{
            echo 'failed';
        }

    }
    
    public function select_product_by_option($option){
        
       $this->db->select('*');
        
        if($option == 'category'){
            
            $this->db->from('product_category');
            $data = $this->db->get();
            if($data->num_rows() > 0){
                echo '<option value="">All</option>';
                foreach($data->result() as $row){
                    echo '<option value="'.$row->product_category_id.'">'.$row->product_category_name.'</option>';
                }
            }
        }
        
        if($option == 'subcategory'){
            $this->db->from('product_sub_category');
            $data = $this->db->get();
            if($data->num_rows() > 0){
                echo '<option value="">All</option>';
                foreach($data->result() as $row){
                    echo '<option value="'.$row->product_sub_category_id.'">'.$row->product_sub_category_name.'</option>';
                }
            }
        }
        
        if($option == 'product'){
            $this->db->from('product_details');
            $data = $this->db->get();
            if($data->num_rows() > 0){
                
                echo '<option value="">All</option>';
                foreach($data->result() as $row){
                    echo '<option value="'.$row->product_id.'">'.$row->product_name.'</option>';
                }
            }
        }
        
         
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
    

    public function customer_report_multi_searchbar($name_search,$colony_search,$status_search,$mobile_no){
              
        
                $this->db->select('*');
		    	$this->db->from('customer_details');
                
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

                $this->db->order_by("first_name", "asc");
		       $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = customer_details.customer_id');
                $this->db->join('current_balance', 'current_balance.customer_id = customer_details.customer_id');
                $this->db->join('delivery_type_details', 'delivery_type_details.d_type_id = customer_details.d_type_id');
                $this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                 $data = $this->db->get();
                return $data->result();
        
        
    }
    
    public function send_promo_code($promo_id,$customer_id){
           
        $arr = array(
	        "customer_id" => $customer_id,
			"promo_code_id"  => $promo_id,
			
	    );
	   
	   if($this->db->insert("customer_promo_code",$arr)){
           
           return 'success';
       }; 
     
    }

}
