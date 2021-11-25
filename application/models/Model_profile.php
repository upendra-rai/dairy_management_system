<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class model_profile extends CI_Model {



	function __construct(){



		parent::__construct();

	}



	public function login(){



		$email = $this->input->post('email');

		$password = $this->input->post('password');

		$check = $this->db->get_where('team_member', array(

					'email' => $email,

					'password' => $password,

					'user_id' => 1

				));



		if($check->num_rows() == 1){



			$arr = array(

					'logged_in' => 'sharmadairy_in',

					'uid' => $check->result()[0]->user_id,
					'title' => 'Ackko',
									
				);



			$this->session->set_userdata($arr);

			redirect('./dashboard');



		} else {



			return '<div id="notification" class="alert alert-danger">Invalid credentials.</div>';

		}		

	}


	public function forgot(){

		$email = $this->input->post('email');

		$check = $this->db->get_where('users', array(

				'email' => $email,

			));

		if($check->num_rows() == 1){

			$tok = uniqid();

            $token = md5($tok);

            $url = base_url('admin/reset_password/'.$check->result()[0]->id.'/'.$token);

            $subject = "Reset Password";

            $from = "support";

            $body = "Hello, <br/> <br/>It seems you have recently requested for Password Reset, If you did so, just click the link bellow to reset your Password.  <br><br>".$url;

            $headers = "From: " . strip_tags($from) . "\r\n";

            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";

            $headers .= "MIME-Version: 1.0\r\n";

            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			mail($email, $subject, $body, $headers);


			$arr = array(

					'token' => $token

				);


			$this->db->where('id', $check->result()[0]->id);


			if ($this->db->update('users', $arr)) {

				return '<div id="notification" class="alert alert-success">we have sent you a mail to <b style="color:springgreen;">' .$email. '</b> along with password reset link</div>';

			} else {

				return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';

			}

		} else {

			return '<div id="notification" class="alert alert-danger">You are not a registered user</div>';

		}

	}



	public function reset_password($user_id, $token){

		$this->db->select('token');

		$this->db->from('users');

		$this->db->where('id', $user_id);

		$d_token = $this->db->get();



		if($d_token->num_rows() == 0){



			return 0;

		} else {



			if($token == $d_token->result()[0]->token){

				return true;

			} else {

				return false;

			}			

		}

	}



	public function update_password($id){



		$password = $this->input->post('password');



		$arr = array(

				'password' => $password,

				'token' => ''

			);



		$this->db->where('id', $id);

		if($this->db->update('users', $arr)){



			return '<div id="notification" class="alert alert-success">Your Password has been updated successfully.</div>';

		} else {



			return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';

		}

	}	
    
    
     // carry formfard stock   verifypos
    
    
    public function auto_carry_forward_stock(){

      date_default_timezone_set('Asia/Kolkata');
          $date = new DateTime();
          $today = $date->format('Y-m-d');
          
        $tommorow = date('Y-m-d', strtotime($today .' -1 day'));
        
        
        $check_today_stock =  $this->db->get_where('dairy_stock',array( 'stock_date' => $today ));
        
        
        
        if($check_today_stock->num_rows() > 0){  
        }else{
            
            $this->db->select('*');
            $this->db->from('dairy_products');
            $product_row = $this->db->get();
            
            
            if($product_row->num_rows() > 0){
                
                foreach($product_row->result() as $row){
                    
                    $p_id = $row->product_id;
                    
                    $arr = array(
                      
                        'stock_date' => $today,
                        'product_id' => $p_id,
                    );
                    
                    $this->db->insert('dairy_stock',$arr);
                }
                
            }
            
            
        }
        
       /* $check_stock = $this->db->get_where('dairy_stock',array( 'stock_date' => $tommorow ));
        
        if($check_stock->num_rows() > 0 ){
   
        
            
            foreach($check_stock->result() as $row){
                         
                $product_id = $row->product_id;
                $remaining_qty = $row->remaining_qty;
                
                if($remaining_qty > 0){
               
                $check_today_stock = $this->db->get_where('dairy_stock',array( 'stock_date' => $today, 'product_id' => $product_id ));
                
                
                if($check_today_stock->num_rows() > 0){
                    // update Query
                      
                    $this->db->where('stock_date',$today);
                    $this->db->where('product_id',$product_id);
                    $this->db->set('produced_qty','produced_qty +'.$remaining_qty,FALSE);
                     $this->db->set('remaining_qty','remaining_qty +'.$remaining_qty,FALSE);
                    if( $this->db->update('dairy_stock')){
                        $this->db->where('stock_date',$today);
                        $this->db->where('product_id',$tommorow);
                        $this->db->set('remaining_qty','remaining_qty -'.$remaining_qty,FALSE);
                        $this->db->set('carry_qty','carry_qty +'.$remaining_qty,FALSE);
                        
                        
                        $this->db->update('dairy_stock');
                        
                    };
                    
                    
                }
                }
                
            }
            
            
        } */
        
      
        
    }
    

}