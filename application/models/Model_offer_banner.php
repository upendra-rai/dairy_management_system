<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_offer_banner extends CI_Model {



	function __construct(){


       date_default_timezone_set("Asia/Calcutta");
		parent::__construct();

	}

	public function select_list()
	{
		       $this->db->select('*');
				$this->db->from('offer_banner');
                //**********Outlet Filter ********//
                 if( $this->session->userdata('outlet_id')){
                     $user_outlet = $this->session->userdata('outlet_id');
                     $this->db->where('outlet_id',$user_outlet);
                }
                //**********Outlet Filter ********//
				$data = $this->db->get();
				return $data->result();
	}

  public function add($status,$img_name){
       
       
      
      
             $arr = array(
					'img_name' => $img_name,
				
				);
               // $this->db->where('banner_id',$id);
               
				if($this->db->update('offer_banner',$arr)){
					 redirect('./offer_banner/add?msg=Offer Banner is successfully added.');
				}else{
					redirect('./offer_banner/add');
				}
     
	}

	public function selected_row($id)
	{
		$this->db->select('*');
		$this->db->from('offer_banner');
		$this->db->where('offer_banner_id',$id);
		$data = $this->db->get();
		return $data->result();
	}

	public function edit($id,$status,$img_name)
	{
		$arr = array(
			'img_name' => $img_name,
			
		);
      $this->db->where('offer_banner_id',$id);
			if($this->db->update('offer_banner',$arr)){

				    $redirect_str = './offer_banner/add/?msg=Offer Banner is successfully updated.';
				    redirect($redirect_str);
			}else{
				    redirect('./offer_banner/add');
			}

	}

	public function del_row($del_id)
	{
		 $this->db->where('offer_banner_id',$del_id);
		 if($this->db->delete('offer_banner')){
			 echo 'success';
		 }else{
					 echo 'failed';
		 }
	}
    public function insert_service_content($note){
     $arr = array(
       'services' => $note, 
     );
        $this->db->where('sr_no',1);
         if($this->db->update('app_content',$arr)){
            echo 'success';
             
			}else{
             echo 'failed';
         }

    }
    public function select_app_content(){
               $this->db->select('*');
				$this->db->from('app_content');
				$data = $this->db->get();
				return $data->result();
        
    }
    public function insert_about_content($note1){
        $arr =array(
        'about' =>$note1,
        );
        $this->db->where('sr_no',1);
        if($this->db->update('app_content',$arr)){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    public function select_about(){
        $this->db->select('*');
        $this->db->from('app_content');
        $data = $this->db->get();
        return $data->result();
    }


}
