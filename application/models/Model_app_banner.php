<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_app_banner extends CI_Model {



	function __construct(){


       date_default_timezone_set("Asia/Calcutta");
		parent::__construct();

	}

	public function select_list()
	{
		        $this->db->select('*');
				$this->db->from('app_banner');
             
				$data = $this->db->get();
				return $data->result();
	}

  public function add($status,$img_name){
      
     
      
        $arr = array(
					'banner_img' => $img_name,
					'banner_status' => $status,
                    
				);

				if($this->db->insert('app_banner',$arr)){
					 redirect('./app_banner/add?msg=Banner is successfully added.');
				}else{
					redirect('./app_banner/add');
				}

	}

	public function selected_row($id)
	{
		$this->db->select('*');
		$this->db->from('app_banner');
		$this->db->where('banner_id',$id);
		$data = $this->db->get();
		return $data->result();
	}

	public function edit($id,$status,$img_name)
	{
       
		$arr = array(
			'banner_img' => $img_name,
			'banner_status' => $status,
           
		);
      $this->db->where('banner_id',$id);
			if($this->db->update('app_banner',$arr)){

				    $redirect_str = './app_banner/add//?msg=Banner is successfully updated.';
				    redirect($redirect_str);
			}else{
				   redirect('./app_banner/add');
			}

	}

	public function del_row($del_id)
	{
		 $this->db->where('banner_id',$del_id);
		 if($this->db->delete('app_banner')){
			 echo 'success';
		 }else{
					 echo 'failed';
		 }
	}


}
