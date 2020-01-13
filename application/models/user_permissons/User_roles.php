<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class User_roles extends CI_Model
{
	 
		///////CATEGORY///////////////////////////////////	
		/////////////////////////////////////////////////
		public function get_permission_data()
			{
				  
				$this->db->select('role_id,role_name'); 
				$query = $this->db->get('user_role');
				return $query->result_array();
            }
            
            public function get_category_data()
			{ 
				$this->db->select('id,lesson_name,permissions'); 
				$query = $this->db->get('lesson_cat');
				return $query->result_array();
            }

            public function update_permissions($data,$id)
			{    
                $data_r = array('permissions'=> json_encode($data));  
                $this->db->where('id',$id);
                $this->db->update('lesson_cat',$data_r); 
			}
			
			
            public function permissions_data($id)
			{   
                $this->db->where('id',$id);
				$query = $this->db->get('lesson_cat');
				return $query->result_array(); 
			}


			public function get_users_list()
			{    
				$query = $this->db->get('user');
				return $query->result_array(); 
			}

			public function get_users_roles()
			{    
				$query = $this->db->get('user_role');
				return $query->result_array(); 
			}


			public function update_role($user_id,$role)
			{     
                $data_r = array('user_role'=> $role);  
                $this->db->where('user_id',$user_id);
                $this->db->update('user',$data_r); 
			}



			
            
}


?>