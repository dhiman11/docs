<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Edit_post extends CI_Model
{
	 
		///////CATEGORY///////////////////////////////////	
		/////////////////////////////////////////////////
		public function edit_post_data($id)
			{
				 
				$this->db->where('id',$id);
				$query = $this->db->get('lesson_post');
				return $query->result_array();
			}
}


?>