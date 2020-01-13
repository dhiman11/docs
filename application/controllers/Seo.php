<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Seo extends MY_Controller {

	public function  __construct()
		{
			parent::__construct();   
			$this->load->model('Sitemap_data');   
		}
		
    function sitemap()
    { 
	
		$result['data'] = $this->Sitemap_data->sitemap();
		header("Content-Type: text/xml;");
		$this->load->view("sitemap",$result);
		
    }
}