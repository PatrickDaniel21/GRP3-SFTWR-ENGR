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

		// if($this->session->userdata('id') == '1')
        //     return redirect('admin');
        // else if($this->session->userdata('id') >'1')
        //     return redirect('user');
	}

	// LOAD THE MAIN VIEW
	public function index()
	{
		$this->load->view('home');
	}

	public function password_check($str)
	{
		if (!(preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str))) {
			redirect(base_url('welcome/password'));
		}
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
				$re = '/[a-zA-Z](@tup.edu.ph)/';
				$str = $this->input->post('email');

				if ( !preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0)){
					redirect(base_url('welcome/emailfailed'));
				}
				
				//CHECK IF THE ENTER PASSWORD IS THE SAME
				if($this->input->post('password') === $this->input->post('password1')){

					$this->form_validation->set_rules('password1', 'Password', 'required|min_length[8]|alpha_numeric');

					if(
						($this->form_validation->run()==TRUE) && 
					    (preg_match('#[0-9]#', $this->input->post('password1')) && 
					   	preg_match('#[a-zA-Z]#', $this->input->post('password1')))
					){
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
								
								$data = array(
									'email' => $this->input->post('email'),
									'fullname' => $this->input->post('fullname'),
									'verification_key' => $verification_key
								);
								$message = $this->load->view('email_registered',$data,true);

								$this->email->initialize($this->config->item('email'));
								$this->email->set_newline("\r\n");
								$this->email->from('clikitstuff@gmail.com','Clikit Admin');
								$this->email->to($this->input->post('email'));
								$this->email->subject($subject);
								$this->email->message($message);

								if($this->email->send())
								{
									redirect(base_url('welcome/email'));
								}
								else{
									redirect(base_url('welcome/failedemail'));
								}
														
							}
						}
						else{
							redirect(base_url('welcome/password'));
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

	public function password(){
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

	public function emailfailed(){
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
				$email    = $this->input->post('email');
				$password = $this->input->post('password');
				$password = sha1($password);

				// CALL FUNCTION TO CHECK THE EMAIL AND PASSWORD
				// TRANSFER IN $status THE RETURN VALUE IN checkPassword 
				$status1 = $this->user_model->checkPassword($password,$email);

				// GO TO DASHBOARD VIEW IF STATEMENT IS TRUE
				if($status1!=false){

					
						// TRANSFER THE DATABASE VALUE IN VARIABLES
						$id 	  = $status1->id;
						$username = $status1->username;
						$email 	  = $status1->email;
						$status   = $status1->status;
						$image   =  $status1->image;
						$fullname 	  = $status1->fullname;

						// STORE AS AN ARRAY IN $session_data  
						$session_data = array(
							'username' => $username,
							'email'    => $email,
							'id'	   => $id,
							'status'   => $status,	
							'image'    => $image,
							'fullname'    => $fullname,
						);

						// SET THE $session_data TO UserLoginSession
						$this->session->set_userdata($session_data);
						$status = $this->session->userdata('status');

					if($status1->rules_regulations == '1'){
						if($status == '1'){
							redirect('admin');
						}
						else{
							redirect('index.php/user');
						}
					}else{
						redirect(base_url('welcome/rules_regulations'));
					}
					
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

	function rules_regulations(){
		$this->load->view('rules_regulations');
	}

	function rules(){
		
		$id = $this->session->userdata('id');

		if($this->user_model->rules($id)){

				if($this->session->userdata('status') == '1'){
					redirect('admin');
				}
				else{
					redirect('index.php/user');
				}
		
			
		}
		else {
			// MAKE AN ALERT FOR NOT MATCHING PASSWORD AND EMAIL
			redirect(base_url('welcome/validation'));
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

					$data = array(
						'code' => $code,
					);
					$message = $this->load->view('email_forgot',$data,true);

					$this->email->initialize($this->config->item('email'));
					$this->email->set_newline("\r\n");
					$this->email->from('clikitstuff@gmail.com','Clikit Admin');
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
					$username 	= $status->username;
					$email 		= $status->email;
					$id 		= $status->id;
					$status 	= $status->status;

					$this->user_model->reset_code($email);

					// STORE AS AN ARRAY IN $session_data  
					$session_data = array(
						'username' => $username,
						'email'    => $email,
						'id'	   => $id,
						'status'   => $status,	
					);

					// SET THE $session_data TO UserLoginSession
					$this->session->set_userdata($session_data);

					// LINK TO Welcome/Dashboard.php
					redirect('welcome/changepass');
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

	public function changepass()
	{
		$this->load->view('changepass');
	}

	public function changepassvalue()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('password1','Password','required');
			$this->form_validation->set_rules('password2', 'Password', 'required|min_length[8]|alpha_numeric');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if(($this->form_validation->run()==TRUE) &&
				(preg_match('#[0-9]#', $this->input->post('password2')) && 
				preg_match('#[a-zA-Z]#', $this->input->post('password2')))
			
			)
			{
                if($this->input->post('password1') === $this->input->post('password2')){

                    $id = $this->session->userdata('id');
                    $password = sha1($this->input->post('password1'));

                    $status = $this->user_model->changepassvalue($password, $id);

                    if($status){
						$this->session->unset_userdata('id');
                        redirect(base_url('welcome/accept'));
                    }else{
						$this->session->unset_userdata('id');
                        redirect(base_url('welcome/notaccept'));     
                    }

                }else{
					
                    redirect(base_url('welcome/error'));   
                }

                
			}else{
				redirect(base_url('welcome/fferror'));
			}
		}
	}

	function error(){
		$this->changepass();
	}
	function fferror(){
		$this->changepass();
	}


	function accept(){
		$this->login();
	}

	function notaccept(){
		$this->login();
	}


	// ALERT FOR INCOMPELETE FORM
	function fcode(){
		$this->otp();
	}

	// ALERT FOR WRONG CODE FORM
	function otperror(){
		$this->otp();
	}

	// LOGOUT
	function logout(){
		$this->session->unset_userdata('id');
		redirect(base_url('welcome/login'));
	}

	
}
