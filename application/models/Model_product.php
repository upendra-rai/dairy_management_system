<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_product extends CI_Model {



	function __construct(){



		parent::__construct();

	}

    public function select_product(){
        
        $this->db->select('*');
        $this->db->from('dairy_products');
        $data = $this->db->get();
        return $data->result();
        
    }

	public function add_product_submit($name,$price,$unit,$product_type,$required_milk){
           
			$arr = array(
		
		    'product_name' => $name,
                'unit' => $unit,
			'product_price' => $price,
            'product_type' => $product_type,
            'required_milk' =>   $required_milk,  
            
		    );
		
		    if($this->db->insert('dairy_products',$arr)){
		    	$p_id = $this->db->insert_id();
                
                $this->db->select('*');
                $this->db->from('customer_details');
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
                $cus = $this->db->get();
                
                if($cus->num_rows() > 0){
                    
                    foreach($cus->result() as $row){
                        
                        $this->db->set('customer_id',$row->customer_id);
                        $this->db->set('product_id',$p_id);
                        $this->db->insert('estimated_product_details');
                        
                    }
                    
                    
                }
                
		    	return "success";
		    }else{
			
			return "failed";
		    };

	}
    
  
    
    public function update_product_submit($name,$unit,$price,$id,$product_type,$required_milk){
        $arr = array(
		
		    'product_name' => $name,
            'unit' => $unit,
			'product_price' => $price,
		    'product_type' => $product_type,
            'required_milk' =>   $required_milk,  
		    );
		    $this->db->where('product_id',$id);
		    if($this->db->update('dairy_products',$arr)){
		    	
		    	return "updatesuccess";
		    }else{
			
			return "failed";
		    };
        
    }
   
    public function delete_product($del_id){
        
        $this->db->where('product_id',$del_id);
        if($this->db->delete('dairy_products')){
            
            echo 'success';
        }else{
            echo 'failed';
        }
    }
  

}