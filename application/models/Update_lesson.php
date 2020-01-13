<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Update_lesson extends CI_Model
{
	 
		///////CATEGORY///////////////////////////////////	
		/////////////////////////////////////////////////
	public function update($lesson_id,$lesson_title,$lesson_slug,$lesson_seo_title,$lesson_seo_keyword,$lesson_seo_description,$lesson_description)
		{ 
			
			$data=array('post_title'=>$lesson_title,'slug'=>$lesson_slug,'last_updated'=>date('Y-m-d H:i:s'),'post'=>$lesson_description,'seo_title'=>$lesson_seo_title,'seo_keyword'=>$lesson_seo_keyword,'seo_description'=>$lesson_seo_description,'updated_by'=>$this->session->userdata('username'));
			$this->db->where('id',$lesson_id);
			$this->db->update('lesson_post',$data);

			
		}


	public function update_sub_category($get_updation_val,$sub_cat_id)
	{ 
		$data=array('sub_category_name'=>$get_updation_val);
		$this->db->where('id',$sub_cat_id);
		$this->db->update('lesson_sub_cat',$data);

	}

	public function update_sub_cat_queee($real_id,$new_queue)
	{
		$data=array('queue'=>$new_queue);
		$this->db->where('id',$real_id);
		$this->db->update('lesson_sub_cat',$data);
	}

	public function update_post_queee($real_id,$new_queue)
	{
		$data=array('queue'=>$new_queue);
		$this->db->where('id',$real_id);
		$this->db->update('lesson_post',$data);
	}

	public function update_category($id,$name)
	{
		$data=array('lesson_name'=>$name);
		$this->db->where('id',$id);
		$this->db->update('lesson_cat',$data);
	}

	public function update_user($id,$name)
	{
		$data=array('username'=>$name);
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
	}
}


?>