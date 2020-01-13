<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Insert_model extends CI_Model
{

    function insert_sub_cat($new_subval, $cat)
    {
        $data = array(
            'category_id' => $cat,
            'sub_category_name' => $new_subval
        );

        $this->db->insert('lesson_sub_cat', $data);
    }

    function insert_post_val($post_val, $sub_id)
    { 
        $data = array(
            'post_title' => $post_val,
            'sub_cat_id' => $sub_id
        ); 
        $this->db->insert('lesson_post', $data);

    }

    function insert_catg_val()
    { 
        $data = array(
            'lesson_name' => 'Enter name',
            'remarks' => 'dbms.png',
            'status' => 1,
        ); 
        $this->db->insert('lesson_cat', $data);

    }


    function insert_user_val()
    { 
        $data = array(
            'username' => 'Enter_username_here',
            'password' => '202cb962ac59075b964b07152d234b70',
            'user_role' => '5',
            'status' => 1,
        ); 
        $this->db->insert('user', $data);

    }



}
 