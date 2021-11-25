<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product_e extends CI_Controller {

	function __construct(){

		parent::__construct();

		 ini_set('max_execution_time', 0);
         ini_set('memory_limit','2048M');

		     $this->load->library('session');
         $this->load->helper('form');
         $this->load->model('model_product_e');
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

	public function add_product()
	{
    // url segment
	   $category_id = $this->uri->segment(3);
		 $subcategory_id = $this->uri->segment(4);
		//url segment
    
		if($this->input->post('submit')){

			 $posted_category_id = $this->input->post('category');
		   $posted_subcategory_id = $this->input->post('subcategory');
       if(!$posted_subcategory_id){
				  $posted_subcategory_id = null;
			 }

             $product_name = $this->input->post('product_name');
			 $unit = $this->input->post('unit');
			 $unit_price = $this->input->post('unit_price');
			 $status =  $this->input->post('status');
             $gst =  $this->input->post('gst');
             $short_discription =  $this->input->post('short_discription');
             $discription =  $this->input->post('discription');
            
            $dairy_product_id = $this->input->post('dairy_product_id');
            
       $img_name = $this->input->post('image_name');
       if(!$img_name){
				 $img_name = '';
			 }

      //echo $posted_category_id;
			 $data["msg"] = $this->model_product_e->add_product($posted_category_id,$posted_subcategory_id,$product_name,$unit,$unit_price,$status,$img_name,$gst,$short_discription,$discription,$dairy_product_id);
		}else{
		$data['active_menu'] = "e_product";
		$data['active_submenu'] = "add_product";

	  // selected category id and sub category id
    	$data['selected_category'] = $category_id;
			$data['selected_subcategory'] = $subcategory_id;
		// selected category id and sub category id

    $data["category_list"] = $this->model_product_e->select_category($category_id,$subcategory_id);
		$data["subcategory_list"] = $this->model_product_e->select_subcategory($category_id,$subcategory_id);
		$data["product_list"] = $this->model_product_e->select_product($category_id,$subcategory_id);
        $data["dairy_products"] = $this->model_product_e->select_all_dairy_product();    

        $data["unit_list"] = $this->model_product_e->select_unit();
        $data["gst_list"] = $this->model_product_e->select_gst();    
		$this->load->view('e_product/add_product', $data);
	}
	}

	public function edit_product()
	{
			// url segment
		   $category_id = $this->uri->segment(3);
			 $subcategory_id = $this->uri->segment(4);
			 $id = $this->uri->segment(5);
			 $count_scroll_position = $this->uri->segment(6);
			//url segment

		if($this->input->post('submit')){

			$posted_category_id = $this->input->post('category');
			$posted_subcategory_id = $this->input->post('subcategory');
			if(!$posted_subcategory_id){
				 $posted_subcategory_id = null;
			}

			$product_name = $this->input->post('product_name');
			$unit = $this->input->post('unit');
			$unit_price = $this->input->post('unit_price');
			$status =  $this->input->post('status');
            $gst =  $this->input->post('gst');
             $short_discription =  $this->input->post('short_discription');
             $discription =  $this->input->post('discription');
             $dairy_product_id = $this->input->post('dairy_product_id');

      $img_name = $this->input->post('image_name');
      $last_uploaded_image_name =  $this->input->post('last_uploaded_image_name');

			 if($last_uploaded_image_name != $img_name){
				  unlink('uploads/product_category_image/'.$last_uploaded_image_name);
		  	}


			 $data["msg"] = $this->model_product_e->edit_product($id,$posted_category_id,$posted_subcategory_id,$product_name,$unit,$unit_price,$status,$img_name,$count_scroll_position,$gst,$short_discription,$discription,$dairy_product_id);



		}else{
		  $data['active_menu'] = "e_product";
		$data['active_submenu'] = "add_product";

			// selected category id and sub category id
			 $data['selected_category'] = $category_id;
			 $data['selected_subcategory'] = $subcategory_id;
		 // selected category id and sub category id

		  $data["product_selected"] = $this->model_product_e->selected_product($id,$category_id,$subcategory_id);
		  $data["category_list"] = $this->model_product_e->select_category($category_id,$subcategory_id);
		  $data["subcategory_list"] = $this->model_product_e->select_subcategory($category_id,$subcategory_id);
		  $data["product_list"] = $this->model_product_e->select_product($category_id,$subcategory_id);
            
          $data["unit_list"] = $this->model_product_e->select_unit();
        $data["gst_list"] = $this->model_product_e->select_gst();  
          $data["dairy_products"] = $this->model_product_e->select_all_dairy_product();        
            
		  $this->load->view('e_product/add_product', $data);
	  }
	}

	public function del_product()
	{
		if(isset($_POST["del_id"])){
			$del_id = $_POST["del_id"];
			$data["msg"] = $this->model_product_e->del_product($del_id);
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
    
    public function list_product()
	{
    
		$data['active_menu'] = "e_product";
		$data['active_submenu'] = "list_product";
		$data["product_list"] = $this->model_product_e->select_all_product();
        //echo json_encode($data['product_list']);
        
		$this->load->view('e_product/list_product', $data);
	
	}
    
}
