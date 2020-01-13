<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard_data extends CI_Model
{  
	/////////////////////////////////////////////////
	public function tutuorial()
	{
		$this->db->order_by('id', 'desc');
		$this->db->limit('20');
		$query = $this->db->get('lesson_post');
		return $query->result_object();
	}

	public function get_gen_settings()
	{
		
		$this->db->order_by('type', 'desc'); 
		$query = $this->db->get('settings_content');
		return $query->result_object();
	}

	public function update_gen_settings($data)
	{
		$set_data = array( 
			"value"=>$data['value']
		);

		$this->db->where('id',$data['id']);
		$this->db->set($set_data);
		$query = $this->db->update('settings_content'); 
		return $this->db->affected_rows();
		;
	}


	public function gen_settings_data($value)
	{
	 
		$this->db->where('slug',$value); 
		$query = $this->db->get('settings_content');  
		return  $query->result_array();
		 
	}





}
 