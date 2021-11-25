<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_search_data extends CI_Model {



	function __construct(){



		parent::__construct();

	}


    public function searchbar_result($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->where($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                      
                      echo '<div class="col-md-6">';
                      echo '<div class="detail_box first">';
                      echo '<p class="box_title ">Customer Details</p>';
                      echo '<img src="'.base_url('catalogs').'/img/customer_img/'.$row->customer_img.'" class="thumbnail" alt="" style="width:120px; height:120px; border-radius: 50%;" />';
                      echo '<p><label>Name:</label> '.$row->customer_firstname.' '.$row->customer_lastname.'</p>';
                      echo '<p><label>Email Address:</label> '.$row->email_id.'</p>';
                      echo ' <p><label>Mobile No.:</label> '.$row->mobile_no.'</p>';
                      echo ' <p><label>Mobile No.:</label> '.$row->mobile_no2.'</p>';
                      echo '<p><label>Address1.:</label> '.$row->address1.'</p>';
                      echo '<p><label>Address2.:</label> '.$row->address2.'</p>';
                      
                      echo '<p><label>Colony Name.:</label> '.$row->colonyname.'</p>';
                      echo '<p><label>City:</label> '.$row->city.'</p>';
                      echo '</div>';
                      echo '</div>';
                      
                      
                      echo '<div class="col-md-6">';
                      echo '<div class="detail_box second" style="border-right: 1px solid transparent;">';
                      echo '<p class="box_title ">Account Details</p>';
                      echo '<p><label>Card No.:</label> '.$row->linked_no.'</p>';
                      echo '<p><label>Balance:</label> '.$row->account.'</p>';
                      echo '<p><label>Ragistration Date:</label> '.date('d-M-y', strtotime($row->time_stamp)).'</p>';
                      echo '<p><label>Status:</label> '.$row->status.'</p>';
                       
                      echo '<br>';
                      echo '<p class="box_title ">Action Panel</p>';
                      echo '<div class="sparkline15-graph" style="padding-left:15px;">';
                      echo '<div class="row">';
                     
                      echo '<div class="switch_style"style=""><span class="span1">Unblock</span><label class="switch"><input type="checkbox" id="update_status" data-status_id="'.$row->linked_no.'"  '.($row->status == "active" ? "unchecked" : "checked").'  /><span class="slider round"></span></label><span class="span2">Block</span></div>';
                      echo '<p><label>Recarge Account:</label></p>';
                      echo '<div class="input-group custom-go-button">
				                 <span class="input-group-addon">Rs.</span>
                                 <input type="text" class="form-control" id="recharge_input" value="" placeholder="0000">
                                 <span class="input-group-btn"><button type="button" id="recharge_bt" data-recharge_id="'.$row->linked_no.'" class="btn btn-primary">RECHARGE</button></span>
                           </div>';
                      
                      echo ' <button data-toggle="tooltip" id="terminate" title="Terminate Account" data-del_id="'.$row->linked_no.'" class="btn btn-primary action_panel_bt" style="background-color:#e91e63; "><i class="fa fa-pencil-square"></i> Terminate Account</button>';
                      
                      echo '<a href="'.base_url().'/customer/edit_customer/'.$row->linked_no.'"><button data-toggle="tooltip" title="Edit" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-pencil-square"></i> Edit Profile</button></a>';
				     
                      echo ' <button data-toggle="tooltip" title="Transaction Detail" data-tran_linkid="'.$row->linked_no.'" id="tran_bt" class="btn btn-primary action_panel_bt" style="background-color:#673ab7; "><i class="fa fa-pencil-square" ></i> Transaction  Detail</button>';
                      
                      echo '  <button data-toggle="tooltip" title="Recharge Detail" data-rech_linkid="'.$row->linked_no.'" id="rech_bt" class="btn btn-primary action_panel_bt" style="background-color:#44bffd;"><i class="fa fa-pencil-square" ></i> Recharge  Detail</button>';
                      
                      echo '</div>';
                      echo '</div>';	        
				      echo '</div>';			         
				      echo '</div>';		         
					

				 }
				 }else{

					 echo "No matching records found";
				 }

    }
	
	public function searchbar_like_result($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					echo '<tr>';
					   echo '<td>1</td>';
			           echo '<td>'.$row->customer_firstname.' '.$row->customer_lastname.'</td>';
			           echo '<td>'.$row->colonyname.'</td>';
			           echo '<td>'.$row->mobile_no.'</td>';
			           echo '<td>'.$row->linked_no.'</td>';
			           echo '<td><div class="st_active">'.$row->status.'</div></td>';
                       echo '<td>';
                       echo ' <a href="'.base_url().'/customer/view_customer/'.$row->linked_no.'"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myview"><i class="fa fa-user" aria-hidden="true"></i></button>';   
                       echo '</td>';
					   echo '<td>';
                       echo ' <a href="'.base_url().'/customer/edit_customer/'.$row->linked_no.'"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>';   
                       echo '</td>';
					   echo '<td>';
                       echo ' <button  title="Trash" class="pd-setting-ed mydelete" data-link_id="'.$row->linked_no.'"><i class="fa fa-trash" aria-hidden="true"></i></button>';   
                       echo '</td>';
			        echo ' </tr>';

				 }
				 }else{

					 echo "No matching records found";
				 }

    }
	
    public function searchbar_card_no($search_by,$linked_id){

		    	$this->db->select('*');
		    	$this->db->from('atm_card_detail');
				$this->db->where('atm_card_no', $linked_id);
                $this->db->join('customer_details','customer_details.customer_id = atm_card_detail.customer_id');
		    	$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					  echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';

                  }
				 }else{

					  echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }

    }
    
        
    public function searchbar_like_colony($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
				$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->like($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					  echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';

                  }
				 }else{

					  echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }

    }    
        
    public function searchbar_like_list($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
				$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->like($search_by, $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					  echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';

                  }
				 }else{

					  echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }

    }
    
    public function searchbar_like_list_number($search_by,$search_for){

		    	$this->db->select('*');
		    	$this->db->from('customer_details');
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
				$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $this->db->like("contact_1", $search_for);
                $this->db->or_like("contact_2", $search_for);
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
					  echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';

                  }
				 }else{

					  echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }

    }
    public function searchbar_name_result($search_by,$firstname,$lastname){

		    	$this->db->select('*');
		    	$this->db->from('customers');
				$this->db->like("customer_firstname", $firstname);
                $this->db->like("customer_lastname", $firstname);
				
		    	$data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                      echo '<div class="col-md-6">';
                      echo '<div class="detail_box first">';
                      echo '<p class="box_title ">Customer Details</p>';
                      echo '<img src="'.base_url('catalogs').'/img/customer_img/'.$row->customer_img.'" class="thumbnail" alt="" style="width:120px; height:120px; border-radius: 50%;" />';
                      echo '<p><label>Name:</label> '.$row->customer_firstname.' '.$row->customer_lastname.'</p>';
                      echo '<p><label>Email Address:</label> '.$row->email_id.'</p>';
                      echo ' <p><label>Mobile No.:</label> '.$row->mobile_no.'</p>';
                      echo ' <p><label>Mobile No.:</label> '.$row->mobile_no2.'</p>';
                      echo '<p><label>Address1.:</label> '.$row->address1.'</p>';
                      echo '<p><label>Address2.:</label> '.$row->address2.'</p>';
                      
                      echo '<p><label>Colony Name.:</label> '.$row->colonyname.'</p>';
                      echo '<p><label>City:</label> '.$row->city.'</p>';
                      echo '</div>';
                      echo '</div>';
                      
                      
                      echo '<div class="col-md-6">';
                      echo '<div class="detail_box second" style="border-right: 1px solid transparent;">';
                      echo '<p class="box_title ">Account Details</p>';
                      echo '<p><label>Card No.:</label> '.$row->linked_no.'</p>';
                      echo '<p><label>Balance:</label> '.$row->account.'</p>';
                      echo '<p><label>Ragistration Date:</label> '.date('d-M-y', strtotime($row->time_stamp)).'</p>';
                      echo '<p><label>Status:</label> '.$row->status.'</p>';
                       
                      echo '<br>';
                      echo '<p class="box_title ">Action Panel</p>';
                      echo '<div class="sparkline15-graph" style="padding-left:15px;">';
                      echo '<div class="row">';
                     
                      echo '<div class="switch_style"style=""><span class="span1">Unblock</span><label class="switch"><input type="checkbox" id="update_status" data-status_id="'.$row->linked_no.'"  '.($row->status == "active" ? "unchecked" : "checked").'  /><span class="slider round"></span></label><span class="span2">Block</span></div>';
                      echo '<p><label>Recarge Account:</label></p>';
                      echo '<div class="input-group custom-go-button">
				                 <span class="input-group-addon">Rs.</span>
                                 <input type="text" class="form-control" id="recharge_input" value="" placeholder="0000">
                                 <span class="input-group-btn"><button type="button" id="recharge_bt" data-recharge_id="'.$row->linked_no.'" class="btn btn-primary">RECHARGE</button></span>
                           </div>';
                      
                      echo ' <button data-toggle="tooltip" id="terminate" title="Terminate Account" data-del_id="'.$row->linked_no.'" class="btn btn-primary action_panel_bt" style="background-color:#e91e63; "><i class="fa fa-pencil-square"></i> Terminate Account</button>';
                      
                      echo '<a href="'.base_url().'/customer/edit_customer/'.$row->linked_no.'"><button data-toggle="tooltip" title="Edit" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-pencil-square"></i> Edit Profile</button></a>';
				     
                      echo ' <button data-toggle="tooltip" title="transaction Detail" id="tran_bt" data-tran_linkid="'.$row->linked_no.'" class="btn btn-primary action_panel_bt" style="background-color:#673ab7; "><i class="fa fa-pencil-square" ></i> Transaction  Detail</button>';
                      
                      echo '  <button data-toggle="tooltip" data-rech_linkid="'.$row->linked_no.'" title="Recharge_detail" id="rech_bt" class="btn btn-primary action_panel_bt" style="background-color:#44bffd;"><i class="fa fa-pencil-square" ></i> Recharge  Detail</button>';
                      
                      echo '</div>';
                      echo '</div>';	        
				      echo '</div>';			         
				      echo '</div>';
				 }
				 }else{
                     echo "No matching records found";
					 
				 }

    }
    
	public function searchbar_list_name($search_by,$firstname,$lastname){
            
		    	$this->db->select('*');
		    	$this->db->from('customer_details');
             
                if($lastname == ""){
                    
                    $this->db->like("first_name", $firstname);
				    $this->db->or_like("last_name", $firstname);
                }else{
                    
                    $this->db->like("first_name", $firstname);
				    $this->db->like("last_name", $lastname);
                }
                $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
		    	$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
                $data = $this->db->get();

				if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                      echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }
				 }else{
                     echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
					 
				 }

    }
	
	public function search_by_date_result($from_date,$to_date){
           date_default_timezone_set('Asia/Kolkata');
		   $start = date("y-m-d",strtotime($from_date));
		   $end = date("y-m-d",strtotime($to_date));
		    
		   
	    	$this->db->select('*');
	    	$this->db->from('customer_details');
			$this->db->where('date(ragistration_date) >=', $start);
            $this->db->where('date(ragistration_date) <=', $end);
            $this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
	    	$this->db->join('colony_detail', 'colony_detail.colony_id = customer_details.colony_id');
            $data = $this->db->get();

			if($data->num_rows() > 0){
		          foreach($data->result() as $row){
                      
                      echo '<ul class="match_result_ul">';
                      echo '<li class="search_li" data-li_link="'.$row->customer_id.'" data-li_name="'.$row->first_name.' '.$row->last_name.'">';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->first_name.' '.$row->last_name.'</p>';
                      echo '<p class="search_subtitle">'.$row->contact_1.' <span>('.$row->colony_name.')</span></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">'.$row->atm_card_no.'</p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';

				 }
				 }else{

					  echo '<ul class="match_result_ul">';
                      echo '<li>';
                      echo '<div class="inline-box"><i class="fa fa-search"></i></div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title">No matching records found</p>';
                      echo '<p class="search_subtitle"></p>';
                      echo '</div>';
                      echo '<div class="inline-box">';
                      echo '<p class="search_title"></p>';
                      echo '</div>';
                      echo '</li>';
                      echo '</ul>';
				 }

	}

}