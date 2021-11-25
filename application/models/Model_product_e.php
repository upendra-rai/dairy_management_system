<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_product_e extends CI_Model {



	function __construct(){


       date_default_timezone_set("Asia/Calcutta");
		parent::__construct();

	}
 
     public function select_unit(){
         $this->db->select('*');
         $this->db->from('unit');
         
        $data = $this->db->get();
        return $data->result();
        
    } 
    
     public function select_all_dairy_product(){
        $this->db->select('*');
        $this->db->from('dairy_products'); 
        $data = $this->db->get();
        return $data->result();
        
    } 
    
     public function select_gst(){
         $this->db->select('*');
         $this->db->from('gst');
         
        $data = $this->db->get();
        return $data->result();
        
    } 
    
	public function select_product($category_id,$subcategory_id)
	{
		    $get_category_id = $this->db->get_where('product_category',array('product_category_id' => $category_id ));
        if($get_category_id->num_rows() == 1){

					   $category_have_subcategory = $get_category_id->result()[0]->have_sub_category;

						 if($category_have_subcategory == 'yes'){

							 $this->db->select('*');
							 $this->db->from('product_details');
							 $this->db->join('product_category','product_category.product_category_id = product_details.product_category_id');
							 $this->db->join('product_sub_category','product_sub_category.product_sub_category_id = product_details.product_sub_category_id','left');
                            

							 $this->db->where('product_details.product_category_id',$category_id);
							 $this->db->where('product_details.product_sub_category_id',$subcategory_id);
                            
							 $data = $this->db->get();
							 return $data->result();

						 }else if($category_have_subcategory == 'no'){
							 $this->db->select('*');
							 $this->db->from('product_details');
							 $this->db->join('product_category','product_category.product_category_id = product_details.product_category_id');

							$this->db->where('product_details.product_category_id',$category_id);
							$data = $this->db->get();
							return $data->result();
						 }


				}


	}

	public function select_category($category_id,$subcategory_id)
	{
		        $this->db->select('*');
				$this->db->from('product_category');
               
				$data = $this->db->get();
				return $data->result();
	}
	public function select_subcategory($category_id,$subcategory_id)
	{
		    $this->db->select('*');
				$this->db->from('product_sub_category');
				if($category_id != '' && $category_id != '0'){
					  $this->db->join('product_category','product_category.product_category_id = product_sub_category.product_category_id');
						$this->db->where('product_sub_category.product_category_id',$category_id);
				}
                
				$data = $this->db->get();
				return $data->result();
	}

  public function add_product($posted_category_id,$posted_subcategory_id,$product_name,$unit,$unit_price,$status,$img_name,$gst,$short_discription,$discription,$dairy_product_id){
        $arr = array(
					'product_category_id' => $posted_category_id,
					'product_sub_category_id' => $posted_subcategory_id,
					'product_name' => $product_name,
                    'short_discription' => $short_discription,
                    'discription' => $discription,
					'product_unit' => $unit,
					'product_unit_price' => $unit_price,
                     'sgst' => $gst/2,
                    'cgst' => $gst/2,
					'product_img' => $img_name,
					'product_status' => $status,
                    'dairy_product_id' => $dairy_product_id,
                
				);

				if($this->db->insert('product_details',$arr)){
					 if(!$posted_subcategory_id){
                       $posted_subcategory_id = 0;
                   }redirect('./product_e/add_product/'.$posted_category_id.'/'.$posted_subcategory_id.'/?msg=Product is successfully added.');
				}else{
					echo 'failed';
				}

	}

	public function selected_product($id,$category_id,$subcategory_id)
	{
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->where('product_id',$id);
		$this->db->where('product_category_id',$category_id);

		if($subcategory_id != '' && $subcategory_id != '0'){
			$this->db->where('product_sub_category_id',$subcategory_id);
		}

		$data = $this->db->get();
		return $data->result();
	}

	public function edit_product($id,$posted_category_id,$posted_subcategory_id,$product_name,$unit,$unit_price,$status,$img_name,$count_scroll_position,$gst,$short_discription,$discription,$dairy_product_id)
	{
		$arr = array(
			'product_category_id' => $posted_category_id,
			'product_sub_category_id' => $posted_subcategory_id,
			'product_name' => $product_name,
            'short_discription' => $short_discription,
            'discription' => $discription,
			'product_unit' => $unit,
			'product_unit_price' => $unit_price,
             'sgst' => $gst/2,
            'cgst' => $gst/2,
			'product_img' => $img_name,
			'product_status' => $status,
            'dairy_product_id' => $dairy_product_id,
		);
      $this->db->where('product_id',$id);
			if($this->db->update('product_details',$arr)){
                   if(!$posted_subcategory_id){
                       $posted_subcategory_id = 0;
                   }
                   
				    $redirect_str = './product_e/add_product/'.$posted_category_id.'/'.$posted_subcategory_id.'/'.$count_scroll_position.'/?msg=Product is successfully updated.';
				    redirect($redirect_str);
			}else{
				    echo 'failed';
			}

	}

	public function del_product($del_id)
	{
		 $this->db->where('product_id',$del_id);
		 if($this->db->delete('product_details')){
			 echo 'success';
		 }else{
					 echo 'failed';
		 }
	}

 // List product section
    
   
    
    public function select_all_product(){
         $this->db->select('*, product_category.product_category_id AS my_product_category_id, product_sub_category.product_sub_category_id AS my_product_sub_category_id,dairy_products.product_id AS dairy_product_id,product_details.product_id AS e_product_id,product_details.product_name AS e_product_name');
         $this->db->from('product_details');
         $this->db->join('product_category','product_category.product_category_id = product_details.product_category_id');
         $this->db->join('product_sub_category','product_sub_category.product_sub_category_id = product_details.product_sub_category_id','left');
        
         $this->db->join('dairy_products','dairy_products.product_id = product_details.dairy_product_id','left Outer');
       
        $data = $this->db->get();
        return $data->result();
        
    }
}
