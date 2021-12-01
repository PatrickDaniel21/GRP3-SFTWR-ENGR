<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// WILL EXECUTE THIS CODE WHEN NEW OBJECT OF THIS CLASS HAS BEEN CREATED
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('User_model');
	}

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
			$this->form_validation->set_rules('fullname','Full Name','required|alpha');
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('email','Email','required|valid_emails|is_unique[users.email]');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('password1','Confirm Password','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				//CHECK IF THE ENTER PASSWORD IS THE SAME
				if($this->input->post('password') === $this->input->post('password1')){

					// USED FOR EMAIL VERIFICATION
					$verification_key = md5(rand());

					// TRANSFER INPUT NAME VALUE IN VARIABLES
					$fullname = $this->input->post('fullname');
					$username = $this->input->post('username');
					$email    = $this->input->post('email');
					$password = $this->input->post('password');

					// PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
					$data = array(
						'fullname'			=>$fullname,
						'username'			=>$username,
						'email'				=>$email,
						'password'			=>sha1($password),
						'verification_key'  =>$verification_key,
						'status'			=>'1'
					);

					$id = $this->user_model->insertuser($data);

					// SENT VERIFICATION
						if($id > 0){
							$subject = "Please verify your email account";
							$message = "
								<p>Good Day,".$this->input->post('fullname')."</p>
								<p> This is email verification mail from C.L.I.K.I.T Login Register system. 
								For complete registration process and login into system. 
								Verify your email by click this <a href='".base_url()."welcome/verify_email/". $verification_key."'>link</a>.</p>
								<p>Once you click this link your email will be verified and you can login into system.</p>
								<p>Thanks</p>
							";
							$config = array(
								'protocol'		=> 'smtp',
								'smtp_host'     => 'smtpout.secureserver.net',
								'smtp_port' 	=>  80,
								'smtp_user'     => 'admin',
								'smtp_pass'		=> 'admin123',
								'mailtype' 		=> 'html',
								'charset'		=> 'iso-8859-1',
								'wordwrap'		=> 	TRUE

               


							);
													 
						}

					// MAKES AN ALERT 
					redirect(base_url('welcome/inserted'));
				}
				// IF NOT THE SAME: MAKE AN ERROR MESSAGES
				else{
					redirect(base_url('welcome/failed'));
				}
				
			}
			else{
				$this->index();
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
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				// TRANSFER INPUT NAME VALUE IN VARIABLES
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$password = sha1($password);

				// //LOAD MAIN MODEL
				// $this->load->model('user_model');

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
