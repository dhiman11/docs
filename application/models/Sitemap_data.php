<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Sitemap_data extends CI_Model
{
	 
		///////CATEGORY///////////////////////////////////	
		/////////////////////////////////////////////////
		public function sitemap()
			{  
				  $this->db->select('slug,last_updated');
				$query = $this->db->get('lesson_post');
				return $query->result_object();
			}
}


?>