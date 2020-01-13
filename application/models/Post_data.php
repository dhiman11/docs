<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Post_data extends CI_Model
{
	 
		///////GET POST DATA///////////////////////////////////	
		/////////////////////////////////////////////////
		public function get_post_data_model($post_id)
			{
				$this->db->select('*');
				$this->db->where('id',$post_id);
				$query = $this->db->get('lesson_post');
				return $query->result_array();
			}
		///////GET META DATA///////////////////////////////////	
		/////////////////////////////////////////////////
		public function get_meta_data($slug)
		{
			$this->db->select('seo_title,seo_keyword,seo_description');
			$this->db->where('slug',$slug);
			$query = $this->db->get('lesson_post');
			return $query->result_array();
		}
		
		 
		///////Next POST///////////////////////////////////	
		/////////////////////////////////////////////////
		public function get_post_next_slug($id)
			{
				$this->db->select('post_title,slug,id');
				$this->db->limit('1'); 
				$this->db->where('id > '.$id);
				$query = $this->db->get('lesson_post');
			 
				return $query->result_array();
			}
			
		///////Prev POST///////////////////////////////////	
		/////////////////////////////////////////////////
		public function get_post_prev_slug($id)
			{
				 
				$this->db->select('post_title,slug,id');
				$this->db->limit('1'); 
				$this->db->order_by('id','desc'); 
				$this->db->where('id < '.$id);
				$query = $this->db->get('lesson_post');
				return $query->result_array();
			}



		////////////////////////////
		//GET ALL SUB CATEGORIES
			
		public function get_all_sub_cat($id)
		{
			 
			$this->db->select('id,sub_category_name'); 
			$this->db->order_by('queue','asc'); 
			$this->db->where('category_id',$id); 
			$query = $this->db->get('lesson_sub_cat');
			return $query->result_array();
		}


		////////////////////////////
		//GET ALL post_list
			
		public function get_all_post_list_data($id)
		{
			 
			$this->db->select('id,post_title'); 
			$this->db->order_by('queue','asc'); 
			$this->db->where('sub_cat_id',$id); 
			$query = $this->db->get('lesson_post');
			return $query->result_array();
		}


		public function search_post_data($keyword)
		{
			$this->db->select('lesson_post.id,lesson_post.post_title,lesson_sub_cat.sub_category_name,lesson_cat.lesson_name,lesson_cat.id as lesson_cat_id');  
			$this->db->join('lesson_sub_cat','lesson_sub_cat.id = lesson_post.sub_cat_id');  
			$this->db->join('lesson_cat','lesson_cat.id = lesson_sub_cat.category_id');  
			$this->db->or_like('lesson_post.post_title',$keyword);
			$this->db->or_like('lesson_post.post',$keyword);
			$query = $this->db->get('lesson_post');
			return $query->result_array();
		}


		public function recent_updated_data()
		{
			$this->db->select('lesson_post.id,lesson_post.post_title, lesson_cat.lesson_name,lesson_cat.id as lesson_cat_id,lesson_post.updated_by as updated_by,,lesson_post.last_updated as last_updated');  
			$this->db->join('lesson_sub_cat','lesson_sub_cat.id = lesson_post.sub_cat_id');  
			$this->db->join('lesson_cat','lesson_cat.id = lesson_sub_cat.category_id');   
			$this->db->order_by('lesson_post.last_updated','DESC');
			$this->db->limit(5);
			$query = $this->db->get('lesson_post');
			return $query->result_array();
		}




			
}



?>