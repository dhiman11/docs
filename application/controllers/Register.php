<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

 
	function  __construct()
	{
	    parent::__construct(); 
		$this->load->database();  
		$this->load->model('Category');  
		$this->load->model('Register_model');  
		$this->load->helper('form');
		$this->load->helper('cookie'); 
		$this->load->library('email'); 
		$this->load->library('session'); 
		$this->load->library('encryption');
		$this->load->library('form_validation');

	}
	
	public function index() 
	{ 
		$value['value']= '' ;
		$value['str'] = '';
		$data['menu'] = $this->Category->category_cat(); 
		$this->load->view('template/header',$data);  
	 	$this->load->view('register/register.php',$value);
		$this->load->view('template/footer');
	}
	public function register_process() 
	{ 
		$value  = array (
		'email' => $this->input->post('email'),
		'username' => $this->input->post('username'),
		'password' => md5($this->input->post('password'))
		 	);
	 
			$this->form_validation->set_rules('username', 'Name', 'required|min_length[3]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
          
			if ($this->form_validation->run() == true) 
			{ 
					$verify = $this->Register_model->verify_register($value);  
					if (count($verify) > 0 )
					{
						if ($value['email'] == $verify[0]['email'] AND $value['username'] == $verify[0]['username'] )
						{
							$value['str'] = 'Email and username already existed';
						}
						elseif ($value['email'] == $verify[0]['email'] )
						{
							$value['str'] = 'Email already existed';
						}
						elseif ( $value['username'] == $verify[0]['username'] )
						{
							$value['str'] = 'username already existed';
						}
						else
						{
							$value['str'] = '';
						} 
						$data['menu'] = $this->Category->category_cat(); 
						$this->load->view('template/header',$data);  

						$value['value']= $verify ;
						$this->load->view('register/register.php',$value);
						$this->load->view('template/footer');
					} 


					if (count($verify) < 1 )
					{   
						///Register new user
						$new_user_id = $this->Register_model->register_new($value); 



						///Make temporary session
						$userdata = array( 'user_id'  => $new_user_id,'username'  => $value['username'],'email' => $value['email'],'logged_in' => 1);  

						$this->session->set_userdata($userdata);
						
						////Create Cooke/////
						$cookie1 = array(
						'name' => 'username',
						'value' => $value['username'],
						'expire' => time() + (10 * 365 * 24 * 60 * 60)
						);
						$cookie2 = array(
						'name' => 'password',
						'value' => $value['password'],
						'expire' => time() + (10 * 365 * 24 * 60 * 60)
						);

						$this->input->set_cookie($cookie1);
						$this->input->set_cookie($cookie2);
						////Create Cooke/////
						
						
						///Email confirmation
						$this->email->from('info@jquerylearn.com', 'Akshay Dhiman'); 
						$this->email->to($value['email']);
						$this->email->subject('Registration verification'); 
						$this->email->message('Dear,'.$value['username'].' Thanks for joining jQuerylearn.com . Now you are part of our family. Please confirm this email by clicking This link : '.base_url('register/verify_email/'.$this->session->userdata('user_id').'/'.urlencode(base64_encode($value['password']))));
						$this->email->send();	


						redirect(base_url('register/verify_email_account'));	
					}
			}
			else
			{
				echo "not correct";
			}
			
				
			 
		   
		
	}
	
		public function verify_email_account() 
	{
		 
			$data['menu'] = $this->Category->category_cat(); 
			$this->load->view('template/header',$data);   
			$this->load->view('register/Check_email');
			$this->load->view('template/footer');
			
			
	}
	
		public function resend_email($status) 
	{
 
			if ($status == 2) 
				
				{
					 
						///Email confirmation
						$this->email->from('info@jquerylearn.com', 'Akshay Dhiman'); 
						$this->email->to($this->session->userdata('email'));
						$this->email->subject('Registration verification'); 
						$this->email->message('Dear,'.$this->session->userdata('username').' Thanks for joining jQuerylearn.com . Now you are part of our family. Please confirm this email by clicking This link : '.base_url('register/verify_email/'.$this->session->userdata('user_id').'/'.urlencode(base64_encode(md5($this->input->cookie('password'))))));
						$this->email->send();	
					 
					 
						redirect(base_url('register/verify_email_account'));							
				}
				else
				{
					   redirect(base_url());	
				}
				
				
	}
	
	
	public function verify_email() 
	{  
		  $user_id = $this->uri->segment(3);
		  $password =  base64_decode(urldecode($this->uri->segment(4)));
			 
		  $verify_email_pass = $this->Register_model->verify_email($user_id,$password); 
		  
		  $user_id_here = $verify_email_pass[0]['user_id']; 
		  if (user_id_here)
		  {
			 $this->Register_model->activate_account($user_id_here);
			 $this->session->set_userdata('status', '1');
			 redirect(base_url());			 
		  }
		  
		  
		  
		  		
	}
	
	
	
	
	
}