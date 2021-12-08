<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// WILL EXECUTE THIS CODE WHEN NEW OBJECT OF THIS CLASS HAS BEEN CREATED
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
		$this->load->database();
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
			$this->form_validation->set_rules('fullname','Full Name','required');
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
						'status'			=>'0'
					);

						$id = $this->user_model->insertuser($data);

						// SENT VERIFICATION
						if($id > 0){
							
							$subject = "Email Verification";

							$message = "
								<html>
									<body style=\"color: #000; 
												font-size: 16px; 
												text-decoration: none; 
												font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
												justify-content: center; 
												background-color: #F2E7E8;\">
										
										<div style=\"max-width: 600px; 
													margin: auto auto; 
													padding: 20px;\">
											
												
											<div style=\"font-size: 14px; 
														padding: 25px; 
														background-color: #E5CFD0;
														moz-border-radius: 10px; 
														-webkit-border-radius: 10px; 
														border-radius: 10px; 
														-khtml-border-radius: 10px;
														border-color: #7B1114; 
														border-width: 4px 1px; 
														border-style: solid;\">
								
												<h1 style=\"font-size: 22px;\">
													<center>Hi ".$this->input->post('fullname').", Thanks for your registration!</center>
												</h1>
												
												<center>
													<p><b>You're almost ready to start enjoying C.L.I.K.I.T.</b></p>
													<p>Please verify that your email address is ".$this->input->post('email')."<br> Simply click the button below to verify your email address.</p>
												</center>

												<p style=\"display: flex; 
														justify-content: center; 
														margin-top: 10px;\">

														
														
													<center>
														<a href='".base_url()."welcome/verify_email/". $verification_key."'   	 target=\"_blank\" style=\"border: 1px solid #620E10; background-color: #3E090A; color: #fff; text-decoration: none; font-size: 16px; padding: 10px 20px; border-radius: 10px;\">
															
																Verify email address

														</a>
													</center>
												</p>
												
											</div>
										</div>
									</body>
								</html>	
							";

							$config = array(
								'protocol'		=> 'smtp',
								'smtp_host'     => 'ssl://smtp.gmail.com',
								'smtp_port' 	=>  465,
								'smtp_user'     => 'clikit01@gmail.com',
								'smtp_pass'		=> 'kozqjgymkkoeecmo',
								'smtp_timeout'	=> '60',
								'mailtype' 		=> 'html',
								'charset'		=> 'iso-8859-1',
								'wordwrap'		=> 	TRUE
							);

							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('clikit01@gmail.com','Clikit Admin');
							$this->email->to($this->input->post('email'));
							$this->email->subject($subject);
							$this->email->message($message);

							if($this->email->send())
							{
								redirect(base_url('welcome/email'));
							}
							else{
								redirect(base_url('welcome/failed-email'));
							}
													 
						}
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


	// ALERT FOR NOT MATCH PASSWORD
	public function failed(){
		$this->index();
	}

	// ALERT FOR EMAIL
	public function email(){
		$this->index();
	}

	// ALERT FOR EMAIL
	public function failedemail(){
		$this->index();
	}

	// EMAIL VERIFICATION
	function verify_email(){
		if($this->uri->segment(3)){
  			$verification_key = $this->uri->segment(3); 

		    if($this->user_model->verify_email($verification_key))
		   {
			  $data['message'] = '1';
		   }
		   else
		   {
			  $data['message'] = '0';
		   }
		   $this->load->view('email_verification', $data);
		}
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

	// CALL VIEW FORGOT
	function forgot(){
		$this->load->view('forgot');
	}

	// FORGOT PASSWORD
	function forgotpassword(){

		if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('email','Email','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				// TRANSFER INPUT NAME VALUE IN VARIABLES
				$email = $this->input->post('email');

				// CALL FUNCTION TO CHECK THE EMAIL 
				// TRANSFER IN $status THE RETURN VALUE IN checkemail 
				$status = $this->user_model->checkemail($email);

				// SENT OTP CODE TO REST PASSWORD
				if( $status!=false){

					$generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					$code = substr(str_shuffle($generator), 0, 8);

					$status = $this->user_model->code_verification($email, $code);

					$subject = "Forgot Password";
					$message = "
						<html>
							<body style=\"color: #000; 
										font-size: 16px; 
										text-decoration: none; 
										font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
										justify-content: center; 
										background-color: #F2E7E8;\">
								
								<div style=\"max-width: 600px; 
											margin: auto auto; 
											padding: 20px;\">
									
										
									<div style=\"font-size: 14px; 
												padding: 25px; 
												background-color: #E5CFD0;
												moz-border-radius: 10px; 
												-webkit-border-radius: 10px; 
												border-radius: 10px; 
												-khtml-border-radius: 10px;
												border-color: #7B1114; 
												border-width: 4px 1px; 
												border-style: solid;\">
						
										<h1 style=\"font-size: 22px;\">
											<center>Verification Code</center>
										</h1>
			
										<p style=\"display: flex; 
												justify-content: center; 
												margin-top: 10px;\">	
											<center>
												<p style=\"border: 1px solid #620E10; background-color: #3E090A; color: #fff; text-decoration: none; font-size: 16px; padding: 10px 20px; border-radius: 10px;\">
													
														".$code."
												</p>
											</center>
										</p>
										
									</div>
								</div>
							</body>
						</html>	
					";
			
					$config = array(
						'protocol'		=> 'smtp',
						'smtp_host'     => 'ssl://smtp.gmail.com',
						'smtp_port' 	=>  465,
						'smtp_user'     => 'clikit01@gmail.com',
						'smtp_pass'		=> 'kozqjgymkkoeecmo',
						'smtp_timeout'	=> '60',
						'mailtype' 		=> 'html',
						'charset'		=> 'iso-8859-1',
						'wordwrap'		=> 	TRUE
					);
			
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('clikit01@gmail.com','Clikit Admin');
					$this->email->to($email);
					$this->email->subject($subject);
					$this->email->message($message);
			
					if($this->email->send())
					{
						redirect(base_url('welcome/otpsent'));
					}
					else{
						redirect(base_url('welcome/otpnotsent'));
					}
				}
				else {	
					// MAKE AN ALERT FOR NOT MATCHING EMAIL
					redirect(base_url('welcome/notemail'));
				}
				

			}
			else{
				// MAKE AN ALERT TO FILL UP THE FORM
				redirect(base_url('welcome/ferror'));
			}
		}
	}

	// ALERT FOR INCOMPELETE FORM
	function ferror(){
		$this->forgot();
	}

	// ALERT FOR NOT EMAIL NOT FOUND
	function notemail(){
		$this->forgot();
	}

	// ALERT WHEN SENT EMAIL
	function otpsent(){
		$this->load->view('otp');
	}

	// ALERT WHEN UNSENT EMAIL
	function otpnotsent(){
		$this->load->view('otp');
	}

	// CALL OTP VIEW
	function otp(){
		$this->load->view('otp');
	}

	function otpcode(){

		if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('code','Verification Code','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				// TRANSFER INPUT NAME VALUE IN VARIABLES
				$code = $this->input->post('code');

				$status = $this->user_model->find_code($code);

				// GO TO DASHBOARD VIEW IF STATEMENT IS TRUE
				if($status!=false){

					// TRANSFER THE DATABASE VALUE IN VARIABLES
					$username = $status->username;
					$email = $status->email;

					$this->user_model->reset_code($email, $username);

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
					// MAKE AN ALERT FOR NOT MATCHING CODE
					redirect(base_url('welcome/fcode'));
				}

			}
			else{
				// MAKE AN ALERT TO FILL UP THE FORM
				redirect(base_url('welcome/otperror'));
			}
		}		
	}

	// ALERT FOR INCOMPELETE FORM
	function fcode(){
		$this->otp();
	}

	// ALERT FOR WRONG CODE FORM
	function otperror(){
		$this->otp();
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
