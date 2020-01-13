<?php 
defined('BASEPATH') or exit('No direct script access allowed');
 
class Delete_model extends CI_Model
{

    function delete_post($id)
    {
        $this->db->delete('lesson_post', array('id' => $id));
    }

  

}
 