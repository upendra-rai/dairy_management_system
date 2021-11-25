<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_collection extends CI_Model{
    
    function __construct(){

		parent::__construct();

	}
    
	public function fat_rate(){
	 $this->db->select('*');
      $this->db->from('milk_fat_rate');
      $data=$this->db->get();
       return $data->result();
	}
	


   public function add_milk_fat($minimum_fat_value,$maximum_fat_value,$fat_rate){
    $data = array(
      'minimum_fat_value' =>$minimum_fat_value,
      'maximum_fat_value' => $maximum_fat_value,
      'fat_rate'=> $fat_rate,
     );
     echo $minimum_fat_value.$maximum_fat_value.$fat_rate;
      if($this->db->insert('milk_fat_rate',$data)){
        echo 'success';
          redirect(base_url().'/collection/fat_rate');
       }else{
          echo 'failed';
       };
   }
    public function edit_milk_fat($edit_id,$minimum_fat_value,$maximum_fat_value,$fat_rate){
        
        $data = array(
      'minimum_fat_value' =>$minimum_fat_value,
      'maximum_fat_value' => $maximum_fat_value,
      'fat_rate'=> $fat_rate,
     );
     echo $minimum_fat_value.$maximum_fat_value.$fat_rate;
        $this->db->where('fat_id',$edit_id);
      if($this->db->update('milk_fat_rate',$data)){
        echo 'success';
          redirect(base_url().'/collection/fat_rate');
       }else{
          echo 'failed';
       };
    }
    public function selected_fat_rate($edit_id){
       // $this->db->select('*');
	$this->db->where('fat_id',$edit_id);
      $this->db->from('milk_fat_rate');
      $data=$this->db->get();
       return $data->result();
    }
    
    public function delete_data($fat_id){
        $this->db->where('fat_id',$fat_id);
    if($this->db->delete('milk_fat_rate')){
        redirect(base_url().'/collection/fat_rate');

           }else{
              echo 'failed';
           }
    }
    
    public function snf(){
	//$this->db->select('*');
	$this->db->where('snf_id=1');
      $this->db->from('snf');
      $data=$this->db->get();
       return $data->result();
    }
    public function edit_snf($minimum_price,$maximum_price,$snf_value){
        $this->db->where('snf_id',1);

    $data = array(
      'minimum_price' =>$minimum_price,
      'maximum_price' => $maximum_price,
        'snf_value' => $snf_value,
      
     );
     //echo $online_payment.$upi_payment.$cod;
      if($this->db->update('snf',$data)){
        echo 'success';
          redirect(base_url().'/collection/snf');
       }else{
          echo 'failed';
       };
    }

}

?>