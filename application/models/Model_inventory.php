<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_inventory extends CI_Model {



	function __construct(){



		parent::__construct();

	}


    //  =========== ////////// ========  new update ======       ////////
   //  =========== ////////// ========  new update ======       ////////
  //  =========== ////////// ========  new update ======       ////////

     public function select_product($search_date){

                $this->db->select('*');
		    	$this->db->from('dairy_products');
                $this->db->order_by('product_name','ASC');
                $this->db->join('dairy_stock','dairy_stock.product_id = dairy_products.product_id','left');
                
                $this->db->where('date(stock_date)',$search_date);
		    	$data = $this->db->get();
        if($data->num_rows() > 1){
            $data = $data->result();
            return array(
                 'stock' => $data,
                 'action' => 'update'
             );


        }else{

                $this->db->select('*');
		    	$this->db->from('dairy_products');
                $this->db->order_by('product_name','ASC');
		    	$data = $this->db->get()->result();

                return array(
                 'stock' => $data,
                 'action' => 'insert'
             );

        }
    }
    
    public function dairy_product_requirement($search_date){
                $this->db->select('dairy_products.product_name,SUM(estimated_product_details.product_qty) as sum_required_qty');
		    	$this->db->from('dairy_products');
                $this->db->join('estimated_product_details','estimated_product_details.product_id = dairy_products.product_id');
                $this->db->join('vacation','vacation.customer_id = estimated_product_details.customer_id','Full');
         
               // $this->db->where('date(start_date) >=', $search_date);
               // $this->db->where('date(end_date) <=', $search_date);
                $this->db->group_by('dairy_products.product_id');
                $data = $this->db->get();
                return $data->result();
        
    }
    
    public function day_before_stock($day_before){
        
        $this->db->select('*');
        $this->db->from('dairy_stock');
        $this->db->where('stock_date',$day_before);
        $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
         
        $data = $this->db->get();
        return $data->result();
        
    }

    public function add_dairy_stock($product_id_array,$product_qty_array,$stock_date,$action){

        //$product_id = explode(',',$product_id_array);
       // $product_qty = explode(',',$product_qty_array);
       $check_stock = $this->db->get_where('dairy_stock',array('stock_date' => $stock_date));
        
        if($check_stock->num_rows() > 0){
            foreach(array_combine($product_id_array, $product_qty_array) as $product => $qty){
                $arr = array(
                    'stock_date' => $stock_date,
                    'product_id' => $product,
                    'produced_qty' => $qty,
                );

                $this->db->where('stock_date',$stock_date);
                $this->db->where('product_id',$product);
                $this->db->set('produced_qty','produced_qty +'.$qty,FALSE);
                $this->db->set('remaining_qty','remaining_qty +'.$qty,FALSE);
                if($this->db->update('dairy_stock')){
                    if($qty != 0){
                    $arr2 = array(
                        'product_id' => $product,
                        'production_qty' => $qty,
                        'production_date' => $stock_date,
                    );
                    
                    $this->db->insert('production_report',$arr2); 
                    }
                }
             }
             echo 'success';
        }else{
            
            foreach(array_combine($product_id_array, $product_qty_array) as $product => $qty){

                $arr = array(
                    'stock_date' => $stock_date,
                    'product_id' => $product,
                    'produced_qty' => $qty,
                    'remaining_qty' => $qty,
                );
                if($this->db->insert('dairy_stock',$arr)){
                    if($qty != 0){
                    $arr2 = array(
                        'product_id' => $product,
                        'production_qty' => $qty,
                        'production_date' => $stock_date,
                    );
                    
                    $this->db->insert('production_report',$arr2);
                    }
                };
             }
             echo 'success';
        }
   
    }
    
    
    public function carry_forward_stock($carry_from,$transfer_qty,$produced_product,$produced_qty,$my_stock_date){
        
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        $day_before = date( 'Y-m-d', strtotime( $today . ' -1 day' ) );
        
     
        echo $produced_product;
        
        $chcek_add_in_stock = $this->db->get_where('dairy_stock',array('product_id' => $produced_product , 'stock_date' => $my_stock_date ));
        
        
        if($chcek_add_in_stock->num_rows() > 0){
             
                        
                        $this->db->where('product_id',$produced_product);
                        $this->db->where('stock_date', $my_stock_date);
                        $this->db->set('produced_qty','produced_qty +'.$produced_qty,FALSE);
                        $this->db->set('remaining_qty','remaining_qty +'.$produced_qty,FALSE);
                        if($this->db->update('dairy_stock')){
                             $this->db->where('product_id',$carry_from);
                             $this->db->where('stock_date', $my_stock_date);
                             $this->db->set('produced_qty','produced_qty -'.$transfer_qty,FALSE);
                             $this->db->set('remaining_qty','remaining_qty -'.$transfer_qty,FALSE);
                             if($this->db->update('dairy_stock')){  
                            
                                   $arr2 = array(
                                       'product_id' => $produced_product,
                                       'production_qty' => $produced_qty,
                                       'production_date' => $my_stock_date,
                                       'carry_from' => $carry_from,
                                       'carry_qty' => $transfer_qty,
                                   );
                                   
                                   if($this->db->insert('production_report',$arr2)){
                                       redirect(base_url().'inventory/dairy_stock/'.$today);
                                   }else{
                                       redirect(base_url().'inventory/dairy_stock/'.$today);
                                   }
                            
                            
                            }else{ redirect(base_url().'inventory/dairy_stock/'.$today); }
                            
                        }else{ redirect(base_url().'inventory/dairy_stock/'.$today); }
                       
                  
                 
        }
        
    /*    $this->db->select('*');
        $this->db->from('dairy_products');
        $this->db->where('dairy_products.product_id',$add_in);
        $this->db->join('dairy_stock') */
        
        
    }

    public function select_agent(){

                $this->db->select('*');
		    	$this->db->from('team_member');

		    	$data = $this->db->get();
                return $data->result();

    }



    public function select_agent_stock($search_date,$agent_id){

          $this->db->select('*,dairy_stock.remaining_qty as avl_produced_stock, agent_stock.remaining_qty as avl_agent_stock');
          $this->db->from('dairy_products');

          $this->db->join('agent_stock','agent_stock.product_id = dairy_products.product_id','left');
          $this->db->join('dairy_stock','dairy_stock.product_id = dairy_products.product_id','left');
          $this->db->where('date(agent_stock.stock_date)',$search_date);
          $this->db->where('date(dairy_stock.stock_date)',$search_date);
          $this->db->where('agent_stock.user_id',$agent_id);
          $data = $this->db->get();
        if($data->num_rows() > 1){
            $data = $data->result();
            return array(
                 'stock' => $data,
                 'action' => 'update'
             );
        }else{
                $this->db->select('*,dairy_stock.remaining_qty as avl_produced_stock');
		    	$this->db->from('dairy_stock');
                $this->db->where('date(dairy_stock.stock_date)',$search_date);
                $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id','left');
                $this->db->order_by('product_name','ASC');
		    	$data = $this->db->get()->result();
                return array(
                 'stock' => $data,
                 'action' => 'insert'
             );
        }
    }

    public function add_agent_dairy_stock($product_id_array,$product_qty_array,$stock_date,$action,$user_id){

        if($action === 'insert'){
            foreach(array_combine($product_id_array, $product_qty_array) as $product => $qty){

                $this->db->where('stock_date',$stock_date);
                $this->db->where('product_id',$product);
                $this->db->set('remaining_qty','remaining_qty - '.$qty, FALSE);
                if($this->db->update('dairy_stock')){
                $arr = array(
                    'stock_date' => $stock_date,
                    'user_id' => $user_id,
                    'product_id' => $product,
                    'assigned_qty' => $qty,
                     'remaining_qty' => $qty,
                );
                $this->db->insert('agent_stock',$arr);
              }
            }
            echo 'success';

        }else if($action === 'update'){
            foreach(array_combine($product_id_array, $product_qty_array) as $product => $qty){
                $this->db->where('stock_date',$stock_date);
                $this->db->where('product_id',$product);
                $this->db->set('remaining_qty','remaining_qty - '.$qty, FALSE);
                    if($this->db->update('dairy_stock')){
                    $this->db->where('stock_date',$stock_date);
                    $this->db->where('user_id',$user_id);
                    $this->db->where('product_id',$product);
                    $this->db->set('assigned_qty','assigned_qty +'.$qty,FALSE);
                    $this->db->set('remaining_qty','remaining_qty +'.$qty,FALSE);
                    $this->db->update('agent_stock');
                   }
            }
             echo 'success';
        }

    }


    public function return_stock_agent_select($search_date){

                      $this->db->select('*');
                      $this->db->from('team_member');

                    //  $this->db->from('agent_stock');
                    //  $this->db->where('stock_date',$search_date);
                    //  $this->db->where('agent_stock.user_id',$agent_id);
                      //$this->db->join('team_member','team_member.user_id = agent_stock.user_id');
                     // $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
                     // $data = $this->db->get()->result();
                      //return $data;

                  $agent = $this->db->get()->result();
        $a = array();

                foreach($agent as $row ){

                      $this->db->select('*');
                      $this->db->from('agent_stock');
                      $this->db->where('stock_date',$search_date);
                     $this->db->where('agent_stock.user_id',$row->user_id);
                    $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');

					 $stock = $this->db->get()->result();
                   // array_merge($a,$stock);

                    $stock_data = array('user_id' => $row->user_id,'name' => $row->name, 'stock' => json_encode($stock));
                    array_push($a,$stock_data);
                   // print_r($stock);
                }
      $v =  json_encode($a);
        return $v;
     /*   foreach(json_decode($v) as $row){

           echo $row->user_id;
           foreach(json_decode($row->stock) as $rows){

               echo $rows->assigned_qty;

           }

        }*/
    }

    public function return_stock_submit($search_date,$agent_id,$product_id_array,$remaining_product_qty_array,$lost_product_qty_array){

       for($i = 0; $i < count($product_id_array); $i++){

                $product = $product_id_array[$i];
                $rem_qty = $remaining_product_qty_array[$i];
                $lost_qty = $lost_product_qty_array[$i];

                $check_return_entry = $this->db->get_where('returned_stock',array( 'stock_date' => $search_date, 'user_id' => $agent_id, 'product_id' => $product ));
                if($check_return_entry->num_rows() == 1){

                }else{
                $this->db->where('stock_date',$search_date);
                $this->db->where('product_id',$product);
                $this->db->set('remaining_qty','remaining_qty +'.$rem_qty,FALSE);
                $this->db->set('lost_qty','lost_qty +'.$lost_qty,FALSE);
                if($this->db->update('dairy_stock')){

                     $this->db->where('stock_date',$search_date);
                     $this->db->where('user_id',$agent_id);
                     $this->db->where('product_id',$product);
                     $this->db->set('remaining_qty',null);

                     $this->db->set('lost_qty','lost_qty +'.$lost_qty,FALSE);
                    if($this->db->update('agent_stock')){

                        $arr = array(
                           'stock_date' => $search_date,
                            'user_id' => $agent_id,
                            'product_id' =>$product,
                            'returned_qty' => $rem_qty,


                        );

                        if($this->db->insert('returned_stock',$arr)){


                        }
                      }
                    }
                }


       }
         echo 'success';

    }


    public function dairy_stock_report(){
                  date_default_timezone_set('Asia/Kolkata');
                  $date = new DateTime();
                  $mydate = $date->format('Y-m-d');

                $this->db->select('*');
		    	$this->db->from('dairy_stock');
                $this->db->where('stock_date',$mydate);
                $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
		    	$data = $this->db->get();
                return $data->result();


    }

    public function dairy_stock_report_filter($start_date){
               
               $date = date('Y-m-d',strtotime($start_date));
                $this->db->select('*');
		    	$this->db->from('dairy_stock');
                $this->db->where('stock_date',$date);
                $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
		    	$data = $this->db->get();
                return $data->result();

    }
    
    
    public function stock_report_filter($start_date,$end_date){
        
               $start_date = date('Y-m-d',strtotime($start_date));
               $end_date = date('Y-m-d',strtotime($end_date));
        
        
                $this->db->select('*');
                $this->db->from('dairy_stock');
                if($start_date){
                        $start_date = date('Y-m-d',strtotime($start_date));
                        $this->db->where('stock_date >=',$start_date);
                    
                }
        
                if($end_date){
                        $start_date = date('Y-m-d',strtotime($end_date));
                        $this->db->where('stock_date <=',$end_date);
                    
                }
                
               
        
                $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
		    	$data = $this->db->get();
                return $data->result();
    }
    
    
    public function sum_stock_report($start_date,$end_date){
        
              
             
        
        
                $this->db->select('dairy_stock.product_id ,dairy_products.product_name,dairy_products.unit,SUM(dairy_stock.produced_qty) AS SUM_produce, SUM(dairy_stock.sold_qty) AS SUM_sold, SUM(dairy_stock.remaining_qty) AS SUM_remaining , SUM(dairy_stock.lost_qty) AS SUM_lost, ');
		    	$this->db->from('dairy_stock');
                
                if($start_date){
                    
                        $start_date = date('Y-m-d',strtotime($start_date));
                       // $this->db->where('stock_date >=',$start_date);
                    
                }
        
                if($end_date){
                          $end_date = date('Y-m-d',strtotime($end_date));
                       
                        //$this->db->where('stock_date <=',$end_date);
                    
                }
                
                $this->db->group_by('dairy_stock.product_id');
        
                $this->db->join('dairy_products','dairy_products.product_id = dairy_stock.product_id');
		    	$data = $this->db->get();
                return $data->result();
    }
    

    public function agent_stock_report($search_date,$agent_id){
         $mydate = date('Y-m-d',strtotime($search_date));

        if($agent_id == ''){
          $this->db->select('*');
          $this->db->from('team_member');
          $agent = $this->db->get()->result();
          $a = array();

                foreach($agent as $row ){

                      $this->db->select('*,c1.name as transferred_to_name, c2.name as received_by_name');
                      $this->db->from('agent_stock');
                      $this->db->where('stock_date',$mydate);
                     $this->db->where('agent_stock.user_id',$row->user_id);
                    $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
                    $this->db->join('team_member c1','c1.user_id = agent_stock.transferred_to','left');
                    $this->db->join('team_member c2','c2.user_id = agent_stock.received_by','left');
                     $stock = $this->db->get()->result();
                   // array_merge($a,$stock);

                    $stock_data = array('user_id' => $row->user_id,'name' => $row->name, 'stock' => json_encode($stock));
                    array_push($a,$stock_data);
                   // print_r($stock);
                }
        $v =  json_encode($a);
        return $v;
        }else{

                     $this->db->select('*,c1.name as transferred_to_name, c2.name as received_by_name');
                      $this->db->from('agent_stock');
                      $this->db->where('stock_date',$mydate);
                     $this->db->where('agent_stock.user_id',$agent_id);
                    $this->db->join('dairy_products','dairy_products.product_id = agent_stock.product_id');
                    $this->db->join('team_member c1','c1.user_id = agent_stock.transferred_to','left');
                    $this->db->join('team_member c2','c2.user_id = agent_stock.received_by','left');
                     $stock = $this->db->get()->result();
                    return $stock;
        }


    }


    public function purchase_report2($start,$end,$card_no){
        $start_date = date('Y-m-d',strtotime($start));
        $end_date = date('Y-m-d',strtotime($end));
        $date_array = array();

        $Variable1 = strtotime($start);
        $Variable2 = strtotime($end);
        for ($currentDate = $Variable1; $currentDate <= $Variable2;
                                         $currentDate += (86400)) {
            $Store = date('Y-m-d', $currentDate);
            $date_array[] = $Store;
        }

        $this->db->select('*');
        $this->db->from('dairy_products');
        $product = $this->db->get()->result();
        $a = array();

        foreach($product as $product_row ){
             $this->db->select('transaction_detail.product_quantity,transaction_detail.transaction_date, dairy_products.unit, SUM(product_quantity) AS qty_sum');
             $this->db->from('transaction_detail');
             $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = transaction_detail.customer_id');
             $this->db->join('dairy_products', 'dairy_products.product_id = transaction_detail.product_id');
             $this->db->where('date(transaction_date) >=', $start_date);
             $this->db->where('date(transaction_date) <=', $end_date);
             $this->db->where('atm_card_no', $card_no);
             $this->db->where('transaction_detail.product_id', $product_row->product_id);
             $this->db->group_by('date(transaction_date)');
             $purchase = $this->db->get()->result();
             //  echo json_encode($purchase);

             $purchase_array = array();

             for ($currentDate = $Variable1; $currentDate <= $Variable2;
                                         $currentDate += (86400)) {
                   $my_current_date = date('Y-m-d', $currentDate);
                   if($purchase){
                           $collect_purchase_data = 0;
                           foreach($purchase as $purchase_data){
                                  if(date('Y-m-d', strtotime($purchase_data->transaction_date)) == $my_current_date){
                                          $collect_purchase_data += $purchase_data->qty_sum;
                                   }else{
                                        $collect_purchase_data += 0;
                                   };
                            }

                           if($collect_purchase_data > 0){
                                  $purchase_array[] = $collect_purchase_data;
                           }else{
                                   $purchase_array[] = '-';
                           }
                    }else{
                           $purchase_array[] = '-';
                    }
              }
         //echo json_encode($purchase_array);

           $purchase_data = array('product_id' => $product_row->product_id, 'product_name' => $product_row->product_name, 'product_price' => $product_row->product_price, 'product_unit' => $product_row->unit, 'product_quantity' => json_encode($purchase_array));
           array_push($a,$purchase_data);
        }
           $v =  json_encode($a);

					 echo $v;
        /*   return array(
              'dates' => $date_array,
              'purchase' => $v
            );

						*/
    }

		public function select_all_customers_for_drop_down(){
			        $this->db->select('customer_details.customer_id,customer_details.first_name,customer_details.last_name,customer_details.contact_1,atm_card_detail.atm_card_no');
							$this->db->from('customer_details');
							$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
							$data = $this->db->get();
							return $data->result();
		}


		public function purchase_recharge_report($start,$end,$card_no){
        $start_date = date('Y-m-d',strtotime($start));
        $end_date = date('Y-m-d',strtotime($end));
        $date_array = array();
				$a = array();

        $Variable1 = strtotime($start);
        $Variable2 = strtotime($end);
        for ($currentDate = $Variable1; $currentDate <= $Variable2;
                                         $currentDate += (86400)) {
            $Store = date('Y-m-d', $currentDate);
            $date_array[] = $Store;
        }


             $this->db->select('recharge_detail.recharge_amount,recharge_detail.recharge_date, SUM(recharge_amount) AS qty_sum');
             $this->db->from('recharge_detail');
             $this->db->join('atm_card_detail', 'atm_card_detail.customer_id = recharge_detail.customer_id');
             $this->db->where('date(recharge_date) >=', $start_date);
             $this->db->where('date(recharge_date) <=', $end_date);
             $this->db->where('atm_card_no', $card_no);
             $this->db->group_by('date(recharge_date)');
             $purchase = $this->db->get()->result();
             //  echo json_encode($purchase);

             $purchase_array = array();

             for ($currentDate = $Variable1; $currentDate <= $Variable2;
                                         $currentDate += (86400)) {
                   $my_current_date = date('Y-m-d', $currentDate);
                   if($purchase){
                           $collect_purchase_data = 0;
                           foreach($purchase as $purchase_data){
                                  if(date('Y-m-d', strtotime($purchase_data->recharge_date)) == $my_current_date){
                                          $collect_purchase_data += $purchase_data->qty_sum;
                                   }else{
                                        $collect_purchase_data += 0;
                                   };
                            }

                           if($collect_purchase_data > 0){
                                  $purchase_array[] = $collect_purchase_data;
                           }else{
                                   $purchase_array[] = '-';
                           }
                    }else{
                           $purchase_array[] = '-';
                    }
              }

							return $purchase_array;
         //echo json_encode($purchase_array);

        /*   $purchase_data = array( 'recharge_quantity' => json_encode($purchase_array));
           array_push($a,$purchase_data);

           $v =  json_encode($a);

					 echo json_encode($purchase_array);
           return array(

              'purchase' => $purchase_array
            );*/
    }


    public function select_customer_for_purchase_report($card_no)
    {
			$this->db->select('*');
			$this->db->from('customer_details');
			$this->db->join('atm_card_detail','atm_card_detail.customer_id = customer_details.customer_id');
			$this->db->join('current_balance','current_balance.customer_id = customer_details.customer_id');
			//$this->db->where('atm_card_detail.atm_card_no',$card_no);
			$data = $this->db->get();
			//return $data->result();
			echo json_encode($data->result());
    }


    //  transfer stock section

     public function select_all_product(){
          $this->db->select('*');
		    	$this->db->from('dairy_products');
		    	$data = $this->db->get();
          return $data->result();

    }

    public function selected_agent_stock_for_transfer($user_id,$product_id){
              date_default_timezone_set('Asia/Kolkata');
              $date = new DateTime();
              $today = $date->format('Y-m-d');

              $this->db->select('*');
		      $this->db->from('agent_stock');
              $this->db->where('stock_date',$today);
              $this->db->where('user_id',$user_id);
              $this->db->where('product_id',$product_id);
              $data = $this->db->get();

              if($data->num_rows() == 1){

                  echo +$data->result()[0]->remaining_qty;


              }else{

                  echo 0;
              }

    }

    public function transfer_stock_submit($product_id,$transfer_from,$transfer_to,$transfer_qty){

        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

       $check_reciver_account = $this->db->get_where('agent_stock',array('stock_date' => $mydate , 'user_id' => $transfer_to, 'product_id' => $product_id));
       if($check_reciver_account->num_rows() == 1){

               $this->db->where('stock_date',$mydate);
               $this->db->where('user_id',$transfer_from);
               $this->db->where('product_id',$product_id);

               $this->db->set('remaining_qty','remaining_qty -'.$transfer_qty, FALSE);
               $this->db->set('transferred_stock','transferred_stock +'.$transfer_qty, FALSE);
               $this->db->set('transferred_to',$transfer_to);

               if($this->db->update('agent_stock')){
                    $this->db->where('stock_date',$mydate);
                    $this->db->where('user_id',$transfer_to);
                    $this->db->where('product_id',$product_id);
                    $this->db->set('remaining_qty','remaining_qty +'.$transfer_qty, FALSE);
                    $this->db->set('received_stock','received_stock +'.$transfer_qty, FALSE);
                    $this->db->set('received_by',$transfer_from);

                    if($this->db->update('agent_stock')){
                               echo "success";
                    }else{ echo "failed"; }

               }else{ echo "failed"; }
     }else{ echo "invalid_reciever"; }



    }
    //  =========== ////////// ========  new update ======       ////////
   //  =========== ////////// ========  new update ======       ////////
  //  =========== ////////// ========  new update ======       ////////




     public function select_inventory(){

                $this->db->select('*');
		    	$this->db->from('inventory');
                $this->db->order_by('inventory_id','desc');
                $this->db->join('dairy_products','dairy_products.product_id = inventory.product_id');
		    	$data = $this->db->get();
                return $data->result();

    }

     public function agent_inventory_list($inventory_id){

                $this->db->select('*, c2.name as transfer_to_user, c1.name as transfer_by_user');
		    	$this->db->from('assigned_inventory');
                $this->db->where('assigned_inventory.product_id',$inventory_id);
                $this->db->order_by('assigned_inventory_id','desc');
                $this->db->join('dairy_products','dairy_products.product_id = assigned_inventory.product_id');
                $this->db->join('team_member c2','c2.user_id = assigned_inventory.user_id');
                $this->db->join('team_member c1','c1.user_id = assigned_inventory.transfer_by','left');
		    	$data = $this->db->get();
                return $data->result();

    }



     public function select_stock(){

                $this->db->select('*');
		    	$this->db->from('current_stock');
                $this->db->join('dairy_products','dairy_products.product_id = current_stock.product_id');
		    	$data = $this->db->get();
                return $data->result();

    }

    public function selected_agent_stock($inventory_id){

                 $this->db->select('*');
		    	$this->db->from('dairy_products');
                $this->db->join('assigned_stock','assigned_stock.product_id = dairy_products.product_id');
               $this->db->join('team_member','team_member.user_id = assigned_stock.user_id');
                $this->db->where('assigned_stock.product_id',$inventory_id);

		    	$data = $this->db->get();
                return $data->result();

    }

    public function selected_stock($inventory_id){
                $this->db->select('*');
		    	$this->db->from('dairy_products');
                $this->db->join('current_stock','current_stock.product_id = dairy_products.product_id');
                $this->db->where('current_stock.product_id',$inventory_id);

		    	$data = $this->db->get();
                return $data->result();

    }

    public function insert_inventory($product_list,$quantity,$total_price){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

        $arr = array(

            'product_id' => $product_list,
            'product_quantity' => $quantity,
            'total' => $total_price,
            'time_stamp' => $time_stamp,

        );

        if($this->db->insert('inventory',$arr)){

            $check_product = $this->db->get_where('current_stock', array( 'product_id' => $product_list ));


            if($check_product->num_rows() == 1){

                  $total_quantity = $check_product->result()[0]->stock_quantity + $quantity;

                  $this->db->set('stock_quantity', $total_quantity);
                   if($this->db->update('current_stock')){

                       return "success";
                   }else{

                       return "failed";
                   }

            }else{

                $arr2 = array(

                    'product_id' => $product_list,
                    'stock_quantity' => $quantity,
                );

                if($this->db->insert('current_stock',$arr2)){


                     return "success";

                }else{

                     return "failed";
                }

            }


        }else{

            return "failed";
        }
    }

    public function assign_product($agent,$quantity,$total_price,$product_id){

        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

        $check_available_quantity = $this->db->get_where('current_stock', array( 'product_id' => $product_id));

        $available_quantity = $check_available_quantity->result()[0]->stock_quantity;

        if($available_quantity >= $quantity){

        $arr = array(
            'user_id' => $agent,
            'product_id' => $product_id,
            'product_quantity' => $quantity,
            'total' => $total_price,
            'assigned_date' => $time_stamp,

        );

        if($this->db->insert('assigned_inventory',$arr)){

            $this->db->where('product_id',$product_id);
            $this->db->set('stock_quantity','stock_quantity - '.$quantity,FALSE);
            if($this->db->update('current_stock')){


            $check = $this->db->get_where('assigned_stock',array('user_id' => $agent, 'product_id' => $product_id));

            if($check->num_rows() == 1){

                $this->db->where('product_id',$product_id);
                $this->db->where('user_id',$agent );
                $this->db->set('stock_quantity','stock_quantity +'.$quantity, FALSE);
                if($this->db->update('assigned_stock')){
                        return "success";

                 }else{

                    return "failed";
                }

            }else{

                $arr2 = array(
                   'user_id' => $agent,
                   'product_id' => $product_id,
                   'stock_quantity' => $quantity,
                );


                if($this->db->insert('assigned_stock',$arr2)){
                    return "success";

                }else{

                    return "failed";

                }

            }

          }else{

                return "failed";
            }

        }else{

            return "failed";
        }

     }else{
            return "insufficent";
        }
   }

   public function transfer_stock($product_id,$agent_id,$transfer_to,$transfer_quantity,$product_price){
        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

       $check_reciver_account = $this->db->get_where('assigned_stock',array('user_id' => $transfer_to, 'product_id' => $product_id));
       if($check_reciver_account->num_rows() == 1){

       $check_issuer_stock = $this->db->get_where('assigned_stock',array('user_id' => $agent_id, 'product_id' => $product_id));
       if($check_issuer_stock->num_rows() == 1){
           $issuer_stock = $check_issuer_stock->result()[0]->stock_quantity;
           if($issuer_stock >= $transfer_quantity){
               $this->db->where('user_id',$agent_id);
               $this->db->where('product_id',$product_id);
               $this->db->set('stock_quantity','stock_quantity -'.$transfer_quantity, FALSE);
               if($this->db->update('assigned_stock')){
                    $this->db->where('user_id',$transfer_to);
                    $this->db->where('product_id',$product_id);
                    $this->db->set('stock_quantity','stock_quantity +'.$transfer_quantity, FALSE);
                    if($this->db->update('assigned_stock')){

                        $arr = array(

                            'user_id' => $transfer_to,
                            'product_id' => $product_id,
                            'product_quantity' => $transfer_quantity,
                            'total' => $product_price,
                            'transfer_by' => $agent_id,
                            'assigned_date' => $time_stamp,

                        );

                        if($this->db->insert('assigned_inventory',$arr)){
                               echo "success";
                        }else{ echo "failed"; }

                    }else{ echo "failed"; }

               }else{ echo "failed"; }

           }else{ echo "insufficent"; }

       }else{ echo "invalid_issuer"; }

     }else{

       $check_issuer_stock = $this->db->get_where('assigned_stock',array('user_id' => $agent_id, 'product_id' => $product_id));
       if($check_issuer_stock->num_rows() == 1){
           $issuer_stock = $check_issuer_stock->result()[0]->stock_quantity;
           if($issuer_stock >= $transfer_quantity){
               $this->db->where('user_id',$agent_id);
               $this->db->where('product_id',$product_id);
               $this->db->set('stock_quantity','stock_quantity -'.$transfer_quantity, FALSE);
               if($this->db->update('assigned_stock')){

                    $arr4 = array(

                        'user_id' => $transfer_to,
                        'product_id' => $product_id,
                        'stock_quantity' => $transfer_quantity,

                    );

                    if($this->db->insert('assigned_stock',$arr4)){

                        $arr = array(

                            'user_id' => $transfer_to,
                            'product_id' => $product_id,
                            'product_quantity' => $transfer_quantity,
                            'total' => $product_price,
                            'transfer_by' => $agent_id,
                            'assigned_date' => $time_stamp,

                        );

                        if($this->db->insert('assigned_inventory',$arr)){
                               echo "success";
                        }else{ echo "failed"; }

                    }else{ echo "failed"; }

               }else{ echo "failed"; }

           }else{ echo "insufficent"; }

       }else{ echo "invalid_issuer"; }


    }

   }


  public function transfer_stock_to_admin($product_id,$agent_id,$transfer_to,$transfer_quantity,$product_price){
      date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $mydate = $date->format('Y-m-d');
        $time_stamp = $date->format('Y-m-d H:i:s');

       $check_current_stock = $this->db->get_where('current_stock', array( 'product_id' => $product_id,));

       if($check_current_stock->num_rows() == 1){
            $check_issuer_stock = $this->db->get_where('assigned_stock',array('user_id' => $agent_id, 'product_id' => $product_id));
           if($check_issuer_stock->num_rows() == 1){
           $issuer_stock = $check_issuer_stock->result()[0]->stock_quantity;
           if($issuer_stock >= $transfer_quantity){
               $this->db->where('user_id',$agent_id);
               $this->db->where('product_id',$product_id);
               $this->db->set('stock_quantity','stock_quantity -'.$transfer_quantity, FALSE);
               if($this->db->update('assigned_stock')){

                    $this->db->where('product_id',$product_id);
                    $this->db->set('stock_quantity','stock_quantity +'.$transfer_quantity, FALSE);
                    if($this->db->update('current_stock')){

                        $arr = array(

                            'user_id' => $transfer_to,
                            'product_id' => $product_id,
                            'product_quantity' => $transfer_quantity,
                            'total' => $product_price,
                            'transfer_by' => $agent_id,
                            'assigned_date' => $time_stamp,

                        );

                        if($this->db->insert('assigned_inventory',$arr)){
                               echo "success";
                        }else{ echo "failed"; }

                    }else{ echo "failed"; }

               }else{ echo "failed"; }

           }else{ echo "insufficent"; }

          }else{ echo "invalid_issuer"; }


       }else{
           echo "invalid_reciever";
       }

  }


  public function delete_inventory($inventory_id,$product_id){

      $check = $this->db->get_where('inventory',array( 'inventory_id' => $inventory_id));

      if($check->num_rows() == 1){

          $inventory_quantity = $check->result()[0]->product_quantity;

          $check_stock = $this->db->get_where('current_stock',array('product_id' => $product_id ));

          if($check_stock->num_rows() == 1){

              $avalable_stock = $check_stock->result()[0]->stock_quantity;

              if($avalable_stock >= $inventory_quantity){

                  $this->db->where('product_id',$product_id);
                  $this->db->set('stock_quantity','stock_quantity -'.$inventory_quantity, FALSE);
                  if($this->db->update('current_stock')){

                      $this->db->where('inventory_id', $inventory_id);
                      if($this->db->delete('inventory')){
                          echo "success";
                      }else{ echo "failed"; }
                  }else{ echo "failed"; }

              }else{ echo "insufficent"; }

          }else{ echo "failed"; }

      }else{ echo "failed"; }

  }

 public function delete_assigned_inventory($inventory_id){

     $check_agent_inventory  = $this->db->get_where('assigned_inventory', array('assigned_inventory_id' => $inventory_id));

     if($check_agent_inventory->num_rows() == 1){

         $agent_id = $check_agent_inventory->result()[0]->user_id;
         $product_id = $check_agent_inventory->result()[0]->product_id;
         $product_quantity = $check_agent_inventory->result()[0]->product_quantity;
         $transfer_by = $check_agent_inventory->result()[0]->transfer_by;

         if($transfer_by == null){

             $check_agent_stock = $this->db->get_where('assigned_stock', array('user_id' => $agent_id, 'product_id' =>  $product_id));

             if($check_agent_stock->num_rows() == 1){

                 $current_agent_stock = $check_agent_stock->result()[0]->stock_quantity;

                 if($current_agent_stock >= $product_quantity){

                     $this->db->where('user_id', $agent_id);
                     $this->db->where('product_id', $product_id);
                     $this->db->set('stock_quantity','stock_quantity -'.$product_quantity,FALSE);
                     if($this->db->update('assigned_stock')){
                         $this->db->where('product_id',$product_id);
                         $this->db->set('stock_quantity','stock_quantity +'.$product_quantity,FALSE);
                         if($this->db->update('current_stock')){

                             $this->db->where('assigned_inventory_id',$inventory_id);
                             if($this->db->delete('assigned_inventory')){
                                  echo "success";
                             }else{ echo "failed"; }

                         }else{

                             echo "failed";
                         }

                     }else{ echo "failed"; }

                 }else{ echo "insufficent"; }

             }else{ echo "invalid_stock"; }

         }else{

             $check_agent_stock = $this->db->get_where('assigned_stock', array('user_id' => $agent_id, 'product_id' =>  $product_id));

             if($check_agent_stock->num_rows() == 1){

                 $current_agent_stock = $check_agent_stock->result()[0]->stock_quantity;

                 if($current_agent_stock >= $product_quantity){

                     $this->db->where('user_id', $agent_id);
                     $this->db->where('product_id', $product_id);
                     $this->db->set('stock_quantity','stock_quantity -'.$product_quantity,FALSE);
                     if($this->db->update('assigned_stock')){
                         $this->db->where('user_id', $transfer_by);
                         $this->db->where('product_id', $product_id);
                         $this->db->set('stock_quantity','stock_quantity +'.$product_quantity,FALSE);
                         if($this->db->update('assigned_stock')){
                              $this->db->where('assigned_inventory_id',$inventory_id);
                             if($this->db->delete('assigned_inventory')){
                                  echo "success";
                             }else{ echo "failed"; }
                         }else{

                             echo "failed";
                         }

                     }else{ echo "failed"; }

                 }else{ echo "insufficent"; }

             }else{ echo "invalid_stock"; }

         }
     }
 }

 // inventory report

   public function inventory_report(){

        date_default_timezone_set('Asia/Kolkata');
        $date = new DateTime();
        $current_month = $date->format('m');
        $current_year = $date->format('Y');

        $this->db->select('*,SUM(total) AS total_value , COUNT(inventory_id) as count_inventory');
        $this->db->from('inventory');
        $this->db->where('MONTH(time_stamp)',$current_month);
        $this->db->where('YEAR(time_stamp)',$current_year);
        $this->db->group_by('DATE(time_stamp)');
        $data = $this->db->get();
        return $data->result();
    }

   public function inventory_report_filter($start_date,$end_date,$product_search){

       $this->db->select('*,SUM(total) AS total_value , COUNT(inventory_id) as count_inventory');
        $this->db->from('inventory');
        if($start_date != 'Start Date'){
            $start = date('Y-m-d',strtotime($start_date));
            $this->db->where('date(time_stamp) >=', $start);
        }
        if($end_date != 'End Date'){
             $end = date('Y-m-d',strtotime($end_date));
            $this->db->where('date(time_stamp) <=', $end);
        }

        if($product_search != ''){
           $this->db->where('product_id', $product_search);

         }
        $this->db->group_by('DATE(time_stamp)');
        $data = $this->db->get();
        return $data->result();

   }

  public function inventory_date_report($date,$product_id){

        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('date(time_stamp)',$date);
        $this->db->join('dairy_products', 'dairy_products.product_id = inventory.product_id');

        if( $product_id != "null"){
        $this->db->where('inventory.product_id',$product_id);
         };

        $data = $this->db->get();
        return $data->result();

  }

 public function inventory_date_report_filter($date,$product_search){
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('date(time_stamp)',$date);
        $this->db->join('dairy_products', 'dairy_products.product_id = inventory.product_id');

        if( $product_search != ""){
        $this->db->where('inventory.product_id',$product_search);
         };

        $data = $this->db->get();
        return $data->result();

 }

// assigned inventory

 public function assigned_inventory_report_filter($start_date,$end_date,$product_search){

       $this->db->select('*,SUM(total) AS total_value , COUNT(assigned_inventory_id) as count_inventory');
        $this->db->from('assigned_inventory');
        if($start_date != 'Start Date'){
            $start = date('Y-m-d',strtotime($start_date));
            $this->db->where('date(assigned_date) >=', $start);
        }
        if($end_date != 'End Date'){
             $end = date('Y-m-d',strtotime($end_date));
            $this->db->where('date(assigned_date) <=', $end);
        }

        if($product_search != ''){
           $this->db->where('product_id', $product_search);

         }
        $this->db->group_by('DATE(assigned_date)');
        $data = $this->db->get();
        return $data->result();

   }

   public function assigned_inventory_date_report($date,$product_id){

        $this->db->select('*');
        $this->db->from('assigned_inventory');
        $this->db->where('date(assigned_date)',$date);
        $this->db->join('dairy_products', 'dairy_products.product_id = assigned_inventory.product_id');
        $this->db->join('team_member', 'team_member.user_id = assigned_inventory.user_id');
        if( $product_id != "null"){
        $this->db->where('assigned_inventory.product_id',$product_id);
         };

        $data = $this->db->get();
        return $data->result();

  }

 public function assigned_inventory_date_report_filter($date,$product_search,$agent_search){
        $this->db->select('*');
        $this->db->from('assigned_inventory');
        $this->db->where('date(assigned_date)',$date);
        $this->db->join('dairy_products', 'dairy_products.product_id = assigned_inventory.product_id');
        $this->db->join('team_member', 'team_member.user_id = assigned_inventory.user_id');
        if( $product_search != ""){
        $this->db->where('assigned_inventory.product_id',$product_search);
         };

        if( $agent_search != ""){
        $this->db->where('assigned_inventory.user_id',$agent_search);
         };

        $data = $this->db->get();
        return $data->result();

 }

//  =========== ////////// ========  Add Purchase ======       ////////
//  =========== ////////// ========  Add Purchase ======       ////////
//  =========== ////////// ========  Add Purchase ======       ////////
 public function add_purchase($search_date,$dealer,$purchase_product_id,$purchase_unit_price,$purchase_qty,$purchase_product_price,$production_product_id,$production_qty)
 {
	   $search_date = date('Y-m-d',strtotime($search_date));
	   $arr = array(
          'dealer_id' =>  $dealer,
					'purchase_product_id' =>  $purchase_product_id,
					'purchase_unit_price' => $purchase_unit_price,
					'purchase_quantity' => $purchase_qty,
					'purchase_price' => $purchase_product_price,
					'purchase_date' => $search_date,
		 );

		 if($this->db->insert('purchase_report',$arr)){

			  $check_raw_stock = $this->db->get_where('dairy_stock', array( 'stock_date' => $search_date, 'product_id' => $purchase_product_id,  ));

				if($check_raw_stock->num_rows() > 0){
                   $this->db->where('dairy_stock.stock_date',$search_date);
									 $this->db->where('dairy_stock.product_id',$purchase_product_id);
									 $this->db->set('produced_qty','produced_qty +'.$purchase_qty, FALSE);
									 $this->db->set('remaining_qty','remaining_qty +'.$purchase_qty, FALSE);

									 if($this->db->update('dairy_stock')){
										 redirect('./inventory/add_purchase/'.$search_date);
 									 }else{
 										echo 'failed';
 									 }
				}else{

					$this->db->select('*');
		 		  $this->db->from('dairy_products');
		 		  $products_list = $this->db->get();


					foreach($products_list->result() as $row){
             $row_product_id = $row->product_id;
						 if($row_product_id == $purchase_product_id){
							 $arr2 = array(
												'stock_date' => $search_date,
												'product_id' => $purchase_product_id,
												'produced_qty' => $purchase_qty,
												'remaining_qty' => $purchase_qty,

							 );
						 }else{
							 $arr2 = array(
												'stock_date' => $search_date,
												'product_id' => $row_product_id,
												'produced_qty' => 0,
												'remaining_qty' => 0,

							 );
						 }
							$this->db->insert('dairy_stock',$arr2);
					 }


            redirect('./inventory/add_purchase/'.$search_date);
			
				}

		 }else {
		 	echo 'failed';
		 }
 }

 public function select_purchase($date)
 {
	   $date = date('Y-m-d',strtotime($date));
 	   $this->db->select('*');
		 $this->db->from('purchase_report');
		 $this->db->where('purchase_date',$date);
		 $this->db->join('dairy_products','dairy_products.product_id = purchase_report.purchase_product_id');
		 $this->db->join('supplyer_details','supplyer_details.supplyer_id = purchase_report.dealer_id');
     $this->db->order_by('purchase_id','desc');
		 $data = $this->db->get();
		 return $data->result();
 }

 public function create_products($search_date,$create_product_id,$create_product_qty)
 {
	   $search_date = date('Y-m-d',strtotime($search_date));
 	   $check_stock = $this->db->get_where('dairy_stock',array('stock_date' => $search_date, 'product_id' => $create_product_id ));

		 if($check_stock->num_rows() == 1){
         $this->db->where('stock_date',$search_date);
				 $this->db->where('product_id',$create_product_id);
				 $this->db->set('produced_qty','product_qty +'.$create_product_qty,FALSE);
				 $this->db->set('remaining_qty','remaining_qty +'.$create_product_qty,FALSE);
				 if($this->db->update('dairy_stock')){
					 echo 'success';
				 }else {
				 	echo 'failed';
				 }

		 }else if($check_stock->num_rows() == 0){
			  $arr = array(
					  'stock_date' => $search_date,
					  'product_id' => $create_product_id,
						'produced_qty' =>  $create_product_qty,
						'remaining_qty' => $create_product_qty,
			   );
				 if($this->db->insert('dairy_stock',$arr)){
					 echo 'success';
				 }else {
				 	echo 'failed';
				 }
		 }
 }

 public function select_all_supplyer()
 {
	 $this->db->select('*');
	 $this->db->from('supplyer_details');
	 $this->db->order_by('supplyer_name','asc');
	 $data = $this->db->get();
	 return $data->result();
 }
}
