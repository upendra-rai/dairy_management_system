<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class billing extends CI_Controller {

	function __construct(){

		parent::__construct();

		     $this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_billing');
         if($this->session->userdata('logged_in') !== 'sharmadairy_in'){
			redirect('./admin/login');
		}

	}
	public function init_user(){
       $user_id = $this->session->userdata('uid');
		
	}

	public function index(){

	}

	public function add_billing()
	{

		if($this->input->post('submit')){
                 $product_details = $this->input->post('product_details');
                 $admin_id = $this->session->userdata('uid');
            
                 $customer_id = $this->input->post('select_customer');
                   
                 //echo $customer_id;
				 $data["msg"] = $this->model_billing->cash_billing($product_details,$admin_id,$customer_id);	 

		}else{
		$data = $this->init_user();
		$data['active_menu'] = "";
		$data['active_submenu'] = "";

		$data["item_category_list"] = $this->model_billing->select_e_product();
        $data["dairy_product_list"] = $this->model_billing->select_dairy_product();    
        $data["all_customer_list"] = $this->model_billing->all_customer_list();        
        
            
		$this->load->view('billing', $data);
	   }
	}
    
    public function print_invoice($bill_id){
        
        
         $data["bill_details"] = $this->model_billing->print_invoice($bill_id);	
        
         //echo json_encode($data);
        $this->load->view('print_invoice',$data);
        
    }

	public function edit_category()
	{
		 $count_scroll_position = $this->uri->segment(3);
		  $id = $this->uri->segment(4);

		if($this->input->post('submit')){
       $category_type = $this->input->post('category_type');
			 $category_name = $this->input->post('category_name');
			 $status =  $this->input->post('status');
       $img_name = $this->input->post('image_name');
       if(!$img_name){
				 $img_name = '';
			 }

       $last_uploaded_image_name =  $this->input->post('last_uploaded_image_name');

			 if($last_uploaded_image_name != $img_name){

				  unlink('uploads/product_category_image/'.$last_uploaded_image_name);
		  	}

			 if($category_type == 'item'){
				 $data["msg"] = $this->model_billing->edit_category_of_items($id,$category_name,$status,$img_name,$count_scroll_position);

			 }

		}else{
		$data['active_menu'] = "e_product";
		$data['active_submenu'] = "add_category";

		$data["item_category_selected"] = $this->model_billing->select_item_category_selected($id);
		$data["item_category_list"] = $this->model_billing->select_item_category();
		$this->load->view('e_product/add_category', $data);
	  }
	}

	public function del_product_category()
	{
		if(isset($_POST["del_id"])){
			$del_id = $_POST["del_id"];
			$data["msg"] = $this->model_billing->del_product_category($del_id);
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
    
 // list category section
    
    public function list_category()
	{

		if($this->input->post('submit')){
       $category_type = $this->input->post('category_type');
			 $category_name = $this->input->post('category_name');
			 $have_subcategory = $this->input->post('have_subcategory');

			 $status =  $this->input->post('status');
       $img_name = $this->input->post('image_name');
			 if($category_type == 'item'){
				 $data["msg"] = $this->model_billing->add_category_of_items($category_name,$status,$have_subcategory,$img_name);

			 }

		}else{
		$data = $this->init_user();
		$data['active_menu'] = "add_category";
		$data['active_submenu'] = "add_category";

		$data["item_category_list"] = $this->model_billing->select_item_category();
		$this->load->view('category/list_category', $data);
	}
	}
}
