<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_expanse_head extends CI_Model {
	function __construct(){
    date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
	}

	
	public function select_item_category()
	{
		        $this->db->select('*');
				$this->db->from('expanse_head');

                $this->db->order_by('expanse_head.expanse_head_id','desc');
				$data = $this->db->get();
				return $data->result();
	}

  public function add_category_of_items($category_name){
        
        $arr = array(
					'expanse_head_name' => $category_name,
					
				);

				if($this->db->insert('expanse_head',$arr)){
					 redirect('./expanse_head/add_category?msg=Category is successfully added.');
				}else{
					echo 'failed';
				}

	}

	public function select_item_category_selected($id)
	{
		$this->db->select('*');
		$this->db->from('expanse_head');
		$this->db->where('expanse_head_id',$id);
		$data = $this->db->get();
		return $data->result();
	}

	public function edit_category_of_items($id,$category_name,$status,$img_name,$count_scroll_position)
	{
		  $arr = array(
				    'expanse_head_name' => $category_name,
			);
      $this->db->where('expanse_head_id',$id);
			if($this->db->update('expanse_head',$arr)){

				    $redirect_str = './expanse_head/add_category/'.$count_scroll_position.'/?msg=Category is successfully updated.';
				    redirect($redirect_str);
			}else{
				    echo 'failed';
			}

	}

	public function del_product_category($del_id)
	{
    $get_row = $this->db->get_where('expanse_head',array('expanse_head_id' => $del_id));

		if($get_row->num_rows() == 1){
        $img_name = $get_row->result()[0]->category_image;
				$this->db->where('expanse_head_id',$del_id);
	 		  if($this->db->delete('expanse_head')){
	 			  echo 'success';
					

	 		  }else{
	 					 echo 'failed';
	 		  }
		}
	}


}
