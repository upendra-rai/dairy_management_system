<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	function __construct(){

		parent::__construct();

		 ini_set('max_execution_time', 0);
         ini_set('memory_limit','2048M');

		$this->load->library('session');
         $this->load->helper('form');
		 $this->load->helper('file');
		 $this->load->helper('download');
		 $this->load->library('zip');

        $this->load->model('model_dashboard');
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			redirect('./admin/login');
		}


	}

	public function init($active_menu){

		$uid = $this->session->userdata('uid');
		$data['user_data'] = $this->model_dashboard->user_data($uid);

		$data['active_menu'] = $active_menu;

		return $data;
	}

	public function index(){
        $data['active_menu'] = "home";

        $this->load->helper('form');

        $data['total_customer'] = $this->model_dashboard->total_customer();
        $data['active_customer'] = $this->model_dashboard->total_active_customer();
        $data['blocked_customer'] = $this->model_dashboard->total_blocked_customer();
        $data['total_terminate'] = $this->model_dashboard->total_terminate();

        $data['today_recharge'] = $this->model_dashboard->select_today_recharge();
        $data['yesterday_recharge'] = $this->model_dashboard->select_yesterday_recharge();
		$data['month_recharge'] = $this->model_dashboard->select_month_recharge();
        $data['lastmonth_recharge'] = $this->model_dashboard->select_lastmonth_recharge();
        $data['thisyear_recharge'] = $this->model_dashboard->select_year_recharge();





		$today_vaction = $this->model_dashboard->today_vacation();
        $data['today_morning_vac'] = $today_vaction['morning'];
        $data['today_evening_vac'] = $today_vaction['evening'];

        $tommrow_vacation = $this->model_dashboard->tommrow_vacation();
        $data['tommrow_morning_vac'] = $tommrow_vacation['morning'];
        $data['tommrow_evening_vac'] = $tommrow_vacation['evening'];

        $after_tommrow_vacation = $this->model_dashboard->after_tommrow_vacation();
        $data['after_tommrow_morning_vac'] = $after_tommrow_vacation['morning'];
        $data['after_tommrow_evening_vac'] = $after_tommrow_vacation['evening'];

        $after_tommrow_tommrow_vacation = $this->model_dashboard->after_tommrow_tommrow_vacation();
        $data['after_tommrow_tommrow_morning_vac'] = $after_tommrow_tommrow_vacation['morning'];
        $data['after_tommrow_tommrow_evening_vac'] = $after_tommrow_tommrow_vacation['evening'];


		    $data['today_sell'] = $this->model_dashboard->select_today_sell();
        $data['yesterday_sell'] = $this->model_dashboard->select_yesterday_sell();
		    $data['month_sell'] = $this->model_dashboard->select_month_sell();
        $data['lastmonth_sell'] = $this->model_dashboard->select_lastmonth_sell();
        $data['thisyear_sell'] = $this->model_dashboard->select_year_sell();
        $data['bar'] = $this->model_dashboard->select_barchart_transaction();
        $data['bar2'] = $this->model_dashboard->select_barchart_recharge();

        $user_ragistration = $this->model_dashboard->user_ragistration();

        $data['total_ragistration'] = $user_ragistration['total_ragistration'];
        $data['new_ragistration'] = $user_ragistration['new_ragistration'];
        $data['completed_ragistration'] = $user_ragistration['completed_ragistration'];
        $data['canceled_ragistration'] = $user_ragistration['canceled_ragistration'];
        
        $order_delivery_datewise_count = $this->model_dashboard->order_delivery_datewise_count();
        
        $data['today_delivery'] = $order_delivery_datewise_count['today_delivery'];
        $data['second_day_delivery'] = $order_delivery_datewise_count['second_day_delivery'];
        $data['third_day_delivery'] = $order_delivery_datewise_count['third_day_delivery'];
        $data['forth_day_delivery'] = $order_delivery_datewise_count['forth_day_delivery'];
        $data['fifth_day_delivery'] = $order_delivery_datewise_count['fifth_day_delivery'];
        
        // carry formward tommorow stock //
        //  $this->model_dashboard->auto_carry_forward_stock();
        // carry formward tommorow stock //
        

        $this->load->view('home', $data);

	}

   
    public function order_delivery_datewise_count(){
         $data['bar2'] = $this->model_dashboard->order_delivery_datewise_count();
        echo json_encode($data['bar2']);
    }
    
    public function demo_chart(){
         $data['bar2'] = $this->model_dashboard->select_barchart_recharge();
        echo json_encode($data['bar2']);
    }

    public function lastmonthsell(){
         $data['bar2'] = $this->model_dashboard->select_lastmonth_sell();
        echo json_encode($data['bar2']);
    }

    public function blocked_customer(){
        $data['active_menu'] = "home";
        $data['blocked'] = $this->model_dashboard->total_blocked_customer_detail();
        //echo json_encode($data['blocked_customer']);
        $this->load->view('customer/total_blocked', $data);
    }

    public function terminate_customer_select(){
        $data['active_menu'] = "home";

				if($this->input->post('submit') != ''){

            $name_search = $this->input->post('name_search');
            $colony_search = $this->input->post('colony_search');

            $name = explode(" ", $name_search);
            if(isset($name[0])){
               $first_name =  $name[0];
            }else{
                $first_name = "";
            }

            if(isset($name[1])){
               $last_name =  $name[1];
            }else{
                $last_name =  "";
            }
            $data['return_name'] = $name_search;
            $data['return_colony'] = $colony_search;

            $data['select_colony'] = $this->model_dashboard->select_colony();
            $data['terminate'] = $this->model_dashboard->terminate_customer_filter($first_name,$last_name,$colony_search);
            $this->load->view('customer/total_terminated',$data);

        }else{
        $data['terminate'] = $this->model_dashboard->terminate_customer_select();
        //echo json_encode($data['blocked_customer']);
				$data['select_colony'] = $this->model_dashboard->select_colony();
        $this->load->view('customer/total_terminated', $data);
			}
    }


    public function uniq(){

        $str = openssl_random_pseudo_bytes(6);
        $value = bin2hex($str);
         echo uniqid($value.date('ymd'));
        //echo date('ymd');
    }

	public function profile(){

		$this->load->helper('form');

		$data = $this->init('profile');

		if($this->input->post('submit') == 'update-pic'){

			$config['upload_path'] = './uploads/profile/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']	= '1024';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$new_name = 'original-'.$_FILES["userfile"]['name'];
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()){

				$data['message'] = '<div id="notification" class="alert alert-warning">'.$this->upload->display_errors().'</div>';
				$this->load->view('my-details/profile', $data);
			} else {

				$image_data = $this->upload->data();
				$data['message'] = $this->resize($image_data);
				$this->load->view('my-details/profile', $data);
			}

		} else if($this->input->post('submit') == 'update-info'){

			$uid = $this->session->userdata('uid');
			$data['message'] = $this->model_dashboard->update_info($uid);
			$this->load->view('my-details/profile', $data);

		} else if($this->input->post('submit') == 'update-pass'){

			$uid = $this->session->userdata('uid');
			$data['message'] = $this->model_dashboard->update_pass($uid);
			$this->load->view('my-details/profile', $data);

		} else {

			$this->load->view('my-details/profile', $data);
		}
	}

	public function resize($image_data){

		$this->load->library('image_lib');
		$thumb_img = 'thumbnail-'.$image_data['client_name'];

		$config['image_library'] = 'gd2';
		$config['source_image'] = $image_data['full_path'];
		$config['new_image'] = './uploads/profile/thumbnail/'.$thumb_img;
		$config['width'] = 160;
		$config['height'] = 160;

		$this->image_lib->initialize($config);

		if($this->image_lib->resize()){

			$uid = $this->session->userdata('uid');
			$data2 = $this->model_dashboard->update_pic($thumb_img, $uid);
			return $data2;
		} else {

			return '<div id="notification" class="alert alert-danger">Something went wrong.</div>';
		}
	}

	public function logout(){

		$this->session->sess_destroy();
		redirect('./admin/login');
	}

	public function angular_crud(){

		echo "Message for Angular";
	}


    public function update_my_profile(){

        if(isset($_POST['first_name'],$_POST['email'])){

            $fname = $_POST['first_name'];
            $email = $_POST['email'];

            $this->model_dashboard->update_my_profile($fname,$email);


        }


    }

     public function change_pass(){

        if(isset($_POST['n_pass'],$_POST['r_pass'])){

            $n_pass = $_POST['n_pass'];
            $r_pass = $_POST['r_pass'];


            $this->model_dashboard->change_pass($n_pass);


        }


    }

    public function data_cleaner(){

        //$before_year = date('Y-m-d', strtotime('-1 year'));
        //echo $before_year;
        date_default_timezone_set('Asia/Kolkata');
        $cookie_name = "sharma_dairy_data_cleaner";
        $cookie_value = date('Y-m-d');
        if(isset($_COOKIE[$cookie_name])) {

            echo "data cleanup is already done";
         }else{

             $before_year = date('Y-m-d', strtotime('-1 year'));
             $this->model_dashboard->my_data_cleaner($before_year);

        }
    }

    public function block_transaction(){

        $cookie_name = "sharma_dairy_card_blocker";

        if(!isset($_COOKIE[$cookie_name])) {
             date_default_timezone_set('Asia/Kolkata');
             $before_tenday = date('Y-m-d', strtotime('-10 days'));
             $this->model_dashboard->my_block_transaction($before_tenday);
         }else{
             echo "card bolcker is already done";
        }
    }

    public function backup()
    {  $data['active_menu'] = "backup";
       $this->load->view('backup',$data);
    }

    public function db_backup()
    {
       date_default_timezone_set('Asia/Kolkata');
       $date = new DateTime();
       $time_stamp = $date->format('d-M-Y, g-i a');

       $this->load->dbutil();
       $backup =& $this->dbutil->backup();
       $this->load->helper('file');
       write_file('<?php echo base_url();?>/downloads', $backup);
       $this->load->helper('download');
       force_download('24k Milk Atm-'.$time_stamp.'.sql', $backup);
    }

	public function db_backup2()
    {
	  /* date_default_timezone_set('Asia/Kolkata');
       $date = new DateTime();
       $time_stamp = $date->format('d-M-Y, g-i a');

       $this->load->dbutil();
	   $db_format = array('tables' => array('colony_detail','delivery_type_details','dairy_products','recharge_limit','customer_details','team_member','current_balance','recharge_detail','transaction_detail','atm_card_detail','terminated_customer'), 'format'=>'zip','filename'=>'Sharma Dairy Atm-'.$time_stamp.'.sql');
       $backup = $this->dbutil->backup($db_format);
 	   $dbname = '24k Milk Atm Zip-'.$time_stamp.'.zip';
	   $save = $dbname;
	   //write_file($save,$backup);
	   force_download($dbname,$backup); */
        
           //ENTER THE RELEVANT INFO BELOW
   
   $host = "localhost";
$username = "root";
$password = "";
$database_name = "dms_update";
// Get connection object and set the charset
$conn = mysqli_connect($host, $username, $password, $database_name);
$conn->set_charset("utf8");
// Get All Table Names From the Database
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}
$sqlScript = "";
foreach ($tables as $table) {
        // Prepare SQLscript for creating table structure
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result);
    // Prepare SQLscript for dumping data for each table
    for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
             if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= '""';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
    }
    
    $sqlScript .= "\n"; 
}
 
if(!empty($sqlScript))
{
    // Save the SQL script to a backup file
    $backup_file_name = $database_name . '_backup_' . time() . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 
 // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exec('rm ' . $backup_file_name); 
}
    }


    public function enter_card()
    {
       $this->model_dashboard->enter_code();
    }
    
    public function enter_auto_card()
    {
       $this->model_dashboard->enter_auto_card();
    }

 public function select_duplicate_entry()
    {
       $this->model_dashboard->select_duplicate_entry();
    }

    public function get_time(){
        date_default_timezone_set('Asia/Kolkata');

        $get_time = date("H:i:s");
        if($get_time >= '04:00:00'  && $get_time <= '15:00:00'){

            $shift_id = 1;
            echo $shift_id;
        }else{

           $shift_id = 2;
            echo $shift_id;
        }

    }


	public function view_vacation()
    {
        $data['active_menu'] = "home";
       $date = $this->uri->segment(3);
       $shift = $this->uri->segment(4);


        if($this->input->post('submit') != '' && $this->input->post('start') != ""){
             $start = $this->input->post('start');
             $date = $this->input->post('start');
             $shift_id =  $this->input->post('shift');


              if($start != 'Start Date'){
                  $data['return_start'] = $start;
              }

              $data['return_shift'] = $shift_id;

              $data['vacation_list'] =$this->model_dashboard->view_vacation_searchbar($date,$shift_id);
              $data['select_shift'] = $this->model_dashboard->select_shift();
              $this->load->view('vacation_list',$data);
              //echo $date.$shift_id;

        }else{

        $data['vacation_list'] =$this->model_dashboard->view_vacation($date,$shift);
        $data['select_shift'] = $this->model_dashboard->select_shift();
        $this->load->view('vacation_list', $data);

		}
    }
    
    public function genrate_order(){
        
        $data['vacation_list'] = $this->model_dashboard->genrate_order();
        
    }
	
	
	public function test_sms(){
		  $msg = "Dear x,Your account has been recharged with Rs. x available balance is Rs. x.Thanks,x Disasa Dairy Farm";
      
		  $user = "avsprimetechnologiesllp";
        $password = "AVSPrime@123";
        $msisdn = '917067428075';//.$mobile;
        $sid = "AVSDMS";
        $name = "vivek";
        $OTP = "6765R";
        $msg = urlencode($msg);
        $fl = "0";
        $gwid = "2";
        $type = "txt";
        $cSession = curl_init(); 
        curl_setopt($cSession,CURLOPT_URL,"http://cloud.smsindiahub.in/api/mt/SendSMS?APIKey=6SkOV9q7g0WTU0Mp0mDPlg&senderid=AVSDMS&channel=trans&DCS=0&flashsms=0&number=7067428075&text=".$msg."&route=0");
        //"http://cloud.smsindiahub.in/api/mt/SendSMS?user=".$user."&password=".$password."&senderid=".$msisdn."&channel=trans&DCS=0&flashsms=0&number=7067428075&text=".$msg."&route=0"		
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false); 
        $result=curl_exec($cSession);
		//echo json_encode($result);
        curl_close($cSession);
        print_r($result);
      
       if($result){
			
			$result = json_decode($result);
           
			if($result->ErrorMessage == 'done'){
				echo 'my_success';
			}else{
				echo 'my_fail';
			}
		}
	}
	
	public function send_dynamic_msg(){
		
		return "ssss";
	}
    
    public function select_admin_notification(){
        
        $data['list'] = $this->model_dashboard->select_admin_notification();
        echo json_encode($data);
    }
    
    public function new_order(){
        
        $data['list'] = $this->model_dashboard->new_order();
        echo json_encode($data);
    }
    
    
    public function view_requirement_update(){
        
         $id = $this->uri->segment(3);
         $notification_id = $this->uri->segment(4);
          $data['list'] = $this->model_dashboard->view_requirement_update($id,$notification_id);
          //echo json_encode($data);
      
    }
    
    
    public function feedback_notification(){
        
         $data['list'] = $this->model_dashboard->feedback_notification();
        echo json_encode($data);
    }
    
     public function read_feedback($id){
        
         $data['list'] = $this->model_dashboard->read_feedback($id);
        
    }
    
    
    public function location_auto_seq(){
        $data['list'] = $this->model_dashboard->location_auto_seq();
        
        print_r($data);
        
    }

}
