<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class expanse extends CI_Controller {

	function __construct(){

		parent::__construct();

		 ini_set('max_execution_time', 0);
         ini_set('memory_limit','2048M');

		     $this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_add_expanse');
         $this->load->model('model_dashboard');
        if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			redirect('./admin/login');
		}



	}
	public function init_user(){
       $user_id = $this->session->userdata('uid');
		
	}

	public function index(){
        $data['active_menu'] = "home";
        $this->load->helper('form');
        $this->load->view('home', $data);
	}

	public function add_expanse()
	{
    // url segment
	   $category_id = $this->uri->segment(3);
		 $subcategory_id = $this->uri->segment(4);
		//url segment
    
		if($this->input->post('submit')){

			 $expanse_head_id = $this->input->post('expanse_head');
		   $expanse_subhead_id = $this->input->post('expanse_subhead');
          
			 $expanse_amount = $this->input->post('expanse_amount');
			 $note = $this->input->post('note');
			 $expanse_date =  $this->input->post('expanse_date');
 

      //echo $posted_category_id;
			$data["msg"] = $this->model_add_expanse->add_expanse($expanse_head_id,$expanse_subhead_id,$expanse_amount,$note,$expanse_date);
		}else{
		$data['active_menu'] = "expanse";
		$data['active_submenu'] = "add_expanse";

	  // selected category id and sub category id
    	$data['selected_category'] = $category_id;
			$data['selected_subcategory'] = $subcategory_id;
		// selected category id and sub category id

    $data["category_list"] = $this->model_add_expanse->select_category($category_id,$subcategory_id);
		$data["subcategory_list"] = $this->model_add_expanse->select_subcategory($category_id,$subcategory_id);
		$data["expanse_list"] = $this->model_add_expanse->select_expanse($category_id,$subcategory_id);
            
        $data["unit_list"] = $this->model_add_expanse->select_unit();
        $data["gst_list"] = $this->model_add_expanse->select_gst();    
		$this->load->view('expanse/add_expanse', $data);
	}
	}

	public function edit_expanse()
	{
			// url segment
		  
			 $id = $this->uri->segment(3);
			

		if($this->input->post('submit')){

            $expanse_head_id = $this->input->post('expanse_head');
		    $expanse_subhead_id = $this->input->post('expanse_subhead');
			 $expanse_amount = $this->input->post('expanse_amount');
			 $note = $this->input->post('note');
			 $expanse_date =  $this->input->post('expanse_date');

			 $data["msg"] = $this->model_add_expanse->edit_expanse($id,$expanse_head_id,$expanse_subhead_id,$expanse_amount,$note,$expanse_date);



		}else{
		  $data['active_menu'] = "expanse";
		$data['active_submenu'] = "add_expanse";


		  $data["expanse_selected"] = $this->model_add_expanse->selected_expanse($id);
		  $data["category_list"] = $this->model_add_expanse->select_category();
		  $data["subcategory_list"] = $this->model_add_expanse->select_subcategory();
		        
		 $this->load->view('expanse/add_expanse', $data);
	  }
	}

	public function del_expanse()
	{
		if(isset($_POST["del_id"])){
			$del_id = $_POST["del_id"];
			$data["msg"] = $this->model_add_expanse->del_expanse($del_id);
		}

	}

// upload category image
	public function upload_image(){

	  if($_FILES["file"]["name"] != "")
      {
		 $img_folder_name = $_POST['img_folder_name'];
	   $test = explode(".", $_FILES["file"]["name"]);
	   $extension = end($test);
	   $name = rand(100,99999).strtotime(date('Y-m-d H:i:s')).bin2hex(openssl_random_pseudo_bytes(4)).'.'.$extension;
	   $location = 'uploads/'.$img_folder_name.'/'.$name;
	   move_uploaded_file($_FILES["file"]["tmp_name"], $location);
	   echo '<img src="'.base_url().$location.'" data-img_name="'.$name.'" alt="User" style="width:100% ; height:100%;"/><input type="hidden" name="image_name" value="'.$name.'" /><button type="button" class="btn" id="inlink_img_bt" data-unlink_img_src="'.$location.'" style="position:absolute; background-color:#ff4747; color:#ffffff; margin-top:-2px;">X</button>';

      }
	}
// upload category image

	public function unlink_image()
	{
		  if(isset($_POST['unlink_img_src'])){
          $unlink_img_src = $_POST['unlink_img_src'];
					if($unlink_img_src != ''){
		        if(unlink($unlink_img_src)){
							echo 'success';
						}else{
							echo 'failes';
						}
		 		 }
			}
	}
    
    
// list product section
    
    public function list_expanse()
	{
    
		$data['active_menu'] = "expanse";
		$data['active_submenu'] = "list_expanse";
		$data["expanse_list"] = $this->model_add_expanse->select_all_expanse();
		$this->load->view('expanse/expanse_list', $data);
	
	}
    
}
