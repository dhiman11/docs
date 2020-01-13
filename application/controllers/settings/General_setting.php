<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  General_setting extends MY_Controller
{
  public function  __construct()
  {
    parent::__construct();
    $this->load->model('Category');
    $this->load->model('Dashboard_data');

    if(isset($_SESSION['role_name']) && $_SESSION['role_name'] =='admin'){
           
    }else{
      redirect(base_url('Login/index')); 
    }
  }
  public function index()
  {
    $results['general_list'] = $this->Dashboard_data->get_gen_settings();
    $data['menu'] = $this->Category->category_cat();
    $this->load->view('template/post_header', $data);
    $this->load->view('dashboard/gen_settings_view', $results);
    $this->load->view('template/footer.php');
  }

  public function process_general_settings()
  {
  
    ////If have image 
    if (isset($_FILES['image'])) {
      if ($_FILES['image']['type'] == 'image/jpeg') {
        move_uploaded_file($_FILES['image']['tmp_name'], FCPATH . "/assets/images/logo321.jpg");
        $_POST['value'] = base_url('assets/images/logo321.jpg');
      }
      if ($_FILES['image']['type'] == 'image/png') {
        move_uploaded_file($_FILES['image']['tmp_name'], FCPATH . "/assets/images/logo321.png");
        $_POST['value'] = base_url('assets/images/logo321.png');
      }
    }

    $post_data =  $this->security->xss_clean($_POST);
    $result = $this->Dashboard_data->update_gen_settings($post_data);
    if ($result == 1) {
      echo json_encode(array("result" => true));
    } else {
      echo json_encode(array("result" => false));
    }
  }
}
 