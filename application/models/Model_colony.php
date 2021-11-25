<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_colony extends CI_Model {



	function __construct(){



		parent::__construct();

	}

    public function select_colony(){
        
        $this->db->select('*');
        $this->db->from('colony_detail');
        $this->db->order_by('colony_name','ASC');
        $data = $this->db->get();
        return $data->result();
        
    }

	public function add_colony_submit($name){
       
            $arr = array(
		
		    'colony_name' => $name,
			
            
		    );
		
		    if($this->db->insert('colony_detail',$arr)){
		    	
		    	return "success";
		    }else{
			
			return "failed";
		    };
       	

	}
    
  
    
    public function update_colony_submit($name,$id){
        $arr = array(
		
		    'colony_name' => $name,
			
		    );
		    $this->db->where('colony_id',$id);
		    if($this->db->update('colony_detail',$arr)){
		    	
		    	return "updatesuccess";
		    }else{
			
			return "failed";
		    };
        
    }
   
    public function delete_colony($del_id){
        
        $this->db->where('colony_id',$del_id);
        
        
        if($this->db->delete('colony_detail')){
                echo 'success';
        }else{
            echo 'failed';
        }
        
        
    }
  

}