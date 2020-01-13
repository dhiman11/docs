<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function  __construct()
	{
		  parent::__construct();  
		  $this->load->model('Category');   
		  $this->load->model('Dashboard_data');   
	}
	
	public function index()
	{
		$data['menu'] = $this->Category->category_cat();		
		$this->load->view('template/header',$data);
		
		$result['tutorial'] = $this->Dashboard_data->tutuorial();
		$this->load->view('dashboard/dashboard',$result);
		$this->load->view('template/footer');
	}
 
 
}
