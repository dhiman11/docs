<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

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

	function  __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Login_model');
		$this->load->model('Category');
		$this->load->helper('form');
		$this->load->helper('cookie');
	}

	public function index()
	{
		$data['login_detail'] = '';
		$data['menu'] = $this->Category->category_cat();
		$this->load->view('template/header', $data);
		$this->load->view('login/login.php', $data);
		$this->load->view('template/footer');
	}

	public function login_process()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$remember = md5($this->input->post('remember'));

		$result = $this->Login_model->verify_login($username, $password);
 
		if (count($result) > 0) {

			foreach ($result as $user) {
				$user_id = $user['user_id'];
				$username = $user['username'];
				$email = $user['email'];
				$status = $user['status'];
				$role_name = $user['role_name'];
			}
			///////////////////////////////




			if ($remember) {

				$cookie1 = array(
					'name' => 'username',
					'value' => $this->input->post('username'),
					'expire' => time() + (10 * 365 * 24 * 60 * 60)
				);
				$cookie2 = array(
					'name' => 'password',
					'value' => $this->input->post('password'),
					'expire' => time() + (10 * 365 * 24 * 60 * 60)
				);

				$this->input->set_cookie($cookie1);
				$this->input->set_cookie($cookie2);
			}
			///////////////////////////////////////
			$userdata = array(
				'user_id'  => $user_id,
				'status'  => $status,
				'username'  => $username,
				'email'     => $email,
				'role_name'     => $role_name,
				'logged_in' => 1
			);

			$this->session->set_userdata($userdata);
			redirect(base_url());
		} else {
			$data['login_detail'] = 'Login Failed';
			$data['menu'] = $this->Category->category_cat();
			$this->load->view('template/header', $data);
			$this->load->view('login/login.php', $data);
			$this->load->view('template/footer');
		}
	}

	public function log_out()
	{
		$this->login_check();

		$userdata = array('user_id', 'username', 'email', 'logged_in', 'role_name');
		$this->session->unset_userdata($userdata);
		redirect(base_url());
	}


	public function change_password_page()
	{
		$this->login_check();

		$data['login_detail'] = 'Login Failed';
		$data['menu'] = $this->Category->category_cat();
		$this->load->view('template/header', $data);
		$this->load->view('login/change_password', $data);
		$this->load->view('template/footer');
	}


	public function change_password()
	{
		$this->login_check();
		
		$post_data = $this->input->post();
		$result = $this->Login_model->change_pass($post_data);

		if ($result ==  1) {
			$data['result'] = $result;
			$data['detail'] = 'Password Changed Successfully';
			$data['menu'] = $this->Category->category_cat();
			$this->load->view('template/header', $data);
			$this->load->view('login/password_change_success', $data);
			$this->load->view('template/footer');
		}else{
			$data['result'] = $result;
			$data['detail'] = 'Password change failed';
			$data['menu'] = $this->Category->category_cat();
			$this->load->view('template/header', $data);
			$this->load->view('login/password_change_success', $data);
			$this->load->view('template/footer');
		}
	}
}
