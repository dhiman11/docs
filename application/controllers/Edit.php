<?php 
defined('BASEPATH') or exit('No direct script access allowed');


/////////////////////////////////////////////////////////
/////////This Class allows you to edit the posts   
class Edit extends MY_Controller
{
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('Category'); 
		$this->load->model('Edit_post');
		$this->load->model('Post_data');
		
		//////////////Check Permission
		//////////////////////////////
		
	}
	///////edit_POST///////////////////////////////////

	private function get_posts_list($id){
		return $this->Post_data->get_all_post_list_data($id);
	}

	private function get_subcategories($category_id){
		return $this->Post_data->get_all_sub_cat($category_id);
	}


	/////////////////////////////////////////////////
	public function post($sub_cat_id,$post_id)
	{
	 $this->login_check_edit_to_post($sub_cat_id,$post_id);
	 
		if(in_array('update',$this->my_role($_SESSION['role_name'],$sub_cat_id,'edit')) || $_SESSION['role_name'] =="admin"){
	 
		}else{
			exit($_SESSION['role_name']." is not allowed to edit . Contact Administrator");
		}
	 
	 

		$cat_data  = $this->get_subcategories($sub_cat_id);
		 
		$i=1;
		$sub_cat=[];
		foreach($cat_data as $sidebar){ 
			$sub_cat[$i] = $sidebar;
			$sub_cat[$i]['posts'] = $this->get_posts_list($sidebar['id']);
			$i++;
		}

		$result['selected_page'] = $post_id;
		$result['category_id'] = $sub_cat_id;

	 
		
		$result['sidebar_category'] = $sub_cat;
		$result['data'] = $this->Edit_post->edit_post_data($post_id);


		//Previous and Next PAGE data/////////////////////////
		$result['next_post'] = $this->Post_data->get_post_next_slug($post_id);  
		$result['prev_post'] = $this->Post_data->get_post_prev_slug($post_id);
 

		//////////////////////////////////////
		$result['menu'] = $this->Category->category_cat();		 
		// $this->load->view('template/post_header',$data);  
		// $this->load->view('template/search');
		$this->load->view('edit_page', $result);
		$this->load->view('template/footer');
	}
}
 