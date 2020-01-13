<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Register_model extends CI_Model
{
		public function verify_register($value)
			{
				//print_r($value);
				
				$this->db->where('username',$value['username']);
				$this->db->or_where('email',$value['email']);  
				$query = $this->db->get('user');
				return $query->result_array();
			}
		  
		  public function register_new($value)
			{
				 
				$data = array(
				'email' => $value['email'],
				'username' => $value['username'],
				'password' => $value['password']
				); 
				
				$this->db->insert('user', $data);
				$last_id = $this->db->insert_id();
				return $last_id;
			}
			
			
			public function verify_email($user_id,$md5)
			{
				//print_r($value);
				
				$this->db->where('user_id',$user_id);
				$this->db->where('password',$md5);  
				$query = $this->db->get('user');
				return $query->result_array();
			}
			
			
			 
			
			
		  public function activate_account($user_id)
			{
				 
					$data = array(
					'status' => '1'
					); 
					$this->db->where('user_id', $user_id);
					$this->db->update('user', $data);
					
					
			}

			
			
}

?>