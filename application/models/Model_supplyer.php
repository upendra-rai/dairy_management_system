<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_supplyer extends CI_Model {



	function __construct(){



		parent::__construct();

	}

    public function select_supplyer(){

        $this->db->select('*');
        $this->db->from('supplyer_details');

        $data = $this->db->get();
        return $data->result();

    }

	public function add($name,$email,$number,$address,$GST_no){

            date_default_timezone_set('Asia/Kolkata');
            $date = new DateTime();
            $time_stamp = $date->format('Y-m-d H:i:s');

			   $arr = array(
            'time_stamp' =>  $time_stamp,
		        'supplyer_name' => $name,
			      'supplyer_mobile_no' => $number,
            'supplyer_email_id' =>  $email,
            'supplyer_address' => $address,
            'GST_no' =>  $GST_no,
		    );

		    if($this->db->insert('supplyer_details',$arr)){
		    	redirect('./supplyer/?001');
		      }else{

			      redirect('./supplyer/add_supplyer');
		       };
	  }

    public function selected_supplyer($id){
        $this->db->select('*');
        $this->db->from('supplyer_details');
        $this->db->where('supplyer_id',$id);
        $data = $this->db->get();
        return $data->result();
    }

    public function edit($name,$email,$number,$address,$GST_no,$id){
			$arr = array(

				 'supplyer_name' => $name,
				 'supplyer_mobile_no' => $number,
				 'supplyer_email_id' =>  $email,
				 'supplyer_address' => $address,
				 'GST_no' =>  $GST_no,
		 );
     $this->db->where('supplyer_id',$id);
		 if($this->db->update('supplyer_details',$arr)){
			 redirect('./supplyer/?002');
			 }else{

				 redirect('./supplyer/edit_supplyer/'.$id);
				};
    }

    public function delete_team_member($del_id){

        $this->db->where('user_id',$del_id);
        if($this->db->delete('team_member')){

            echo 'success';
        }else{
            echo 'failed';
        }
    }


}
