<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

  public function __construct()
  {

    parent::__construct();
    $this->load->model('user_permissons/User_roles'); 
  }


  protected  function my_role($role, $cat = 0,$processing="insert")
  {

    $data = $this->User_roles->permissions_data($cat);
    
    $permission = json_decode($data[0]['permissions'], true);
    if(array_key_exists($role,$permission)){
      return $permission[$role];
    }else{
      echo json_encode(array("result" => false, 'msg' => $_SESSION['role_name'] . " is not allowed to ".$processing." . Contact Administrator"));
			exit();
    }
   
  }



}
 