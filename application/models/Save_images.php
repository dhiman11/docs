<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Save_images extends CI_Model
{
	 
			public function show_images()
			{
				// print_r($input); 
				 
				$this->db->limit(100);
				$this->db->order_by('id','desc');
				$query  = $this->db->get('images');
				return $query->result_array();
				  
			}
		 
			
			public function add_pics($filename)
			{
				// print_r($input); 
				$data = array('image_name' => $filename);

				$this->db->insert('images', $data);
				return $this->db->insert_id();


			}
			
			
	 
}

?>

 