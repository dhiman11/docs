<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P extends MY_Controller {
 
	 public function  __construct()
	{
		  parent::__construct();  
		 // $this->load->model('Category');  
         $this->load->model('Category');   
		   
	}
	
	public function privacy()
    
    {
        $data['menu'] = $this->Category->category_cat();
        $this->load->view('template/header',$data);
        $this->load->view('privacy');
        $this->load->view('template/footer');
    }

	public function about_us()
    
    {
        $data['menu'] = $this->Category->category_cat();
        $this->load->view('template/header',$data);
        $this->load->view('about_us');
        $this->load->view('template/footer');
    }
	
	
	public function contact_us()
    
    {
        $data['menu'] = $this->Category->category_cat();
        $this->load->view('template/header',$data);
        $this->load->view('contact_us');
        $this->load->view('template/footer');
    }
	
	
	 
}
