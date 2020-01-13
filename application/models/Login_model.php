<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Login_model extends CI_Model
{
		public function verify_login($username,$password)
			{
				$this->db->where('user.username',$username);
				// $this->db->or_where('user.email',$username);
				$this->db->where('user.password',$password);  
				$this->db->join('user_role','user_role.role_id = user.user_role','left');
				$query = $this->db->get('user');
				return $query->result_array();
			}
		  

			public function change_pass($data)
			{
				$user_id = $_SESSION['user_id'];

				$this->db->set('password',md5($data['new_pass']));
				$this->db->where('password',md5($data['old_pass']));
				$this->db->where('user_id',$user_id);
				$this->db->update('user');

				return  $this->db->affected_rows();
				 
				 
				 
				
			}

			
			
}

?>