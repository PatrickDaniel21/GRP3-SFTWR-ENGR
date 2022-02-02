<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orgs extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
		$this->load->database();

        if(!$this->session->userdata('id'))
            return redirect('welcome');
        if($this->session->userdata('status') == '1')
            return redirect('admin');

    }
   public function index(){
        $orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('orgsreg_dashboard', $orgsreg);
   }

   public function createorg(){
        $this->load->view('createorg');
   }

    public function orgsprof(){
        $orgsPosts['data'] = $this->user_model->getOrgsPosts(); 
        $this->load->view('orgsprof',  $orgsPosts);
   }


   function registerNow(){
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
            $org_verification_key = md5(rand());
            $orgadmin_id = $this->session->userdata('id');

            $org_representative = $this->input->post('org_representative');
			$org_reptupid       = $this->input->post('org_reptupid');
			$org_name           = $this->input->post('org_name');
			$org_president      = $this->input->post('org_president');
            $org_contact       = $this->input->post('org_contact');
			$org_about           = $this->input->post('org_about');

            $data = array(
                'orgadmin_id'                   =>$orgadmin_id,
                'org_name'				        =>$org_name,
                'org_president'			        =>$org_president,
                'org_contact'                   =>$org_contact,
                'org_about'			            =>$org_about,
                'org_representative'			=>$org_representative,
                'org_reptupid'			        =>$org_reptupid,
                'org_status'                    => '0',
                'org_verification_key'          =>$org_verification_key,
            );

            if($this->user_model->registerNow($data)){
                redirect(base_url('user/success'));
            }
            else{
                redirect(base_url('user/failed'));
            }

		}
		
	}

    public function orgsprofile($org_id, $orgadmin_id){      
        redirect(base_url('orgs/orgsprof/'.$org_id.'/'.$orgadmin_id));
    }

    public function orgjoined($org_id){      
        redirect(base_url('orgs/orgjoin/'.$org_id));
    }

    public function orgjoin(){
        $orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('orgjoin', $orgsreg);
    }

    public function joinorgs($org_id){

        $orgmember_fullname   = $this->input->post('orgmember_fullname');
		$orgmember_section    = $this->input->post('orgmember_section');
		$orgmember_college    = $this->input->post('orgmember_college');
        $orgmember_id         = $this->session->userdata('id');
        $orgm_id              = $org_id;

		// PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
		$data = array(
			'orgmember_fullname'			=>$orgmember_fullname,
			'orgmember_section'			    =>$orgmember_section,
			'orgmember_college'				=>$orgmember_college,
            'orgmember_id'			        =>$orgmember_id,
			'orgm_id'				        =>$orgm_id,
		);

        $member = $this->user_model->joinorgs($data);

        if($member != ""){

            $subject = "Join Organization";

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
                                                    <center>Hi ".$this->input->post('org_name')." , I'd like to become a member of your organization. </center>
                                                </h1>

												<p>
                                                    <p><b>Here's my information</b></p>
													<p>Full Name: ".$this->input->post('orgmember_fullname')."</p>
													<p>Section: ".$this->input->post('orgmember_section')."</p>
													<p>College: ".$this->input->post('orgmember_college')."</p>
												</p>	
                                                
                                                <p style=\"display: flex; 
														justify-content: center; 
														margin-top: 10px;\">
	
													<center>
														<a href='".base_url()."orgs/verify_joined/". $orgmember_id.'/'.$orgm_id."'style=\"border: 1px solid #620E10; background-color: #3E090A; color: #fff; text-decoration: none; font-size: 16px; padding: 10px 20px; border-radius: 10px;\">
															
                                                            Add member

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
								'smtp_user'     => 'clikitstuff@gmail.com',
								'smtp_pass'		=> 'sbigavnmutuoikgo',
								'smtp_timeout'	=> '60',
								'mailtype' 		=> 'html',
								'charset'		=> 'iso-8859-1',
								'wordwrap'		=> 	TRUE
							);

							$this->email->initialize($config);
							$this->email->set_newline("\r\n");
							$this->email->from('clikitstuff@gmail.com','Clikit Admin');
							$this->email->to($this->input->post('org_contact'));
							$this->email->subject($subject);
							$this->email->message($message);

							if($this->email->send())
							{
								redirect(base_url('orgs/email'));
							}
							else{
								redirect(base_url('orgs/failedemail'));
							}


        }
    }

    function email(){
        $this->index();
    }
	function failedemail(){
        $this->index();
    }

    function verify_joined(){
		if($this->uri->segment(3)){
  			$orgmember_id = $this->uri->segment(3); 
            $orgm_id = $this->uri->segment(4); 

		  if($this->user_model->verify_joined($orgmember_id, $orgm_id))
		   {
			  $data['message'] = '1';
		   }
		   else
		   {
			  $data['message'] = '0';
		   }
		   $this->load->view('verify_joined', $data);
		}
	}

	public function contact(){
		$orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('contact', $orgsreg);
   }

   function sendcontact(){

	$subject = $this->input->post('subject');

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
							<center>Messages to ".$this->input->post('org_name')."</center>
						</h1>

						<p>
							<p>".$this->input->post('message')."</p>
						</p>
						
						<p>
							<p>Looking forward to hearing from you. <br>
							You can Email Me Here: ".$this->input->post('email')."</p>
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
		'smtp_user'     => 'clikitstuff@gmail.com',
		'smtp_pass'		=> 'sbigavnmutuoikgo',
		'smtp_timeout'	=> '60',
		'mailtype' 		=> 'html',
		'charset'		=> 'iso-8859-1',
		'wordwrap'		=> 	TRUE
	);

	$this->email->initialize($config);
	$this->email->set_newline("\r\n");
	$this->email->from('clikitstuff@gmail.com','Clikit Admin');
	$this->email->to($this->input->post('org_contact'));
	$this->email->subject($subject);
	$this->email->message($message);

	if($this->email->send())
	{
		
		$subject = "Contact Us Update";

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
								<center
									Contact Us Update
								</center>
							</h1>

							<p>	
								<h4>Hi,Thank you for contacting us, we have received your email and <br>
								we'll be in touch as soon as possible.</h4>
								Your Email is Successfully Sent to: <br>
								Organization Name: ".$this->input->post('org_name')." <br>
								Organization Email: ".$this->input->post('org_contact')."<br><br>

								Your Subject: ".$this->input->post('subject')." <br>
								Your Messages: ".$this->input->post('message')." <br>


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
			'smtp_user'     => 'clikitstuff@gmail.com',
			'smtp_pass'		=> 'sbigavnmutuoikgo',
			'smtp_timeout'	=> '60',
			'mailtype' 		=> 'html',
			'charset'		=> 'iso-8859-1',
			'wordwrap'		=> 	TRUE
		);

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('clikitstuff@gmail.com','Clikit Admin');
		$this->email->to($this->input->post('email'));
		$this->email->subject($subject);
		$this->email->message($message);

		if($this->email->send())
		{
			
			redirect(base_url('orgs/emailcontact'));
		}
		else{
			redirect(base_url('orgs/failedemailcontact'));
		}

   } else{
		redirect(base_url('orgs/failedemailcontact'));
	}

   }

   function emailcontact(){
    	$this->index();
   }
   function failedemailcontact(){
        $this->index();
   }

   public function aboutus(){
	$this->load->view('aboutus');
}

}
