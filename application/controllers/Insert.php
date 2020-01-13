<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insert extends MY_Controller
{

	public function  __construct()
	{
		parent::__construct();
		$this->load->model('Insert_model');
	}
	public function insert_sub_cat()
	{
		$new_subval = $this->input->post('subval');
		$category_id = $this->input->post('category_id');
		//////////////////////
		if (in_array('insert', $this->my_role($_SESSION['role_name'], $category_id)) || $_SESSION['role_name'] == "admin") {
		 
		} else {
			echo json_encode(array("result" => false, 'msg' => $_SESSION['role_name'] . " is not allowed to insert . Contact Administrator"));
			exit();
		}
		//////////////////////


		$this->Insert_model->insert_sub_cat($new_subval, $category_id);
		echo json_encode(array("result" => true));
	}

	public function insert_new_post()
	{
		$post_val = $this->input->post('post_val');
		$sub_id = $this->input->post('sub_id');
		$category = $this->input->post('category');

		//////////////////////
		if (in_array('insert', $this->my_role($_SESSION['role_name'], $category)) || $_SESSION['role_name'] == "admin") {
		 
		} else {
			echo json_encode(array("result" => false, 'msg' => $_SESSION['role_name'] . " is not allowed to insert . Contact Administrator"));
			exit();
		}
		/////////////////////

		$this->Insert_model->insert_post_val($post_val, $sub_id);
		echo json_encode(array("result" => true));
	}


	
	public function insert_category()
	{
		$this->Insert_model->insert_catg_val();
		echo json_encode(array("result" => true));
	}

	public function insert_user()
	{
		$this->Insert_model->insert_user_val();
		echo json_encode(array("result" => true));
	}

}
