<?php
defined('BASEPATH') or exit('No direct script access allowed');

/////////////////////////////////////////////////////////
/////////This Class allows you to delete the posts   
class Delete extends MY_Controller
{

	public function  __construct()
	{
		parent::__construct();
		$this->load->model('Delete_model');
	}
	public function delete_post()
	{
		$delete_id = $this->input->post('id');
		$category = $this->input->post('category');

		if (in_array('insert', $this->my_role($_SESSION['role_name'], $category)) || $_SESSION['role_name'] == "admin") {
			echo $_SESSION['role_name'];
		} else {
			echo json_encode(array("result" => false, 'msg' => $_SESSION['role_name'] . " is not allowed to Delete . Contact Administrator"));
			exit();
		}  
		$this->Delete_model->delete_post($delete_id);
		echo json_encode(array("result" => true));
	}
}
