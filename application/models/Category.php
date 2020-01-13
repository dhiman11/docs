<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Category extends CI_Model
{
	 
		///////CATEGORY///////////////////////////////////	
		/////////////////////////////////////////////////
		public function category_cat()
			{
				$this->db->where('status','1');
			 	
				$query = $this->db->get('lesson_cat');
				return $query->result_object();
			}
		///////FIND POST ID///////////////////////////////////	
		/////////////////////////////////////////////////
		public function post_id($id)
			{
				$this->db->select('sub_cat_id');
				$this->db->where('sub_cat_id',$id);
				$this->db->limit(1);
				$query = $this->db->get('lesson_post');
				return $query->result_array();
			}
		///////FIND Category  ID using sub_id///////////////////////////////////	
		/////////////////////////////////////////////////
		public function find_category_id($id) 
			{ 
				$this->db->select('category_id');
				$this->db->where('category_id',$id);
				$query = $this->db->get('lesson_sub_cat');
				return $query->result_array();
			}
			
			
			
		////////SUB CATEGORY/////////////////////////////
		/////////////////////////////////////////////////
		public function category_sub_cat($id)
			{
				 $this->db->where('category_id',$id);
				$query = $this->db->get('lesson_sub_cat');
				return $query->result_array();
			}
			
		////////SUB POST/////////////////////////////
		/////////////////////////////////////////////////
		public function post_menu()
			{
			   $this->db->order_by('id','asc');
				$query = $this->db->get('lesson_post');
				return $query->result_array();
			}
			
	 
			
}

?>