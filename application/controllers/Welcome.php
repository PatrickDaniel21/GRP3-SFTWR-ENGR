<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// LOAD THE MAIN VIEW
	public function index()
	{
		$this->load->view('home');
	}

	// FORM VALIDATION
	function registerNow()
	{

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname','Full Name','required|alpha');
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('email','Email','required|valid_emails');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('password1','Password','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				//CHECK IF THE ENTER PASSWORD IS THE SAME
				if($this->input->post('password') === $this->input->post('password1')){

					// TRANSFER INPUT NAME VALUE IN VARIABLES
					$fullname = $this->input->post('fullname');
					$username = $this->input->post('username');
					$email    = $this->input->post('email');
					$password = $this->input->post('password');

					// PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
					$data = array(
						'fullname'	=>$fullname,
						'username'	=>$username,
						'email'		=>$email,
						'password'	=>sha1($password),
						'status'	=>'1'
					);

					// LOAD MAIN MODEL
					$this->load->model('user_model');
					// CALL THE FUNCTION IN MAIN MODEL
					$this->user_model->insertuser($data);
					// MAKES AN ALERT 
					redirect(base_url('welcome/inserted'));
				}
				// IF NOT THE SAME: MAKE AN ERROR MESSAGES
				else{
					redirect(base_url('welcome/failed'));
				}
				
			}
		}
		
	}

	// ALERT FOR SUCCESSFULLY CREATED ACCOUNT
	public function inserted(){
		$this->index();
	}

	// ALERT FOR NOT MATCH PASSWORD
	public function failed(){
		$this->index();
	}

	// CALL VIEW LOGIN
	function login(){
		$this->load->view('login');
	}

	// LOGIN VERIFICATION
	function loginnow()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				// TRANSFER INPUT NAME VALUE IN VARIABLES
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$password = sha1($password);

				//LOAD MAIN MODEL
				$this->load->model('user_model');
				// CALL FUNCTION TO CHECK THE EMAIL AND PASSWORD
				// TRANSFER IN $status THE RETURN VALUE IN checkPassword 
				$status = $this->user_model->checkPassword($password,$email);

				// GO TO DASHBOARD VIEW IF STATEMENT IS TRUE
				if($status!=false){

					// TRANSFER THE DATABASE VALUE IN VARIABLES
					$username = $status->username;
					$email = $status->email;

					// STORE AS AN ARRAY IN $session_data  
					$session_data = array(
						'username'=>$username,
						'email' => $email,
					);

					// SET THE $session_data TO UserLoginSession
					$this->session->set_userdata('UserLoginSession',$session_data);

					// LINK TO Welcome/Dashboard.php
					redirect(base_url('welcome/dashboard'));
				}
				else {
					// MAKE AN ALERT FOR NOT MATCHING PASSWORD AND EMAIL
					redirect(base_url('welcome/validation'));
				}

			}
			else{
				// MAKE AN ALERT TO FILL UP THE FORM
				redirect(base_url('welcome/validation1'));
			}
		}
	}

	// ALERT FOR NOT MATCHING PASSWORD AND EMAIL
	function validation(){
		$this->login();
	}

	// ALERT TO FILL UP THE FORM
	function validation1(){
		$this->login();
	}

	// GO TO views/dashboard.php
	function dashboard(){
		$this->load->view('dashboard');
	}

	// LOGOUT
	function logout(){
		session_destroy();
		redirect(base_url('welcome/login'));
	}
}
