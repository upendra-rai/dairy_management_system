<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_setting extends CI_Model{
    
    function __construct(){

		parent::__construct();

	}
    
	public function countsms(){
	 $this->db->select('*');
      $this->db->from('sms_account');
      $data=$this->db->get();
       return $data->result();
	}
	

  public function payment_setting(){
	//$this->db->select('*');
	$this->db->where('sr_no=1');
      $this->db->from('payment_gateway_details');
      $data=$this->db->get();
       return $data->result();
   }
   public function edit_payment_setting($online_payment,$upi_payment,$cod){
   	 $this->db->where('sr_no',1);

    $data = array(
      'online_payment' =>$online_payment,
      'upi_payment' => $upi_payment,
      'cod'=> $cod,
     );
     echo $online_payment.$upi_payment.$cod;
      if($this->db->update('payment_gateway_details',$data)){
        echo 'success';
          redirect(base_url().'/Setting/payment_setting');
       }else{
          echo 'failed';
       };
   }

}

?>