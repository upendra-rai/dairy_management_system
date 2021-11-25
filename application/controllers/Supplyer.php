<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class supplyer extends CI_Controller {

	function __construct(){

		parent::__construct();



		$this->load->library('session');
         $this->load->helper('form');

        $this->load->model('model_dashboard');
        $this->load->model('model_supplyer');
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

        $this->load->helper('form');
        $data['active_menu'] = "management";
        $data['active_submenu'] = "supplyer";

        $data["team"] = $this->model_supplyer->select_supplyer();
		    $this->load->view('supplyer/supplyer',$data);

	}

    public function add_supplyer(){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "supplyer";
        if($this->input->post('submit') != ""){

            $name = $this->input->post('name');
            $number = $this->input->post('mobile_no');
            $email = $this->input->post('email_id');
            $address = $this->input->post('address');
            $GST_no = $this->input->post('GST_no');

            $data['message'] = $this->model_supplyer->add($name,$email,$number,$address,$GST_no);

        }else{
           $this->load->view('supplyer/add_supplyer',$data);
        }
    }



    public function edit_supplyer( $id){
        $data['active_menu'] = "management";
        $data['active_submenu'] = "supplyer";

        if($this->input->post('submit') != ""){

					$name = $this->input->post('name');
					$number = $this->input->post('mobile_no');
					$email = $this->input->post('email_id');
					$address = $this->input->post('address');
					$GST_no = $this->input->post('GST_no');

          $data['message'] = $this->model_supplyer->edit($name,$email,$number,$address,$GST_no,$id);

        }else{
        $data["supplyer"] = $this->model_supplyer->selected_supplyer($id);
        $this->load->view('supplyer/edit_supplyer',$data);

        }
    }


    public function delete_member(){

        if(isset($_POST['del_id'])){

            $del_id = $_POST['del_id'];
            $this->model_supplyer->delete_team_member($del_id);
        }
    }


}
