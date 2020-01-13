<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends MY_Controller {
 
	 public function  __construct()
	{
		  parent::__construct();  
		  $this->load->model('Category');  
		  $this->load->model('Post_data');   
		  ini_set('memory_limit', '-1');
	}
	


		
	private function get_post_data($post_id){

		return $this->Post_data->get_post_data_model($post_id);

	}
	private function get_posts_list($id){
			return $this->Post_data->get_all_post_list_data($id);
	}
	private function get_subcategories($category_id){
		return $this->Post_data->get_all_sub_cat($category_id);
	}

	
	public function index($category_id,$post_id=0)
	{
	  
		$cat_data  = $this->get_subcategories($category_id);
		 
		$i=1;
		$sub_cat=[];
		foreach($cat_data as $sidebar){ 
			$sub_cat[$i] = $sidebar;
			$sub_cat[$i]['posts'] = $this->get_posts_list($sidebar['id']);
			$i++;
		}
		
	 
		$data['post_data'] = $this->get_post_data($post_id);
 	 
		$data['category_id'] = $category_id;
		$data['selected_page'] = $post_id;
		$data['sidebar_category'] = $sub_cat;

		//Previous and Next PAGE data/////////////////////////
		$data['next_post'] = $this->Post_data->get_post_next_slug($post_id);
		$data['prev_post'] = $this->Post_data->get_post_prev_slug($post_id); 
		//////////////////////////////////////

		$data['menu'] = $this->Category->category_cat();		 
		$this->load->view('template/post_header',$data);  
		$search['page'] = 'tutorial';
		$this->load->view('template/search',$search);
		$this->load->view('post_page',$data); 
		$this->load->view('template/footer');
  
		}
	 

		public function search_something()
		{
			$data = $this->input->get_post('searching_for'); 
			$result = $this->Post_data->search_post_data($data); 

			$array_data =[];  
		 
			$i=0;

			foreach($result as $key => $value){
				 
				 $array_data[$value['lesson_cat_id']]['lesson'] = $value['lesson_name'];
				 $array_data[$value['lesson_cat_id']][$value['sub_category_name']]['post_title'][$value['id']] = $value['post_title']; 
				//  $array_data[$value['lesson_cat_id']] = array($value['id']); 
			  $i++;
			} 
			
			echo json_encode($array_data);
			
		}

		public function recent_topics(){
			$data =$this->Post_data->recent_updated_data();
		 
			echo json_encode($data);
		}

		
	}
 
 
 
