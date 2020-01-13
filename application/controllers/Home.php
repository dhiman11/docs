<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
		This is home page controller
	 */
	 public function  __construct()
	{
		  parent::__construct();  
		  $this->load->model('Category');  
		   
	}
	
	public function index()
	{
		$search['page'] = 'home';
		$data['menu'] = $this->Category->category_cat();
		$this->load->view('template/header',$data);
		$this->load->view('template/search',$search);
		$this->load->view('home_page',$data);
		$this->load->view('template/footer');
	}
 
 
}
