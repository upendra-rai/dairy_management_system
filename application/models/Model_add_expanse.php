<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_add_expanse extends CI_Model {



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
    
     public function select_gst(){
         $this->db->select('*');
         $this->db->from('gst');
         
        $data = $this->db->get();
        return $data->result();
        
    } 
    
	public function select_expanse($category_id,$subcategory_id)
	{
		    $get_category_id = $this->db->get_where('expanse_head',array('expanse_head_id' => $category_id ));
        if($get_category_id->num_rows() == 1){

					   $category_have_subcategory = $get_category_id->result()[0]->have_sub_head;

						

							 $this->db->select('*');
							 $this->db->from('expanse');
							 $this->db->join('expanse_head','expanse_head.expanse_head_id = expanse.expanse_head_id');
							 $this->db->join('expanse_subhead','expanse_subhead.expanse_subhead_id = expanse.expanse_subhead_id','left');

							 $this->db->where('expanse.expanse_head_id',$category_id);
							// $this->db->where('expanse.expanse_subhead_id',$subcategory_id);
                            
							 $data = $this->db->get();
							 return $data->result();

						


				}


	}

	public function select_category()
	{
		        $this->db->select('*');
				$this->db->from('expanse_head');
               
				$data = $this->db->get();
				return $data->result();
	}
	public function select_subcategory()
	{
		        $this->db->select('*');
				$this->db->from('expanse_subhead');
			
				$data = $this->db->get();
				return $data->result();
	}

  public function add_expanse($expanse_head_id,$expanse_subhead_id,$expanse_amount,$note,$expanse_date){
       if(!$expanse_subhead_id){
                       $expanse_subhead_id = 0;
                   }
         $arr = array(
					'expanse_head_id' => $expanse_head_id,
					'expanse_subhead_id' => $expanse_subhead_id,
					'expanse_amount' => $expanse_amount,
                    'note' => $note,
                    'date' => $expanse_date,
					
				);

				if($this->db->insert('expanse',$arr)){
					redirect('./expanse/list_expanse');
				}else{
					echo 'failed';
				}

	}

	public function selected_expanse($id)
	{
		$this->db->select('*,expanse.date AS expanse_date');
		$this->db->from('expanse');
		$this->db->where('expanse_id',$id);
		$data = $this->db->get();
		return $data->result();
	}

	public function edit_expanse($id,$expanse_head_id,$expanse_subhead_id,$expanse_amount,$note,$expanse_date)
	{
		   $arr = array(
					'expanse_head_id' => $expanse_head_id,
					'expanse_subhead_id' => $expanse_subhead_id,
					'expanse_amount' => $expanse_amount,
                    'note' => $note,
                    'date' => $expanse_date,
					
				);
             $this->db->where('expanse_id',$id);
			if($this->db->update('expanse',$arr)){
                   if(!$expanse_subhead_id){
                       $expanse_subhead_id = 0;
                   }
                   
				    $redirect_str = './expanse/list_expanse';
				    redirect($redirect_str);
			}else{
				    echo 'failed';
			}

	}

	public function del_expanse($del_id)
	{
		 $this->db->where('expanse_id',$del_id);
		 if($this->db->delete('expanse')){
			 echo 'success';
		 }else{
					 echo 'failed';
		 }
	}

 // List product section
    
    
    public function select_all_expanse(){
         $this->db->select('*');
         $this->db->from('expanse');
         $this->db->join('expanse_head','expanse_head.expanse_head_id = expanse.expanse_head_id');
         $this->db->join('expanse_subhead','expanse_subhead.expanse_subhead_id = expanse.expanse_subhead_id','left');
       $this->db->order_by('expanse_id','desc');
        $data = $this->db->get();
        return $data->result();
        
    }
}
