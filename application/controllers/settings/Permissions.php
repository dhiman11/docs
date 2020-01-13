<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  Permissions extends MY_Controller
{

   
    public function  __construct()
    {
        

        parent::__construct();
        $this->load->model('Category');
        $this->load->model('user_permissons/User_roles');
        
        
        if(isset($_SESSION['role_name']) && $_SESSION['role_name'] =='admin'){
           
          }else{
            redirect(base_url('Login/index')); 
          }
          
    }

    public function index()
    {
   
        $data['menu'] = $this->Category->category_cat();	
        $this->load->view('template/post_header',$data);  

        $data['users'] = $this->User_roles->get_users_list();
        $data['get_users_roles'] = $this->User_roles->get_users_roles();
         

        $data['permissions_data'] = $this->User_roles->get_permission_data();
       
        $data['categories_data'] = $this->User_roles->get_category_data();
        
       
      
        $this->load->view('dashboard/permission_view',$data);
        $this->load->view('template/footer.php');  
    }

    public function process_permissons()
    { 
        $data = $this->input->post();
        $category_id = $this->input->post('category_id');
 
        $i=1;
        
        $post_data = array( 
                "admin" => [],
                "developer" => [],
                "manager" => [],
                "editor" => [],
                "guest" => []
             );
        

        foreach($data as $key => $value){
            if($key !='category_id'){
                $post_data[$key] = $value; 
            $i++;
            } 
         }
   

        $this->User_roles->update_permissions($post_data,$category_id);
        echo json_encode(array("result"=>true));


    }
    
}
 