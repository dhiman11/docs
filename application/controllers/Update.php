<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update extends MY_Controller
{

	public function  __construct()
	{
		parent::__construct();
		$this->load->model('Update_lesson');
		$this->load->model('user_permissons/User_roles');
	}
	public function lesson()
	{

		$lesson_id = $this->input->POST('lesson_id');
		$lesson_title = $this->input->POST('lesson_title');
		$lesson_slug = $this->input->POST('lesson_slug');
		$lesson_seo_keyword = $this->input->POST('lesson_seo_keyword');
		$lesson_seo_description = $this->input->POST('lesson_seo_description');
		$lesson_description = $this->input->POST('lesson_description');
		$lesson_seo_title = $this->input->POST('lesson_seo_title');

		$this->Update_lesson->update($lesson_id, $lesson_title, $lesson_slug, $lesson_seo_title, $lesson_seo_keyword, $lesson_seo_description, $lesson_description);
		echo json_encode(array("result" => true));
	}

	public function update_sub_cat()
	{
		$get_updation_val = $this->input->POST('get_updationval');
		$sub_cat_id = $this->input->POST('sub_cat_id');
		$category = $this->input->POST('category');

		if (in_array('update', $this->my_role($_SESSION['role_name'], $category, 'update')) || $_SESSION['role_name'] == "admin") {
			$this->Update_lesson->update_sub_category($get_updation_val, $sub_cat_id);
			echo json_encode(array("result" => true));
		} else {
			echo json_encode(array("result" => false, "msg" => $_SESSION['role_name'] . " is not allowed to edit . Contact Administrator"));
			// exit($_SESSION['role_name'] . " is not allowed to edit . Contact Administrator");
		}
	}


	public function update_subcat_queue()
	{
		$new_queue = 1;
		foreach ($this->input->get_post('subcat') as $value) {
			$this->Update_lesson->update_sub_cat_queee($value, $new_queue);
			$new_queue++;
		}
	}


	public function update_post_queue()
	{
		$new_queue = 1;
		foreach ($this->input->get_post('post') as $value) {
			$this->Update_lesson->update_post_queee($value, $new_queue);
			$new_queue++;
		}
	}


	public function update_category_name()
	{
		$allowed_extensions = array( "png", "jpg", "gif" , "jpeg");

		$filename= $_FILES["file_0"]["name"];
		$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
	 

		if (isset($_FILES['file_0'])) {
			if (in_array($file_ext,$allowed_extensions)) {
				if (file_exists(FCPATH . "/assets/category_images/" . $this->input->POST('category_id') . ".jpg")) {
					unlink(FCPATH . "/assets/category_images/" . $this->input->POST('category_id') . ".jpg"); 
				}elseif(FCPATH . "/assets/category_images/" . $this->input->POST('category_id') . ".png"){
					unlink(FCPATH . "/assets/category_images/" . $this->input->POST('category_id') . ".png");
				}   
				move_uploaded_file($_FILES['file_0']['tmp_name'], FCPATH . "/assets/category_images/" . $this->input->POST('category_id') . ".".$file_ext);
			}
		}

		$category_id = $this->input->POST('category_id');
		$category_name = $this->input->POST('category_name');
		$this->Update_lesson->update_category($category_id, $category_name);
		header('Content-type: application/json');
		echo json_encode(array("result" => true));
	}


	public function update_user_name()
	{
		$user_id = $this->input->POST('user_id');
		$user_name = $this->input->POST('user_name');
		$this->Update_lesson->update_user($user_id, $user_name);
		echo json_encode(array("result" => true));
	}


	public function update_user_role()
	{
		$user_id = $this->input->POST('user_id');
		$new_role = $this->input->POST('new_role');

		$this->User_roles->update_role($user_id, $new_role);
		if ($user_id == $_SESSION['user_id']) {

			$array = array(
				'role_name' => $new_role
			);

			$this->session->set_userdata($array);
		}
		echo json_encode(array("result" => true));
	}
}
