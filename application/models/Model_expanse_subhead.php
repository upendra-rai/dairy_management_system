<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_expanse_subhead extends CI_Model {



	function __construct(){


       date_default_timezone_set("Asia/Calcutta");
		parent::__construct();

	}

	public function select_product_subcategory($selected_category_id)
	{
		        $this->db->select('*');
				$this->db->from('expanse_subhead');
        
                if($selected_category_id){
				 $this->db->where('expanse_subhead.expanse_head_id',$selected_category_id);
				$this->db->join('expanse_head','expanse_head.expanse_head_id = expanse_subhead.expanse_head_id');
                }
         
                $data = $this->db->get();
				return $data->result();
	}

	public function select_category(){
		$this->db->select('*');
		$this->db->from('expanse_head');
		$data = $this->db->get();
		return $data->result();
	}

  public function add_subcategory($posted_category_id,$subcategory_name,$status){
     
        $arr = array(
					'expanse_head_id' => $posted_category_id,
					'expanse_subhead_name' => $subcategory_name,
					
				);

				if($this->db->insert('expanse_subhead',$arr)){
					 redirect('./expanse_subhead/add_subcategory/'.$posted_category_id.'/?msg=Sub Category is successfully added.');
				}else{
					echo 'failed';
				}

	}

	public function selected_subcategory($id)
	{
		$this->db->select('*');
		$this->db->from('expanse_subhead');
		$this->db->where('expanse_subhead_id',$id);
		$data = $this->db->get();
		return $data->result();
	}

	public function edit_subcategory($id,$posted_category_id,$subcategory_name)
	{
		  $arr = array(
				'expanse_subhead_name' => $subcategory_name,
			
			);
      $this->db->where('expanse_subhead_id',$id);
			if($this->db->update('expanse_subhead',$arr)){

				    $redirect_str = './expanse_subhead/add_subcategory/'.$posted_category_id.'/'.$count_scroll_position.'/?msg=Sub Category is successfully updated.';
				    redirect($redirect_str);
			}else{
				    echo 'failed';
			}

	}

	public function del_subcategory($del_id)
	{
		 $this->db->where('expanse_subhead_id',$del_id);
		 if($this->db->delete('expanse_subhead')){
			 echo 'success';
		 }else{
					 echo 'failed';
		 }
	}


}
