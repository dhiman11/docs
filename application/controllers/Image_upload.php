<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
	
class Image_upload extends MY_Controller
{
		public function  __construct()
		{
			parent::__construct();  
			$this->load->model('Save_images');   
			$this->login_check();
		}
		///////edit_POST///////////////////////////////////	
		/////////////////////////////////////////////////
		public function index()
		{  
			$data['images'] = $this->Save_images->show_images(); 
			$this->load->view('images/images_data',$data);  
		}	
		
		public function upload_images()
		{ 
		 
			$photo =  $this->input->post('lesson_img');
			
				$i=1;
				if($photo)
				{
					foreach($photo as $value)
					{ 
						$strippedImg = str_replace('data:image/jpeg;base64,','',$value);
						$path='./uploads/';
						$filename= 'photo_'.time().$i.'.jpeg';
						file_put_contents($path.$filename, base64_decode($strippedImg));
						$output = $this->Save_images->add_pics($filename);
						$i++; 
					}
				}

			 
		}
}


?>